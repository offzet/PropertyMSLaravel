<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class NormalUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Normal User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('jacinto220827'), 
            'user_type' => 'user',
            'email_verified_at' => now(),
        ]);

        $this->command->info('Normal user created successfully!');
        $this->command->info('Email: user@mail.com');
        $this->command->info('Password: jacinto220827');
    }
}