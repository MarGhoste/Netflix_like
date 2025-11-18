<div class="min-h-screen bg-black text-white">

    <!-- Incluye el sidebar para navegación lateral, pasando los géneros -->
    <x-app.sidebar />

    <main class="ml-20 mx-auto max-w-7xl pt-8 pb-12 px-4 sm:px-8">

        <h1 class="text-4xl font-extrabold pt-10 text-white mb-2 [text-shadow:0_0_10px_#facc15]">Mi Lista de Favoritos
        </h1>
        <p class="text-lg text-gray-400 mb-8">Películas y series que has añadido a tu colección.</p>

        @if ($favoriteMovies->count() > 0)
            {{-- CUADRÍCULA DE PELÍCULAS FAVORITAS --}}
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-6">

                @foreach ($favoriteMovies as $movie)
                    <a href="{{ route('movie.show', ['id' => $movie->id]) }}"
                        class="bg-gray-900 rounded-lg overflow-hidden shadow-xl 
                                transform transition duration-500 hover:scale-[1.03] 
                                hover:shadow-purple-500/50 border border-transparent hover:border-yellow-400">

                        <!-- Tarjeta de la película -->
                        <img src="{{ asset('storage/' . $movie->image) }}" alt="{{ $movie->title }}"
                            class="w-full h-72 object-cover">

                        <div class="p-3 text-center">
                            <h3 class="text-base font-semibold truncate text-white">{{ $movie->title }}</h3>
                            <p class="text-sm text-gray-400">
                                {{ $movie->release_date ? date('Y', strtotime($movie->release_date)) : 'N/A' }}
                            </p>
                        </div>
                    </a>
                @endforeach

            </div>

            {{-- Paginación --}}
            <div class="mt-8">
                {{ $favoriteMovies->links() }}
            </div>
        @else
            {{-- Mensaje si la lista está vacía --}}
            <div class="text-center p-20 bg-gray-900/50 rounded-lg mt-10">
                <p class="text-2xl text-gray-400">Tu lista de favoritos está vacía.</p>
                <p class="text-lg text-gray-500 mb-6">Añade películas usando el botón "+ Mi Lista" en la página de
                    detalles.</p>
                <a href="{{ route('dashboard') }}"
                    class="mt-4 inline-block px-6 py-3 bg-purple-600 text-white font-semibold rounded-full hover:bg-purple-700 transition">
                    Ver el Catálogo
                </a>
            </div>
        @endif

    </main>
</div>
