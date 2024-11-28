<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OPCreated {
    use Dispatchable,  SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public $op) {}
}
