<?php

namespace Database\Seeders;

use App\Models\Application_Type;
use Illuminate\Database\Seeder;

class ApplicationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Application_Type::create([
            'name' => 'Loan',
            'commitmemt' => 1,
            'amount' => 500000,
            'administrative_fee' => 500000,
            'monitoring_fee' => 500000,
        ]);
        Application_Type::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => bcrypt('password'),
        ]);
    }
}
