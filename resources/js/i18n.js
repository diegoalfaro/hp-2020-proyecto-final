import Translator from 'lang.js';

function shouldIgnore(ignore, locale, domain) {
	for (let [ignoreLocale, ignoreDomains] of Object.entries(ignore)) {
		if (locale === ignoreLocale && ignoreDomains.includes(domain)) {
			return true;
		}
	}

	return false;
}

function importTranslations({ ignore, globalTranslationsKey }) {
	const catalogue = {};
	const files = require.context('@lang', true, /\.(php|json)$/);

	files.keys().forEach((file) => {
		// Find localization files at the root directory
		const [isGlobal, rootLocale] = /\.\/([A-Za-z0-9-_]+).(?:php|json)/.exec(file) ?? [];

		if (isGlobal) {
			catalogue[`${rootLocale}.${globalTranslationsKey}`] = files(file);

			return;
		}

		// Find localization files in a /lang/ directory
		const [isScoped, locale, domain] =
			/\.\/([A-Za-z0-9-_]+)\/([A-Za-z0-9-_]+).(?:php|json)/.exec(file) ?? [];

		if (!ignore || !shouldIgnore(ignore, locale, domain)) {
			catalogue[`${locale}.${domain}`] = files(file);
		}
	});

	return catalogue;
}

const options = {
    locale: 'es',
    fallback: 'es'
};

// Creates the Lang.js object
const i18n = new Translator({
    messages: importTranslations(options),
    ...options,
});

// Defines a global translation function
window.__ = window.$lang = (key, ...args) => {
    // Non-global translations
    if (key.match(/^[\w-]+(?:\.[\w-]+)+$/)) {
        return i18n.get(key, ...args);
    }

    // Global translations
    const result = i18n.get(`${i18n.locale}.${key}`, ...args);

    return result.startsWith(i18n.locale)
        ? result.substr(i18n.locale.length + 1)
        : result;
};