<div class="min-h-screen bg-black text-white">

    {{-- Menu lateral (ASIDE) --}}
    <x-app.sidebar />
    {{-- Cierre del menu lateral (ASIDE --}}


    {{-- Contenido principal --}}
    <div id="app-container-teatro" class="min-h-screen bg-black text-white">

        {{-- Contenido principal --}}
        <main id="teatro-escenario" class="ml-20 mx-auto max-w-7xl pt-8 pb-12 px-8">

            {{-- === HERO BANNER PRINCIPAL === --}}
            <div class="relative w-full h-96 bg-gray-800 rounded-lg overflow-hidden shadow-2xl">

                {{-- VERIFICACIÓN CLAVE: Solo muestra el contenido si $heroMovie existe --}}
                @if ($heroMovie)
                    <img src="{{ asset('storage/' . $heroMovie->image) }}" alt="{{ $heroMovie->title }}"
                        class="w-full h-full object-cover opacity-60">

                    <div
                        class="absolute inset-0 p-8 flex flex-col justify-center bg-gradient-to-r from-black/80 to-transparent">
                        {{-- Aquí el código accede a las propiedades de $heroMovie --}}
                        <h2 class="text-5xl font-extrabold mb-3 text-white">{{ $heroMovie->title }}</h2>
                        <p class="text-lg text-gray-300 mb-4 max-w-lg">
                            {{ $heroMovie->description }}
                        </p>

                        <div class="flex space-x-4 mt-2">
                            {{-- Botón "Ver Ahora" --}}
                            <a href="{{ route('movie.show', ['id' => $heroMovie->id]) }}"
                                class="flex items-center px-6 py-3 bg-white text-black font-semibold rounded-full shadow-lg hover:bg-gray-200 transition duration-300">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" />
                                </svg>
                                Ver Ahora
                            </a>
                            <button
                                class="flex items-center px-6 py-3 bg-purple-600 text-white font-semibold rounded-full shadow-lg hover:bg-purple-700 transition duration-300">
                                + Mi Lista
                            </button>
                        </div>
                    </div>
                @else
                    {{-- Alternativa si no hay hero movie --}}
                    <div class="absolute inset-0 flex items-center justify-center bg-gray-900/80">
                        <p class="text-xl text-gray-400">¡Carga tu primera película destacada en el Panel de
                            Administración!</p>
                    </div>
                @endif
            </div>

            {{-- === FILA DE CONTENIDO (CARRUSEL) === --}}

            {{-- === SECCIÓN DE CUADRÍCULA (Recomendados) === --}}
            {{-- Pasa la colección real: $recommendedMovies --}}
            <x-movie-row-carousel title="Recomendados para ti" :movies="$recommendedMovies" />
            {{-- FIN DE FILA DE CONTENIDO (Recomendados) --}}


            {{-- === SECCIÓN DE CUADRÍCULA (Lo Nuevo) === --}}
            {{-- Pasa la colección real: $newMovies --}}
            <x-movie-row-carousel title="Lo Nuevo" :movies="$newMovies" />
            {{-- FIN DE FILA DE LA SEGUNDA FILA DE CONTENIDO (Lo Nuevo) --}}

            {{-- === FILA DE CONTENIDO (TENDENCIAS) === --}}
            {{-- Pasa la colección real: $trendingMovies --}}
            <x-movie-row-carousel title="Tendencia Global" :movies="$trendingMovies" />
            {{-- FIN DE LA FILA DE TENDDENCIAS --}}

            {{-- === FIN DE LA FILA DE CONTENIDO (CARRUSEL) === --}}

        </main>
    </div>

    </main>
</div>
</div>
