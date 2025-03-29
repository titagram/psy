@extends('layouts.base')

@section('content')
<h1>Schedule a Class</h1>

<form action="{{ route('schedule.store') }}" method="POST">
    @csrf

    <label>Prestazione:</label>
    <select name="session_type_id">
        @foreach($sessionTypes as $sessionType)
            <option value="{{ $sessionType->id }}">{{ $sessionType->name }}</option>
        @endforeach
    </select>

    <label>Date:</label>
    <input type="date" name="date" min="{{ date('Y-m-d', strtotime('tomorrow')) }}" required>

    <label>Time:</label>
    <select name="time">
        @foreach(['05:00:00', '06:00:00', '07:00:00', '08:00:00', '17:00:00', '18:00:00', '19:00:00', '20:00:00'] as $time)
            <option value="{{ $time }}">{{ date('g:i A', strtotime($time)) }}</option>
        @endforeach
    </select>

    <button type="submit">Schedule</button>
</form>
@endsection
