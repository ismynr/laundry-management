<?php

namespace App\Repositories;

use App\Interfaces\CustomerRepositoryInterface;
use App\Customer;

class CustomerRepository implements CustomerRepositoryInterface
{
    public function getAllLatest()
    {
        return Customer::latest()->get();
    }

    public function getAll()
    {
        return Customer::all();
    }

    public function getBy($column, $data){
        return Customer::where($column, $data)->get();
    }
    
    public function getById($id)
    {
        return Customer::find($id);
    }

    public function store(array $data)
    {
        return Customer::create($data);
    }

    public function update(array $data, $id)
    {
        return Customer::find($id)->update($data);
    }

    public function destroy($id)
    {
        return Customer::destroy($id);
    }
}