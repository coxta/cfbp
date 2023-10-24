import defaultTheme from 'tailwindcss/defaultTheme';
const colors = require("tailwindcss/colors");
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    safelist: [
        {
            pattern: /./,
        },
    ],
    theme: {
        colors: {
            transparent: "transparent",
            current: "currentColor",
            black: colors.black,
            white: colors.white,
            gray: colors.gray,
            slate: colors.slate,
            indigo: colors.indigo,
            red: colors.red,
            yellow: colors.amber,
            blue: colors.blue,
            green: colors.emerald,
            purple: colors.purple,
            cyan: colors.cyan,
            orange: colors.orange,
            light: 'var(--light)',
            'light-accent': 'var(--lightAccent)',
            muted: 'var(--muted)',
            'muted-accent': 'var(--mutedAccent)',
            dark: 'var(--dark)',
            'dark-accent': 'var(--darkAccent)',
            primary: 'var(--primary)',
            'primary-accent': 'var(--primaryAccent)',
            secondary: 'var(--secondary)',
            'secondary-accent': 'var(--secondaryAccent)',
            success: 'var(--success)',
            'success-accent': 'var(--successAccent)',
            danger: 'var(--danger)',
            'danger-accent': 'var(--dangerAccent)',
            warning: 'var(--warning)',
            'warning-accent': 'var(--warningAccent)',
            info: 'var(--info)',
            'info-accent': 'var(--infoAccent)',
        },
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
