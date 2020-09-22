<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrewMethod extends Model
{
    //
    protected $fillable = [
        'method'
    ];

    public function cafes()
    {
        return $this->belongsToMany(Cafe::class, 'cafes_brew_methods', 'brew_methods_id', 'cafes_id');
    }
}
