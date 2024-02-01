<?php

describe('CompanyServiceTest', function () {
    beforeEach(function () {
        $this->companyService = $this->app->make
        (\App\Services\Contracts\ICompanyService::class);
        \Illuminate\Support\Facades\Artisan::call('migrate:fresh');
        \App\Models\User::factory(1)->create();
        \App\Models\Company::factory(3)->create();
    });

    it('should return companies', function () {
        $companies = $this->companyService->getAll();
        // paginator instance
        $this->assertInstanceOf(\Illuminate\Contracts\Pagination\LengthAwarePaginator::class, $companies);
        // check if the challenge is in the paginator
        $this->assertModelExists($companies->first());
        // check if is a collection
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $companies->getCollection());
    });

    it('should create a company', function () {
        $countCompanies = \App\Models\Company::query()->count();
        $company = $this->companyService->create([
            'name' => 'Test Company',
            'email' => "mycompany@mail.com",
            'website' => "https://mycompany.com",
            'user_id' => 1
        ]);
        $this->assertModelExists($company);
        $this->assertDatabaseCount(\App\Models\Company::class, $countCompanies + 1);
    });

    it('should update a company', function (
        \App\Models\Company $company, $newName
    ) {
        expect($company->name)->toBe($newName);
    })->with([
        [
            fn() => $this->companyService->update(1, [
                'name' => 'Updated Company',
            ]),
            'Updated Company'
        ]
    ]);

    it('should throw an error if company does not exists in getById', function () {
        $this->assertThrows(
            fn() => $this->companyService->getById('1000'),
            \Illuminate\Database\Eloquent\ModelNotFoundException::class
        );
    });

    it('should return a company by id', function () {
        $company = $this->companyService->getById(1);
        $this->assertModelExists($company);
    });

    it('should throw an error if company does not exists in update', function () {
        $this->assertThrows(
            fn() => $this->companyService->update('1000', [
                'name' => 'Updated Company',
            ]),
            \Illuminate\Database\Eloquent\ModelNotFoundException::class
        );
    });

    it('should throw an error if company does not exists in delete', function () {
        $this->assertThrows(
            fn() => $this->companyService->delete('1000', [
                'name' => 'Updated Company',
            ]),
            \Illuminate\Database\Eloquent\ModelNotFoundException::class
        );
    });

    it('should delete a company', function () {
        $company = $this->companyService->delete(1);
        $this->assertSoftDeleted($company);
    });
});
