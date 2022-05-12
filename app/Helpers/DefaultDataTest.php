<?php

namespace App\Helpers;

use App\Models\Document;
use App\Models\JobOffer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DefaultDataTest
{
    use RefreshDatabase;

    public static function data_seed()
    {
        Document::factory()->create([
            'name' => 'cedula',
        ]);
        Document::factory()->create([
            'name' => 'ruc',
        ]);


        User::factory()->create([
            'document_id' => 1,
            'name' => 'user',
            'email' => 'user@user.com',
            'password' => '1234'
        ]);


        JobOffer::factory()->times(20)->create();
    }
}
