<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'board_id',
        'parent_post_id',
        'media_id',
        'title', 
        'content',
        'unique_identifier',
        'user_ip',
        'show_name',
        'show_filename',
        'is_shadow_banned',
        'bumped_at'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'bumped_at',
    ];

    /**
     * Get the route for the given board.
     *
     * @return string
     */
    public function getRouteAttribute(): string
    {
        return route('posts.show', $this->id);
    }

    /**
     * Has many child posts.
     */
    public function children()
    {
        return $this->hasMany(self::class, 'parent_post_id');
    }
}
