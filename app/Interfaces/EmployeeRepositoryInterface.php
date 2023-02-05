<?php

namespace App\Interfaces;

interface EmployeeRepositoryInterface
{
    public function getAllEmployees();
    public function deleteEmployee($employeeId);
    public function createEmployee(array $employeeDetails);
}
