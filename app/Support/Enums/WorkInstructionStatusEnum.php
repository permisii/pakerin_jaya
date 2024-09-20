<?php

namespace App\Support\Enums;

use App\Traits\Enums\Arrayable;

enum WorkInstructionStatusEnum: int {
    use Arrayable;

    case Draft = 1;
    case Submitted = 2;
    case Approved = 3;
    case Rejected = 4;
}
