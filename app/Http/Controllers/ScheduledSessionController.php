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
        $scheduledClasses = Auth::user()->scheduledSessions()
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
        if (!Gate::allows('schedule-class')) {
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
            'instructor_id' => Auth::id(),
        ]);


        $validated = $request->validate([
            'session_type_id' => 'required|exists:class_types,id',
            'date_time' => 'required|unique:scheduled_classes,date_time|after:now',
            'therapist_id' => 'required|exists:users,id',
        ]);


        ScheduledSession::create($validated);

        return redirect()->route('schedule.index')->with('success', 'Class scheduled successfully!');
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


    public function destroy(ScheduledSession $schedule)
    {
        if ($schedule->therapist_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $schedule->delete();

        return redirect()->route('schedule.index')->with('success', 'Seduta cancellata.');

    }
}
