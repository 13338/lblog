<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];

    /**
     * Get the post's category.
     */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    function delete()
    {
        parent::delete();
    }
}
