<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class ProgramChallengeController extends ApiController
{
    public function __construct()
    {
    }

    public function index(Request $request, Program $program)
    {
        return $this->successResponse(
            $program->with('challenges')->first()
        );
    }

    public function store(Request $request, Program $program)
    {
        $request->validate([
            'challenge_id' => 'required|integer|exists:companies,id',
        ]);
        $program->challenges()->attach($request->challenge_id);
        return $this->successResponse(
            $program->with('challenges')->first()
        );
    }
}
