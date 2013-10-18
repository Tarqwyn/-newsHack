 

(function () {
    /*  Enviroment build Variables
    *
    *   ENVIROMENTS_CONST - holds all current environment paths
    *   env - Sets the key to collect the file path
    *   version - passed as a query string to require in order to break cache
    *   debug - Sets CSS debugging for BBC desktop site
    *   isDesktop - Detects BBC Desktop site
    *
    */
    var ENVIROMENTS_CONST = {
        dev : 'http://localhost:8888',
        prod : 'http://localhost:8888'
    },
    env = 'prod',
    version = '1',
    baseUrl = ENVIROMENTS_CONST[env],
    debug = false,
    isDesktop = (!window.bbcNewsResponsive);
    /*  End of Enviroment build Variables */

    el = document.getElementById('newshack');
    //environment variable switch based on current environment 'production' when released...
    el.className = 'ns__clearfix';
 
    //default configuration 
    config = {
        paths: {
            'js': baseUrl + '/newshack/www/js/module', //define entry point for desktop js...
            'lib': baseUrl + '/newshack/www/js/lib',
            'bootstrap': baseUrl + '/newshack/www/js/bootstrap'
        }
    };
    
    if (env !== 'dev') {
        config.paths['js'] = baseUrl + '/newshack/www/js/compiled/desktop';
    }
    
    require(config, [(env !== 'dev') ? 'js/ns_all' : 'js/app'], function () {
        require(['js/app'], function (MyNews) {
            new MyNews();
        });
    }); //end of require

}());