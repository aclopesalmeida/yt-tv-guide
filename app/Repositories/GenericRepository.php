<?php

namespace App\Repositories;

use App\Interfaces\IGenericRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class GenericRepository implements IGenericRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }


    protected function addJoins(Builder $query, array $relationships)
    {
   
            foreach($relationships as $relationship => $value)
             { 
                if( is_callable($value) )
                {
                    foreach($value as $k => $v)
                    {
                        dd($v);
                        $query = $query->with([$relationship => $v])->whereHas($relationship, $v);
                    }
                }
                else
                {
                    $query = $query->with($value);
                }
        }
        

        return $query;
    }


    public function addConstraints($query, array $constraints)
    {
        foreach($constraints as $k => $v)
        {
            $query = $query->where($k, $v);
        }

        return $query;
    }


    public function get(int $id, array $relationships = null)
    {
        $query = $this->model->where('id', $id);

        if(!is_null($relationships))
        {
            $query = $this->addJoins($query, $relationships);
        }

        return $query->first();
    }


    public function getAll(array $orderBy = null, int $take = null, array $constraints = null, array $relationships = null)
    {
        $query = $this->model;
        if(!is_null($orderBy)) 
        {
            $query = $query->orderBy($orderBy[0], $orderBy[1]);
        }

        if(!is_null($constraints))
        {
            $query = $this->addConstraints($query, $constraints);
        }

        if(!is_null($relationships))
        {
            $query = $this->addJoins($query, $relationships);
        }

        if(!is_null($take))
        {
            $query = $query->take($take);
        }

        return $query->get();
    }


    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function edit(int $id, array $data)
    {
        $this->model->find($id)->update($data);
        return $this->get($id);
    }

    public function delete(int $id)
    {
        $this->model->find($id)->delete();
    }
}