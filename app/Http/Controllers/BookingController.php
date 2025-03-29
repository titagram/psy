<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ScheduledSession;

class BookingController extends Controller
{

    public function index()
    {
        $bookings = auth()->user()->bookings()
            ->where('date_time', '>', now())
            ->get();

        return view('member.upcoming', ['bookings' => $bookings]);
    }



    public function create()
    {
        $scheduledSessions = ScheduledSession::with(['sessionType', 'therapist'])
            ->where('date_time', '>', now())
            ->oldest()
            ->get();

        return view('patient.book', ['scheduledSessions' => $scheduledSessions]);
    }

    public function store(Request $request)
    {
        auth()->user()->bookings()->attach($request->scheduled_session_id);

        return redirect()->route('booking.index');
    }

   
    public function destroy(int $id)
    {
        auth()->user()->bookings()->detach($id);

        return redirect()->route('booking.index');
    }
    //nota: detach rimuove dalla pivot



}
