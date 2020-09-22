<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
    protected $fillable = [
        'name', 'address', 'website', 'description'
    ];

    /**
     * 与用户模块的关联(1对多（反向）)
     *
     * @return void
     */
    public  function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * 与店铺模块的关联，1对多
     */
    public function cafes()
    {
        return $this->hasMany(Cafe::class);
    }
}
