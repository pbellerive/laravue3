module.exports = {
  purge: [
    'node_modules/vue-tailwind/dist/*.js',
    './tailwind.config.js',
    './resources/**/*.blade.php',
    './resources/**/js/components/authentification/*.vue',
    './resources/**/js/components/dashboard/*.vue',
    './resources/**/js/components/error/*.vue',
    './resources/**/js/components/exercise/*.vue',
    './resources/**/js/components/training/*.vue',
    './resources/**/js/components/program/*.vue',
    './resources/**/js/components/ui/*.vue',
    './resources/**/js/components/user/*.vue',
    './resources/**/js/components/*.vue',
    './resources/**/js/bootstrap.js',
    'resources/**/js/vueTailwindBootStrap.js'
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      colors: {
        green: {
          'jem-50': '#C2E561',
          'jem-100': '#BBE250',
          'jem-200': '#B4E03E',
          'jem-300': '#AEDD2C',
          'jem-400': '#A4D322',
          'jem-500': '#95C11F',
          'jem-600': '#88AF1D',
          'jem-700': '#7B9E1A',
          'jem-800': '#6D8C17',
          'jem-900': '#5F7B14',
        },
        gray: {
          'jem-50': '#A3A3A3',
          'jem-100': '#999999',
          'jem-200': '#8F8F8F',
          'jem-300': '#858585',
          'jem-400': '#7A7A7A',
          'jem-500': '#706F6F',
          'jem-600': '#666666',
          'jem-700': '#5C5C5C',
          'jem-800': '#525252',
          'jem-900': '#474747',
        }
      },
    },
  },
  variants: {
    extend: {},
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}
