<x-app-layout>
    <style>
        /* Replicamos el estilo de escenario en esta vista */

        .detalle-escenario {

            background-color: #000000;

            box-shadow: inset 0 0 30px rgba(0, 0, 0, 0.9);

        }
    </style>

    <div class="min-h-screen bg-black text-white">

        <x-app.sidebar />

        <main class="ml-20 mx-auto max-w-7xl pt-8 pb-12 px-8">

            <div class="detalle-escenario rounded-lg shadow-2xl p-8 mt-10">

                <div class="flex flex-col md:flex-row gap-8">

                    {{-- Columna Izquierda: Poster --}}
                    <div class="md:w-1/3 flex-shrink-0">
                        {{-- CORRECCIÓN 1: Usamos la columna 'image' de la BD --}}
                        <img src="{{ asset('storage/' . $movie->image) }}" alt="{{ $movie->title }}"
                            class="w-full h-auto rounded-lg shadow-xl object-cover border-4 border-purple-600/50">
                    </div>

                    {{-- Columna Derecha: Información y Botones --}}
                    <div class="md:w-2/3">

                        <h1 class="text-5xl font-extrabold text-white mb-4">{{ $movie->title }}</h1>

                        <p class="text-lg text-gray-400 mb-6">
                            {{-- CORRECCIÓN 2: Usamos 'release_date' y formateamos el año --}}
                            {{ $movie->release_date ? date('Y', strtotime($movie->release_date)) : 'N/A' }}
                            |
                            {{-- Columna 'genre' no existe, mostramos 'N/A' o puedes añadir otra columna --}}
                            N/A
                        </p>

                        <p class="text-gray-300 leading-relaxed mb-8">
                            {{-- CONEXIÓN CORRECTA: Usamos 'description' --}}
                            {{ $movie->description }}
                        </p>

                        <a href="{{ route('movie.watch', ['movie' => $movie->id]) }}"
                            class="w-full sm:w-auto flex items-center justify-center px-10 py-4 bg-purple-600 text-white font-bold text-xl rounded-lg shadow-xl hover:bg-purple-700 transition duration-300 mb-6">
                            <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" />
                            </svg>
                            Iniciar Película
                        </a>

                        <div class="flex space-x-4">
                            {{-- Botones de Likes/Dislikes (funcionalidad no implementada aún, pero listos) --}}
                            <a href="{{ route('movie.watch', ['movie' => $movie->id]) }}"
                                class="w-full sm:w-auto flex items-center justify-center px-10 py-4 bg-purple-600 text-white font-bold text-xl rounded-lg shadow-xl hover:bg-purple-700 transition duration-300 mb-6">
                                <svg class="w-6 h-6 mr-3" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    
                                    <path
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" />
                                    
                                </svg>
                                Iniciar Película
                                </a>

                            {{-- INTEGRACIÓN DE LIVEWIRE AQUI --}}
                            @livewire('movie-rating', ['movie' => $movie])
                            {{-- FIN INTEGRACIÓN --}}
                        </div>

                    </div>
                </div>

            </div>

        </main>
    </div>
</x-app-layout>
