<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'color'];
    
    public function menuItems()
    {
        return $this->hasMany(MenuItem::class);
    }
}