<?php

namespace App\Services;

use App\Models\Challenge;
use App\Services\Contracts\IChallengeService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

class ChallengeService implements IChallengeService
{

    public function getAll(): LengthAwarePaginator
    {
        return Challenge::query()->paginate(10);
    }

    public function getById(string $id): Model|array
    {
        return Challenge::query()->findOrFail($id);
    }

    public function create(array $data): Model|array
    {
        return Challenge::query()->create($data);
    }

    public function update(string $id, array $data): Model|array|bool
    {
        $challenge = Challenge::query()->findOrFail($id);
        return tap($challenge)->update($data);
    }

    public function delete(int|string $id): bool|array|Model
    {
        $challenge = Challenge::query()->findOrFail($id);
        return tap($challenge)->delete();
    }
}