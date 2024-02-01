<?php

namespace App\Http\Controllers;

use App\utils\GptGenerator;
use Illuminate\Http\Request;

class AiGeneratorController extends ApiController
{
    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \Illuminate\Validation\ValidationException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function generable($table, GptGenerator $gpt)
    {

        \Illuminate\Support\Facades\Validator::make(
            ['table' => $table],
            ['table' => 'required|string|in:users,challenges,companies,programs']
        )->validated();

        // Generador de servicios dinámicos según en nombre de la tabla
        $callableServices = [
            'users' => app()->make(\App\Services\Contracts\IUserService::class),
            'challenges' => app()->make(\App\Services\Contracts\IChallengeService::class),
            'companies' => app()->make(\App\Services\Contracts\ICompanyService::class),
            'programs' => app()->make(\App\Services\Contracts\IProgramService::class),
        ];

        $data = $gpt->generator($table);
        return $this->successResponse($callableServices[$table]->create($data));
    }
}
