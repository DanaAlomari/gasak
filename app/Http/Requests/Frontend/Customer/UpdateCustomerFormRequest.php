<?php

namespace App\Http\Requests\Frontend\Customer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateCustomerFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::guard('customers')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [

            'name_en'=>'required',
            'email'=>'required|email|unique:users,email,'.auth('customers')->user()->id,
            'phone'=>'required|unique:users,phone,'.auth('customers')->user()->id,
            'password'=>'confirmed',
            "profile_photo_path" => 'mimes:g3,gif,ief,jpeg,jpg,jpe,ktx,png,btif,sgi,svg,svgz,tiff,webp|max:4048',
        ];
    }
}
