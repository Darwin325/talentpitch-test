<?php

use Illuminate\Testing\Fluent\AssertableJson;

describe('ChallengeController', function () {

    beforeEach(function () {
        $this->artisan('migrate:fresh');
        $this->artisan('db:seed');
    });

    it('should return a list of challenges', function () {
        $response = $this->get('/api/challenges');
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'data' => [
                        '*' => [
                            'id',
                            'name',
                            'description',
                            'points',
                            'user_id',
                            'created_at',
                            'updated_at',
                            'deleted_at',
                        ],
                    ],
                ],
            ]);
    });

    it('should return a max of 10 challenges', function () {
        \App\Models\Challenge::factory(10)->create();
        $response = $this->get('/api/challenges');
        expect(count($response->json('data.data')))->toBeLessThanOrEqual(10);
    });

    it('should return a challenge', function () {
        $response = $this->get('/api/challenges/1');
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'description',
                    'points',
                    'user_id',
                    'created_at',
                    'updated_at',
                    'deleted_at',
                ],
            ]);
    });

    it('should throw a validation error if the data is invalid', function () {
        $response = $this->post('/api/challenges', [
            'name' => 'New Challenge',
            'description' => 'Description of the new challenge',
            'points' => 100,
        ]);
        $response->assertStatus(422);
    });

    it('should create a new challenge', function () {
        $response = $this->post('/api/challenges', [
            'name' => 'New Challenge',
            'description' => 'Description of the new challenge',
            'points' => 100,
            'user_id' => 1,
        ]);
        $response->assertStatus(201);
    });

    it('should update a challenge', function () {
        $response = $this->put('/api/challenges/1', [
            'name' => 'Updated Challenge',
            'description' => 'Description of the updated challenge',
            'points' => 200,
            'user_id' => 1,
        ]);
        $response->assertStatus(200);
    });

    it('should delete a challenge', function () {
        $response = $this->delete('/api/challenges/1');
        $response->assertStatus(200);
    });
});