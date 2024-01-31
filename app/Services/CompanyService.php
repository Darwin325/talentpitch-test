<?php

namespace App\Services;

use App\Models\Company;
use App\Services\Contracts\ICompanyService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

class CompanyService implements ICompanyService
{

    public function getAll(): LengthAwarePaginator
    {
        return Company::query()->paginate(10);
    }

    public function getById(string $id): Model|array
    {
        return Company::query()->findOrFail($id);
    }

    public function create(array $data): Model|array
    {
        return Company::query()->create($data);
    }

    public function update(string $id, array $data): Model|array|bool
    {
        $company = Company::query()->findOrFail($id);
        return tap($company)->update($data);
    }

    public function delete(int|string $id): bool|array|Model
    {
        $company = Company::query()->findOrFail($id);
        return tap($company)->delete();
    }
}