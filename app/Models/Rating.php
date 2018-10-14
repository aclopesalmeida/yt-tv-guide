<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = ['show_id', 'user_id', 'rating'];

    public function show()
    {
        return $this->belongsTo(Show::class, 'show_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
