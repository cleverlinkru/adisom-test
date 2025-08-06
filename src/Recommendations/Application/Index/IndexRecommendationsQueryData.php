<?php

namespace App\Recommendations\Application\Index;

class IndexRecommendationsQueryData
{
    public function __construct(
        public readonly ?string $category,
        public readonly ?int $min_subscribers,
        public readonly ?int $max_subscribers,
        public readonly ?string $language,
        public readonly ?string $region,
        public readonly ?string $last_video_period,
    )
    {
    }
}