<?php
declare(strict_types=1);

namespace App\Enums;

enum WinPercentage: int
{
    case HIGH = 7;
    case MEDIUM = 5;
    case LOW = 3;
    case MIN = 1;
}
