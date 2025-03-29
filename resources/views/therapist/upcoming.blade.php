@extends('layouts.base')

@section('content')
<h1>Prossime sedute</h1>

@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

<table>
    <tr>
        <th>Session</th>
        <th>Date</th>
        <th>Time</th>
        <th>Duration (min)</th>
        <th>Action</th>
    </tr>
    @foreach($scheduledSessions as $session)
    <tr>
        <td>{{ $session->sessionType->name }}</td>
        <td>{{ date('d M Y', strtotime($session->date_time)) }}</td>
        <td>{{ date('g:i A', strtotime($session->date_time)) }}</td>
        <td>{{ $session->sessionType->minutes }}</td>
        <td>
            <form action="{{ route('schedule.destroy', $session) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Cancel</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
