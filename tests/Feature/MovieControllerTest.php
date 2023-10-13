<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Movie;
use Laravel\Sanctum\Sanctum;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MovieControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */


   use RefreshDatabase;

    public function testCreateResource()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['create']
        );

        $file = UploadedFile::fake()->image('test-image.jpg');
        $randomFloat = fake()->randomFloat(1, 0, 11);

        $response = $this->postJson(route('index'), [
            'title' => 'MOVIE A',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ut ante vehicula, fermentum nisi sit amet, convallis lacus. Maecenas eu lacus massa. 
                            Nam quis nibh ac felis sollicitudin ornare. Vestibulum orci ex, tincidunt ut augue a, 
                            varius tincidunt risus.',
            'rating' => $randomFloat,
            'image' => $file
        ]);

        $response->assertStatus(200);
    }

    public function testGetResource()
    {
        
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $file = UploadedFile::fake()->image('test-image.jpg');

        $data = Movie::factory()->create();

        $response = $this->get(route('index', $data));

        $response->assertStatus(200);
    }

    
    public function testShowResource()
    {
        
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $file = UploadedFile::fake()->image('test-image.jpg');

        $data = Movie::factory()->create();

        $response = $this->get("/api/movies/{$data->id}");

        $response->assertStatus(200);
    }



    public function testUpdateResource()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $data = Movie::factory()->create();

        $file = UploadedFile::fake()->image('test-image.jpg');
        $randomFloat = fake()->randomFloat(1, 0, 11);

        $updatedData = [
            'title' => 'Movie updated',
            'description' => 'Description of this movie is updated',
            'rating' => $randomFloat,
            'img' => $file
        ];

        $response = $this->patch("/api/movies/{$data->id}", $updatedData);

        $response->assertStatus(200);
    }

    public function testDeleteResource()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $data = Movie::factory()->create();

        $response = $this->delete(route('delete', $data));

        $response->assertStatus(200); 
    }


}
