<?php

describe('CompanyController', function () {
    beforeEach(function () {
        $this->artisan('migrate:fresh');
        $this->artisan('db:seed');
    });

    it('should return a list of companies', function () {
        $response = $this->get('/api/companies');
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'data' => [
                        '*' => [
                            'id',
                            'name',
                            'email',
                            'website',
                            'user_id',
                            'created_at',
                            'updated_at',
                            'deleted_at',
                        ],
                    ],
                ],
            ]);
    });

    it('should return a max of 10 companies', function () {
        \App\Models\Company::factory(10)->create();
        $response = $this->get('/api/companies');
        expect(count($response->json('data.data')))->toBeLessThanOrEqual(10);
    });

    it('should return a company', function () {
        $response = $this->get('/api/companies/1');
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'email',
                    'website',
                    'user_id',
                    'created_at',
                    'updated_at',
                    'deleted_at',
                ],
            ]);
    });

    it('should throw a validation error if the data is invalid', function () {
        $response = $this->post('/api/companies', [
            'name' => 'New Company',
            'email' => '',
        ]);
        $response->assertStatus(422);
    });

    it('should create a company', function () {
        $response = $this->post('/api/companies', [
            'name' => 'New Company',
            'email' => 'newcompany@mail.com',
            'website' => 'http://newcompany.com',
            'user_id' => 1,
        ]);
        $response->assertStatus(201);

    });

    it('should update a company', function () {
        $response = $this->put('/api/companies/1', [
            'name' => 'Updated Company',
        ]);
        $response->assertStatus(200);
    });

    it('should delete a company', function () {
        $response = $this->delete('/api/companies/1');
        $response->assertStatus(200);
    });
});
