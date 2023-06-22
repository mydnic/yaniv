const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        'node_modules/abcreche-ui/src/js/components/**/*.vue',
        './app/**/*.php',
        './resources/**/*.html',
        './resources/**/*.js',
        './resources/**/*.php',
        './resources/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: [...defaultTheme.fontFamily.sans]
            },
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
