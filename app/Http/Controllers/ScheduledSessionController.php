<?php

namespace App\Http\Controllers;

use App\Models\SessionType;
use Illuminate\Http\Request;
use App\Models\ScheduledSession;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ScheduledSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $scheduledSessions = Auth::user()->scheduledSessions()
            ->where('date_time', '>', now())
            ->orderBy('date_time', 'asc')
            ->get();

        return view('therapist.upcoming', compact('scheduledSessions'));
    }

    /**
     * Mostrerà al terapeuta i tipi di seduta disponibili, es "prima seduta", "colloquio gratuito", "seduta ordinaria", "psicometria" ecc.
     */
    public function create()
    {
        if (!Gate::allows('schedule-session')) {
            abort(403, 'Unauthorized');
        }
        $sessionTypes = SessionType::all();
        return view('therapist.schedule', compact('sessionTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $dateTime = "{$request->input('date')} {$request->input('time')}";


        $request->merge([
            'date_time' => $dateTime,
            'therapist' => Auth::id(),
        ]);


        $validated = $request->validate([
            'session_type_id' => 'required|exists:session_types,id',
            'date_time' => 'required|unique:scheduled_sessions,date_time|after:now',
            'therapist' => 'required|exists:users,id',
        ]);


        ScheduledSession::create($validated);

        return redirect()->route('schedule.index')->with('success', 'Session scheduled successfully!');
    }



    /*  public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //
    } */


    public function destroy(ScheduledSession $scheduledSession)
    {
        if (Auth::user()->cannot('delete', $scheduledSession)) {
            abort(403, 'Unauthorized');
        }

          
        $scheduledSession->patients()->detach();

        SessionCanceled::dispatch($scheduledSession);

        $scheduledSession->delete();

        return redirect()->route('schedule.index')->with('success', 'Seduta cancellata.');

    }
}
