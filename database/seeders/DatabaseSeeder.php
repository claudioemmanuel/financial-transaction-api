<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTypeSeeder::class);
        \App\Models\User::factory(2)->create();
        $this->call(ShopkeeperUserSeeder::class);
        $this->call(TransactionSeeder::class);
    }
}
