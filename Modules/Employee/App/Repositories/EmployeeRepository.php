<?php
namespace Modules\Employee\app\Repositories;

use Modules\Employee\App\Models\Employee;

class EmployeeRepository implements EmployeeRepositoryInterface
{

//Store An Employee
    public function create(array $data)
    {
        $salary = $data['monthly_salary_package'];
        $designation = $data['designation'];

        $tax = 0;
        if ($salary >= 150000) {
            $tax = $salary * 0.05; // 5% tax
        } elseif ($salary >= 100000) {
            $tax = $salary * 0.03; // 3% tax
        }

        // Bonus Calculate
        $bonus = 0;
        switch ($designation) {
            case 'Manager': $bonus = $salary * 0.05; break;
            case 'Senior': $bonus = $salary * 0.03; break;
            case 'Associate': $bonus = $salary * 0.01; break;
        }

        // Net Salary Calculate
        $netSalary = $salary - $tax;

        // Database Employee Record Create
        return Employee::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'designation' => $designation,
            'monthly_salary_package' => $salary,
            'monthly_tax_value' => $tax,
            'yearly_increasing_bonus' => $bonus,
            'monthly_net_salary' => $netSalary,
        ]);
    }
    /**
     * Get all employees.
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAll()
    {
        return Employee::latest()->paginate(10);
    }

    /**
     * Find an employee by ID.
     * @param int $id
     * @return Employee
     */
    public function find(int $id)
    {
        return Employee::findOrFail($id);
    }

    /**
     * Update an employee's data.
     * @param int $id
     * @param array $data
     * @return Employee
     */
    public function update(int $id, array $data)
    {
        $employee = $this->find($id);
        $updatedData = $data;

        // Salary or Designation Update also update calculation
        $recalculate = isset($data['monthly_salary_package']) || isset($data['designation']);

        if ($recalculate) {
//            If recalculate is true then update
            $salary = $data['monthly_salary_package'] ?? $employee->monthly_salary_package;
            $designation = $data['designation'] ?? $employee->designation;

            // Tax calculate
            $tax = 0;
            if ($salary >= 150000) {
                $tax = $salary * 0.05;
            } elseif ($salary >= 100000) {
                $tax = $salary * 0.03;
            }

            // Bonus Calculate
            $bonus = 0;
            switch ($designation) {
                case 'Manager': $bonus = $salary * 0.05; break;
                case 'Senior': $bonus = $salary * 0.03; break;
                case 'Associate': $bonus = $salary * 0.01; break;
            }

            $updatedData['monthly_tax_value'] = $tax;
            $updatedData['monthly_net_salary'] = $salary - $tax;
            $updatedData['yearly_increasing_bonus'] = $bonus;
        }

        $employee->update($updatedData);
        return $employee->fresh();
    }

//    Delete Employee
    /**
     * Delete an employee.
     * @param int $id
     * @return bool
     */
    public function delete(int $id)
    {
        return $this->find($id)->delete();
    }


//    Search Employee By Phone
    /**
     * Search employees by phone number.
     * @param string $phone
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function searchByPhone(string $phone)
    {
        return Employee::where('phone', 'like', '%' . $phone . '%')->get();
    }
}
