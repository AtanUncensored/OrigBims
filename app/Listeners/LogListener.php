<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Auth;
use App\Models\Log;
use App\Events\UserLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserLog $event)
    {
        Log::create([
            'user_id' => auth()->user()->id,
            'log_entry' => $event->log_entry
        ]);
    }
}
