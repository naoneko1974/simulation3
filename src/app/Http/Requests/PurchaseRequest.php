<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequest extends FormRequest
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
            'payment_id' => 'required',
            'postcode' => 'required|max:8|min:8',
            'address' => 'required|max:255',
            'building' => 'max:255',
        ];
    }

    public function messages(){
        return [
            'payment_id.required' => '支払い方法を選択してください',
            'postcode.required' => '郵便番号を入力してください',
            'postcode.min' => '郵便番号はハイフン入りの8桁で入力してください',
            'postcode.max' => '郵便番号はハイフン入りの8桁で入力してください',
            'address.required' => '住所を入力してください',
            'address.max' => '住所は255文字以内としてください',
            'building.max' => '建物名は255文字以内としてください',
        ];
    }
}
