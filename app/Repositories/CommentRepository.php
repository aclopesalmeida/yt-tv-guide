<?php

namespace App\Repositories;

use App\Models\Comment;
use App\Interfaces\ICommentRepository;

class CommentRepository extends GenericRepository implements ICommentRepository
{
    public function __construct(Comment $model)
    {
        $this->model = $model;
    }
}