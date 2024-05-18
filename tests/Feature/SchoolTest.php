<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SchoolTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testCreatePost()
    {
        // Data to be sent in the request body
        $postData = [
                "name" => "Olalink Academy","email" => "agbenigaambali@gmail.com",
                "phone" => "09032367489","address"=> "sokori ,kemta ajibona street, Abk"
        ];

        // Make a POST request to the API endpoint with the data
        $response = $this->post('/api/create', $postData);

        // Assert that the response status code is 201 (Created)
        $response->assertStatus(201);

        // Optionally, you can assert specific JSON structure or data in the response
        // For example, if you expect the response to contain the created post data:
        $response->assertJson([
            'title' => 'New Post Title',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            // Add more fields as needed
        ]);
    }
}
