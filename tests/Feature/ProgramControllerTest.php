<?php

describe('ProgramController', function () {
    beforeEach(function () {
        $this->artisan('migrate:fresh');
        $this->artisan('db:seed');
    });

    it('should return a list of programs', function () {
        $response = $this->get('/api/programs');
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'data' => [
                        '*' => [
                            'id',
                            'title',
                            'description',
                            'start_date',
                            'end_date',
                            'created_at',
                            'updated_at',
                        ],
                    ]
                ],
            ]);
    });

    it('should return a max of 10 programs', function () {
        \App\Models\Program::factory(10)->create();
        $response = $this->get('/api/programs');
        expect(count($response->json('data.data')))->toBeLessThanOrEqual(10);
    });

    it('should return a program', function () {
        $response = $this->get('/api/programs/1');
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'title',
                    'description',
                    'start_date',
                    'end_date',
                    'created_at',
                    'updated_at',
                ],
            ]);
    });

    it('should throw a validation error if the data is invalid', function () {
        $response = $this->post('/api/programs', [
            'title' => 'New Program',
            'description' => '',
        ]);
        $response->assertStatus(422);
    });

    it('should create a program', function () {
        $response = $this->post('/api/programs', [
            'title' => 'New Program',
            'description' => 'This is a new program',
            'start_date' => '2021-01-01',
            'end_date' => '2021-12-31',
            'user_id' => 1,
        ]);
        $response->assertStatus(201)
            ->assertJson([
                'data' => [
                    'title' => 'New Program',
                    'description' => 'This is a new program',
                    'start_date' => '2021-01-01',
                    'end_date' => '2021-12-31',
                    'user_id' => 1,
                ],
            ]);
    });

    it('should update a program', function () {
        $response = $this->put('/api/programs/1', [
            'title' => 'Updated Program',
            'description' => 'This is an updated program',
            'start_date' => '2021-01-01',
            'end_date' => '2021-12-31',
        ]);
        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'title' => 'Updated Program',
                    'description' => 'This is an updated program',
                    'start_date' => '2021-01-01',
                    'end_date' => '2021-12-31',
                ],
            ]);
    });

    it('should delete a program', function () {
        $response = $this->delete('/api/programs/1');
        $response->assertStatus(200);
    });
});
