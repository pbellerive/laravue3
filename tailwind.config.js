module.exports = {
  purge: [
    'node_modules/vue-tailwind/dist/*.js',
    './tailwind.config.js',
    './resources/**/*.blade.php',
    './resources/**/js/components/authentification/*.vue',
    './resources/**/js/components/dashboard/*.vue',
    './resources/**/js/components/error/*.vue',
    './resources/**/js/components/ui/*.vue',
    './resources/**/js/components/user/*.vue',
    './resources/**/js/components/*.vue',
    './resources/**/js/bootstrap.js',
    'resources/**/js/vueTailwindBootStrap.js'
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
    },
  },
  variants: {
    extend: {},
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}
