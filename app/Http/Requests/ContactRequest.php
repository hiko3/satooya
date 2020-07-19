<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'type' => ['required', 'regex:/(里親の申し込み|質問・お問い合わせ)/'],
            'body' => 'required|max:5000',
        ];
    }

    public function messages()
    {
      return [
        'required' => '入力必須の項目です',
        'regex'    => '不正な入力です',
        'max' => ':max文字以内で入力してください',
      ];
    }
}
