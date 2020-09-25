<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    protected $fillable = [
        'name',
    ];
    public $timestamps = false;
    public function cafes()
    {
        return $this->belongsToMany(Cafe::class, 'cafes_tags', 'tags_id', 'cafes_id');
    }
}
