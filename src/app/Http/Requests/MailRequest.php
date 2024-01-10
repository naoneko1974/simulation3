<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MailRequest extends FormRequest
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
            'message' => 'required',
        ];
    }

    public function messages(){
        return [
            'name.required' => 'ユーザー名を入力してください',
            'name.max' => 'ユーザー名は255文字以内としてください',
            'message.required' => 'メッセージを入力してください',
        ];
    }
}
