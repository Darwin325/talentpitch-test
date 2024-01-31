<?php

namespace App\Services\Contracts;

use Illuminate\Database\Eloquent\Model;

interface IUserService
{
    public function getAll(): array;

    public function getById(string $id): Model|array;

    public function create(array $data): Model|array;

    public function update(string $id, array $data): Model|array|bool;

    public function delete(int|string $id): bool|array|Model;
}