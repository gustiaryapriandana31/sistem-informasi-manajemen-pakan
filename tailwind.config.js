import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            screens: {
                xs: "350px", // Sesuaikan ukuran ini sesuai kebutuhan Anda
            },
            fontFamily: {
                caveat: ["Caveat Brush", "cursive"],
                poppins: ["Poppins", "sans-serif"],
                roboto: ["Roboto", "sans-serif"],
                poppins: ["Poppins", "sans-serif"],
                "roboto-mono": ["Roboto Mono", "sans-serif"],
                audiowide: ["Audiowide", "sans-serif"],
                "ibm-plex-mono": ["IBM Plex Mono", "sans-serif"],
            },
        },
    },

    plugins: [forms],
};
