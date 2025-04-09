<?php
declare(strict_types=1);

namespace App\Enums;

enum WinThreshold: int
{
    case HIGH = 900;
    case MEDIUM = 600;
    case LOW = 300;
}
