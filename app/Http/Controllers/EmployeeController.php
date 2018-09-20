<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;
use App\Http\Requests\EmployeeRequest;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $data = Employee::select()
            ->orderBy($request->get('order') ?: 'nome')
            ->paginate($request->get('limit') ?: 15);

        return response()->json($data);
    }

    public function store(EmployeeRequest $request)
    {
        return $this->save($request, new Employee());
    }

    public function show(Employee $employee)
    {
        return response()->json($employee, $employee->wasRecentlyCreated ? 201 : 200);
    }

    public function update(EmployeeRequest $request, Employee $employee)
    {
        return $this->save($request, $employee);
    }

    private function save(EmployeeRequest $request, Employee $employee)
    {
        $employee->fullName = $request->json('fullName');
        $employee->brCpf = $request->json('brCpf');
        $employee->email = $request->json('email');
        $employee->telephoneType = $request->json('telephoneType');
        $employee->telephone = $request->json('telephone');
        $employee->zipCode = $request->json('zipCode');
        $employee->city = $request->json('city');
        $employee->state = $request->json('state');
        $employee->avenue = $request->json('avenue');
        $employee->number = $request->json('number');
        $employee->neighborhood = $request->json('neighborhood');
        $employee->password = $request->json('password');
        $employee->save();

        return $this->show($employee);
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return response()->json(null, 204);
    }
}
