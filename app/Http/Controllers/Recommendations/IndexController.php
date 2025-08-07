<?php

namespace Apps\AdisomTest\Http\Controllers\Recommendations;

use Apps\AdisomTest\Http\Controllers\Controller;
use Apps\AdisomTest\Http\Requests\Recommendations\IndexRecommendationsRequest;
use App\Recommendations\Application\Index\IndexRecommendationsQueryData;
use App\Recommendations\Application\Index\IndexRecommendationsQueryHandler;
use Illuminate\Support\Facades\Cache;

class IndexController extends Controller
{
    public function __construct(
        protected IndexRecommendationsQueryHandler $queryHandler,
    )
    {
    }
    
    public function __invoke(IndexRecommendationsRequest $request)
    {
        return Cache::remember($request->generateKey(), 600, function () use ($request) {
            return $this->queryHandler->__invoke(new IndexRecommendationsQueryData(
                category: $request->input('category') ?? null,
                min_subscribers: $request->input('min_subscribers') ?? null,
                max_subscribers: $request->input('max_subscribers') ?? null,
                language: $request->input('language') ?? null,
                region: $request->input('region') ?? null,
                last_video_period: $request->input('last_video_period') ?? null,
                order_by: $request->input('order_by') ?? null,
                order: $request->input('order') ?? null,
            ));
        });
    }
}