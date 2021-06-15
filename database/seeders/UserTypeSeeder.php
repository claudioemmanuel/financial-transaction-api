<?php

namespace Database\Seeders;

use App\Models\UserType;
use Illuminate\Database\Seeder;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_type = [
            [
                'name'  => 'Common'
            ],
            [
                'name'  => 'Shopkeeper'
            ]
        ];

        foreach ($user_type as $key => $value) {

            UserType::create([
                'name' => $value['name']
            ]);
        }
    }
}
