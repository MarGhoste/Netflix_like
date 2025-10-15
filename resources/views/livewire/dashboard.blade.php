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

                <img src="{{ asset('images/feature-4.png') }}" alt="Póster de Película Destacada"
                    class="w-full h-full object-cover opacity-60">

                <div
                    class="absolute inset-0 p-8 flex flex-col justify-center bg-gradient-to-r from-black/80 to-transparent">
                    <h2 class="text-5xl font-extrabold mb-3 text-white">Título de Película Destacada</h2>
                    <p class="text-lg text-gray-300 mb-4 max-w-lg">
                        Descripción corta e impactante de la película. Un thriller de ciencia ficción que desafía las
                        leyes del espacio y el tiempo.
                    </p>

                    <div class="flex space-x-4 mt-2">
                        <button
                            class="flex items-center px-6 py-3 bg-white text-black font-semibold rounded-full shadow-lg hover:bg-gray-200 transition duration-300">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" />
                            </svg>
                            Ver Ahora
                        </button>
                        <button
                            class="flex items-center px-6 py-3 bg-purple-600 text-white font-semibold rounded-full shadow-lg hover:bg-purple-700 transition duration-300">
                            + Mi Lista
                        </button>
                    </div>
                </div>
            </div>

            {{-- === FILA DE CONTENIDO (CARRUSEL) === --}}

            {{-- === SECCIÓN DE CUADRÍCULA (Recomedados) === --}}
            <h2 class="text-2xl font-bold mt-12 mb-6 text-white">Recomendados para ti</h2>

            <div class="flex space-x-4 overflow-x-auto pb-4 scrollbar-hide">

                {{-- Tarjeta de Película/Serie (Ejemplo 1) --}}
                @for ($i = 1; $i <= 8; $i++)
                    <a href="{{ route('movie.show', ['id' => $i]) }}"
                        class="flex-shrink-0 w-52 bg-gray-900 rounded-lg overflow-hidden shadow-xl transform transition duration-500 hover:scale-105 hover:shadow-purple-500/50">
                        <img src="{{ asset('images/telon.jpg' . $i . '.jpg') }}" alt="Póster {{ $i }}"
                            class="w-full h-64 object-cover">
                        <div class="p-3">
                            <h3 class="text-base font-semibold truncate text-white">Título Corto {{ $i }}
                            </h3>
                            <p class="text-sm text-gray-400 mt-1">2023 | Thriller</p>
                        </div>
                    </a>
                @endfor

            </div>

            {{-- FIN DE FILA DE CONTENIDO (Recomendados) --}}


            {{-- === SECCIÓN DE CUADRÍCULA (Lo Nuevo) === --}}
            <h2 class="text-2xl font-bold mt-12 mb-6 text-white">Colecciones que podrías amar</h2>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4">

                {{-- Tarjeta de Película/Serie en Cuadrícula (Ejemplo 9 a 14) --}}
                @for ($i = 9; $i <= 14; $i++)
                    <div
                        class="bg-gray-900 rounded-lg overflow-hidden shadow-xl transform transition duration-500 hover:scale-[1.03] hover:shadow-purple-500/50">
                        <img src="{{ asset('images/poster-' . $i . '.jpg') }}" alt="Póster {{ $i }}"
                            class="w-full h-56 object-cover">
                        <div class="p-3 text-center">
                            <h3 class="text-base font-semibold truncate text-white">Colección Título
                                {{ $i }}
                            </h3>
                        </div>
                    </div>
                @endfor

            </div>

            {{-- FIN DE FILA DE LA SEGUNDA FILA DE CONTENIDO (Lo Nuevo) --}}

            {{-- === FILA DE CONTENIDO (TENDENCIAS) === --}}
            <h2 class="text-2xl font-bold mt-12 mb-6 text-white">Tendencia Global</h2>

            <div class="flex space-x-4 overflow-x-auto pb-4 scrollbar-hide">

                {{-- Tarjeta de Película/Serie (Ejemplo 15 a 22) --}}
                @for ($i = 15; $i <= 22; $i++)
                    <div
                        class="flex-shrink-0 w-60 bg-gray-900 rounded-lg overflow-hidden shadow-xl transform transition duration-500 hover:scale-105 hover:shadow-purple-500/50">
                        <img src="{{ asset('images/poster-' . $i . '.jpg') }}" alt="Póster {{ $i }}"
                            class="w-full h-32 object-cover">
                        <div class="p-3">
                            <h3 class="text-lg font-semibold truncate text-white">Película Hot {{ $i }}
                            </h3>
                            <p class="text-sm text-purple-400 mt-1">¡Ahora en Streaming!</p>
                        </div>
                    </div>
                @endfor

            </div>
            {{-- FIN DE LA FILA DE TENDDENCIAS --}}

        </main>
    </div>

    </main>
</div>
</div>
