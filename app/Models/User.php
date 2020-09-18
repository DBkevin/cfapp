<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable  implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar', 'phone', 'introduction',  'weixin_openid', 'weixin_unionid', 'nick_name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'weixin_openid', 'weixin_unionid',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_bind_weixin' => 'boolean'
    ];
    /**
     * 返回userID
     *
     * @return void
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    /**
     * 返回的信息中额外附带的信息
     *
     * @return void
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
    /**
     * 与图片的1对多关联
     *
     * @return void
     */
    public function images()
    {
        return $this->belongsToMany(Image::class);
    }
}
