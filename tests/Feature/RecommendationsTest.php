<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RecommendationsTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_basic_sort_cache_logs(): void
    {
        $this->seed();
        
        $response = $this->get('/api/recommendations/');
        $response->assertStatus(200);
        $response->assertJson([
            [
                'id' => '8f6108e7-f01a-4536-9926-78528cce1a2d',
                'title' => 'Channel 2',
                'category' => 'Health',
                'subscribers_count' => 290878,
                'average_views' => 1512221,
                'engagement_rate' => 7.01,
                'language' => 'Spanish',
                'region' => 'UK',
                'last_video_published_at' => '2024-11-11 00:00:00',
            ],
            [
                'id' => '5c425039-37f4-4687-b304-d8c42619278e',
                'title' => 'Channel 1',
                'category' => 'Music',
                'subscribers_count' => 2872421,
                'average_views' => 83378,
                'engagement_rate' => 3.88,
                'language' => 'Spanish',
                'region' => 'China',
                'last_video_published_at' => '2024-10-20 00:00:00',
            ],
        ]);
        
        $this->assertDatabaseHas('request_execution_logs', [
            'url' => 'api/recommendations',
        ]);
    }
    
    public function test_filters(): void
    {
        $this->seed();
        
        $response = $this->get('/api/recommendations/?category=Health');
        $response->assertStatus(200);
        $response->assertJson([
            [
                'id' => '8f6108e7-f01a-4536-9926-78528cce1a2d',
                'title' => 'Channel 2',
                'category' => 'Health',
                'subscribers_count' => 290878,
                'average_views' => 1512221,
                'engagement_rate' => 7.01,
                'language' => 'Spanish',
                'region' => 'UK',
                'last_video_published_at' => '2024-11-11 00:00:00',
            ],
        ]);
        
        $response = $this->get('/api/recommendations/?category=Music&min_subscribers_count=2000000');
        $response->assertStatus(200);
        $response->assertJson([
            [
                'id' => '5c425039-37f4-4687-b304-d8c42619278e',
                'title' => 'Channel 1',
                'category' => 'Music',
                'subscribers_count' => 2872421,
                'average_views' => 83378,
                'engagement_rate' => 3.88,
                'language' => 'Spanish',
                'region' => 'China',
                'last_video_published_at' => '2024-10-20 00:00:00',
            ],
        ]);
    }
}
