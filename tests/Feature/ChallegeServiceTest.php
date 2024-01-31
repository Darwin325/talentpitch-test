<?php

describe('ChallengeServiceTest', function () {
    beforeEach(function () {
        $this->challengeService = $this->app->make(\App\Services\Contracts\IChallengeService::class);
        \Illuminate\Support\Facades\Artisan::call('migrate:refresh');
        \App\Models\Challenge::factory(3)->create();
    });

    it('should return challenges', function () {
        $challenges = $this->challengeService->getAll();
        // paginator instance
        $this->assertInstanceOf(\Illuminate\Contracts\Pagination\LengthAwarePaginator::class, $challenges);
        // check if the challenge is in the paginator
        $this->assertModelExists($challenges->first());
        // check if is a collection
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $challenges->getCollection());
    });

    it('should create a challenge', function () {
        $countChallenges = \App\Models\Challenge::query()->count();
        $challenge = $this->challengeService->create([
            'name' => 'Test Challenge',
            'description' => "Test Description",
            'points' => 44
        ]);
        $this->assertModelExists($challenge);
        $this->assertDatabaseCount(\App\Models\Challenge::class, $countChallenges + 1);
    });

    it('should update a challenge', function (
        \App\Models\Challenge $challenge, $newName
    ) {
        expect($challenge->name)->toBe($newName);
    })->with([
        [
            fn() => $this->challengeService->update(1, [
                'name' => 'Updated Challenge',
            ]),
            'Updated Challenge'
        ]
    ]);

    it('should throw an error if challenge does not exists in getById', function () {
        $this->assertThrows(
            fn() => $this->challengeService->getById('1000'),
            \Illuminate\Database\Eloquent\ModelNotFoundException::class
        );
    });

    it('should return a challenge by id', function () {
        $challenge = $this->challengeService->getById(1);
        $this->assertModelExists($challenge);
    });

    it('should throw an error if challenge does not exists in update', function () {
        $this->assertThrows(
            fn() => $this->challengeService->update('1000', [
                'name' => 'Updated Challenge',
            ]),
            \Illuminate\Database\Eloquent\ModelNotFoundException::class
        );
    });

    it('should throw an error if challenge does not exists in delete', function () {
        $this->assertThrows(
            fn() => $this->challengeService->delete('1000', [
                'name' => 'Updated Challenge',
            ]),
            \Illuminate\Database\Eloquent\ModelNotFoundException::class
        );
    });

    it('should delete a challenge', function () {
        $challenge = $this->challengeService->delete(1);
        $this->assertSoftDeleted($challenge);
    });
});
