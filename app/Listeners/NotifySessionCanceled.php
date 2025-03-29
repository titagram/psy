<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Jobs\NotifySessionCanceledJob;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\SessionCanceledNotification;


class NotifySessionCanceled
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
    public function handle(SessionCanceled $event)
    {
        $scheduledSession = $event->scheduledSession;

        $patients = $event->scheduledSession->patients;

        $details = [
            'sessionDateTime' => $event->scheduledSession->date_time,
        ];

        $patients->each(function ($user) use ($details) {
            Mail::to($user)->send(new SessionCanceledMail($details));
        });
        
        
        Log::info('Session canceled:', [
            'scheduled_session_id' => $scheduledSession->id,
            'therapist_id' => $scheduledSession->instructor_id,
            'date_time' => $scheduledSession->date_time
        ]);

        Notification::send($patients, new SessionCanceledNotification($details));
        
        $patients = $event->scheduledSession->patients()->get();
        $details = [
            'classDateTime' => $event->scheduledSession->date_time,
        ];

        NotifyClassCanceledJob::dispatch($patients, $details);


    
    }

   

}
