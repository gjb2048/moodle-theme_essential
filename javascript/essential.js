
require(['core/first'], function() {
    require(['theme_essential/bootstrap', 'theme_essential/anti_gravity', 'theme_essential/essential_custom', 'core/log'], function(bootstrap, ag, ec, log) {
        log.debug('Essential JavaScript initialised');
    });
});
