require(['core/first'], function() { // jshint ignore:line
    require(['theme_essential/bootstrap', 'theme_essential/anti_gravity', 'core/log'], function(bootstrap, ag, log) { // jshint ignore:line
        log.debug('Essential JavaScript initialised');
    });
});
