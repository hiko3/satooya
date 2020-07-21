<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    protected $fillable = [
        'user_id',
        'tag_category_id',
        'sub_category_id',
        'title',
        'content',
        'image',
        'gender',
        'recruit_status',
        'deadline_date',
    ];

    /** ページ表示数 */
    const PAGINATE_NUM = 24;

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function tagCategory() {
        return $this->belongsTo(TagCategory::class);
    }

    public function subCategory() {
        return $this->belongsTo(SubCategory::class);
    }

    public function prefectures() 
    {
        return $this->belongsToMany(Prefecture::class, 'post_prefectures', 'post_id', 'prefecture_id');
    }

    public function favorites()
    {
        return $this->belongsToMany(User::class, 'favorites', 'post_id', 'user_id');
    }


    /**
     * 掲載期限日になったら、recruit_statusを募集終了に更新
     *
     * @return bool
     */
    public function updateStateByDeadline()
    {
      $posts = $this->all();
      $now = Carbon::now()->format('Y-m-d');
      foreach ($posts as $post) {
        if ($post->deadline_date < $now) {
          $post->recruit_status = "募集終了";
          $post->save();
        }
      }
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

    /**
     * キーワード検索
     *
     * @param Builder $query
     * @param mixed $keyword
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearchKeyword($query, $keyword)
    {
        if (!empty($keyword)) {
            return $query->where('title', 'LIKE', '%'.$keyword.'%')
                        ->orWhere('content', 'LIKE', '%'.$keyword.'%')
                        ->orWhereIn('posts.sub_category_id', function($query) use ($keyword) {
                            $query->select('id')
                                ->from('sub_categories')
                                ->where('name', 'LIKE', '%'.$keyword.'%');
                        });
        }
    }

    /**
     * ソート
     *
     * @param Builder $query
     * @param [type] $sort
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortPosts($query, $sort)
    {
        if ($sort === 'deadline') {
            return $query->orderBy('deadline_date', 'asc');
        } else {
            return $query->orderBy('created_at', 'desc');
        }
    }

    /**
     * 募集一覧表示
     *
     * @param array $searches
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public function getSearchIndexPost($searches, $prefectures)
    {
        if (!empty($prefectures)) {
            return $this->whereHas('prefectures', function($query) use ($prefectures) {
                            $query->whereIn('prefecture_id', $prefectures);
                        })
                        ->searchCategory($searches['tag_category_id'] ?? '')
                        ->searchRecruitState($searches['recruit_status'] ?? '')
                        ->searchGender($searches['gender'] ?? '')
                        ->searchKeyword($searches['title'] ?? '')
                        ->sortPosts($searches['sort'] ?? '')
                        ->with(['user', 'prefectures', 'subCategory',
                          'favorites' => function($query) {
                            $query->where('user_id', Auth::id());
                          }
                        ])
                        ->paginate(self::PAGINATE_NUM);
        } 
        else {
            return $this->searchCategory($searches['tag_category_id'] ?? '')
                        ->searchRecruitState($searches['recruit_status'] ?? '')
                        ->searchGender($searches['gender'] ?? '')
                        ->searchKeyword($searches['title'] ?? '')
                        ->sortPosts($searches['sort'] ?? '')
                        ->with(['user', 'prefectures', 'subCategory',
                          'favorites' => function($query) {
                            $query->where('user_id', Auth::id());
                          }
                        ])
                        ->paginate(self::PAGINATE_NUM);
        }
    }


}
