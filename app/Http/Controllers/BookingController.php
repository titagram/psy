<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function create()
{
    $scheduledSessions = ScheduledSession::with(['sessionType', 'therapist'])
        ->where('date_time', '>', now())
        ->oldest()
        ->get();

    return view('patient.book', ['scheduledSessions' => $scheduledSessions]);
}

}
