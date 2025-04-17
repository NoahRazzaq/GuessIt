@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-white shadow-xl rounded-lg p-6 w-full max-w-sm"> {{-- max-w-sm au lieu de md --}}
        <h2 class="text-xl font-bold text-center mb-4">🎉 Résultat</h2>

        <div class="mb-3">
            <img src="{{ $object->image_path }}" alt="Objet mystère" class="w-full h-40 object-cover rounded">
        </div>

        <h3 class="text-lg font-semibold">{{ $object->name }}</h3>
        <p class="text-sm text-gray-600 mb-4">{{ $object->description }}</p>

        <div class="bg-gray-100 p-3 rounded mb-4 text-sm">
            <p><strong>Ton estimation :</strong> {{ number_format($guessed_price, 2) }} €</p>
            <p><strong>Prix réel :</strong> {{ number_format($actual_price, 2) }} €</p>
            <p><strong>Feedback :</strong> {{ $feedback }}</p>
            <p><strong>Score :</strong> {{ $score }} pt{{ $score > 1 ? 's' : '' }}</p>
        </div>

        <a href="{{ route('play') }}"
           class="block text-center bg-green-600 text-white py-2 rounded hover:bg-green-700 transition text-sm">
            🔄 Rejouer
        </a>
    </div>
</div>
@endsection
