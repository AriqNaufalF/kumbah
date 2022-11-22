const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Poppins', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    400: '#B2ADF5',
                    600: '#8980F5',
                    800: '#6762D3',
                },
                secondary: {
                    400: '#FFE45E',
                    600: '#FFD60A',
                },
                tertiary: {
                    400: '#FF6392',
                    600: '#FF3370',
                },
            },
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
