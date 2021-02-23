const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Downtown Regular', ...defaultTheme.fontFamily.sans]
            },
            colors: {
                primary: {
                    DEFAULT: '#7C077E',
                },
                secondary: {
                    DEFAULT: '#210846',
                },
                'link-main': {
                    DEFAULT: '#0ADBFB',
                },
                'link-active': {
                    DEFAULT: '#FFFFFF',
                },
                'border': {
                    DEFAULT: '#43237D',
                }
            },
        },
    },

    variants: {
        opacity: ['responsive', 'hover', 'focus', 'disabled'],
    },

    plugins: [require('@tailwindcss/ui')],
};
