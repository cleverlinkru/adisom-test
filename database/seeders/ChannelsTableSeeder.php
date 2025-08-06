<?php

namespace Database\Seeders;

use App\Recommendations\Infrastructure\Eloquent\ChannelsModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChannelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ChannelsModel::create([
            'id' => '5c425039-37f4-4687-b304-d8c42619278e',
            'title' => 'Channel 1',
            'category' => 'Music',
            'subscribers_count' => 2872421,
            'average_views' => 83378,
            'engagement_rate' => 3.88,
            'language' => 'Spanish',
            'region' => 'China',
            'last_video_published_at' => '2024-10-20',
        ]);
        ChannelsModel::create([
            'id' => '8f6108e7-f01a-4536-9926-78528cce1a2d',
            'title' => 'Channel 2',
            'category' => 'Health',
            'subscribers_count' => 290878,
            'average_views' => 1512221,
            'engagement_rate' => 7.01,
            'language' => 'Spanish',
            'region' => 'UK',
            'last_video_published_at' => '2024-11-11',
        ]);
    }
}
