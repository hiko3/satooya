<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'gender', 'prefecture_id', 'avatar', 'introduction', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // リレーション
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function prefecture()
    {
      return $this->belongsTo(Prefecture::class);
    }

    // リレーション
    public function favorites()
    {
        return $this->belongsToMany(Post::class, 'favorites', 'user_id', 'post_id');
    }


    /**
     * お気に入り登録
     *
     * @param [int] $postId
     * @return void
     */
    public function favorite($postId)
    {
        $exist = $this->is_favorite($postId);

        if (!$exist) {
            return $this->favorites()->attach($postId);
        }
    }

    /**
     * お気に入り解除
     *
     * @param [int]] $postId
     * @return void
     */
    public function unfavorite($postId)
    {
        $exist = $this->is_favorite($postId);

        if ($exist) {
            return $this->favorites()->detach($postId);
        }
    }


    /**
     * 既にお気に入り登録してるか
     *
     * @param [int] $postId
     * @return boolean
     */
    public function is_favorite($postId)
    {
        return $this->favorites()->where('post_id', $postId)->exists();
    }
}
