<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\Link;
use App\Jobs\StoreLuckyResult;


enum WinThreshold: int
{
    case HIGH = 900;
    case MEDIUM = 600;
    case LOW = 300;
}

enum WinPercentage: int
{
    case HIGH = 7;
    case MEDIUM = 5;
    case LOW = 3;
    case MIN = 1;
}

class LuckyService
{
    /**
     * @param  Link  $link
     * @return array
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
     * @return int
     */
    private function generateRandomNumber(): int
    {
        return rand(1, 1000);
    }

    /**
     * @param  int  $number
     * @return bool
     */
    private function isWin(int $number): bool
    {
        return $number % 2 === 0;
    }

    /**
     * @param  int  $number
     * @param  bool  $isWin
     * @return float
     */
    private function calculateWinAmount(int $number, bool $isWin): float
    {
        if (!$isWin) {
            return 0;
        }

        if ($number > WinThreshold::HIGH->value) {
            return round($number * WinPercentage::HIGH->value / 10);
        }

        if ($number > WinThreshold::MEDIUM->value) {
            return round($number * WinPercentage::MEDIUM->value / 10);
        }

        if ($number > WinThreshold::LOW->value) {
            return round($number * WinPercentage::LOW->value / 10);
        }

        return round($number * WinPercentage::MIN->value / 10);
    }
}
