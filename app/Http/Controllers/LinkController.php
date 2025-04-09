<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LuckyService;
use App\Services\AccessLinkService;

class LinkController extends Controller
{
    public function view(Request $request): \Illuminate\View\View
    {
        return view('page', [
            'token' => $request->link->token,
        ]);
    }

    public function generateNewLink(Request $request, AccessLinkService $service): \Illuminate\Http\RedirectResponse
    {
        $service->deactivate($request->link);
        $newLink = $service->createLink($request->link->user_id);

        return redirect()->route('link.page', ['token' => $newLink->token]);
    }

    public function deactivateLink(Request $request, AccessLinkService $service): \Illuminate\Http\RedirectResponse
    {
        $service->deactivate($request->link);

        return redirect()->route('register.store')->with('status', 'Link deactivated.');
    }

    public function feelingLucky(Request $request, LuckyService $service): \Illuminate\Http\JsonResponse
    {
        $result = $service->generate($request->link);

        return response()->json($result);
    }

    /**
     * Todo: add cache to improve performance
     */
    public function history(Request $request): \Illuminate\Http\JsonResponse
    {
        $history = $request->link->luckyResults()
            ->latest('id')
            ->take(3)
            ->get(['number', 'result', 'win_amount', 'created_at']);

        return response()->json($history);
    }
}
