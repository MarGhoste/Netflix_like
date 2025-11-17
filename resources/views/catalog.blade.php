<x-app-layout>

    <div id="app-container-teatro" class="min-h-screen bg-black text-white">

        <x-app.sidebar />

        {{-- Contenido principal --}}
        <main id="teatro-escenario" class="ml-20 mx-auto max-w-7xl pt-8 pb-12 px-8">

            <h1 class="text-4xl font-extrabold pt-10 text-white mb-2">{{ $pageTitle }}</h1>
            <p class="text-lg text-gray-400 mb-8">{{ $pageDescription }}</p>

            {{-- CUADRÍCULA DINÁMICA DE PELÍCULAS --}}
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-6">

                {{-- CORRECCIÓN CLAVE: Iterar sobre $movies (plural) como $movie (singular) --}}
                @foreach ($movies as $movie)
                    <a href="{{ route('movie.show', ['id' => $movie->id]) }}"
                        class="bg-gray-900 rounded-lg overflow-hidden shadow-xl transform transition duration-500 hover:scale-[1.03] hover:shadow-purple-500/50">

                        {{-- CORRECCIÓN 1: Usar la columna 'image' de la base de datos --}}
                        <img src="{{ asset('storage/' . $movie->image) }}" alt="{{ $movie->title }}"
                            class="w-full h-72 object-cover">

                        <div class="p-3 text-center">
                            {{-- CORRECCIÓN 2: Usar las propiedades de $movie --}}
                            <h3 class="text-base font-semibold truncate text-white">{{ $movie->title }}</h3>
                            <p class="text-sm text-gray-400">
                                {{-- CORRECCIÓN 3: Acceder al release_date --}}
                                {{ $movie->release_date ? date('Y', strtotime($movie->release_date)) : 'N/A' }}
                            </p>
                        </div>
                    </a>
                @endforeach

            </div>

            {{-- Paginación enviada por el controlador --}}
            <div class="mt-8 col-span-full">
                {{ $movies->links() }}
            </div>

        </main>
    </div>

</x-app-layout>
