<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Movie;

class Dashboard extends Component
{
    public $heroMovie;
    public $newMovies;
    public $trendingMovies;
    public $recommendedMovies;

    public function mount()
    {
        // Lógica de carga de datos (NO necesita cambiarse)
        $this->heroMovie = Movie::where('is_published', true)->where('is_trending', true)->latest('id')->first();
        $this->newMovies = Movie::where('is_published', true)->where('is_new', true)->latest('release_date')->take(12)->get();
        $this->trendingMovies = Movie::where('is_published', true)->where('is_trending', true)->latest('created_at')->take(12)->get();
        $this->recommendedMovies = $this->newMovies;
    }

    // EL PUNTO CLAVE ES AQUÍ: APUNTAR A LA UBICACIÓN CORRECTA DE LA VISTA
    public function render()
    {
        // ESTO ASUME QUE EL ARCHIVO DE TU DASHBOARD ES: resources/views/livewire/dashboard.blade.php
        return view('livewire.dashboard')
            ->layout('layouts.app');
    }

    public function logout()
    {
        // ... (Lógica de logout) ...
        Auth::guard('web')->logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect('/');
    }
}
