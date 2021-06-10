<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    private $model = 'App\Models\Article';
    private $name = 'article';
    private $singular = 'Artículo';

    public function __construct() {
        View::share('name', strtolower($this->name));
        View::share('singular', $this->singular);
    }

    public function index() {      
        $records = $this->model::get();
        return view('admin.'.$this->name . '.index', compact('records'));
    }

    public function create() {
        return view('admin.'.$this->name . '.create');
    }

     public function store(ArticleRequest $request) {  
          $data = $request->all();  
          $object = $this->model::create($data);
          if (empty($object->slug)) {
               $object->slug = Str::slug($object->title, '-') . '-' . $object->id;
          } else{
            $object->slug = Str::slug($object->title, '-');
          }      
          $object->save();
          session()->flash('flash.success', 'Registro creado con éxito');
          return redirect()->route($this->name . '.index');
     }

     public function edit($id) {
          $record = $this->model::findOrFail($id);
          $back = route($this->name . '.index');
          return view('admin.'.$this->name . '.edit', compact('record', 'back'));

     }

    public function update(ArticleRequest $request, $id) {
        $object = $this->model::findOrFail($id);
        if (method_exists($object, 'getFieldsFiles')) {
            $object->fill($request->except($object->getFieldsFiles()));
        }else{
            $object->fill($request->all());
        }
        if (empty($object->slug)) {
           $object->slug = Str::slug($object->title, '-') . '-' . $object->id;
        }else{
          $object->slug = Str::slug($object->title, '-');
        } 
        $object->save();
        session()->flash('flash.success', 'Registro actualizado con éxito');
        return redirect($request->_back);
    }

    public function destroy($id) {
        $this->model::findOrFail($id)->delete();
        session()->flash('flash.success', 'El registro se eliminó con éxito');
        return redirect()->route($this->name . '.index');
    }

    public function published() {
        $data = request()->all();
        $record = $this->model::findOrFail($data['id']);
        $message = '';
        if ($data['status'] == 'true') {
            $message = 'Artículo publicado.';
            $record->published = 1;
        } else {
            $message = 'Artículo despublicado.';
            $record->published = 0;
        }

        $record->save();
        return response()->json(['status' => true , 'message'=> $message]);
    }
}
