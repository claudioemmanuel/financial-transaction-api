<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    public function getById(int $id);

    public function create(array $data);
}
