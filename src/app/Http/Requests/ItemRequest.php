<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'brand' => 'string|max:100',
            'price' => 'required|integer',
            'condition_id' => 'required',
            'category_id' => 'required',
        ];
    }

    public function messages(){
        return [
            'name.required' => '商品名を入力してください',
            'name.string' => '商品名を文字列で入力してください',
            'name.max' => '商品名は255文字以内としてださい',
            'brand.string' => 'ブランド名は文字列で入力してください',
            'brand.max' => 'ブランド名は100文字列としてください',
            'price.required' => '販売価格を入力してください',
            'price.integer' => '販売価格は数値で入力してください',
            'condition_id.required' => '商品の状態を選択してください',
            'category_id.required' => 'カテゴリを選択してください',
        ];
    }
}
