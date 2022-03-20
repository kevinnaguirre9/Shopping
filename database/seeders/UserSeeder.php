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
        $AdminUsers = [
            [
                'citizen_card' => '0953665551',
                'first_name' => 'Kevin',
                'last_name' => 'Aguirre',
                'email' => 'kevinnaguirre9@gmail.com',
                'password' => '$2y$10$N6790koLA5RG9w5FApblC./nl0t.JYn5uzPAlyOg46JSoPKYHp5SW', // Powerlifting9
                'is_admin' => 1
            ],
            [
                'citizen_card' => '0987654321',
                'first_name' => 'Sergio',
                'last_name' => 'Diaz',
                'email' => 'codediaz@gmail.com',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'is_admin' => 1
            ],
        ];

        foreach($AdminUsers as $administrators) 
        {
            User::create($administrators);
        }
    }
}
