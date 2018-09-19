<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;
use App\Http\Requests\EmployeeRequest;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $data = Employee::select('id', 'nome')
            ->orderBy('nome')
            ->paginate($request->get('porPagina') ?: 15);

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
        $employee->nome = $request->json('nome');
        $employee->email = $request->json('email');
        $employee->observacao = $request->json('observacao');
        $employee->save();

        return $this->show($employee);
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return response()->json(null, 204);
    }
}
