const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        borderColor: theme => ({
            ...theme('colors'),
            'primary': 'rgb(49, 58, 85)',
        }),
        backgroundColor: theme => ({
            ...theme('colors'),
            'primary': 'rgb(41, 49, 69)',
            'secondary': 'rgb(35, 42, 59)',
            'active': 'rgb(58, 141, 245)',
        }),
        extend: {
            fontFamily: {
                sans: ['Roboto', ...defaultTheme.fontFamily.sans],
                mono: ['Roboto', ...defaultTheme.fontFamily.sans],
                'logo': ['Passion One', ...defaultTheme.fontFamily.sans]
            },
            colors: {
                primary: {
                    DEFAULT: 'rgb(226, 232, 240)',
                },
                secondary: {
                    DEFAULT: 'rgb(113, 128, 150)',
                },
                'link-active': {
                    DEFAULT: 'rgb(58, 141, 245)',
                }
            },
        },
    },

    variants: {
        opacity: ['responsive', 'hover', 'focus', 'disabled'],
    },

    plugins: [require('@tailwindcss/ui')],
};
