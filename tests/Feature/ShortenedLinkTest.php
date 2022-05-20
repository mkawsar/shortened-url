<?php

namespace Tests\Feature;

use App\Models\ShortLink;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShortenedLinkTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_url_list(): void
    {
        $this->json('GET', '/api/v1/short/link/list', [], ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                'current_page',
                'data',
                'first_page_url',
                'from',
                'last_page',
                'last_page_url',
                'links',
                'next_page_url',
                'path',
                'per_page',
                'prev_page_url',
                'to',
                'total'
            ]);
    }

    /**
     * @return void
     */
    public function test_required_field_for_url_create(): void
    {
        $data = [];

        $this->json('POST', '/api/v1/short/link/create', $data, ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJsonStructure([
                'data'
            ]);
    }

    /**
     * @return void
     */
    public function test_success_for_url_create(): void
    {
        $faker = \Faker\Factory::create();
        $data = [
            'link' => $faker->url()
        ];

        $this->json('POST', '/api/v1/short/link/create', $data, ['Accept' => 'application/json'])
            ->assertStatus(201)
            ->assertJsonStructure([
                'data'
            ]);
    }
}
