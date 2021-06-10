<?php

namespace App\Library;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class Uploader {
    /**

     * Receives the model instance

     * @var Model

     */

    private $model;
    /**

     * Receives the images attributes array

     * @var array

     */

    private $images;

    /**

     * Receives the other files array

     * @var array

     */

    private $otherFiles;

    function __construct($model) {

        $this->model = $model;

        $this->images = [];

        //$this->otherFiles = $this->model->getUploadableFiles();

        //$this->processImagesFields();

    }

    public function uploadFiles() {
        if ($this->model->id) {
            $this->validateFiles();
        } else {
            if ($this->hasFilesRequired()) {
                $this->validateFiles();
            } else {
                return true;
            }
        }

        $uploadableFiles = $this->model->getUploadableFiles();
        foreach ($uploadableFiles as $field => $item) {
            $file = request()->file($field);     
            $folder = $item['folder'];
            $hash = $item['hash'] ?? false;
            if (!$this->model->id) {
                if (!empty($file)) {
                    //$this->model->{$field} = $this->storeFile($item , $file);
                    $this->model->{$field} = \FlipUpload::save($file , $folder , $hash);
                }

            } else {
                if (request()->file($field)) {
                    Storage::disk('uploads')->delete($this->model->{$field});
                    $this->model->{$field} = \FlipUpload::save($file , $folder , $hash);
                }
            }
        }
    }



    private function hasFilesRequired() {

        $uploadableFiles = $this->model->getUploadableFiles();
        $hasRequired = false;
        foreach ($uploadableFiles as $field => $item) {
            if (strpos($item['rules'], 'required') !== FALSE) {
                $hasRequired = true;
                break;
            }
        }
        return $hasRequired;
    }



    private function validateFiles() {
        $uploadableFiles = $this->model->getUploadableFiles();
        foreach ($uploadableFiles as $field => $item) {
            if (isset($item['rules'])) {
                if (!$this->model->id) {
                    request()->validate([$field => $item['rules']]);
                } else {
                    if (request()->file($field)) {
                        request()->validate([$field => $item['rules']]);
                    }

                }

            }

        }

    }



    private function uploadImageFiles() {

        $this->verifyAllImageFieldsExistence();

        $this->uploadAllImageFiles();

    }

    private function processImagesFields() {

        $uploadableImages = $this->model->getUploadableImages();
        foreach ($uploadableImages as $key => $attributes) {

            // Verify if the image has an array with sizes attributes or only a string with the field name

            if (!is_array($attributes)) {

                $this->images[$attributes] = $this->setImageSizes([]);

            } else {

                $this->images[$key] = $this->setImageSizes($attributes);

            }

        }

    }

    private function setImageSizes($sizes) {

        foreach ($this->model->getImageDefaultSizes() as $sizeDescription => $size) {

            if (!isset($sizes[$sizeDescription])) {

                $sizes[$sizeDescription] = $size;

            }

        }

        return $sizes;

    }

    private function verifyAllImageFieldsExistence() {

        foreach ($this->images as $imageFieldName => $attributes) {

            $this->verifyTableFieldExistent($imageFieldName);

        }

    }

    private function verifyAllOtherFilesFieldsExistence() {

        foreach ($this->images as $imageFieldName => $attributes) {

            $this->verifyTableFieldExistent($imageFieldName);

        }

    }

    private function verifyTableFieldExistent($fileFieldName) {

        if (!Schema::hasColumn($this->model->getTable(), $fileFieldName)) {

            throw new \Exception("The " . $fileFieldName . " field is inexistent in the '" . $this->model->getTable()

                . "' table. Please verify and add this field to make file uploads", 1);

        }

    }

    private function uploadAllImageFiles() {

        foreach ($this->images as $imageFieldName => $attributes) {

            if (request()->hasFile($imageFieldName)) {

                $this->deleteImageFiles($imageFieldName);

                $this->uploadImage($imageFieldName, $attributes);

            }

        }

    }

    private function uploadImage($imageFieldName, $attributes) {

        $image = request()->file($imageFieldName);

        $imageData = ['image' => $image];

        foreach ($attributes as $sizeType => $size) {

            if ($this->imageSizeTypeEnabled($sizeType)) {

                $imageData['sizeType'] = $sizeType;

                $imageData['size'] = $size;

                $this->storeResizedImage($imageData);

            }

        }

        $this->model->{$imageFieldName} = $this->getImageBasePath($image, '{type}');

    }

    private function imageSizeTypeEnabled($sizeType) {

        $resizeTypes = $this->model->getImageResizeTypes();

        return (isset($resizeTypes[$sizeType])) ? $resizeTypes[$sizeType] : true;

    }

    private function storeResizedImage($imageData) {

        $image = $imageData['image'];

        $path = $this->getImageBasePath($image, $imageData['sizeType']);

        $imageResized = $this->getResizedImage($image, $imageData['size']);

        if (config('filesystems.default') == 's3') {

            $resource = $imageResized->stream()->detach();

            Storage::put($path, $resource);

        } else {

            Storage::put($path, $imageResized->encode());

        }

        return $path;

    }

    private function getImageBasePath($image, $suffix = '') {

        return $image->hashName('images/' . $this->getModelName() . '/' . $suffix);

    }

    /**

     * Get the model name.

     *

     * @return string

     */

    private function getModelName() {

        return (isset($this->model->uploadFolderName))

        ? $this->model->uploadFolderName

        : strtolower(str_plural((new \ReflectionClass($this->model))->getShortName()));

    }

    private function getResizedImage($image, $size) {

        /*$image = Image::make($image);

        if($size !== 'image_width') {

        $image->orientate();

        $image->resize($size, null, function ($constraint) {

        $constraint->aspectRatio();

        $constraint->upsize();

        });

        }*/

        return $image;

    }

    protected function uploadOtherFiles() {

        foreach ($this->otherFiles as $fileFieldName) {

            if (request()->hasFile($fileFieldName)) {

                $this->deleteFile($fileFieldName);

                $this->model->{$fileFieldName} = $this->uploadFile($fileFieldName);

            }

        }

    }

    public function deleteFiles() {



        $uploadableFiles = $this->model->getUploadableFiles();

        foreach ($uploadableFiles as $field => $item) {
            Storage::disk('uploads')->delete($this->model->{$field});

        }

    }

    private function deleteImageFiles($imageField) {

        Storage::delete([

            $this->getImageDatabasePath($imageField),

            $this->getImageDatabasePath($imageField, 'medium'),

            $this->getImageDatabasePath($imageField, 'thumb'),

        ]);

        $this->model->{$imageField} = null;

    }

    private function deleteFile($fileField) {

        Storage::delete($this->model->{$fileField});

        $this->model->{$fileField} = null;

    }

    private function uploadFile($fileFieldName) {

        $file = request()->file($fileFieldName);

        $path = 'files/' . $this->getModelName();

        return Storage::put($path, $file);

    }

    private function getImageDatabasePath($imageField, $type = 'normal') {

        $genericPath = $this->model->{$imageField};

        return str_replace('{type}', $type, $genericPath);

    }

    public function getImagePath($imageField, $type = 'normal') {

        $path = $this->getImageDatabasePath($imageField, $type);

        return Storage::url($path);

    }

    public function getFilePath($fileField) {

        return Storage::url($this->model->{$fileField});

    }

}