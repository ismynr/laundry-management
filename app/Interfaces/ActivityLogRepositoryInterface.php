<?php

namespace App\Interfaces;

interface ActivityLogRepositoryInterface
{
    public function getAllLatest();

    public function getAllLatestLimit($limit);

    public function getById($id);
}