<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ItemTest extends TestCase
{
    public function testHello()
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $response = $this->get('/search');
        $response->assertStatus(200);

        

        

        $response = $this->get('/no_route');
        $response->assertStatus(404);
    }
}

