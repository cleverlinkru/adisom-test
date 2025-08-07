<?php

namespace App\Recommendations\Application\Index;

use App\Recommendations\Domain\ChannelsFinder;
use Illuminate\Support\Collection;

class IndexRecommendationsQueryHandler
{
    public function __construct(
        protected ChannelsFinder $finder,
    )
    {
    }
    
    /**
     * @param IndexRecommendationsQueryData $data
     * @return Collection<RecommendationData>
     */
    public function __invoke(IndexRecommendationsQueryData $data): Collection
    {
        return $this->finder->__invoke(
            category: $data->category,
            min_subscribers: $data->min_subscribers,
            max_subscribers: $data->max_subscribers,
            language: $data->language,
            region: $data->region,
            last_video_period: $data->last_video_period,
            order_by: $data->order_by,
            order: $data->order,
        );
    }
}