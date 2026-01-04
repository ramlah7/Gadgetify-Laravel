/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                navy: {
                    900: '#020617', // Deep Navy/Black
                    800: '#0f172a', // Slate 900 for cards
                    700: '#1e293b', // Slate 800 for lighter cards
                },
                blue: {
                    500: '#3b82f6', // Electric Blue
                    400: '#60a5fa',
                },
                cyan: {
                    400: '#22d3ee', // Cyan Accents
                    500: '#06b6d4',
                }
            },
            fontFamily: {
                sans: ['Inter', 'Montserrat', 'sans-serif'],
            },
            animation: {
                'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                'float': 'float 6s ease-in-out infinite',
            },
            keyframes: {
                float: {
                    '0%, 100%': { transform: 'translateY(0)' },
                    '50%': { transform: 'translateY(-10px)' },
                }
            }
        },
    },
    plugins: [],
};

