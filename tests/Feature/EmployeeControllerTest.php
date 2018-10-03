<?php

namespace Tests\Feature;

use App\Employee;
use Tests\AuthenticatedTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class EmployeeControllerTest extends AuthenticatedTestCase
{
    use DatabaseMigrations;

    /**
     * @var string $endpoint
     */
    private $endpoint = 'api/v1/backoffice/employee/';

    public function testResourceShowMethodMustReturnAnEmployeeData()
    {
        // We have 10 employees are created
        /** @var Employee $employees */
        $employees = factory(Employee::class, 10)->create();
        $first = $employees->first();

        // When we request the first one
        $response = $this->json('GET', $this->endpoint . $first->id);

        // It should return a valid, one employee json
        $response
            ->assertStatus(200)
            ->assertJson($this->jsonEmployeeStructure($first));
    }

    public function testResourceIndexMethodMustReturnAnEmployeeList()
    {
        // We have 10 employees are created
        /** @var Employee $employees */
        $employees = factory(Employee::class, 10)->create();

        // When we request the all of the employees
        $response = $this->json('GET', $this->endpoint);

        // It should return a valid, pagination employee json
        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'current_page',
                'data' => [
                    '*' => [
                        'id',
                        'full_name',
                        'br_cpf',
                        'email',
                        'telephone_type',
                        'telephone',
                        'zip_code',
                        'city',
                        'state',
                        'avenue',
                        'number',
                        'neighborhood',
                        'complement',
                        'active',
                        'updated_at',
                        'created_at',
                    ],
                ],
                'first_page_url',
                'from',
                'last_page',
                'last_page_url',
                'next_page_url',
                'path',
                'per_page',
                'prev_page_url',
                'to',
                'total',
            ]);
    }

    public function testMustCreateANewEmployee()
    {
        // We create one new employee and save it on the database
        $employee = factory(Employee::class)->create();

        // We create one new employee on memory
        $newEmployee = factory(Employee::class)->make()->toArray();

        // Find the last employee
        $findedEmployee = Employee::find($employee->id);
        $id = $findedEmployee ? $findedEmployee->id + 1 : 1;

        // When we save this new employee
        $newEmployee['password'] = 'teste123';
        $newEmployee['password_confirmation'] = 'teste123';
        $newEmployee['active'] = true;
        $response = $this->json('POST', $this->endpoint, $newEmployee);

        // It should return this valid json employee
        $response
            ->assertStatus(201)
            ->assertJson([
                'id' => $id,
                'full_name' => $newEmployee['full_name'],
                'br_cpf' => $newEmployee['br_cpf'],
                'email' => $newEmployee['email'],
                'telephone_type' => $newEmployee['telephone_type'],
                'telephone' => $newEmployee['telephone'],
                'zip_code' => $newEmployee['zip_code'],
                'city' => $newEmployee['city'],
                'state' => $newEmployee['state'],
                'avenue' => $newEmployee['avenue'],
                'number' => $newEmployee['number'],
                'neighborhood' => $newEmployee['neighborhood'],
                'complement' => $newEmployee['complement'],
                'active' => $newEmployee['active'],
            ])
            ->assertJsonStructure([
                'updated_at',
                'created_at',
            ]);
    }

    public function testUpdateAnEmployee()
    {
        // We create one new employee and save it on the database
        $employee = factory(Employee::class)->create();

        // We create one new employee on memory
        $employeeModified = factory(Employee::class)->make()->toArray();
        $employeeModified['password'] = 'teste123';
        $employeeModified['password_confirmation'] = 'teste123';

        // When we edit this employee
        $uri = $this->endpoint . $employee->id;
        $response = $this->json('PUT', $uri, $employeeModified);

        // And find the employee edited in the database
        $findedEmployee = Employee::find($employee->id)->toArray();

        // It should return this valid json employee, with the full_name changed
        $response
            ->assertStatus(200)
            ->assertJsonFragment($findedEmployee);
    }

    public function testMustDeleteAnEmployee()
    {
        // We create one new employee and save it on the database
        $employee = factory(Employee::class)->create();

        // When we delete this employee
        $uri = $this->endpoint . $employee->id;
        $response = $this->json('DELETE', $uri);

        // And then try to find it
        $employeeRemove = Employee::find($employee->id);

        // It should return nothing (null)
        $response->assertStatus(204);
        $this->assertEquals(null, $employeeRemove);
    }

    public function testMustActiveAnEmployee()
    {
        // We create one new employee and save it on the database
        $employee = factory(Employee::class)->create();

        // This employee is inactive
        $employee->active = false;

        // When we change this employee to active
        $uri = $this->endpoint . 'active/' . $employee->id;
        $response = $this->json('POST', $uri);

        // And then try to find it
        $employeeChanged = Employee::find($employee->id);

        // It should this valid json employee, with active = true
        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'active' => true,
            ]);

        $this->assertEquals(true, $employeeChanged->active);
    }

    public function testMustInactiveAnEmployee()
    {
        // We create one new employee and save it on the database
        $employee = factory(Employee::class)->create();

        // This employee is active
        $employee->active = true;

        // When we change this employee to inactive
        $uri = $this->endpoint . 'inactive/' . $employee->id;
        $response = $this->json('POST', $uri);

        // And then try to find it
        $employeeChanged = Employee::find($employee->id);

        // It should this valid json employee, with active = false
        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'active' => false,
            ]);

        $this->assertEquals(false, $employeeChanged->active);
    }

    private function jsonEmployeeStructure($employee)
    {
        return [
            'id' => $employee->id,
            'full_name' => $employee->full_name,
            'br_cpf' => $employee->br_cpf,
            'email' => $employee->email,
            'telephone_type' => $employee->telephone_type,
            'telephone' => $employee->telephone,
            'zip_code' => $employee->zip_code,
            'city' => $employee->city,
            'state' => $employee->state,
            'avenue' => $employee->avenue,
            'number' => $employee->number,
            'neighborhood' => $employee->neighborhood,
            'complement' => $employee->complement,
            'active' => $employee->active,
            'updated_at' => $employee->updated_at,
            'created_at' => $employee->created_at,
        ];
    }
}
