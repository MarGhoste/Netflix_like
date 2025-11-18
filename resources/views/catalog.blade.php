<x-app-layout>

    <div id="app-container-teatro" class="min-h-screen bg-gradient-to-br from-gray-900 to-black text-white">

        <!-- CAMBIO CLAVE AQUÍ: Pasamos la variable $sidebarGenres al componente Blade -->
        <x-app.sidebar />

        {{-- Contenido principal --}}
        <main id="teatro-escenario" class="ml-20 mx-auto max-w-7xl py-12 px-4 sm:px-8">

            <div class="border-b border-purple-800/50 pb-4 mb-8">
                <h1 class="text-4xl sm:text-5xl font-extrabold text-purple-400">{{ $pageTitle }}</h1>
                <p class="text-lg text-gray-400 mt-2">{{ $pageDescription }}</p>
            </div>

            {{-- CUADRÍCULA DINÁMICA DE PELÍCULAS --}}
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-6">

                {{-- CORRECCIÓN CLAVE: Iterar sobre $movies (plural) como $movie (singular) --}}
                @foreach ($movies as $movie)
                    {{-- Tarjeta de Película con efecto hover mejorado --}}
                    <a href="{{ route('movie.show', ['id' => $movie->id]) }}"
                        class="group relative block bg-gray-900 rounded-lg overflow-hidden shadow-lg 
                        transition-all duration-300 ease-in-out transform hover:scale-105 hover:shadow-purple-500/40">

                        <img src="{{ asset('storage/' . $movie->image) }}" alt="{{ $movie->title }}"
                            class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">

                        {{-- Superposición con gradiente e información que aparece al hacer hover --}}
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-transparent 
                                    opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-4">

                            {{-- Icono de Play --}}
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div
                                    class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center
                                            backdrop-blur-sm opacity-0 group-hover:opacity-100 scale-75 group-hover:scale-100 transition-all duration-300">
                                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z">
                                        </path>
                                    </svg>
                                </div>
                            </div>

                            <h3 class="text-base font-bold text-white truncate">{{ $movie->title }}</h3>
                            <span
                                class="text-sm text-gray-300">{{ $movie->release_date ? \Carbon\Carbon::parse($movie->release_date)->format('Y') : 'N/A' }}</span>
                        </div>
                    </a>
                @endforeach

            </div>

            {{-- Paginación con estilos personalizados para el tema oscuro --}}


        </main>
    </div>

</x-app-layout>
