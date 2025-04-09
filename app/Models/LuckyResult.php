<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LuckyResult extends Model
{
    protected $fillable = [
        'link_id',
        'number',
        'result',
        'win_amount',
    ];

    public function link(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Link::class);
    }
}
