<?php

namespace App\Repositories;

use App\Interfaces\ServiceRepositoryInterface;
use App\Service;

class ServiceRepository implements ServiceRepositoryInterface
{
    public function getAllLatest()
    {
        return Service::latest()->get();
    }

    public function getAll()
    {
        return Service::all();
    }

    public function getBy($column, $data){
        return Service::where($column, $data)->get();
    }
    
    public function getById($id)
    {
        return Service::find($id);
    }

    public function store(array $data)
    {
        return Service::create($data);
    }

    public function update(array $data, $id)
    {
        return Service::find($id)->update($data);
    }

    public function destroy($id)
    {
        return Service::destroy($id);
    }

    public function searchServiceReq($data){
        return Service::whereRaw("(service_type LIKE '%".$data."%')")
                ->limit(30)
                ->get();
    }
}