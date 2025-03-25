@extends('layouts.base')

@section('content')
<h1>Upcoming Classes</h1>

@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

<table>
    <tr>
        <th>Class</th>
        <th>Date</th>
        <th>Time</th>
        <th>Duration (min)</th>
        <th>Action</th>
    </tr>
    @foreach($scheduledClasses as $class)
    <tr>
        <td>{{ $class->classType->name }}</td>
        <td>{{ date('d M Y', strtotime($class->date_time)) }}</td>
        <td>{{ date('g:i A', strtotime($class->date_time)) }}</td>
        <td>{{ $class->classType->minutes }}</td>
        <td>
            <form action="{{ route('schedule.destroy', $class) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Cancel</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
