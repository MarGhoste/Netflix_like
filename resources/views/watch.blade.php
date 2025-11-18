<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reproduciendo: {{ $movie->title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://player.vimeo.com/api/player.js"></script>
    <style>
        /* --- Estilos Generales y de Fondo --- */
        body {
            background-color: #111827;
            /* gray-900 */
        }

        /* --- Contenedor del Video --- */
        /* Contenedor responsivo para el iframe (16:9) */
        .video-container {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
        }

        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        /* --- Caja de Recomendación Mejorada --- */
        #recommendation-box {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 20;
            background-size: cover;
            background-position: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 2rem;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.6s ease-in-out;
        }

        #recommendation-box.active {
            opacity: 1;
            pointer-events: auto;
        }

        /* Efecto de superposición oscura y desenfoque */
        #recommendation-box::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            z-index: -1;
        }
    </style>
</head>

<body class="antialiased text-gray-200">

    {{-- Botón de Volver Minimalista --}}
    <a href="{{ route('movie.show', ['id' => $movie->id]) }}" title="Volver a {{ $movie->title }}"
        class="group absolute z-30 top-6 left-6 flex items-center justify-center w-12 h-12 bg-black/40 rounded-full hover:bg-black/60 transition-all duration-300">
        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
    </a>

    <main class="min-h-screen pt-16 lg:pt-0 flex flex-col items-center">

        <div class="w-full max-w-7xl px-4 pt-4 lg:pt-8 relative">

            <div class="video-container rounded-xl overflow-hidden shadow-2xl">
                @php
                    // Lógica para construir la URL de Vimeo de forma robusta
                    $trailerUrl = $movie->trailer_url;
                    $queryParams = http_build_query([
                        'autoplay' => 1,
                        'muted' => 1,
                        'color' => '6d28d9',
                        'title' => 0,
                        'byline' => 0,
                        'portrait' => 0,
                    ]);
                    $finalUrl = $trailerUrl . (str_contains($trailerUrl, '?') ? '&' : '?') . $queryParams;
                @endphp
                <iframe id="vimeo-player" src="{{ $finalUrl }}" frameborder="0"
                    allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>

                {{-- Caja de recomendación rediseñada --}}
                <div id="recommendation-box">
                    <h2 class="text-4xl font-bold mb-2 text-white drop-shadow-lg">Fin del video</h2>
                    <p class="text-lg text-gray-300 mb-6 drop-shadow-md">A continuación:</p>
                    <h3 id="recommendation-title"
                        class="text-3xl md:text-5xl font-extrabold mb-8 text-white drop-shadow-xl"></h3>
                    <a id="recommendation-link" href="#"
                        class="flex items-center gap-3 bg-white text-black font-bold py-3 px-8 rounded-lg shadow-lg transition duration-300 transform hover:scale-105 hover:bg-gray-200">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z">
                            </path>
                        </svg>
                        Ver Siguiente
                    </a>
                </div>
            </div>
        </div>

    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {

            // --- DATOS DE LARAVEL ---
            const nextMovie = {
                title: "{{ $nextMovie->title ?? 'Catálogo' }}",
                url: "{{ $nextMovie ? route('movie.watch', ['movie' => $nextMovie->id]) : route('dashboard') }}",
                // Pasamos la URL de la imagen para el fondo de la recomendación
                imageUrl: "{{ $nextMovie ? asset('storage/' . $nextMovie->image) : '' }}"
            };

            const iframe = document.getElementById('vimeo-player');
            if (!iframe) return console.error("Iframe 'vimeo-player' no encontrado.");

            const player = new Vimeo.Player(iframe);
            const recommendationBox = document.getElementById('recommendation-box');
            const recommendationTitle = document.getElementById('recommendation-title');
            const recommendationLink = document.getElementById('recommendation-link');

            // --- ¡CAMBIO CLAVE PARA PANTALLA COMPLETA! ---
            // Cuando el video comience a reproducirse (evento 'playing'), intentamos ponerlo en pantalla completa.
            // Nota: Esto puede ser bloqueado por algunos navegadores si no detectan una interacción reciente del usuario.
            player.on('playing', function() {
                player.requestFullscreen().catch(error => {
                    // Es normal que esto falle si el usuario no ha interactuado con la página,
                    // por lo que usamos console.warn para no mostrar un error alarmante.
                    console.warn('No se pudo activar la pantalla completa automáticamente:', error);
                });
            });

            // Escuchar el evento 'ended' (Fin del video)
            player.on('ended', function() {
                // Aplicamos el título y la URL
                recommendationTitle.innerText = nextMovie.title;
                recommendationLink.href = nextMovie.url;

                // Aplicamos la imagen de fondo si existe
                if (nextMovie.imageUrl) {
                    recommendationBox.style.backgroundImage = `url('${nextMovie.imageUrl}')`;
                }

                // Mostramos la caja de recomendación
                recommendationBox.classList.add('active');
            });

            player.on('error', function(error) {
                console.error('Error de Vimeo Player:', error);
            });
        });
    </script>
</body>

</html>
</p>
</div>
</div>
</div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', () => {

        // --- DATOS DE LARAVEL ---
        const nextMovie = {
            title: "{{ $nextMovie->title ?? 'Error: Película no encontrada' }}",
            // CORRECCIÓN: Usamos ['movie' => $nextMovie->id] para que coincida con la definición de la ruta
            url: "{{ $nextMovie ? route('movie.watch', ['movie' => $nextMovie->id]) : url('/') }}"
        };

        const iframe = document.getElementById('vimeo-player');
        if (!iframe) return console.error("Iframe 'vimeo-player' no encontrado.");

        const player = new Vimeo.Player(iframe);
        const recommendationBox = document.getElementById('recommendation-box');
        const recommendationText = document.getElementById('recommendation-text');
        const recommendationLink = document.getElementById('recommendation-link');

        // Escuchar el evento 'ended' (Fin del video)
        player.on('ended', function() {
            recommendationText.innerText = 'Siguiente: ' + nextMovie.title;
            recommendationLink.href = nextMovie.url;
            recommendationBox.classList.add('active');
        });

        player.on('error', function(error) {
            console.error('Error de Vimeo Player:', error);
        });
    });
</script>
</body>

</html>

<a href="{{ route('movie.show', ['id' => $movie->id]) }}"
