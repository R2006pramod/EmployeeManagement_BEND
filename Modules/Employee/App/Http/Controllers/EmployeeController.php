<?php

namespace Modules\Employee\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Employee\App\Repositories\EmployeeRepositoryInterface;
use Modules\Employee\app\Http\Requests\UpdateEmployeeRequest;
use Modules\Employee\app\Http\Requests\CreateEmployeeRequest;

class EmployeeController extends Controller
{
    protected $employeeRepositoryInterface;

    public function __construct(EmployeeRepositoryInterface $employeeRepositoryInterface)
    {
        $this->employeeRepositoryInterface = $employeeRepositoryInterface;
    }


    /**
     * Display All Employees
     */
    public function index()
    {
        return $this->employeeRepositoryInterface->getAll();
    }

    /**
     * Update An Employee
     */
    public function update(UpdateEmployeeRequest $request, \Modules\Employee\App\Models\Employee $employee)
    {
        $updatedEmployee = $this->employeeRepositoryInterface->update($employee->id, $request->validated());

        return response()->json([
            'message' => 'Employee updated successfully',
            'employee' => $updatedEmployee
        ]);
    }

    /**
     * Remove An Employee
     */
    public function destroy(int $id)
    {
        $this->employeeRepositoryInterface->delete($id);
        return response()->json(['message' => 'Employee deleted successfully']);
    }

//    Store An Employee
    public function store(CreateEmployeeRequest $request)
    {
        $validatedData = $request->validated();
        $employee = $this->employeeRepositoryInterface->create($validatedData);

        return response()->json([
            'message' => 'Employee added successfully',
            'employee' => $employee
        ], 200);
    }

    /**
     * Search for employees by phone.
     */
    public function search(Request $request)
    {
        $request->validate(['phone' => 'required|string']);

        $employees = $this->employeeRepositoryInterface->searchByPhone($request->phone);
        return response()->json($employees);
    }
}
