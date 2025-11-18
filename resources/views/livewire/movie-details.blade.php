<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-900 to-black text-white">

        <x-app.sidebar />

        <main class="ml-20">
            {{-- HERO BANNER DE LA PELÍCULA --}}
            <div class="relative w-full h-[60vh] min-h-[500px] flex items-center justify-start">

                {{-- Imagen de fondo con superposición oscura --}}
                <div class="absolute inset-0">
                    <img src="{{ asset('storage/' . $movie->image) }}" alt="Fondo de {{ $movie->title }}"
                        class="w-full h-full object-cover opacity-30">
                    <div class="absolute inset-0 bg-gradient-to-r from-black via-black/80 to-transparent">
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent">
                    </div>
                </div>

                {{-- Contenido de Información --}}
                <div class="relative z-10 max-w-7xl mx-auto px-8 w-full">
                    <div class="max-w-3xl">
                        <h1
                            class="text-5xl md:text-7xl font-extrabold text-white drop-shadow-lg [text-shadow:0_0_15px_#9333ea]">
                            {{ $movie->title }}
                        </h1>

                        {{-- Metadatos --}}
                        <div class="flex items-center flex-wrap gap-x-4 gap-y-2 mt-4 text-gray-300 font-semibold">
                            <span>{{ $movie->release_date ? \Carbon\Carbon::parse($movie->release_date)->format('Y') : 'N/A' }}</span>
                            <span class="border border-gray-500 px-2 py-0.5 rounded text-sm">HD</span>
                            <span>{{ $movie->duration ? $movie->duration . ' min' : '' }}</span>
                            @if ($movie->genres->isNotEmpty())
                                <span>&bull;</span>
                                <span>{{ $movie->genres->pluck('name')->implode(', ') }}</span>
                            @endif
                        </div>

                        <p class="text-gray-300 leading-relaxed mt-6 max-w-2xl">
                            {{ $movie->description }}
                        </p>

                        {{-- Botones de Acción --}}
                        <div class="flex flex-wrap items-center gap-4 mt-8">
                            <a href="{{ route('movie.watch', ['movie' => $movie->id]) }}"
                                class="flex items-center px-6 py-3 bg-white text-black font-extrabold text-lg rounded-md shadow-xl hover:bg-gray-200 transition duration-300 transform hover:scale-105">
                                <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Iniciar Película
                            </a>

                            <a href="{{ route('my-list') }}"
                                class="flex items-center px-6 py-3 bg-gray-700/70 text-white font-semibold text-lg rounded-md shadow-lg hover:bg-gray-600/80 transition duration-300 backdrop-blur-sm">
                                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                                Mi Lista
                            </a>

                            {{-- INTEGRACIÓN DE LIVEWIRE AQUI --}}
                            @livewire('movie-rating', ['movie' => $movie])
                            {{-- FIN INTEGRACIÓN --}}
                        </div>
                    </div>
                </div>
            </div>

            {{-- Contenido Adicional (Actores, Director, etc.) --}}
            <div class="max-w-7xl mx-auto px-8 py-12">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-gray-300">
                    <div>
                        <h3 class="text-gray-500 font-semibold mb-2">Director</h3>
                        <p class="text-lg">{{ $movie->director->name ?? 'No disponible' }}</p>
                    </div>
                    <div>
                        <h3 class="text-gray-500 font-semibold mb-2">Elenco</h3>
                        <p class="text-lg">{{ $movie->actors->pluck('name')->take(5)->implode(', ') }}...</p>
                    </div>
                    <div>
                        <h3 class="text-gray-500 font-semibold mb-2">Clasificación</h3>
                        <p class="text-lg">+16 (Ejemplo)</p>
                    </div>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>
