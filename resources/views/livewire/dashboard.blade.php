<div class="min-h-screen bg-gradient-to-br from-gray-900 to-black text-white">

    <!-- CAMBIO CLAVE: Pasamos la variable $sidebarGenres al componente. -->
    <x-app.sidebar />

    <!-- Contenido principal: Centramos el contenido y le damos un máximo de ancho para un look de aplicación -->
    <main class="ml-20 px-4 sm:px-8 py-8 mx-auto max-w-7xl">

        {{-- === HERO BANNER PRINCIPAL: TEMA MORADO/DORADO === --}}
        {{-- Usamos un borde sutil y un ligero offset para darle profundidad (shadow-purple/gold) --}}
        <div
            class="relative w-full h-96 bg-gray-900 rounded-xl overflow-hidden shadow-2xl 
                    transform transition duration-500 hover:shadow-purple-600/50 hover:scale-[1.005] 
                    border border-purple-800/50">

            {{-- VERIFICACIÓN CLAVE: Solo muestra el contenido si $heroMovie existe --}}
            @if ($heroMovie)
                {{-- Imagen de fondo con gradiente oscurecedor --}}
                <img src="{{ asset('storage/' . $heroMovie->image) }}" alt="{{ $heroMovie->title }}"
                    class="w-full h-full object-cover opacity-40 transition-opacity duration-500">

                {{-- Contenedor del texto: Gradient from-black/90 para garantizar legibilidad --}}
                <div
                    class="absolute inset-0 p-8 sm:p-12 flex flex-col justify-end bg-gradient-to-t from-black via-black/70 to-transparent">

                    <div class="w-full max-w-3xl">
                        {{-- Título: Más grande y con un sutil brillo dorado --}}
                        <h2
                            class="text-5xl sm:text-7xl font-extrabold mb-3 text-white 
                                    drop-shadow-lg [text-shadow:0_0_10px_#9333ea,0_0_20px_#facc15]">
                            {{ $heroMovie->title }}
                        </h2>

                        {{-- Metadatos: Año, Géneros, Calificación --}}
                        <div class="flex items-center space-x-4 mb-4 text-gray-300 font-semibold">
                            <span>{{ \Carbon\Carbon::parse($heroMovie->release_date)->format('Y') }}</span>
                            <span class="border border-gray-500 px-2 py-0.5 rounded text-sm">HD</span>
                            @if ($heroMovie->genres->count() > 0)
                                <span>{{ $heroMovie->genres->first()->name }}</span>
                            @endif
                            <span class="flex items-center">
                                <svg class="w-5 h-5 text-yellow-400 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                8.5
                            </span>
                        </div>

                        {{-- Descripción: Un poco más sutil --}}
                        <p class="text-base sm:text-lg text-gray-300 mb-6 max-w-2xl font-light">
                            {{ \Illuminate\Support\Str::limit($heroMovie->description, 150) }}
                        </p>

                        <div class="flex space-x-4 mt-2">
                            {{-- Botón "Ver Ahora": Destacado en dorado/blanco --}}
                            <a href="{{ route('movie.show', ['id' => $heroMovie->id]) }}"
                                class="flex items-center px-6 py-3 bg-white text-black font-extrabold text-lg rounded-md shadow-xl hover:bg-gray-200 transition duration-300 transform hover:scale-105">
                                <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Ver Ahora
                            </a>

                            {{-- Botón "Mi Lista": Estilo secundario --}}
                            <a href="{{ route('my-list') }}"
                                class="flex items-center px-6 py-3 bg-gray-700/70 text-white font-semibold text-lg rounded-md shadow-lg hover:bg-gray-600/80 transition duration-300 backdrop-blur-sm">
                                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                                Mi Lista
                            </a>
                        </div>
                    </div>
                </div>
            @else
                {{-- Alternativa si no hay hero movie --}}
                <div class="absolute inset-0 flex items-center justify-center bg-gray-900/80">
                    <p class="text-xl text-gray-400">¡Carga tu primera película destacada en
                        el Panel de Administración!</p>
                </div>
            @endif
        </div>

        {{-- === FILA DE CONTENIDO (CARRUSEL) === --}}

        {{-- === SECCIÓN DE CUADRÍCULA (Recomendados) === --}}
        <x-movie-row-carousel title="Recomendados para ti" :movies="$recommendedMovies" class="mt-12" />
        {{-- FIN DE FILA DE CONTENIDO (Recomendados) --}}


        {{-- === SECCIÓN DE CUADRÍCULA (Lo Nuevo) === --}}
        <x-movie-row-carousel title="Lo Nuevo" :movies="$newMovies" class="mt-10" />
        {{-- FIN DE FILA DE LA SEGUNDA FILA DE CONTENIDO (Lo Nuevo) --}}

        {{-- === FILA DE CONTENIDO (TENDENCIAS) === --}}
        <x-movie-row-carousel title="Tendencia Global" :movies="$trendingMovies" class="mt-10" />
        {{-- FIN DE LA FILA DE TENDDENCIAS --}}

        {{-- -------------------------------------------------------------------------------- --}}
        {{-- === CARRUSELES DINÁMICOS POR GÉNERO === --}}
        @if (isset($genresWithMovies) && $genresWithMovies->count() > 0)
            <h3 class="text-2xl font-bold mt-16 mb-4 text-gray-300">
                Explorar por Género
            </h3>
            @foreach ($genresWithMovies as $genre)
                @if ($genre->movies->count() > 0)
                    <x-movie-row-carousel title="{{ $genre->name }}" :movies="$genre->movies" class="mt-10" />
                @endif
            @endforeach
        @endif
        {{-- -------------------------------------------------------------------------------- --}}


    </main>
    <!-- Fin del contenido principal -->
</div>
