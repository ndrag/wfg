const defaultTheme = require('tailwindcss/defaultTheme')
const colors = require('tailwindcss/colors')

module.exports = {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue'
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ['Roboto', ...defaultTheme.fontFamily.sans],
        heading: ['Montserrat', ...defaultTheme.fontFamily.sans]
      },
       //https://tailwindcss.com/docs/customizing-colors#curating-colors
      colors: {
        gray: colors.stone,
      }
    }
  },
  plugins: [require('@tailwindcss/forms', '@tailwindcss/aspect-ratio')]
}
