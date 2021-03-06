<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{
    public function getAllLatest();

    public function getAllLatestAdmin();

    public function getAllLatestKaryawan();

    public function getAll();

    public function getBy($column, $data);

    public function getById($id);

    public function store(array $data);

    public function update(array $data, $id);

    public function destroy($id);
}