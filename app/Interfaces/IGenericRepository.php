<?php

namespace App\Interfaces;

interface IGenericRepository 
{
    function get(int $id, array $relationships = null);
    function getAll(array $orderBy = null, int $take = null, array $constraints = null, array $relationships = null);
    function create(array $data);
    function edit(int $id, array $data);
    function delete(int $id);
}