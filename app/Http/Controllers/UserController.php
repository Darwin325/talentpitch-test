<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Services\Contracts\IUserService;
use Illuminate\Http\Request;

class UserController extends ApiController
{
    public function __construct(
        private readonly IUserService $userService
    )
    {
    }

    public function index()
    {
        return $this->successResponse($this->userService->getAll());
    }

    public function show(string $id)
    {
        return $this->successResponse($this->userService->getById($id));
    }

    public function store(UserRequest $request)
    {
        return $this->successResponse(
            $this->userService->create($request->all()),
            null,
            201
        );
    }

    public function update(Request $request, string $id)
    {
        return $this->successResponse(
            $this->userService->update($id, $request->all())
        );
    }

    public function destroy(string $id)
    {
        return $this->successResponse(
            $this->userService->delete($id)
        );
    }
}
