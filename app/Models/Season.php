<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    public function show()
    {
        return $this->belongsTo(Show::class);
    }
}
