<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    public function shows()
    {
        return $this->hasMany(Show::class);
    }
}
