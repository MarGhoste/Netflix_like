<x-app-layout>
    <style>
        /* Replicamos el estilo de escenario en esta vista */
        .detalle-escenario {
            background-color: #000000;
            box-shadow: inset 0 0 30px rgba(0, 0, 0, 0.9);
        }
    </style>

    <div class="min-h-screen bg-black text-white">

        {{-- Menu lateral (ASIDE) --}}
        <x-app.sidebar />
        {{-- Cierre del menu lateral (ASIDE --}}

        {{-- Contenido principal de la Película --}}
        <main class="ml-20 mx-auto max-w-7xl pt-8 pb-12 px-8">

            <div class="detalle-escenario rounded-lg shadow-2xl p-8 mt-10">

                <div class="flex flex-col md:flex-row gap-8">

                    {{-- Columna Izquierda: Poster --}}
                    <div class="md:w-1/3 flex-shrink-0">
                        <img src="{{ asset($movie->poster_path) }}" alt="{{ $movie->title }}"
                            class="w-full h-auto rounded-lg shadow-xl object-cover border-4 border-purple-600/50">
                    </div>

                    {{-- Columna Derecha: Información y Botones --}}
                    <div class="md:w-2/3">

                        <h1 class="text-5xl font-extrabold text-white mb-4">{{ $movie->title }}</h1>

                        <p class="text-lg text-gray-400 mb-6">
                            {{ $movie->release_year }} | {{ $movie->genre }}
                        </p>

                        <p class="text-gray-300 leading-relaxed mb-8">
                            {{ $movie->description }}
                        </p>

                        <button
                            class="w-full sm:w-auto flex items-center justify-center px-10 py-4 bg-purple-600 text-white font-bold text-xl rounded-lg shadow-xl hover:bg-purple-700 transition duration-300 mb-6">
                            <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" />
                            </svg>
                            Iniciar Película
                        </button>

                        <div class="flex space-x-4">
                            <button
                                class="flex items-center px-6 py-3 bg-gray-700 text-green-400 font-semibold rounded-full hover:bg-gray-600 transition duration-300">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM10 2.5a1 1 0 00-1 1v10.5a1 1 0 001 1h6.5a2 2 0 001.995-1.858L19.017 7.5A2 2 0 0017.017 5H13.858a2 2 0 00-1.858-1.995L10 2.5z" />
                                </svg>
                                Me Gusta
                            </button>

                            <button
                                class="flex items-center px-6 py-3 bg-gray-700 text-red-400 font-semibold rounded-full hover:bg-gray-600 transition duration-300">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M18 9.5a1.5 1.5 0 11-3 0v-6a1.5 1.5 0 013 0v6zM10 17.5a1 1 0 001-1V5.996a1 1 0 00-1-1H3.5A2.5 2.5 0 001 7.496v6.008A2.5 2.5 0 003.5 16.004H6.142a2 2 0 001.858 1.995L10 17.5z" />
                                </svg>
                                No Me Gusta
                            </button>
                        </div>

                    </div>
                </div>

            </div>

        </main>
    </div>
</x-app-layout>
