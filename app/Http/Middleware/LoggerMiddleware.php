<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class LoggerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $contents = json_decode($response->getContent(), true, 512);
        
        $headers  = $request->header();

        $debug_mode = config('app.debug', false);
    
        $dt = new Carbon();
        $data = [
            'path'         => $request->getPathInfo(),
            'method'       => $request->getMethod(),
            'ip'           => $request->ip(),
            'http_version' => $_SERVER['SERVER_PROTOCOL'],
            'timestamp'    => $dt->toDateTimeString(),
            'headers'      => [
                'user-agent' => $headers['user-agent'],
                // 'referer'    => $headers['referer'],
                // 'origin'     => $headers['origin'],
            ], 
        ];

        if ($request->user()) {
            $data['user_id'] = $request->user()->id;
        }

        if (count($request->all()) > 0) {
             // keys to skip like password or any sensitive information
            $hiddenKeys = ['password'];

            $data['request'] = $request->except($hiddenKeys);
        }

        if ($debug_mode) {
            if(!empty($contents['status'])) {
                $data['response']['status'] = $contents['status'];
            }
            
            if (!empty($contents['message'])) {
                $data['response']['message'] = $contents['message'];
            }
            
            if (!empty($contents['errors'])) {
                $data['response']['errors'] = $contents['errors'];
            }
            
            if (!empty($contents['error'])) {
                $data['response']['error'] = $contents['error'];
            }
            
            // to log the data from the response
            if (!empty($contents['data'])) {
                $data['response']['data'] = $contents['data'];
            }
        }

        // a unique message to log
        $message = str_replace('/', '_', trim($request->getPathInfo(), '/'));

        Log::info($message, $data);

        return $response;
    }
}
