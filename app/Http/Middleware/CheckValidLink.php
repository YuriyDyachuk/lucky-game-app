<?php
declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\AccessLinkService;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

readonly class CheckValidLink
{
    public function __construct(
       private AccessLinkService $accessLinkService)
    {}

    public function handle(Request $request, Closure $next): Response
    {
        $token = (string) $request->route('token');

        if (!$token) {
            Log::warning('Token not found in route');
            return redirect()->route('register.store')->with('status', 'Forbidden, link not found.');
        }

        $result = $this->accessLinkService->getValidLink($token);

        if (!$result) {
            Log::warning('Invalid link for token: ' . $token);
            return redirect()->route('register.store')->with('status', 'Forbidden, link not found.');
        }

        $request->merge(['link' => $result]);
        return $next($request);
    }

}

