<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'postcode' => 'max:8|min:8',
            'address' => 'max:255',
            'building' => 'max:255',
        ];
    }

    public function messages(){
        return [
            'name.required' => 'ユーザー名を入力してください',
            'name.max' => 'ユーザー名は255文字以内としてください',
            'postcode.min' => '郵便番号はハイフン入りの8桁で入力してください',
            'postcode.max' => '郵便番号はハイフン入りの8桁で入力してください',
            'address.max' => '住所は255文字以内としてください',
            'building.max' => '建物名は255文字以内としてください',
        ];
    }
}
