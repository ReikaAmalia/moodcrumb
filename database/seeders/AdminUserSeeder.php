<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            [
                'email' => 'admin@moodcrumb.test',
            ],
            [
                'name' => 'Admin MoodCrumb',
                'password' => 'password',
                'role' => UserRole::Admin,
            ]
        );
    }
}