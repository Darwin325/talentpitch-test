<?php

describe('UserTestService', function () {

    beforeEach(function () {
       $this->userService = $this->app->make(\App\Services\Contracts\IUserService::class);
         \Illuminate\Support\Facades\Artisan::call('migrate:refresh');
         \App\Models\User::factory()->create();
    });

    it('test get all users', function () {
        $users = $this->userService->getAll();
        // paginator instance
        $this->assertInstanceOf(\Illuminate\Contracts\Pagination\LengthAwarePaginator::class, $users);
        // check if the user is in the paginator
        $this->assertModelExists($users->first());
        // check if is a collection
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $users->getCollection());
    });

    it('test create user', function () {
        $countUsers = \App\Models\User::query()->count();
        $user = $this->userService->create([
            'name' => 'Test User',
            'email' => "mail@mail.com",
            'password' => '1234567'
        ]);
        $this->assertModelExists($user);
        $this->assertDatabaseCount(\App\Models\User::class, $countUsers + 1);
    });

    it('test get user by id do not exists', function () {
        $this->assertThrows(
            fn() => $this->userService->getById('1000'),
            \Illuminate\Database\Eloquent\ModelNotFoundException::class
        );
    });

    it('test get user by id', function () {
        $this->assertDatabaseCount(\App\Models\User::class, 1);
        $user = $this->userService->getById(1);
        $this->assertModelExists($user);
    });

    it('test update user do not exists', function () {
        $this->assertThrows(
            fn() => $this->userService->update('1000', [
                'name' => 'Test User Updated',
            ]),
            \Illuminate\Database\Eloquent\ModelNotFoundException::class
        );
    });

    it('test update user', function (\App\Models\User $user, $newName) {
        expect($user->name)->toBe($newName);
    })->with([
        [
            fn()=> $this->userService->update(1, [
                'name' => 'Test User Updated',
            ]),
            'Test User Updated'
        ]
    ]);

    it('test delete user do not exists', function () {
        $this->assertThrows(
            fn() => $this->userService->delete('1000'),
            \Illuminate\Database\Eloquent\ModelNotFoundException::class
        );
    });

    it('test delete user', function () {
        $countUsers = \App\Models\User::query()->count();
        $this->userService->delete(1);
        $this->assertDatabaseCount(\App\Models\User::class, $countUsers - 1);
    });
});
