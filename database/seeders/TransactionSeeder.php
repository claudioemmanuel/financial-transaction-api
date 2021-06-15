<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('pt_BR');

        Transaction::create([
            'user_id'   => 1,
            'payee_id'  => 2,
            'value'     => $faker->randomFloat(2, 0, 99999)
        ]);
    }
}
