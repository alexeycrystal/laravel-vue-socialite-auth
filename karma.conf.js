var webpackConf = require('./webpack.config.js');
delete webpackConf.entry

module.exports = function(config) {
    config.set({
        browsers: ['Chrome'],
        frameworks: ['jasmine'],
        port: 9876,
        colors: true,
        logLevel: config.LOG_INFO,
        reporters: ['spec'],
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
            {pattern: 'tests/**/*spec.js', watched: false}
        ],
        exclude: [
        ],
        preprocessors: {
            'app.js': ['webpack', 'babel'],
            'tests/**/*.spec.js': ['babel', 'webpack']
        }
    })
}