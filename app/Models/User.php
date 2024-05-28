<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'user_name',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    
    public function microposts()
    {
        return $this->hasMany(Board::class);
    }

    /**
     * このユーザーがお気に入り登録しているポスト。（Boardモデルとの関係を定義）
     */
    public function favorites()
    {
        return $this->belongsToMany(Board::class, 'favorites', 'user_id', 'board_id')->withTimestamps();
    }
    
    /**
     * $boardIdで指定されたポストをお気に入り登録する。
     *
     * @param  int  $boardId
     * @return bool
     */
    public function favorite(int $boardId)
    {
        $exist = $this->is_favorites($boardId);
        $its_me = $this->id == $boardId;
        
        if ($exist || $its_me) {
            return false;
        } else {
            $this->favorites()->attach($boardId);
            return true;
        }
    }
    
    /**
     * $boardIdで指定されたポストを解除する。
     * 
     * @param  int $boardId
     * @return bool
     */
    public function unfavorite(int $boardId)
    {
        $exist = $this->is_favorites($boardId);
        $its_me = $this->id == $boardId;
        
        if ($exist && !$its_me) {
            $this->favorites()->detach($boardId);
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * 指定された$boardIdのポストをこのユーザーがお気に入り登録しているか調べる。登録中ならtrueを返す。
     * 
     * @param  int $boardId
     * @return bool
     */
    public function is_favorites(int $boardId)
    {
        return $this->favorites()->where('board_id', $boardId)->exists();
    }
    
    /**
     * このユーザーとフォロー中ユーザーの投稿に絞り込む。
     */
    public function feed_favoreites()
    {
        // このユーザーがフォロー中のユーザーのidを取得して配列にする
        $boardIds = $this->favorites()->pluck('board.message_id')->toArray();
        // それらのユーザーが所有する投稿に絞り込む
        return Board::whereIn('message_id', $boardIds);
    }
    
}
