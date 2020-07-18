<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255',
              Rule::unique('users')->ignore(Auth::id())],
            'gender' => ['required', 'regex:/(男性|女性)/'],
            'avatar' => 'file|image|mimes:jpeg,png,jpg,gif|max:2048',
            'prefecture_id' => ['required', 'exists:prefectures,id'],
            'introduction' => 'max:1200',
        ];
    }

    public function messages()
    {
        return [
            'require' => '入力必須の項目です',
            'max'     => ':max文字以内で入力してください',
            'email'   => '正しいメールアドレスを入力してください',
            'email.unique'  => 'ご指定のメールアドレスは既に存在します',
        ];
    }
}
