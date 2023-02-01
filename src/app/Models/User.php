<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
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
    // $fillableにカラム名を定義するとそれ以外のカラムを登録/更新でエラーを吐きます
    protected $fillable = [
        'screen_name',
        'name',
        'profile_image',
        'email',
        'password'
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
    ];

    public function followers() //フォロワーの情報を入手
    {
        //情報を得たい場所は、userテーブルなので、self::class
        //中間のテーブルとして、followersテーブルを使う
        //belongsToMany('関係するモデル', '中間テーブルのテーブル名', '中間テーブル内で対応しているID名', '関係するモデルで対応しているID名');
        return $this->belongsToMany(self::class, 'followers', 'followed_id', 'following_id');
    }

    public function follows()
    {
        return $this->belongsToMany(self::class, 'followers', 'following_id', 'followed_id');
    }

    public function getAllUsers(Int $user_id)
    {
        //where(引数1:検索したいカラムid,2:<>は「でない」,3:自分のidである$user_id)
        //usersのテーブルからidが自分のidである$user_idではないidを検索
        //paginate(5)はページごとに5個表示
        return $this->where('id', '<>', $user_id)->paginate(5);
    }

    // フォローする
    public function follow(Int $user_id)
    {
        return $this->follows()->attach($user_id);
    }

    // フォロー解除する
    public function unfollow(Int $user_id)
    {
        return $this->follows()->detach($user_id);
    }

    // フォローしているか
    public function isFollowing(Int $user_id)
    {
        return (boolean) $this->follows()->where('followed_id', $user_id)->first(['id']);
    }

    // フォローされているか
    public function isFollowed(Int $user_id)
    {
        return (boolean) $this->followers()->where('following_id', $user_id)->first(['id']);
    }

    //ユーザープロフィール編集
    public function updateProfile(Array $params)
    {
        if (isset($params['profile_image'])) {
            $file_name = $params['profile_image']->store('public/profile_image/');

            $this::where('id', $this->id)
                ->update([
                    'screen_name'   => $params['screen_name'],
                    'name'          => $params['name'],
                    'profile_image' => basename($file_name),
                    'email'         => $params['email'],
                ]);
        } else {
            $this::where('id', $this->id)
                ->update([
                    'screen_name'   => $params['screen_name'],
                    'name'          => $params['name'],
                    'email'         => $params['email'],
                ]);
        }

        return;
    }

    //add 2022/0620
    public function getAllFollows()
    {
        //where(引数1:検索したいカラムid,2:<>は「でない」,3:自分のidである$user_id)
        //usersのテーブルからidが自分のidである$user_idではないidを検索
        //paginate(5)はページごとに5個表示
        return $this->follows()->paginate(5);
    }

    public function getAllFollowers()
    {
        //where(引数1:検索したいカラムid,2:<>は「でない」,3:自分のidである$user_id)
        //usersのテーブルからidが自分のidである$user_idではないidを検索
        //paginate(5)はページごとに5個表示
        return $this->followers()->paginate(5);
    }
}
