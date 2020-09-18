<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //
    protected $fillable = ['type', 'path'];
    /**
     * 与用户表的1对多关联的反向（用户为1）
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
