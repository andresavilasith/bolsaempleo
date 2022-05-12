<?php

namespace Tests\Feature;

use App\Helpers\DefaultDataTest;
use App\Models\JobOffer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class JobOfferControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_job_offer_index()
    {
        $this->withoutExceptionHandling();

        DefaultDataTest::data_seed();

        $job_offers = JobOffer::all();

        $response = $this->get('/api/job_offer');

        $response->assertOk();

        $response->assertJsonStructure(['job_offers', 'status']);
    }

    /** @test */
    public function test_job_offer_show()
    {
        $this->withoutExceptionHandling();

        DefaultDataTest::data_seed();

        $user = User::first();

        $token = JWTAuth::fromUser($user);

        $job_offer = JobOffer::first();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('/api/job_offer/' . $job_offer->id );

        $response->assertOk();

        $response->assertJsonStructure(['job_offer', 'status']);
    }



    /** @test  */
    public function test_job_offer_store()
    {
        $this->withoutExceptionHandling();

        DefaultDataTest::data_seed();

        $user = User::first();

        $name = 'Oferta 1';
        $state = 'activo';

        $token = JWTAuth::fromUser($user);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('/api/job_offer', [
            'name' => $name,
            'state' => $state
        ]);

        $response->assertOk();

        $this->assertCount(21, JobOffer::all());

        $job_offer = JobOffer::latest('id')->first();

        $this->assertEquals($job_offer->name, $name);;
        $this->assertEquals($job_offer->state, $state);;

        $response->assertJsonStructure([
            'job_offer',
            'status',
            'message'
        ])->assertStatus(200);
    }


    /** @test */
    public function test_job_offer_update()
    {
        $this->withoutExceptionHandling();

        DefaultDataTest::data_seed();

        $user = User::first();

        $name = 'Oferta modificada';
        $state = 'inactivo';

        $token = JWTAuth::fromUser($user);

        $job_offer = JobOffer::first();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->put('/api/job_offer/' . $job_offer->id, [
            'name' => $name, 
            'state' => $state
        ]);

        $response->assertOk();

        $this->assertCount(20, JobOffer::all());

        $job_offer = $job_offer->fresh();

        $this->assertEquals($job_offer->name, $name);
        $this->assertEquals($job_offer->state, $state);


        $response->assertJsonStructure(['job_offer', 'status', 'message'])->assertStatus(200);
    }

    /** @test */
    public function test_job_offer_destroy()
    {
        $this->withoutExceptionHandling();

        DefaultDataTest::data_seed();

        $user = User::first();

        $token = JWTAuth::fromUser($user);

        $job_offer = JobOffer::first();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->delete('/api/job_offer/' . $job_offer->id);

        $response->assertOk();

        $job_offers = JobOffer::all();

        $this->assertCount(19, JobOffer::all());

        $response->assertJsonStructure(['job_offers', 'status', 'message'])->assertStatus(200);
    }
}
