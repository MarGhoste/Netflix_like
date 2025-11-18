# Plataforma de Streaming tipo Netflix

Este proyecto es una aplicación web desarrollada con Laravel y Livewire que emula las funcionalidades básicas de una plataforma de streaming de video como Netflix. Permite a los usuarios explorar un catálogo de películas, ver detalles, añadirlas a una lista personal y calificarlas.

**Desarrollado por:** Marcos Carpio Corazon.

---

## ✨ Características Principales

-   **Dashboard Dinámico:** Página de inicio que muestra una película destacada (Hero), carruseles de "Novedades", "Tendencias" y películas organizadas por género.
-   **Catálogo Completo:** Explora películas por categorías como "Lo más nuevo", "Tendencias" o por géneros específicos.
-   **Páginas de Detalle:** Cada película tiene su propia página con sinopsis, director, actores, y más.
-   **Sistema de "Mi Lista":** Los usuarios autenticados pueden añadir o quitar películas de su lista personal de favoritos.
-   **Calificación de Contenido:** Sistema de "Like" y "Dislike" para que los usuarios puedan valorar las películas.
-   **Interacción Inteligente:**
    -   Dar "Like" a una película la añade automáticamente a "Mi Lista".
    -   Quitar el "Like" o dar "Dislike" la elimina de "Mi Lista".
    -   El botón "+ Mi Lista" del banner principal utiliza el sistema de Eventos Globales de Livewire para comunicarse con los componentes de calificación, asegurando que el estado de isFavorite se mantenga sincronizado en toda la interfaz.
-   **Paginación:** Las listas largas de películas en el catálogo y "Mi Lista" están paginadas para un mejor rendimiento.
-   **Diseño Responsivo:** Interfaz estilizada con Tailwind CSS, adaptada para una experiencia de usuario agradable en diferentes dispositivos.
-   **Panel de Administración Profesional:** Módulo privado construido con Filament PHP, que proporciona una interfaz de gestión elegante y centralizada para el contenido y los usuarios.
-   **Control de Acceso Basado en Roles (RBAC):** Implementación robusta de roles y permisos a través del paquete Spatie Laravel Permission para controlar granularmente el acceso a las funcionalidades del panel.

---

## 🚀 Tecnologías Utilizadas

-   **Stack Principal (TALL Stack):**
    -   [PHP 8+](https://www.php.net/)
    -   [Laravel 12](https://laravel.com/)
    -   [Livewire 3](https://livewire.laravel.com/)
-   **Frontend:**
    -   [Tailwind CSS](https://tailwindcss.com/)
    -   [Alpine.js](https://alpinejs.dev/) (integrado en el stack TALL)
    -   [Vite](https://vitejs.dev/) para la compilación de assets.
-   **Base de Datos:**
    -   MySQL / MariaDB

---

## 📋 Guía de Instalación Local

Sigue estos pasos para poner en marcha el proyecto en tu entorno de desarrollo.

1.  **Clonar el repositorio:**

    ```bash
    git clone https://github.com/MarGhoste/Netflix_like.git
    cd Netflix_like
    ```

2.  **Instalar dependencias de PHP:**

    ```bash
    composer install
    ```

3.  **Instalar dependencias de Node.js:**

    ```bash
    npm install
    ```

4.  **Configurar el entorno:**

    -   Copia el archivo de ejemplo `.env.example` a `.env`.

    ```bash
    cp .env.example .env
    ```

    -   Genera una nueva clave de aplicación.

    ```bash
    php artisan key:generate
    ```

5.  **Configurar la Base de Datos:**

    -   Abre tu archivo `.env` y configura los datos de conexión a tu base de datos (DB_DATABASE, DB_USERNAME, DB_PASSWORD).

6.  **Ejecutar las migraciones:**
    Esto creará todas las tablas necesarias en tu base de datos.

    ```bash
    php artisan migrate
    ```

7.  **(Opcional) Poblar la base de datos:**
    ejecuta los seeders para generar datos de prueba (películas, géneros, etc.)

    ```bash
    php artisan db:seed
    ```

8.  **Compilar los assets:**
    Ejecuta Vite en modo de desarrollo para compilar CSS y JS.

    ```bash
    npm run dev
    ```

9.  **Iniciar el servidor:**
    Finalmente, inicia el servidor de desarrollo de Laravel.
    ```bash
    php artisan serve
    ```

¡Listo! Ahora puedes acceder a la aplicación desde `http://127.0.0.1:8000`.

CUALQUIER DUDA NO DUDES EN ESCRIBIRME :D !!!
