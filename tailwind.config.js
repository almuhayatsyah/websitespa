/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./app/Filament/**/*.php",
        "./resources/views/filament/**/*.blade.php",
        "./vendor/filament/**/*.blade.php",
    ],
    theme: {
        extend: {
            colors: {
                // Warm Earth-tone SPA palette
                spa: {
                    50:  '#faf6f1',
                    100: '#f3ebe0',
                    200: '#e8d5be',
                    300: '#d4b896',
                    400: '#c4a882',
                    500: '#a0845c',
                    600: '#8b6f47',
                    700: '#74593a',
                    800: '#5e4830',
                    900: '#4a3825',
                },
                // Warm accent (sage/olive)
                sage: {
                    50:  '#f6f7f4',
                    100: '#e8ebe2',
                    200: '#d2d8c6',
                    300: '#b3bda1',
                    400: '#96a37e',
                    500: '#7a8963',
                    600: '#606d4e',
                    700: '#4b5540',
                    800: '#3e4535',
                    900: '#353b2f',
                },
                // Cream backgrounds
                cream: {
                    50:  '#fefdfb',
                    100: '#fdf8f0',
                    200: '#faf0e0',
                    300: '#f5e4cc',
                    400: '#efd5b2',
                    500: '#e6c499',
                },
            },
            fontFamily: {
                sans: ['Inter', 'system-ui', 'sans-serif'],
                heading: ['Playfair Display', 'Georgia', 'serif'],
            },
            boxShadow: {
                'soft':  '0 2px 15px -3px rgba(139, 111, 71, 0.07), 0 10px 20px -2px rgba(139, 111, 71, 0.04)',
                'card':  '0 1px 3px rgba(139, 111, 71, 0.05), 0 1px 2px rgba(139, 111, 71, 0.1)',
                'hover': '0 10px 40px -10px rgba(139, 111, 71, 0.25)',
            },
            borderRadius: {
                '2xl': '1rem',
                '3xl': '1.5rem',
                '4xl': '2rem',
            },
            animation: {
                'fade-up':      'fadeUp 0.6s ease-out forwards',
                'fade-in':      'fadeIn 0.4s ease-out forwards',
                'slide-in-left':'slideInLeft 0.5s ease-out forwards',
                'pulse-slow':   'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                'float':        'float 3s ease-in-out infinite',
            },
            keyframes: {
                fadeUp: {
                    '0%':   { opacity: '0', transform: 'translateY(20px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                fadeIn: {
                    '0%':   { opacity: '0' },
                    '100%': { opacity: '1' },
                },
                slideInLeft: {
                    '0%':   { opacity: '0', transform: 'translateX(-20px)' },
                    '100%': { opacity: '1', transform: 'translateX(0)' },
                },
                float: {
                    '0%, 100%': { transform: 'translateY(0px)' },
                    '50%':      { transform: 'translateY(-8px)' },
                },
            },
        },
    },
    plugins: [
        require('@tailwindcss/typography'),
        require('@tailwindcss/forms'),
    ],
};
