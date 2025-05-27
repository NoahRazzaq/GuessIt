@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-100 px-4 py-8">
    <div class="bg-white shadow-xl rounded-lg p-6 w-full max-w-md flex flex-col">
        <h2 class="text-2xl font-bold text-center mb-6">🧩 Devine le prix de l'objet mystère</h2>

        {{-- Image --}}
        <div class="w-full h-48 sm:h-56 md:h-64 flex items-center justify-center overflow-hidden mb-4">
            <img src="{{ Storage::disk('s3')->url($object->image_path) }}"
                 alt="{{ $object->name }}"
                 class="object-contain h-full">
        </div>

        {{-- Infos --}}
        <h3 class="text-xl font-semibold">{{ $object->name }}</h3>
        <p class="text-sm text-gray-600 mb-4">{{ $object->description }}</p>

        {{-- Formulaire --}}
        <form method="POST" action="{{ route('play.submit') }}" class="mt-auto">
            @csrf
            <input type="hidden" name="object_id" value="{{ $object->id }}">
            <input type="hidden" name="time_taken" id="time_taken">

            <label class="block text-sm font-medium mb-1">Ton estimation (€) :</label>
            <input type="number" name="guessed_price" step="0.01" required
                   class="w-full px-3 py-2 border border-gray-300 rounded mb-4">

          <button class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
  Valider votre estimation
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
