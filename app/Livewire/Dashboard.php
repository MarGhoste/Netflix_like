<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{

    // Esta es la lógica del componente.
    // Por ahora, lo dejamos vacío, pero aquí irán:
    // - Las películas o series principales (variables)
    // - La lógica de búsqueda, filtros, etc.


    public function render()
    {
        // Esta función carga la vista livewire/dashboard.blade.php
        return view('livewire.dashboard')
         ->layout('layouts.app');
    }

     public function logout()
    {
        // Cierra la sesión
        Auth::guard('web')->logout();

        // Invalida la sesión (prevención de seguridad)
        session()->invalidate();
        
        // Regenera el token CSRF (prevención de seguridad)
        session()->regenerateToken();

        // Redirige a la página de inicio (o a donde desees)
        return redirect('/');
    }
}
