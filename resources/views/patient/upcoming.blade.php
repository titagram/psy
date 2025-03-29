@extends('layouts.app')

@section('content')
    <h1>Prossime sedute</h1>

    @if($bookings->isEmpty())
        <p>Ecco i prossimi appuntamenti.</p>
    @else
        @foreach($bookings as $session)
            <div>
                <h2>{{ $session->sessionType->name }}</h2>
                <p class="text-sm">Terapeuta: {{ $session->therapist->name }}</p>

                <form action="{{ route('booking.destroy', $session->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Sei sicuro di voler cancellare questa seduta?');" class="btn btn-danger">
                        Cancel
                    </button>
                </form>
            </div>
        @endforeach
    @endif
@endsection
