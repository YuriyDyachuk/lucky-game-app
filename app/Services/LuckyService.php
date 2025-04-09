<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\Link;
use Random\RandomException;
use App\Enums\WinThreshold;
use App\Enums\WinPercentage;
use App\Jobs\StoreLuckyResult;

class LuckyService
{
    /**
     * @throws RandomException
     */
    public function generate(Link $link): array
    {
        $number = $this->generateRandomNumber();
        $isWin = $this->isWin($number);
        $winAmount = $this->calculateWinAmount($number, $isWin);

        dispatch(new StoreLuckyResult($link, $number, $winAmount, $isWin));

        return [
            'number' => $number,
            'result' => $isWin ? 'win' : 'lose',
            'win_amount' => $winAmount,
        ];
    }

    /**
     * @throws RandomException
     */
    private function generateRandomNumber(): int
    {
        return random_int(1, 1000);
    }

    private function isWin(int $number): bool
    {
        return $number % 2 === 0;
    }

    private function calculateWinAmount(int $number, bool $isWin): float
    {
        if (!$isWin) {
            return 0;
        }

        return match (true) {
            $number > WinThreshold::HIGH->value   => round($number * WinPercentage::HIGH->value / 10),
            $number > WinThreshold::MEDIUM->value => round($number * WinPercentage::MEDIUM->value / 10),
            $number > WinThreshold::LOW->value    => round($number * WinPercentage::LOW->value / 10),
            default                               => round($number * WinPercentage::MIN->value / 10),
        };
    }
}
