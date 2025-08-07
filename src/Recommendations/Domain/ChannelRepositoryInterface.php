<?php

namespace App\Recommendations\Domain;

use App\Recommendations\Domain\Data\RecommendationData;
use Illuminate\Support\Collection;

interface ChannelRepositoryInterface
{
    /**
     * @return Collection<RecommendationData>
     */
    public function findBy(
        ?string $category,
        ?int $min_subscribers,
        ?int $max_subscribers,
        ?string $language,
        ?string $region,
        ?string $last_video_period,
        ?string $order_by,
        ?string $order,
    ): Collection;
}