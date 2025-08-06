<?php

namespace Apps\AdisomTest\Http\Middleware;

use Apps\AdisomTest\Models\RequestExecutionLog;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class RequestExecutionLoging
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $startTime = microtime(true);
        
        $response = $next($request);
        
        $endTime = microtime(true);
        $executionTime = $endTime - $startTime;
        
        Cache::put('last_execution_time', $executionTime);
        
        $model = new RequestExecutionLog();
        $model->url = $request->path();
        $model->execution_time = $executionTime;
        $model->save();
        
        return $response;
    }
}
