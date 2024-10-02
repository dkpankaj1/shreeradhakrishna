<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'name' => 'admin',
            'email' => 'admin@email.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        \App\Models\Customer::create([
            'card'               =>'1234123412340001',
            'name'              => 'Aman Singh',
            'phone'             => '123456789',
            'payment_type'      => "UPI",
            'payment_detail'    => '9794445940@ybl'
        ]);
        \App\Models\Customer::create([
            'card'               =>'1234123412340002',
            'name'              => 'Dipankar Pankaj',
            'phone'             => '9919823355',
            'payment_type'      => "UPI",
            'payment_detail'    => '9794445940@ybl'
        ]);
        \App\Models\Customer::create([
            'card'               =>'1234123412340003',
            'name'              => 'Arvind Singh',
            'phone'             => '9784578457',
            'payment_type'      => "Google Pay",
            'payment_detail'    => '9784578457'
        ]);
        
    }
}
