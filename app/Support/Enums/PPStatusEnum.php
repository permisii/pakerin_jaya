<?php

namespace App\Support\Enums;

use App\Traits\Enums\Arrayable;

enum PPStatusEnum: int {
    use Arrayable;
    case Input = 1;
    case Process = 2;
}
