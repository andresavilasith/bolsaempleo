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
        User::factory()->create([
            'document_id' => 2,
            'name' => 'user2',
            'email' => 'user2@user.com',
            'password' => '1234'
        ]);
        JobOffer::factory()->create([
            'name' => 'Laravel developer',
            'state' => 'activo',
        ]);

        $user=User::first();
        


        JobOffer::factory()->times(1999)->create();

        $jobs_offers=JobOffer::where('state','activo')->get();

        $users_jobs_all = [];

        foreach ($jobs_offers as $job_offer) {
            $users_jobs_all[] = $job_offer->id;
        }
        
        $user->job_offers()->sync($users_jobs_all);
    }
}
