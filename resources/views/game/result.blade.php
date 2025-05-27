@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-center min-h-screen bg-gray-100 px-4 py-8">
        <div class="bg-white shadow-xl rounded-lg p-6 w-full max-w-sm">
            <h2 class="text-xl font-bold text-center mb-4">🎯 Résultat</h2>

           {{-- Image --}}
        <div class="w-full h-48 sm:h-56 md:h-64 flex items-center justify-center overflow-hidden mb-4">
            <img src="{{ Storage::disk('s3')->url($object->image_path) }}"
                 alt="{{ $object->name }}"
                 class="object-contain h-full">
        </div>

            <h3 class="text-lg font-semibold">{{ $object->name }}</h3>
            <p class="text-sm text-gray-600 mb-4">{{ $object->description }}</p>

            {{-- 👇 Couleur dynamique ici --}}
            @php
                $colorClasses = match(true) {
                    $score === 3, $score === 2 => 'bg-green-100',
                    $score === 1 => 'bg-orange-100 text-orange-800',
                    default => 'bg-gray-100 text-gray-800'
                };
            @endphp

            <div class="p-4 rounded mb-4 text-sm {{ $colorClasses }}">
                <p><strong>Ton estimation :</strong> {{ number_format($guessed_price, 2) }} €</p>
                <p><strong>Prix réel :</strong> {{ number_format($actual_price, 2) }} €</p>
                <p><strong>Feedback :</strong> {{ $feedback }}</p>
                <p><strong>Score :</strong> {{ $score }} pt{{ $score > 1 ? 's' : '' }}</p>
            </div>

            <a href="{{ route('play') }}"
                class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                🔄 Rejouer
            </a>
        </div>
    </div>
@endsection
