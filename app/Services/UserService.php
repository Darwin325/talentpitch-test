<?php

namespace App\Services;

use App\Models\User;
use App\Services\Contracts\IUserService;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserService implements IUserService
{

    public function getAll(): LengthAwarePaginator
    {
        return User::query()->paginate(10);
    }

    public function getById(string | int $id): Model|array
    {
        return User::query()->findOrFail($id);
    }

    public function create(array $data): Model|array
    {
        return User::query()->create($data);
    }

    public function update(string $id, array $data): Model|array|bool
    {
        $user = User::query()->findOrFail($id);
        return tap($user)->update($data);
    }

    public function delete(int|string $id): bool|array|Model
    {
        $user = User::query()->findOrFail($id);
        return tap($user)->delete();
    }
}