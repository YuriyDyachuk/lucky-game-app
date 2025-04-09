<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $fillable = [
        'user_id',
        'token',
        'active',
        'expires_at',
    ];

    public function luckyResults(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(LuckyResult::class);
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
