module.exports = {
  content: ['./tailwind.config.js', './resources/**/*.blade.php', './resources/**/js/**/*.vue', './resources/**/js/bootstrap.js', 'resources/**/js/vueTailwindBootStrap.js', './node_modules/laravue-ui-components/**/*.vue'],
  darkMode: 'media', // or 'media' or 'class'
  theme: {
    extend: {},
  },
  variants: {
    extend: {},
  },
  // plugins: [require('@tailwindcss/forms')],
};
