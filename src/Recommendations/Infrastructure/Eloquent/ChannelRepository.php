<?php

namespace App\Recommendations\Infrastructure\Eloquent;

use App\Recommendations\Domain\ChannelRepositoryInterface;
use App\Recommendations\Domain\Data\ChannelData;
use DateTime;
use Illuminate\Support\Collection;

class ChannelRepository implements ChannelRepositoryInterface
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
    ): Collection
    {
        $eloquentChannels = ChannelsModel::query()
            ->when($category !== null, function ($q) use ($category) {
                $q->where('category', $category);
            })
            ->when($min_subscribers !== null, function ($q) use ($min_subscribers) {
                $q->where('subscribers_count', '>=', $min_subscribers);
            })
            ->when($max_subscribers !== null, function ($q) use ($max_subscribers) {
                $q->where('subscribers_count', '<=', $max_subscribers);
            })
            ->when($language !== null, function ($q) use ($language) {
                $q->where('language', $language);
            })
            ->when($region !== null, function ($q) use ($region) {
                $q->where('region', $region);
            })
            ->when($last_video_period !== null, function ($q) use ($last_video_period) {
                $dateline = new DateTime();
                switch ($last_video_period) {
                    case 'last_7_days':
                        $dateline->modify('-7 day');
                        break;
                    case 'last_month':
                        $dateline->modify('-1 month');
                        break;
                    case 'last_year':
                        $dateline->modify('-1 year');
                        break;
                }
                $q->where('last_video_published_at', '>=', $dateline);
            })
            ->when($order_by !== null, function ($q) use ($order_by, $order) {
                $q->orderBy($order_by, $order ?? 'desc');
            })
            ->when($order_by === null, function ($q) {
                $q->orderByDesc('engagement_rate');
                $q->orderByDesc('average_views');
            })
            ->limit(10)
            ->get();
        
        $channels = $eloquentChannels->map(function (ChannelsModel $eloquentChannel) {
            return ChannelData::fromPrimitives(
                id: $eloquentChannel->id,
                title: $eloquentChannel->title,
                category: $eloquentChannel->category,
                subscribers_count: $eloquentChannel->subscribers_count,
                average_views: $eloquentChannel->average_views,
                engagement_rate: $eloquentChannel->engagement_rate,
                language: $eloquentChannel->language,
                region: $eloquentChannel->region,
                last_video_published_at: $eloquentChannel->last_video_published_at,
            );
        });
        
        return new Collection($channels);
    }
}