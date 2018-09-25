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
            ->orderBy($request->get('order') ?: 'full_name')
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

    public function active(Employee $employee)
    {
        $employee->active = true;
        $employee->save();

        return response()->json($employee, 200);
    }

    public function inactive(Employee $employee)
    {
        $employee->active = false;
        $employee->save();

        return response()->json($employee, 200);
    }

    private function save(EmployeeRequest $request, Employee $employee)
    {
        // {
        // 	"fullName": "Igor Guastalla de Lima",
        // 	"brCpf": "06151516982",
        // 	"email": "limaguastallaigor@gmail.com",
        // 	"telephoneType": "COMERCIAL",
        // 	"telephone": "44999938455",
        // 	"zipCode": "87013-000",
        // 	"city": "Maringá",
        // 	"state": "Paraná",
        // 	"avenue": "Avenida Brasil",
        // 	"number": "3832",
        // 	"neighborhood": "Centro",
        //  "complement": "apto 302",
        // 	"password": "teste123"
        // }

        $employee->full_name = $request->json('full_name');
        $employee->br_cpf = $request->json('br_cpf');
        $employee->email = $request->json('email');
        $employee->telephone_type = $request->json('telephone_type');
        $employee->telephone = $request->json('telephone');
        $employee->zip_code = $request->json('zip_code');
        $employee->city = $request->json('city');
        $employee->state = $request->json('state');
        $employee->avenue = $request->json('avenue');
        $employee->number = $request->json('number');
        $employee->neighborhood = $request->json('neighborhood');
        $employee->complement = $request->json('complement');
        $employee->password = bcrypt($request->json('password'));
        $employee->active = true;
        $employee->save();

        return $this->show($employee);
    }

    public function destroy(EmployeeRequest $employee)
    {
        $employee->delete();

        return response()->json(null, 204);
    }
}
