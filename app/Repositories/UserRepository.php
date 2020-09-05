<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\User;

class UserRepository implements UserRepositoryInterface
{
    public function getAllLatest()
    {
        return User::latest()->get();
    }

    public function getAllLatestAdmin()
    {
        return User::where('role', 'admin')->latest()->get();
    }

    public function getAllLatestKaryawan()
    {
        return User::where('role', 'karyawan')->latest()->get();
    }

    public function getAll()
    {
        return User::all();
    }

    public function getBy($column, $data)
    {
        return User::where($column, $data)->get();
    }
    
    public function getById($id)
    {
        return User::with('karyawan')->find($id);
    }
    
    public function store(array $data)
    {
        return User::create($data);
    }

    public function update(array $data, $id)
    {
        return User::find($id)->update($data);
    }

    public function destroy($id)
    {
        return User::destroy($id);
    }
}