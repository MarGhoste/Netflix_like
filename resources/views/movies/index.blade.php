<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Catálogo de Películas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach ($movies as $movie)
                            <div class="bg-gray-200 p-4 rounded-lg">
                                <a href="{{ route('movies.show', $movie) }}">
                                    {{-- Use the 'image' attribute from the database --}}
                                    @if($movie->image)
                                        <img src="{{ $movie->image }}" alt="{{ $movie->title }}" class="w-full h-auto rounded-md mb-4">
                                    @else
                                        {{-- Placeholder if no poster --}}
                                        <div class="w-full h-64 bg-gray-400 flex items-center justify-center rounded-md mb-4">
                                            <span class="text-gray-600">{{ $movie->title }}</span>
                                        </div>
                                    @endif
                                    <h3 class="font-bold text-lg">{{ $movie->title }}</h3>
                                </a>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6">
                        {{ $movies->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
