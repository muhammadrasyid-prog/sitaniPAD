<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'umar@arrofii.id'],
            [
                'name' => 'Umar Taufiq',
                'password' => Hash::make('password'),
                'is_super_admin' => true,
            ]
        );

        $adminBiasa = User::firstOrCreate(
            ['email' => 'pkk@arrofii.id'],
            [
                'name' => 'Ibu PKK (Admin)',
                'password' => Hash::make('password'),
                'is_super_admin' => false,
            ]
        );

        $this->call(DummyDataSeeder::class);
    }
}
