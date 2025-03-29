<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class NotifySessionCanceledJob implements ShouldQueue
{
    use Queueable;

    public $patients;
    public array $details;

    public function __construct($patients, array $details)
    {
        $this->patients = $patients;
        $this->details = $details;
    }

    public function handle()
    {
        Notification::send($this->patients, new SessionCanceledNotification($this->details));
    }

}
