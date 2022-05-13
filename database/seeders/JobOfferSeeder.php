<?php

namespace Database\Seeders;

use App\Models\JobOffer;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobOfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=User::first();
        $user2=User::latest('id')->first();
        
        JobOffer::factory()->times(2000)->create();


        $jobs_offers=JobOffer::where('state','activo')->get();

        $users_jobs_all = [];

        foreach ($jobs_offers as $job_offer) {
            $users_jobs_all[] = $job_offer->id;
        }
        
        $user->job_offers()->sync($users_jobs_all);
        $user2->job_offers()->sync($users_jobs_all);
    }
}
