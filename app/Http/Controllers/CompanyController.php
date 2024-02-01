<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Services\Contracts\ICompanyService;
use Illuminate\Http\Request;

class CompanyController extends ApiController
{
    public function __construct(
        public readonly ICompanyService $companyService
    )
    {
    }

    public function index()
    {
        return $this->successResponse(
            $this->companyService->getAll()
        );
    }

    public function show($id)
    {
        return $this->successResponse(
            $this->companyService->getById($id)
        );
    }

    public function store(CompanyRequest $request)
    {
        return $this->successResponse(
            $this->companyService->create($request->all()),
            "Company created successfully.",
            201
        );
    }

    public function update(Request $request, $id)
    {
        return $this->successResponse(
            $this->companyService->update($id, $request->all())
        );
    }

    public function destroy($id)
    {
        return $this->successResponse(
            $this->companyService->delete($id)
        );
    }
}
