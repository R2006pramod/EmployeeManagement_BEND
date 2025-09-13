<?php
namespace Modules\Employee\app\Repositories;

interface EmployeeRepositoryInterface
{
// Store An Employee
    public function create(array $data);
//    Get All employees
    public function getAll();
//    find id to delete or update employee
    public function find(int $id);
//    update An Employee
    public function update(int $id, array $data);
//    delete an employee
    public function delete(int $id);
//    employee search by phone
    public function searchByPhone(string $phone);
}
