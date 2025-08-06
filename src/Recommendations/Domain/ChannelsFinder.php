<?php

namespace App\Recommendations\Domain;

use App\Recommendations\Domain\ChannelRepositoryInterface;
use App\Recommendations\Domain\Data\RecommendationData;
use Illuminate\Support\Collection;

class ChannelsFinder
{
    public function __construct(
        protected ChannelRepositoryInterface $channelRepository,
    )
    {
    }
    
    /**
     * @return Collection<RecommendationData>
     */
    public function __invoke(
        ?string $category,
        ?int $min_subscribers,
        ?int $max_subscribers,
        ?string $language,
        ?string $region,
        ?string $last_video_period,
    ): Collection
    {
        return $this->channelRepository->findBy(
            category: $category,
            min_subscribers: $min_subscribers,
            max_subscribers: $max_subscribers,
            language: $language,
            region: $region,
            last_video_period: $last_video_period,
        );
    }
}