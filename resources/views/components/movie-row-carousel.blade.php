{{-- Definimos las variables que este componente requiere al ser llamado --}}
@props(['title', 'movies'])

<h2 class="text-2xl font-bold mt-12 mb-4 text-white px-2 sm:px-4">{{ $title }}</h2>

{{-- 
    Contenedor principal del carrusel:
    - flex: Habilita la fila de tarjetas.
    - space-x-3: Espacio más reducido entre tarjetas para un look más compacto.
    - overflow-x-auto: Permite el desplazamiento horizontal.
    - pb-4: Padding inferior para que el zoom no quede cortado por el contenedor.
--}}
<div class="flex space-x-3 overflow-x-auto pb-4 scrollbar-hide">

    @foreach ($movies as $movie)
        {{-- Enlace de la Tarjeta --}}
        <a href="{{ route('movie.show', ['id' => $movie->id ?? $movie]) }}" {{-- Clases de la tarjeta (w-56 o w-64 para tarjetas más grandes) --}}
            class="group relative flex-shrink-0 w-44 sm:w-52 h-64 sm:h-72 
                   bg-gray-900 rounded-md overflow-hidden shadow-2xl cursor-pointer
                   transform transition duration-500 ease-in-out 
                   hover:scale-[1.15] hover:z-10 hover:shadow-purple-800/80 
                   origin-left">

            {{-- IMAGEN (POSTER) --}}
            {{-- CORRECCIÓN: Usamos la ruta de storage para la imagen --}}
            <img src="{{ asset('storage/' . ($movie->image ?? 'images/placeholder-movie.jpg')) }}"
                alt="{{ $movie->title ?? 'Póster' }}" class="w-full h-full object-cover">

            {{-- Capa de Información (Overlay) - Se muestra siempre, pero se mejora al hacer hover --}}
            <div
                class="absolute inset-x-0 bottom-0 p-3 
                        bg-gradient-to-t from-black/80 via-black/30 to-transparent">

                {{-- TÍTULO --}}
                <h3 class="text-sm sm:text-base font-semibold text-white truncate group-hover:whitespace-normal">
                    {{ $movie->title ?? 'Título Corto' }}
                </h3>

                {{-- METADATA DE LA PELÍCULA --}}
                <p class="text-xs text-gray-400 mt-0.5">
                    {{ $movie->release_date ? date('Y', strtotime($movie->release_date)) : 'N/A' }}
                    {{-- Si tiene géneros (si la relación está cargada), puedes listarlos: --}}
                    {{-- @if (isset($movie->genres) && $movie->genres->count()) | {{ $movie->genres->first()->name }} @endif --}}
                </p>

            </div>

            {{-- INDICADOR DE HOVER (OPCIONAL: para simular el efecto de "Play") --}}
            <div
                class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 
                        flex items-center justify-center transition-opacity duration-300">
                <svg class="w-10 h-10 text-white fill-current" viewBox="0 0 24 24">
                    <path d="M8 5v14l11-7z" />
                </svg>
            </div>

        </a>
    @endforeach

</div>
