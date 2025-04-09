<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\Link;
use Illuminate\Support\Str;

class AccessLinkService
{
    public function getValidLink(string $token): ?Link
    {
        return Link::whereToken($token)
            ->where('active', true)
            ->where('expires_at', '>', now())
            ->first();
    }

    public function deactivate(Link $link): void
    {
        $link->update(['active' => false]);
    }

    public function createLink(int $userId): Link
    {
        return Link::create([
            'user_id' => $userId,
            'token' => Str::uuid(),
            'expires_at' => now()->addDays(7),
            'is_active' => true,
        ]);
    }
}
