<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\UserCustomerModel;

class SignupRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
            'form_email'=>['required', 'email' , 'unique:App\Models\UserCustomerModel,user_customer_email'],
            'form_name'=>['required','unique:App\Models\UserCustomerModel,user_customer_name'],
            'form_password'=>'required',

        ];
    }
    public function messages()
    {
        return[
            'required'=>':attribute không được để trống',
            'email'=>':attribute không đúng định dạng',
            'unique'=>':attribute đã tồn tại'
        ];
    }
    public function attributes()
    {
        return[
            'form_name'=>'Name',
            'form_email'=>'E-mail',
            'form_password'=>'Password',
        ];
    }
}
