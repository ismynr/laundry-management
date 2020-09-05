<?php

namespace App\Repositories;

use App\Interfaces\KaryawanRepositoryInterface;
use App\Karyawan;

class KaryawanRepository implements KaryawanRepositoryInterface
{
    public function getAllLatest()
    {
        return Karyawan::latest()->get();
    }

    public function getAll()
    {
        return Karyawan::all();
    }

    public function getBy($column, $data)
    {
        return Karyawan::where($column, $data)->get();
    }
    
    public function getById($id)
    {
        return Karyawan::find($id);
    }
    
    public function store(array $data)
    {
        return Karyawan::create($data);
    }

    public function update(array $data, $id)
    {
        return Karyawan::find($id)->update($data);
    }

    public function destroy($id)
    {
        return Karyawan::destroy($id);
    }
}