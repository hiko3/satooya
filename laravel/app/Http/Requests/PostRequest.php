<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        $cateId = $this->input('tag_category_id');
        return [
            'title'           => 'required|max:100',
            'content'         => 'required|max:1000',
            'image'           => 'file|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tag_category_id' => 'required|exists:tag_categories,id,deleted_at,NULL',
            'sub_category_id' => [
                'required',
                Rule::exists('sub_categories', 'id')->where(function ($query) use ($cateId) {
                    $query->where('tag_category_id', $cateId);
                }),
            ],
            'gender'          => ['required', 'regex:/(オス|メス|不明)/'],
            'recruit_status'  => 'required|exists:posts',
            'prefectures'     => 'required|exists:prefectures,id',
            'deadline_date'   => 'required|date|before:1 years|after:today'
        ];
    }

    public function messages()
    {
        return [
            'required'  => '入力必須の項目です',
            'max'       => ':max文字以内で入力してください',
            'image'     => '画像ファイル以外はアップロードできません',
            'exists'    => '存在しない項目です',
            'regex'     => '不正な入力です',
            'before'    => '1年以内の日付を入力してください',
            'after'     => '明日以降の日付を入力してください'
        ];
    }
}
