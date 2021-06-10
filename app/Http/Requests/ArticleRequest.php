<?php



namespace App\Http\Requests;



use Illuminate\Foundation\Http\FormRequest;
use App\Models\Article;

class ArticleRequest extends FormRequest
{  

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        $article = Article::find($this->article);
        $rules = [
              'title'=>'required',
              'text'=>'required',
        ];

        if($this->method() == 'POST' || !is_null(request()->image)){
          $rules['image'] = 'required|image|mimes:jpeg,bmp,png,svg|max:2200';
        }

        if($this->method() == 'PUT'){
          $rules['slug'] = 'unique:articles,slug,'.$article->id;        }

        return $rules;        

    }



    public function messages(){
      
        return [
          'image.required'=>'La imagen es requerida',
          'image.mimes'=>'La imagen debe ser un archivo de tipo: :values',
          'image.image'=>'El archivo debe ser una imagen',
          'image.max'=>'El archivo (imagen ES) debe pesar máximo 2 MB',
          'title.required'=>'El título es requerido',
          'text.required'=>'El contenido es requerido',
          'slug.unique'=>'La URL amigable debe ser única',
        ];

    }



   

}

