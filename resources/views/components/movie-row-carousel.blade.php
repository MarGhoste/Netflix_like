{{-- Definimos las variables que este componente requiere al ser llamado --}}
@props(['title', 'movies'])

<h2 class="text-2xl font-bold mt-12 mb-6 text-white">{{ $title }}</h2>

<div class="flex space-x-4 overflow-x-auto pb-4 scrollbar-hide">

    {{-- Tarjeta de Película/Serie --}}
    @foreach ($movies as $movie)
        <a href="{{ route('movie.show', ['id' => $movie->id ?? $movie]) }}"
            class="flex-shrink-0 w-52 bg-gray-900 rounded-lg overflow-hidden shadow-xl transform transition duration-500 hover:scale-105 hover:shadow-purple-500/50">

            <img src="{{ asset('images/poster-' . ($movie->id ?? $movie) . '.jpg') }}" alt="Póster"
                class="w-full h-64 object-cover">

            <div class="p-3">
                {{-- Si $movie es un objeto, usa $movie->title. Si es solo un ID, usa un marcador. --}}
                <h3 class="text-base font-semibold truncate text-white">
                    {{ $movie->title ?? 'Título Corto ' . ($movie->id ?? $movie) }}
                </h3>
                <p class="text-sm text-gray-400 mt-1">2023 | Thriller</p>
            </div>
        </a>
    @endforeach

</div>
{{-- FIN DE LA FILA DE RECOMENDADOS --}}
