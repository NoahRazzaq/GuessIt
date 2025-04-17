@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-white shadow-xl rounded-lg p-8 w-full max-w-sm"> {{-- max-w-md pour une largeur maximale --}}
        <h2 class="text-2xl font-bold text-center mb-6">🧩 Devine le prix de l'objet mystère</h2>

        <div class="mb-4">
            <img src="{{ $object->image_path }}" alt="Objet mystère" class="w-full h-48 object-cover rounded">
        </div>

        <h3 class="text-xl font-semibold">{{ $object->name }}</h3>
        <p class="text-sm text-gray-600 mb-4">{{ $object->description }}</p>

        <form method="POST" action="{{ route('play.submit') }}">
            @csrf
            <input type="hidden" name="object_id" value="{{ $object->id }}">
            <input type="hidden" name="time_taken" id="time_taken">

            <label class="block text-sm font-medium mb-1">Ton estimation (€) :</label>
            <input type="number" name="guessed_price" step="0.01" required
                   class="w-full px-3 py-2 border border-gray-300 rounded mb-4">

            <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
                Valider ma réponse
            </button>
        </form>
    </div>
</div>

<script>
    let time = 0;
    const input = document.getElementById('time_taken');
    setInterval(() => {
        time++;
        input.value = time;
    }, 1000);
</script>
@endsection
