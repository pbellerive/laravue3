import { createI18n } from 'vue-i18n';

let messages = require('./translations.js').default;

// Create VueI18n instance with options
const i18n = createI18n({
  locale: 'fr', // set locale
  fallback: 'en',
  allowComposition: true,
  messages,
  // set locale messages
});

export default i18n;
