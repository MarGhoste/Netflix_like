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
            <x-movie-row-carousel title="Recomendados para ti" :movies="range(1, 8)" />
            {{-- FIN DE FILA DE CONTENIDO (Recomendados) --}}


            {{-- === SECCIÓN DE CUADRÍCULA (Lo Nuevo) === --}}
            <x-movie-row-carousel title="Lo Nuevo" :movies="range(15, 22)" />
            {{-- FIN DE FILA DE LA SEGUNDA FILA DE CONTENIDO (Lo Nuevo) --}}

            {{-- === FILA DE CONTENIDO (TENDENCIAS) === --}}
            <x-movie-row-carousel title="Tendencia Global" :movies="range(23, 30)" />
            {{-- FIN DE LA FILA DE TENDDENCIAS --}}

            {{-- === FIN DE LA FILA DE CONTENIDO (CARRUSEL) === --}}

        </main>
    </div>

    </main>
</div>
</div>
