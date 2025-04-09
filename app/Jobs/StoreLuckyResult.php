<?php
declare(strict_types=1);

namespace App\Jobs;

use App\Models\Link;
use App\Models\LuckyResult;
use Illuminate\Bus\Queueable;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class StoreLuckyResult implements ShouldQueue
{
    use Queueable, InteractsWithQueue, SerializesModels;

    public $tries = 5;

    protected Link $link;
    protected int $number;
    protected float $winAmount;
    protected bool $isWin;

    /**
     * @param Link $link
     * @param int $number
     * @param float $winAmount
     * @param bool $isWin
     */
    public function __construct(Link $link, int $number, float $winAmount, bool $isWin)
    {
        $this->link = $link;
        $this->number = $number;
        $this->winAmount = $winAmount;
        $this->isWin = $isWin;
    }

    public function handle(): void
    {
        try {
            LuckyResult::create([
                'link_id' => $this->link->id,
                'number' => $this->number,
                'result' => $this->isWin ? 'win' : 'lose',
                'win_amount' => $this->winAmount,
            ]);
        } catch (\Exception $e) {
            Log::error('Error creating LuckyResult: ' . $e->getMessage());
            throw $e;
        }
    }
}
