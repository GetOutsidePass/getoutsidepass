<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    //
    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function passes()
    {
        return $this->belongsToMany(\App\Pass::class)->withTimestamps();
    }

}
