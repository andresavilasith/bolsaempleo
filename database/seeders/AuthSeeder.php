<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'document_id' => 1,
            'name' => 'user',
            'email' => 'user@user.com',
            'password' => '1234'
        ]);
        User::factory()->create([
            'document_id' => 2,
            'name' => 'user2',
            'email' => 'user2@user.com',
            'password' => '1234'
        ]);
        User::factory()->create([
            'document_id' => 2,
            'name' => 'user3',
            'email' => 'user3@user.com',
            'password' => '1234'
        ]);
    }
}
