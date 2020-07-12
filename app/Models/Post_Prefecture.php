<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post_Prefecture extends Model
{
    protected $table = 'post_prefectures';

    protected $fillable = [
        'post_id',
        'prefecture_id',
    ];

    public function scopeSearchPrefecture($query, $prefectureId)
    {
        return $query->where('prefecture_id', $prefectureId);
    }
}
