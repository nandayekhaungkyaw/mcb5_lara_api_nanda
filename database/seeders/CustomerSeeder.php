<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
use Faker\Guesser\Name;
use Illuminate\Support\Str;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {


$myanmarNames = [
    'Aung Aung',
    'Kyaw Kyaw',
    'Min Min',
    'Tun Tun',
    'Zaw Zaw',
    'Ko Ko',
    'Myo Myo',
    'Htet Htet',
    'Thiri Thant',
    'Nandar Hlaing',
];
$townships = [
    'Hlaing',
    'Sanchaung',
    'Kamayut',
    'Bahan',
    'Dagon',
    'Latha',
    'Ahlone',
];
$divisions = [
    'Yangon Region',
    'Mandalay Region',
    'Naypyidaw Union Territory',
    'Bago Region',
    'Ayeyarwady Region',
    'Magway Region',
    'Sagaing Region',
    'Tanintharyi Region',
    'Mon State',
    'Shan State',
];


for ($i = 1; $i <= 16; $i++) {
    Customer::create([
        'name' => $myanmarNames[array_rand($myanmarNames)],
        'birth' => now()->subYears(rand(18, 40))->subDays(rand(1, 365)),
        'email' => 'customer' . $i . '@example.com',
        'phone' => '09' . rand(100000000, 999999999),
        'township' => $townships[array_rand($townships)],

        'division' => $divisions[array_rand($divisions)],
        'user_id' => 1,
    ]);
}

    }
}
