<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['user_id', 'show_id', 'body'];

    public function show()
    {
        return $this->belongsTo(Show::class);
    }

    public function user() 
    {
        return $this->belongsTo(User::class);
    }
}
