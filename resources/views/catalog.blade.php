<x-app-layout>

    <div id="app-container-teatro" class="min-h-screen bg-black text-white">

        <x-app.sidebar />

        {{-- Contenido principal --}}
        <main id="teatro-escenario" class="ml-20 mx-auto max-w-7xl pt-8 pb-12 px-8">

            <h1 class="text-4xl font-extrabold pt-10 text-white mb-2">{{ $pageTitle }}</h1>
            <p class="text-lg text-gray-400 mb-8">{{ $pageDescription }}</p>

            {{-- CUADRÍCULA DINÁMICA DE PELÍCULAS --}}
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-6">

                @foreach ($movies as $movieId)
                    <a href="{{ route('movie.show', ['id' => $movieId]) }}"
                        class="bg-gray-900 rounded-lg overflow-hidden shadow-xl transform transition duration-500 hover:scale-[1.03] hover:shadow-purple-500/50">

                        {{-- Usamos el ID del bucle para la imagen de ejemplo --}}
                        <img src="{{ asset('images/poster-' . $movieId . '.jpg') }}" alt="Póster {{ $movieId }}"
                            class="w-full h-72 object-cover">
                        <div class="p-3 text-center">
                            <h3 class="text-base font-semibold truncate text-white">Película ID: {{ $movieId }}
                            </h3>
                        </div>
                    </a>
                @endforeach

            </div>
            {{-- Aquí iría la paginación si usaras datos reales --}}

        </main>
    </div>

</x-app-layout>
