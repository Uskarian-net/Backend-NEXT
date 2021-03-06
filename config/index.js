const base = require('./base.json');
const test = require('./test.json');
const production = require('./production.json');
const development = require('./development.json');

const environment = process.env.NODE_ENV || 'development';

const config = {
    test: Object.assign({}, base, test),
    development: Object.assign({}, base, development),
    production: Object.assign({}, base, production)
};

/**
 * Gets the config object for the current environment.
 *
 * @returns {Object}
 */
function getConfig() {
    return config[environment];
}

module.exports = {
    environment,
    getConfig,
    config
};