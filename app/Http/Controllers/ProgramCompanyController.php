<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class ProgramCompanyController extends ApiController
{
    public function __construct()
    {
    }

    public function index(Request $request, Program $program)
    {
        return $this->successResponse(
            $program->with('companies')->first()
        );
    }

    public function store(Request $request, Program $program)
    {
        $request->validate([
            'company_id' => 'required|integer|exists:companies,id',
        ]);
        $program->companies()->attach($request->company_id);
        return $this->successResponse(
            $program->with('companies')->first()
        );
    }
}
