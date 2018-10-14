<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Show extends Model
{

    protected $fillable = ['channel_id','youtube_id', 'name', 'rating', 'number_ratings', 'popularity'];

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function seasons()
    {
        return $this->hasMany(Season::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function comments()
    {
        return $this->hasMany(App\Models\Comment::class);
    }
}
