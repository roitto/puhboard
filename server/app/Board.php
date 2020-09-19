<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'url', 'url_short', 'description', 'icon', 'is_hidden',
    ];

    /**
     * Get the route for the given board.
     *
     * @return string
     */
    public function getRouteAttribute(): string
    {
        return route('board.show', $this->url);
    }
}
