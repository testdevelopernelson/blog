<?php



namespace App\Http\Requests;



use Illuminate\Foundation\Http\FormRequest;



class UserAdminRequest extends FormRequest {

    /**

     * Determine if the user is authorized to make this request.

     *

     * @return bool

     */

    public function authorize() {

        return true;

    }



    /**

     * Get the validation rules that apply to the request.

     *

     * @return array

     */

    public function rules() {



        $rules = [

            'name' => 'required',

            'email' => 'required',

        ];



        if($this->method() == 'POST' || !empty(request()->get('password'))){

          $rules['password'] = 'required|confirmed|min:6';

        }


        return $rules;



    }



    public function messages() {



        return [

            'name.required' => 'El nombre es requerido',

            'email.required' => 'El usuario es requerido',

            'password.required' => 'La contraseña es requerida',

            'password.confirmed' => 'Las contraseñas no coinciden',

            'password.min' => 'Las contraseña debe tener mínimo 6 caracteres',

            'percent.required' => 'El porcentaje es requerido',



        ];

    }



}

