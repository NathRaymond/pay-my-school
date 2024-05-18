<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'John Doe',
            'account_number' => '808989123',
            'phone' => '0808989123',
            'email' => 'john@example.com',
            'address' => 'Oke-Ilewo Abk',
            'created_date' => '2020-10-16',
            'registeredby' => 'OGSG415984',
            'password' => bcrypt('password'),






        ]);
    }
}
