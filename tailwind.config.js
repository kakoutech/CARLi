const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                'brand': {
                    100: '#ff729c',
                    200: '#ff729c',
                    300: '#ff729c',
                    400: '#ff729c',
                    500: '#ff729c',
                    600: '#ff729c',
                    700: '#CC5B7C',
                    800: '#CC5B7C',
                    900: '#CC5B7C',
                }
            },
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
