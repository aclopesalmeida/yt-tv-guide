<?php

namespace App\Repositories;

use App\Models\Message;
use App\Interfaces\IMessageRepository;


class MessageRepository extends GenericRepository implements IMessageRepository
{

    public function __construct(Message $model)
    {
        $this->model = $model;
    }
}