<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Jesus',
                'email' => 'rigili27@gmail.com',
                'password' => 'asd123456',
            ],
        ];

        foreach ($users as $userData) {
            User::firstOrCreate(
                ['email' => $userData['email']], // condiciones
                [
                    'name' => $userData['name'],
                    'password' => Hash::make($userData['password']),
                ]
            );
        }
    }
}
