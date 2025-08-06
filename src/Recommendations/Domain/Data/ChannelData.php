<?php

namespace App\Recommendations\Domain\Data;

class ChannelData
{
    public function __construct(
        public readonly string $id,
        public readonly string $title,
        public readonly string $category,
        public readonly int $subscribers_count,
        public readonly int $average_views,
        public readonly float $engagement_rate,
        public readonly string $language,
        public readonly string $region,
        public readonly string $last_video_published_at,
    )
    {
    }
    
    public static function fromPrimitives(
        string $id,
        string $title,
        string $category,
        int $subscribers_count,
        int $average_views,
        float $engagement_rate,
        string $language,
        string $region,
        string $last_video_published_at,
    ): self
    {
        return new self(
            id: $id,
            title: $title,
            category: $category,
            subscribers_count: $subscribers_count,
            average_views: $average_views,
            engagement_rate: $engagement_rate,
            language: $language,
            region: $region,
            last_video_published_at: $last_video_published_at,
        );
    }
}