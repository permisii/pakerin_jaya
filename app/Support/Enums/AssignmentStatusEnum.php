<?php

namespace App\Support\Enums;

use App\Traits\Enums\Arrayable;

enum AssignmentStatusEnum: int {
    use Arrayable;
    case Draft = 1;
    case Process = 2;
    case Done = 3;
}
