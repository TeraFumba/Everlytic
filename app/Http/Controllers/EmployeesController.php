<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\EmployeeRepositoryInterface;
use Illuminate\Support\Facades\Validator;

class EmployeesController extends Controller
{
    private EmployeeRepositoryInterface $employeeRepository;

    public function __construct( EmployeeRepositoryInterface $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    public function index()
    {
        $employees = $this->employeeRepository->getAllEmployees();

        return view('employees.index', ['employees' =>  $employees]);
    }

    public function store(Request $request)
    {
        // Validation
        $validator = Validator::make( $request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'position' => 'required',
            'email' => 'required|email|unique:employees',
        ]);

        // Return the message
        if($validator->fails()){
            return response()->json([
                'error' => true,
                'message' => $validator->errors()
            ]);
        }

        $employeeDetails = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'position' => $request->position,
            'email' => $request->email,
        ];

        $this->employeeRepository->createEmployee($employeeDetails);

        $sen['success'] = true;
        $sen['message'] = 'Successfully created';
        return \Response::json( $sen );
    }

    public function destroy(Request $request)
    {
        $employeeId = $request->route('id');

        $this->employeeRepository->deleteEmployee($employeeId);

        $sen['success'] = true;
        $sen['message'] = 'Successfully deleted';
        return \Response::json( $sen );
    }

}
