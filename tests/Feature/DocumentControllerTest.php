<?php

namespace Tests\Feature;

use App\Helpers\DefaultDataTest;
use App\Models\Document;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class DocumentControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_get_all_documents_to_create_a_register()
    {
        $this->withoutExceptionHandling();

        DefaultDataTest::data_seed();

        $documents = Document::all();

        $response = $this->get('/api/document');

        $response->assertOk();

        $response->assertJsonStructure(['documents', 'status']);
    }

    /** @test */
    public function test_document_show()
    {
        $this->withoutExceptionHandling();

        DefaultDataTest::data_seed();

        $user = User::first();

        $token = JWTAuth::fromUser($user);

        $document = Document::first();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('/api/document/' . $document->id);

        $response->assertOk();

        $response->assertJsonStructure(['document', 'status']);
    }



    /** @test  */
    public function test_document_store()
    {
        $this->withoutExceptionHandling();

        DefaultDataTest::data_seed();

        $user = User::first();

        $name = 'Documento nuevo';

        $token = JWTAuth::fromUser($user);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('/api/document', [
            'name' => $name,
        ]);

        $response->assertOk();

        $this->assertCount(3, Document::all());

        $document = Document::latest('id')->first();

        $this->assertEquals($document->name, $name);;

        $response->assertJsonStructure([
            'document',
            'status',
            'message'
        ])->assertStatus(200);
    }


    /** @test */
    public function test_document_update()
    {
        $this->withoutExceptionHandling();

        DefaultDataTest::data_seed();

        $user = User::first();

        $name = 'Documento editado';

        $token = JWTAuth::fromUser($user);

        $document = Document::first();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->put('/api/document/' . $document->id, [
            'name' => $name
        ]);

        $response->assertOk();

        $this->assertCount(2, Document::all());

        $document = $document->fresh();

        $this->assertEquals($document->name, $name);


        $response->assertJsonStructure(['document', 'status', 'message'])->assertStatus(200);
    }

    /** @test */
    public function test_document_destroy()
    {
        $this->withoutExceptionHandling();

        DefaultDataTest::data_seed();

        $user = User::first();

        $token = JWTAuth::fromUser($user);

        $document = Document::first();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->delete('/api/document/' . $document->id);

        $response->assertOk();

        $documents = Document::all();

        $this->assertCount(1, Document::all());

        $response->assertJsonStructure(['documents', 'status', 'message'])->assertStatus(200);
    }
}
