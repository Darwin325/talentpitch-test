<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class ProgramUserController extends ApiController
{
    public function __construct()
    {
    }

    public function index(Request $request, Program $program)
    {
        return $this->successResponse(
            $program->with('users')->first()
        );
    }

    public function store(Request $request, Program $program)
    {
        $request->validate([
            'user_id' => 'required|integer|exists:companies,id',
        ]);
        $program->users()->attach($request->user_id);
        return $this->successResponse(
            $program->with('users')->first()
        );
    }
}
