<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class ShopkeeperUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('pt_BR');

        User::create([
            'name'          => $faker->name(),
            'email'         => $faker->unique()->safeEmail(),
            'cpf_cnpj'      => $faker->cnpj,
            'password'      => bcrypt('123456'),
            'wallet'        => 0,
            'user_type_id'  => 2
        ]);
    }
}
