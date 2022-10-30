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
                    500: '#8980F5',
                    700: '#6762D3',
                },
                secondary: {
                    400: '#C6DCA7',
                    500: '#A8CB7C',
                },
            },
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
