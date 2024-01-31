<?php

use Illuminate\Testing\Fluent\AssertableJson;

describe('UserController', function () {

    beforeEach(function () {
        \Illuminate\Support\Facades\Artisan::call('migrate:refresh');
        \App\Models\User::factory(15)->create();
    });

    it('get users', function () {
        $response = $this->get('/api/users');
        $response->assertStatus(200);
        $response->assertJson(fn(AssertableJson $json) => (
        $json
            ->has('data', fn(AssertableJson $json) => (
            $json
                ->has('data')
                ->has('data.0', fn(AssertableJson $json) => (
                $json
                    ->hasAll([
                        'id', 'name',
                        'email', 'email_verified_at',
                        'created_at', 'updated_at'
                    ])
                    ->etc()
                ))
                ->has('current_page')
                ->etc()
            ))
            ->has('message')
            ->etc()

        ));
    });

    it("get max 10 users", function () {
        $response = $this->get('/api/users');
        $response->assertStatus(200);
        $response->assertJson(fn(AssertableJson $json) => (
        $json
            ->has('data', fn(AssertableJson $json) => (
            $json
                ->has('data', 10)
                ->etc()
            ))
            ->etc()
        ));
    });

    it('data validation store user', function () {
        $response = $this->post('/api/users', [
            'name' => 'John Doe',
            'email' => '',
        ]);
        expect($response->status())->toBe(422);
        $response->assertJson(fn(AssertableJson $json) => (
        $json
            ->has('message', fn(AssertableJson $json) => (
            $json
                ->has('email')
                ->etc()
            ))
            ->etc()
        ));
    });

    it('store user', function () {
        $response = $this->post('/api/users', [
            'name' => 'John Doe',
            'email' => 'mail@mail.com',
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);
        $response->assertStatus(201);
    });

    it('show user', function () {
        $response = $this->get('/api/users/1');
        $response->assertStatus(200);
        $response->assertJson(fn(AssertableJson $json) => (
        $json
            ->has('data', fn(AssertableJson $json) => (
            $json
                ->hasAll([
                    'id', 'name',
                    'email', 'email_verified_at',
                    'created_at', 'updated_at'
                ])
                ->etc()
            ))
            ->has('message')
            ->etc()
        ));
    });

    it('update user', function () {
        $response = $this->put('/api/users/1', [
            'name' => 'John Doe'
        ]);
        $response->assertStatus(200);
    });

    it('delete user', function () {
        $response = $this->delete('/api/users/1');
        $response->assertStatus(200);
    });
});
