<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => '123@gmail.com'],
            [
                'name' => 'Admin',
                'email' => '123@gmail.com',
                'password' => bcrypt('123'),
                'is_admin' => true,
            ]
        );
    }
}
