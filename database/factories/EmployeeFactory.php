<?php

use App\Models\Employee;
use Faker\Generator as Faker;
use Faker\Provider\pt_BR\Address AS BrazilianAddress;
use Faker\Provider\pt_BR\PhoneNumber;
use Faker\Provider\pt_BR\Person;

$factory->define(Employee::class, function (Faker $faker) {
    static $password;

    $faker->addProvider(new BrazilianAddress($faker));
    $faker->addProvider(new PhoneNumber($faker));
    $faker->addProvider(new Person($faker));
    $phone = '(' . $faker->areaCode . ')'. $faker->phone;

    return [
        'full_name' => $faker->name,
        'br_cpf' => $faker->cpf,
        'email' => $faker->unique()->safeEmail,
        'telephone_type' => $faker->randomElement(['COMERCIAL', 'RESIDENTIAL', 'CELLPHONE']),
        'telephone' => $phone,
        'zip_code' => $faker->postcode,
        'city' => $faker->city,
        'state' => $faker->state,
        'avenue' => $faker->streetName,
        'number' => ltrim($faker->buildingNumber, '0'),
        'neighborhood' => $faker->citySuffix,
        'complement' => $faker->text(10),
        'password' => $password ?: $password = bcrypt('teste123'),
        'active' => $faker->boolean(100),
        'remember_token' => str_random(10),
    ];
});
