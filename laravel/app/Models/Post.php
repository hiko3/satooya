<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id',
        'tag_category_id',
        'title',
        'content',
        'image',
        'gender',
        'recruit_status',
        'deadline_date',
    ];

    /** ページ表示数 */
    const PAGINATE_NUM = 21;

    public function tagCategory() {
        return $this->belongsTo(TagCategory::class);
    }

    // public function prefecture() {
    //     return $this->belongsTo(Prefecture::class);
    // }

    public function prefectures() {
        return $this->belongsToMany(Prefecture::class, 'post_prefectures', 'post_id', 'prefecture_id');
    }

    /**
     * カテゴリ検索
     *
     * @param mixed $query
     * @param int $categoryId
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearchCategory($query, $categoryId)
    {
        if (!empty($categoryId)) {
            return $query->where('tag_category_id', $categoryId);
        }
    }

    /**
     * 募集対象地域検索
     *
     * @param mixed $query
     * @param mixed $prefectureId
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearchPrefecture($query, $prefectureId)
    {
        // if (!empty($prefectureId)) {

        //     return $query->whereIn('prefecture_id', $prefectureId)
        //                 ->orWhereRaw("FIND_IN_SET(?, prefecture_id)", [$prefectureId]);
        // }
        // if (!empty($prefectureId)) {
        //     $query->whereHas('prefectures', function($query) use ($prefectureId) {
        //         return $query->where('prefecture_id', $prefectureId);
        //     });
        
    }



    /**
     * 募集状況検索
     *
     * @param mixed $query
     * @param string $recruitStatus
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearchRecruitState($query, $recruitStatus)
    {
        if (!empty($recruitStatus)) {
            return $query->where('recruit_status', $recruitStatus);
        }
    }

    /**
     * 性別検索
     *
     * @param mixed $query
     * @param string $gender
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearchGender($query, $gender)
    {
        if (!empty($gender)) {
            return $query->where('gender', $gender);
        }
    }

    public function scopeSearchKeyword($query, $keyword)
    {
        if (!empty($keyword)) {
            return $query->where('title', 'LIKE', '%'.$keyword.'%');
        }
    }

    /**
     * 募集一覧表示
     *
     * @param array $searches
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public function getIndexPost($searches)
    {
        return $this->searchCategory($searches['tag_category_id'] ?? '')
                    // ->searchPrefecture($searches['prefecture_id'] ?? '')
                    ->searchRecruitState($searches['recruit_status'] ?? '')
                    ->searchGender($searches['gender'] ?? '')
                    ->searchKeyword($searches['title'] ?? '');
                    // ->orderBy('updated_at', 'desc')
                    // ->paginate(self::PAGINATE_NUM);
    }
}
