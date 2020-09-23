<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cafe extends Model
{
    //
    public function methods()
    {
        return $this->belongsToMany(BrewMethod::class, 'cafes_brew_methods', 'cafes_id', 'brew_methods_id');
    }
    public function company()
    {
        return $this->belongsTo(Company::class, 'companies_id', 'id');
    }
    public function images()
    {
        return $this->belongsToMany(Image::class, 'images_cafes', 'cafes_id', 'images_id');
    }
}
