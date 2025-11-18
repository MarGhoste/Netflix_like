<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Dashboard;

Route::view('/', 'welcome');

//Route::view('dashboard', 'dashboard')
//->middleware(['auth', 'verified'])
//->name('dashboard');

Route::get('/dashboard', Dashboard::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

use App\Http\Controllers\ActorController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DirectorController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\RatingController;


Route::middleware('auth')->group(function () {
    Route::resource('movies', MovieController::class);
    Route::resource('genres', GenreController::class);
    Route::resource('directors', DirectorController::class);
    Route::resource('actors', ActorController::class);
    Route::resource('ratings', RatingController::class);
    Route::resource('comments', CommentController::class);
});

// routes/web.php

use App\Models\Movie; // Asegúrate de que tu modelo exista

Route::get('/movie/{id}', function ($id) {
    // Usa findOrFail para buscar por la columna 'id'
    $movie = Movie::findOrFail($id);

    return view('livewire.movie-details', compact('movie'));
})->name('movie.show');

// routes/web.php

use App\Http\Controllers\CatalogController; // Creamos este controlador en el siguiente paso
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\WatchController;
use App\Livewire\MyList;

// Ruta dinámica: acepta 'recomendados', 'nuevo', o 'tendencias'
Route::get('/catalogo/{category}', [CatalogController::class, 'show'])
    ->name('catalog.show');

Route::post('logout', function (Request $request) {
    // 1. Cierra la sesión del usuario
    Auth::guard('web')->logout();

    // 2. Invalida la sesión actual
    $request->session()->invalidate();

    // 3. Regenera el token CSRF para evitar ataques
    $request->session()->regenerateToken();

    // 4. Redirige al usuario a la página de inicio o a donde desees
    // Usualmente es la página de login ('login') o la raíz ('/')
    return redirect('/');
})->middleware('auth')->name('logout');

Route::get('/watch/{movie}', [WatchController::class, 'show'])
    ->middleware(['auth', 'verified'])
    ->name('movie.watch');

Route::get('/mi-lista', MyList::class)
    ->middleware('auth') // Clave: Solo usuarios logueados pueden acceder
    ->name('my-list');


require __DIR__ . '/auth.php';
