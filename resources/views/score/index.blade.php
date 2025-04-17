@extends('layouts.app')

@section('content')
<div class="mt-4 grid gap-4">
    @foreach ($guesses as $guess)
        @php
            $badgeColor = match(true) {
                $guess->score >= 2 => 'bg-green-100 text-green-700 border-green-300',
                $guess->score == 1 => 'bg-yellow-100 text-yellow-800 border-yellow-300',
                default => 'bg-red-100 text-red-700 border-red-300'
            };
        @endphp

        <div class="bg-white shadow-md rounded-lg p-4 border border-gray-200 flex items-start gap-4">
            {{-- Image de l'objet --}}
            <div class="w-16 h-16 flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
                <img src="{{ $guess->object->image_path }}" alt="{{ $guess->object->name }}" class="w-full h-full object-cover">
            </div>

            {{-- Infos devinette --}}
            <div class="flex-1">
                <div class="flex justify-between items-start">
                    <h4 class="font-bold text-gray-800 text-sm">
                        {{ $guess->object->name ?? 'Objet inconnu' }}
                    </h4>
                    <span class="text-xs font-semibold px-2 py-1 border rounded {{ $badgeColor }}">
                        {{ $guess->score }} pt{{ $guess->score > 1 ? 's' : '' }}
                    </span>
                </div>

                <p class="text-xs mt-1"><strong>Prix deviné :</strong> {{ number_format($guess->guessed_price, 2) }} €</p>
                <p class="text-xs"><strong>Résultat :</strong> {{ $guess->feedback }}</p>
                <p class="text-[10px] text-gray-500 mt-1">{{ $guess->created_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>
    @endforeach
</div>


@endsection
