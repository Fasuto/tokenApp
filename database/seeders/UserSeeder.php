<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
                'name' => "Fausto Cevallos",
                'email' => "fausto@email.com",
                'password' => bcrypt("c0!m6ZuoZK#t1EoPsRiq"),
                'profile' => 'admin'
        ]);

        User::create([
                'name' => "Juan Perez",
                'email' => "juan@email.com",
                'password' => bcrypt("8Fkgy%*O0x%VwkM1#wRR"),
                'profile' => 'user'
        ]);

        \App\Models\User::factory(50)->create();
    }
}
