<?php

describe('CompanyServiceTest', function () {
    beforeEach(function () {
        $this->programService = $this->app->make
        (\App\Services\Contracts\IProgramService::class);
        \Illuminate\Support\Facades\Artisan::call('migrate:fresh');
        \App\Models\User::factory(1)->create();
        \App\Models\Program::factory(3)->create();
    });

    it('should return programs', function () {
        $programs = $this->programService->getAll();
        // paginator instance
        $this->assertInstanceOf(\Illuminate\Contracts\Pagination\LengthAwarePaginator::class, $programs);
        // check if the challenge is in the paginator
        $this->assertModelExists($programs->first());
        // check if is a collection
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $programs->getCollection());
    });

    it('should create a program', function () {
        $countPrograms = \App\Models\Program::query()->count();
        $program = $this->programService->create([
            'title' => 'Test Program',
            'description' => "This is a test program",
            'start_date' => '2021-01-01',
            'end_date' => '2021-12-31',
            'user_id' => 1
        ]);
        $this->assertModelExists($program);
        $this->assertDatabaseCount(\App\Models\Program::class, $countPrograms + 1);
    });

    it('should update a program', function (
        \App\Models\Program $program, $newName
    ) {
        expect($program->title)->toBe($newName);
    })->with([
        [
            fn() => $this->programService->update(1, [
                'title' => 'Program updated',
            ]),
            'Program updated'
        ]
    ]);

    it('should throw an error if program does not exists in getById', function () {
        $this->assertThrows(
            fn() => $this->programService->getById('1000'),
            \Illuminate\Database\Eloquent\ModelNotFoundException::class
        );
    });

    it('should return a program by id', function () {
        $program = $this->programService->getById(1);
        $this->assertModelExists($program);
    });

    it('should throw an error if program does not exists in update', function () {
        $this->assertThrows(
            fn() => $this->programService->update('1000', [
                'title' => 'Updated Program',
            ]),
            \Illuminate\Database\Eloquent\ModelNotFoundException::class
        );
    });

    it('should throw an error if program does not exists in delete', function () {
        $this->assertThrows(
            fn() => $this->programService->delete('1000'),
            \Illuminate\Database\Eloquent\ModelNotFoundException::class
        );
    });

    it('should delete a program', function () {
        $countPrograms = \App\Models\Program::query()->count();
        $program = $this->programService->delete(1);
        $this->assertDatabaseCount(\App\Models\Program::class, $countPrograms - 1);
    });
});
