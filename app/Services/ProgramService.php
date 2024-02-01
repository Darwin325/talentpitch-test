<?php

namespace App\Services;

use App\Models\Program;
use App\Services\Contracts\IProgramService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

class ProgramService implements IProgramService
{

    public function getAll(): LengthAwarePaginator
    {
        return Program::query()->paginate(10);
    }

    public function getById(string $id): Model|array
    {
        return Program::query()->findOrFail($id);
    }

    public function create(array $data): Model|array
    {
        return Program::query()->create($data);
    }

    public function update(string $id, array $data): Model|array|bool
    {
        $program = Program::query()->findOrFail($id);
        return tap($program)->update($data);
    }

    public function delete(int|string $id): bool|array|Model
    {
        $program = Program::query()->findOrFail($id);
        return tap($program)->delete();
    }
}