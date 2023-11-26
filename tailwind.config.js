/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["*.{php, html}", "**/*.{php, html}"],
  theme: {
    extend: {
      colors: {
        primary: 'rgb(var(--clr-su-primary) / <alpha-value>)',
        accent: 'rgb(var(--clr-su-accent) / <alpha-value>)',
        secondary: 'rgb(var(--clr-su-secondary) / <alpha-value>)',
        tertiary: 'rgb(var(--clr-su-tertiary) / <alpha-value>)'
      },
    },
  },
  plugins: [],
}
