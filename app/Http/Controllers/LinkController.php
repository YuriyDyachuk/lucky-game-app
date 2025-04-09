<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Services\LuckyService;
use Illuminate\Http\JsonResponse;
use App\Services\AccessLinkService;
use Illuminate\Http\RedirectResponse;
use Random\RandomException;

class LinkController extends Controller
{
    public function __construct(
        private readonly LuckyService $luckyService,
        private readonly AccessLinkService $accessLinkService,
    ) {}

    public function view(Request $request): View
    {
        return view('page', [
            'token' => $request->link->token,
        ]);
    }

    public function generateNewLink(Request $request): RedirectResponse
    {
        $this->accessLinkService->deactivate($request->link);
        $newLink = $this->accessLinkService->createLink($request->link->user_id);

        return redirect()->route('link.page', ['token' => $newLink->token]);
    }

    public function deactivateLink(Request $request): RedirectResponse
    {
        $this->accessLinkService->deactivate($request->link);

        return redirect()->route('register.store')->with('status', 'Link deactivated.');
    }

    /**
     * @throws RandomException
     */
    public function feelingLucky(Request $request): JsonResponse
    {
        $result = $this->luckyService->generate($request->link);

        return response()->json($result);
    }

    /**
     * Todo: add cache to improve performance
     */
    public function history(Request $request): JsonResponse
    {
        $history = $request->link->luckyResults()
            ->latest('id')
            ->take(3)
            ->get(['number', 'result', 'win_amount', 'created_at']);

        return response()->json($history);
    }
}
