<?php

namespace App\Repositories;

use App\Interfaces\EmployeeRepositoryInterface;
use App\Models\Employees;


class EmployeeRepository implements EmployeeRepositoryInterface
{

    public function getAllEmployees()
    {
        return Employees::all();
    }

    public function deleteEmployee($employeeId)
    {
        return Employees::destroy($employeeId);
    }

    public function createEmployee(array $employeeDetails)
    {
        Employees::create($employeeDetails);
    }
}
