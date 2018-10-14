<?php

namespace App\Repositories;

use App\Models\Channel;
use App\Interfaces\IChannelRepository;

class ChannelRepository extends GenericRepository implements IChannelRepository
{
    public function __construct(Channel $model)
    {
        $this->model = $model;
    }
}