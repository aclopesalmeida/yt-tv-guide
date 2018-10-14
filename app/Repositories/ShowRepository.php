<?php

namespace App\Repositories;

use App\Models\Show;
use App\Interfaces\IShowRepository;

class ShowRepository extends GenericRepository implements IShowRepository
{
    public function __construct(Show $model)
    {
        $this->model = $model;
    }
}