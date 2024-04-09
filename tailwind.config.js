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
            colors: {
                'g6': '#446c00',
                'g6-2': '#324900',
                'g6-3': '#1b2500',
                'atlantis': {
                    '50': '#f8ffe4',
                    '100': '#eeffc5',
                    '200': '#dbff92',
                    '300': '#c2ff53',
                    '400': '#a7fb20',
                    '500': '#80d600',
                    '600': '#67b500',
                    '700': '#4e8902',
                    '800': '#3f6c08',
                    '900': '#375b0c',
                    '950': '#1a3300',
                },
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
