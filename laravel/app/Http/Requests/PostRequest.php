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
            'gender'          => 'required|exists:posts',
            'recruit_status'  => 'required|exists:posts',
            'prefectures'     => 'required|exists:post_prefectures,prefecture_id',
            'deadline_date'   => 'required|date|before:1 years|after:today'
        ];
    }

    public function messages()
    {
        return [
            'required'                 => '入力必須の項目です',
            'max'                      => ':max文字以内で入力してください',
            'image'                    => '画像ファイル以外はアップロードできません',
            'exists'                   => '存在しない項目です',
            'before'                   => '1年以内の日付を入力してください',
            'after'                    => '明日以降の日付を入力してください'
        ];
    }
}
