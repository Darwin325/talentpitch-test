<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProgramRequest;
use App\Services\Contracts\IProgramService;
use Illuminate\Http\Request;

class ProgramController extends ApiController
{
    public function __construct(
        private readonly IProgramService $programService
    )
    {
    }

    public function index()
    {
        return $this->successResponse(
            $this->programService->getAll()
        );
    }

    public function store(ProgramRequest $request)
    {
        return $this->successResponse(
            $this->programService->create($request->all()),
            "Program created successfully.",
            201
        );
    }

    public function show($id)
    {
        return $this->successResponse(
            $this->programService->getById($id)
        );
    }

    public function update(Request $request, $id)
    {
        return $this->successResponse(
            $this->programService->update($id, $request->all())
        );
    }

    public function destroy($id)
    {
        return $this->successResponse(
            $this->programService->delete($id)
        );
    }
}
