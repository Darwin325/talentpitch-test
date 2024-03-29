<?php

use Illuminate\Database\Eloquent\Relations\MorphToMany;

describe('RelationsTest', function () {
    beforeEach(function () {
        $this->artisan('migrate:fresh');
        $this->artisan('db:seed');
    });

    it('Program model should have a morph relation with Challenge model', function () {
        $program = \App\Models\Program::factory()->create();
        expect($program->challenges())->toBeInstanceOf(MorphToMany::class);
    });

    it('Program model should have a morph relation with Company model', function () {
        $program = \App\Models\Program::factory()->create();
        expect($program->companies())->toBeInstanceOf(MorphToMany::class);
    });

    it('Challenge model should have a morph relation with Program model', function () {
        $challenge = \App\Models\Challenge::factory()->create();
        expect($challenge->programs())->toBeInstanceOf(MorphToMany::class);
    });

    it('Company model should have a morph relation with Program model', function () {
        $company = \App\Models\Company::factory()->create();
        expect($company->programs())->toBeInstanceOf(MorphToMany::class);
    });

    it('User model should have a morph relation with Program model', function () {
        $user = \App\Models\User::factory()->create();
        expect($user->programs())->toBeInstanceOf(MorphToMany::class);
    });

    it('Program model should have a morph relation with User model', function () {
        $program = \App\Models\Program::factory()->create();
        expect($program->users())->toBeInstanceOf(MorphToMany::class);
    });

    it('Program should add a challenge', function () {
        $program = \App\Models\Program::factory()->create();
        $challenge = \App\Models\Challenge::factory()->create();
        $program->challenges()->attach($challenge);
        $pivot = $program->challenges()->find($challenge->id)->pivot;
        expect($pivot->programable_id)->toBe($challenge->id);
    });

    it('Program should add a company', function () {
        $program = \App\Models\Program::factory()->create();
        $company = \App\Models\Company::factory()->create();
        $program->companies()->attach($company);
        $pivot = $program->companies()->find($company->id)->pivot;
        expect($pivot->programable_id)->toBe($company->id);
    });

    it('Challenge should add a program', function () {
        $challenge = \App\Models\Challenge::factory()->create();
        $program = \App\Models\Program::factory()->create();
        $challenge->programs()->attach($program);
        $pivot = $challenge->programs()->find($program->id)->pivot;
        expect($pivot->programable_id)->toBe($program->id);
    });

    it('Company should add a program', function () {
        $company = \App\Models\Company::factory()->create();
        $program = \App\Models\Program::factory()->create();
        $company->programs()->attach($program);
        $pivot = $company->programs()->find($program->id)->pivot;
        expect($pivot->programable_id)->toBe($program->id);
    });

    it('User should add a program', function () {
        $user = \App\Models\User::factory()->create();
        $program = \App\Models\Program::factory()->create();
        $user->programs()->attach($program);
        $pivot = $user->programs()->find($program->id)->pivot;
        expect($pivot->programable_id)->toBe($program->id);
    });

    it('Program should add a user', function () {
        $program = \App\Models\Program::factory()->create();
        $user = \App\Models\User::factory()->create();
        $program->users()->attach($user);
        $pivot = $program->users()->find($user->id)->pivot;
        expect($pivot->programable_id)->toBe($user->id);
    });
});
