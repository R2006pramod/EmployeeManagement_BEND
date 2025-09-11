<?php
namespace Modules\Employee\App\Repositories;

use Modules\Employee\App\Models\Employee;
 // Step 1 දී සෑදූ Model එක මෙතනට import කරන්න

class EmployeeRepository implements EmployeeRepositoryInterface
{
    public function store(array $data)
    {
        $salary = $data['monthly_salary_package'];
        $designation = $data['designation'];

        // PDF එකට අනුව Tax ගණනය කිරීම
        $tax = 0;
        if ($salary >= 150000) {
            $tax = $salary * 0.05; // 5% tax
        } elseif ($salary >= 100000) {
            $tax = $salary * 0.03; // 3% tax
        }

        // PDF එකට අනුව Bonus ගණනය කිරීම
        $bonus = 0;
        switch ($designation) {
            case 'Manager': $bonus = $salary * 0.05; break;
            case 'Senior': $bonus = $salary * 0.03; break;
            case 'Associate': $bonus = $salary * 0.01; break;
        }

        // Net Salary ගණනය කිරීම
        $netSalary = $salary - $tax;

        // Database එකේ Employee record එක සෑදීම
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
}
