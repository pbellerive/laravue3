import Vue from 'vue'
import VueI18n from 'vue-i18n'

let messages = require('./translations.js').default

Vue.use(VueI18n)

// Create VueI18n instance with options
const i18n = new VueI18n({
  locale: 'fr', // set locale
  fallback: 'en',
  messages
  // set locale messages
})


export default i18n
