<?php

namespace App\Repositories;

use App\Interfaces\ExpanseRepositoryInterface;
use App\Expanse;

class ExpanseRepository implements ExpanseRepositoryInterface
{
    public function getAllLatest()
    {
        return Expanse::latest()->get();
    }

    public function getAll()
    {
        return Expanse::all();
    }

    public function getBy($column, $data){
        return Expanse::where($column, $data)->get();
    }
    
    public function getById($id)
    {
        return Expanse::find($id);
    }

    public function store(array $data)
    {
        return Expanse::create($data);
    }

    public function update(array $data, $id)
    {
        return Expanse::find($id)->update($data);
    }

    public function destroy($id)
    {
        return Expanse::destroy($id);
    }
}