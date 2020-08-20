<?php

namespace App\Repositories;

use App\Interfaces\PackageRepositoryInterface;
use App\Package;

class PackageRepository implements PackageRepositoryInterface
{
    public function getAllLatest()
    {
        return Package::latest()->get();
    }

    public function getAll()
    {
        return Package::all();
    }

    public function getBy($column, $data){
        return Package::where($column, $data)->get();
    }
    
    public function getById($id)
    {
        return Package::find($id);
    }

    public function store(array $data)
    {
        return Package::create($data);
    }

    public function update(array $data, $id)
    {
        return Package::find($id)->update($data);
    }

    public function destroy($id)
    {
        return Package::destroy($id);
    }
}