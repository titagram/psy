@extends('layouts.app')

@section('content')
<h1>Prenota un appuntamento</h1>

@if($scheduledSessions->isEmpty())
  <p>Nessun appuntamento fissato.</p>
@else
  @foreach($scheduledSessions as $session)
    <div>
      <h2>{{ $session->sessionType->name }} ({{ $session->sessionType->minutes }} min)</h2>
      <p session="text-sm">Instructor: {{ $session->instructor->name }}</p>
      <p session="mt-2">{{ $session->sessionType->description }}</p>
      <form action="{{ route('booking.store') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">Prenota</button>
      </form>
    </div>
  @endforeach
@endif
@endsection
