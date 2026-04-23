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
                "primary": "#004A99",
                "surface-container-lowest": "#ffffff",
                "on-surface": "#191c1e",
                "on-surface-variant": "#424751",
                "outline": "#737783",
                "outline-variant": "#c2c6d3",
                "surface-container-low": "#f2f4f6",
                "surface-container-high": "#e6e8ea",
                "on-primary": "#ffffff",
                "primary-container": "#003b7a"
            },
            fontFamily: {
                "headline": ["Manrope", "sans-serif"],
                "body": ["Inter", "sans-serif"],
            },
        },
    },
    plugins: [require('@tailwindcss/forms')],
};