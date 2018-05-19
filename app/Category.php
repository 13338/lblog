<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    /**
     * Get the posts for the category.
     */
    public function posts()
    {
        return $this->hasMany('App\Post')->paginate(10);
    }
}
