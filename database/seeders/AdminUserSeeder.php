<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'aromablendbd@gmail.com'],
            [
                'name' => 'Admin',
                'email' => 'aromablendbd@gmail.com',
                'password' => bcrypt('password'),
                'is_admin' => true,
            ]
        );
    }
}
