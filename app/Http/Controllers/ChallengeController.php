<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChallengeRequest;
use App\Services\Contracts\IChallengeService;
use Illuminate\Http\Request;

class ChallengeController extends ApiController
{
    public function __construct(
        private readonly IChallengeService $challengeService
    )
    {
    }

    public function index()
    {
        return $this->successResponse(
            $this->challengeService->getAll()
        );
    }

    public function show($id)
    {
        return $this->successResponse(
            $this->challengeService->getById($id)
        );
    }

    public function store(ChallengeRequest $request)
    {
        return $this->successResponse(
            $this->challengeService->create($request->all()),
            "Challenge created successfully",
            201
        );
    }

    public function update(Request $request, $id)
    {
        return $this->successResponse(
            $this->challengeService->update($id, $request->all())
        );
    }

    public function destroy($id)
    {
        return $this->successResponse(
            $this->challengeService->delete($id),
        );
    }
}
