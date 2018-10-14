<?php

namespace App\Repositories;

use \App\Models\Rating;
use \App\Interfaces\IRatingRepository;


class RatingRepository extends GenericRepository implements IRatingRepository
{

    public function __construct(Rating $model)
    {
        $this->model = $model;
    }
}