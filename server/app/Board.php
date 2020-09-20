<?php

namespace App;

use App\Post;
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

    /**
     * Has many posts.
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
