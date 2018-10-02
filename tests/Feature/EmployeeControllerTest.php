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

    function jsonEmployeeStructure($employee)
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
