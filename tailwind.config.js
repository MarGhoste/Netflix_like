import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            keyframes: {
        'glitch-top': {
          '0%, 100%': { transform: 'translateX(0)' },
          '20%': { transform: 'translateY(-4px)' },
          '40%': { transform: 'translateY(-4px)' },
          '60%': { transform: 'translateY(-2px)' },
          '80%': { transform: 'translateY(-1px)' },
        },
        'glitch-bottom': {
          '0%, 100%': { transform: 'translateX(0)' },
          '20%': { transform: 'translateY(4px)' },
          '40%': { transform: 'translateY(4px)' },
          '60%': { transform: 'translateY(2px)' },
          '80%': { transform: 'translateY(1px)' },
        },
        'glitch-flicker': {
          '0%': { opacity: '0.8' },
        '2%': { opacity: '1' },
        '4%': { opacity: '0.85' },
        '6%': { opacity: '1' },
        '8%': { opacity: '0.9' },
        '100%': { opacity: '1' },
        },
        'scan-line': {
            '0%': { transform: 'translateY(-100%)' },
            '100%': { transform: 'translateY(200%)' },
        },
      },
      animation: {
        'glitch-top': 'glitch-top 1s cubic-bezier(0.25, 0.46, 0.45, 0.94) infinite alternate',
        'glitch-bottom': 'glitch-bottom 1s cubic-bezier(0.25, 0.46, 0.45, 0.94) infinite alternate',
        'glitch-flicker': 'glitch-flicker 2s steps(1, end) infinite',
        'scan-line': 'scan-line 8s linear infinite', // Línea de escaneo lenta y constante
      },
      filter: {
          'none': 'none',
          'glitch-blur': 'blur(1px)', // Un desenfoque ligero para la interferencia
      },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
