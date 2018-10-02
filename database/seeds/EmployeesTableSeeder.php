<?php

use App\Employee;
use App\TelephoneTypesEnum;
use Illuminate\Database\Seeder;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employee = new Employee();
        $employee->full_name = 'Pedro';
        $employee->br_cpf = '525.832.430-39';
        $employee->email = 'teste@gmail.com';
        $employee->telephone_type = TelephoneTypesEnum::COMERCIAL;
        $employee->telephone = '(44)99845-8452';
        $employee->zip_code = '81020-490';
        $employee->city = 'Curitiba';
        $employee->state = 'Paraná';
        $employee->avenue = 'Rua Cyro Correia Pereira';
        $employee->number = '5';
        $employee->neighborhood = 'Cidade Industrial';
        $employee->complement = 'apto 123';
        $employee->password = bcrypt('teste123');
        $employee->active = true;
        $employee->save();

        $employee2 = new Employee();
        $employee2->full_name = 'João';
        $employee2->br_cpf = '100.208.030-44';
        $employee2->email = 'joao@gmail.com';
        $employee2->telephone_type = TelephoneTypesEnum::RESIDENTIAL;
        $employee2->telephone = '(43)12345-1234';
        $employee2->zip_code = '82033-130';
        $employee2->city = 'Londrina';
        $employee2->state = 'Paraná';
        $employee2->avenue = 'Avenida Lagunas';
        $employee2->number = '22';
        $employee2->neighborhood = 'Zona 3';
        $employee2->password = bcrypt('teste321');
        $employee2->complement = 'Green house';
        $employee2->active = true;
        $employee2->save();
    }
}
