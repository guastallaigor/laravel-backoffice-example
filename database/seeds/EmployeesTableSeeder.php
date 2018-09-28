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
        $employee->full_name = 'Igor Guastalla de Lima';
        $employee->br_cpf = '061.515.169-82';
        $employee->email = 'limaguastallaigor@gmail.com';
        $employee->telephone_type = TelephoneTypesEnum::COMERCIAL;
        $employee->telephone = '(44)99993-8455';
        $employee->zip_code = '87013-000';
        $employee->city = 'Maringá';
        $employee->state = 'Paraná';
        $employee->avenue = 'Avenida Brasil';
        $employee->number = '3832';
        $employee->neighborhood = 'Centro';
        $employee->complement = 'apto xxx';
        $employee->password = bcrypt('teste123');
        $employee->active = true;
        $employee->save();

        $employee2 = new Employee();
        $employee2->full_name = 'João';
        $employee2->br_cpf = '666.666.666-66';
        $employee2->email = 'joao@gmail.com';
        $employee2->telephone_type = TelephoneTypesEnum::RESIDENTIAL;
        $employee2->telephone = '(43)12345-1234';
        $employee2->zip_code = '82033-130';
        $employee2->city = 'Londrina';
        $employee2->state = 'Paraná';
        $employee2->avenue = 'Avenida Lagunas';
        $employee2->number = '22';
        $employee2->neighborhood = 'Zona 3';
        $employee2->complement = 'Casa verde';
        $employee2->password = bcrypt('teste321');
        $employee2->active = true;
        $employee2->save();
    }
}
