<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title'           => 'required|max:100',
            'content'         => 'required|max:1000',
            'image'           => 'file|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tag_category_id' => 'required|exists:tag_categories,id,deleted_at,NULL',
            'prefecture_id'   => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required'                 => '入力必須の項目です',
            'max'                      => ':max文字以内で入力してください',
            'image'                    => '画像ファイル以外はアップロードできません',
            'exists'   => 'カテゴリーを選択してください',
        ];
    }
}
