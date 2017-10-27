var webpackConf = require('./webpack.config.js');
delete webpackConf.entry

module.exports = function(config) {
    config.set({
        browsers: ['PhantomJS'],
        frameworks: ['jasmine'],
        port: 9876,
        colors: true,
        logLevel: config.LOG_INFO,
        reporters: ['progress'],
        autoWatch: true,
        singleRun: true,
        concurrency: Infinity,
        webpack: webpackConf,
        webpackMiddleware: {
            noInfo: true,
            stats: 'errors-only'
        },
        basePath: './resources/assets/js/',
        files: [
            {pattern: 'tests/**/*.js', watched: false},
        ],
        exclude: [
        ],
        preprocessors: {
            'app.js': ['webpack', 'babel'],
            'tests/**/*.spec.js': ['babel', 'webpack']
        },
    })
}