<?php

namespace Modules\Employee\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Employee\App\Repositories\EmployeeRepositoryInterface;
use Modules\Employee\App\Http\Requests\CreateEmployeeRequest;

class EmployeeController extends Controller
{
    protected $interface;

    public function __construct(EmployeeRepositoryInterface $EmployeeRepositoryInterface)
    {
        $this->interface = $EmployeeRepositoryInterface;
    }

    public function store(CreateEmployeeRequest $request)
    {
        $validatedData = $request->validated();
        $employee = $this->interface->store($validatedData);

        return response()->json([
            'message' => 'Employee added successfully',
            'employee' => $employee
        ], 201);
    }
}
