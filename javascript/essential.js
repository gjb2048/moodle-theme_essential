
require(['core/first'], function() {
    require(['theme_essential/bootstrap', 'theme_essential/anti_gravity', 'core/log'], function(bootstrap, ag, log) {
        log.debug('Essential JavaScript initialised');
    });
});
