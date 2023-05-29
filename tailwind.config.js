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
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: '#006466',
                secondary: '#1B3A4B',
                success: '#066839',
                danger: '#7C162E',
                warning: '#E47311',
                info: '#114477',
                light: '#07C8F9',
                dark: '#110E1B',
                muted: '#403F4C',
                focus: '#7929E8',
                white: '#F1FAEE'
            }
    },
},

    plugins: [require('@tailwindcss/forms')],
};
