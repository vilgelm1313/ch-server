<?php

namespace App\Events\Auth;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AuthEvent
{
    use Dispatchable, SerializesModels;

    public function __construct(public string $action, public string $username = '')
    {
        //
    }
}
