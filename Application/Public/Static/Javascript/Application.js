var Application = Ember.Application.create();

/**
 * Set the root URL of the application.
 */
Application.Router.reopen({
    location: 'auto',
    rootURL: '/'
});

/**
 * Declare the router.
 */
Application.Router.map(function () {
    this.route('features');
    this.route('sources');
    this.route('community');
    this.route('about');
});

Application.ApplicationRoute = Ember.Route.extend({

    actions: {
        toggleMenu: function ()
        {
            var menu = $('#menu');

            if ('false' === menu.attr('aria-selected')) {
                menu.attr('aria-selected', 'true');
                menu.attr('aria-hidden',   'false');
            } else {
                menu.attr('aria-selected', 'false');
                menu.attr('aria-hidden',   'true');
            }
        },

        linkTo: function (ruleId)
        {
            this.controllerFor('application').transitionToRoute(ruleId);
            this.send('toggleMenu');
        }
    }

});

Application.SourcesRoute = Ember.Route.extend({

    model: function ()
    {
        return new Ember.RSVP.Promise(
            function (resolve, reject) {
                $.getJSON(
                    'https://api.github.com/repos/atoum/atoum/releases/latest'
                ).done(function (data) {
                    resolve({
                        releases: {
                            latest: {
                                name: data.name,
                                page_url: data.html_url,
                                tarball_url: data.tarball_url,
                                zipball_url: data.zipball_url,
                                pharball_url: data.assets.find(function (asset) {
                                    return 'atoum.phar' === asset.name;
                                }).browser_download_url
                            }
                        },
                        composer: {
                            latest_version: '~' + data.tag_name.split('.')[0] + '.0',
                            current_x: data.tag_name.split('.')[0],
                            next_x: parseInt(data.tag_name.split('.')[0]) + 1
                        }
                    });
                });
            }
        );
    }

});

Application.SuperCodeComponent = Ember.Component.extend({

    tagName   : 'code',
    classNames: ['line-numbers'],
    language  : null,

    didInsertElement: function ()
    {
        this._super();

        var element = this.get('element');
        element.classList.add('language-' + this.get('language'));

        Ember.run.scheduleOnce(
            'afterRender',
            this,
            function () {
                Prism.highlightElement(element);
            }
        );
    }

});


/**
 * Polyfills.
 */

if (!Array.prototype.find) {
    Array.prototype.find = function(predicate) {
        if (this === null) {
            throw new TypeError('Array.prototype.find called on null or undefined');
        }

        if (typeof predicate !== 'function') {
            throw new TypeError('predicate must be a function');
        }

        var list    = Object(this);
        var length  = list.length >>> 0;
        var thisArg = arguments[1];
        var value;

        for (var i = 0; i < length; i++) {
            value = list[i];

            if (predicate.call(thisArg, value, i, list)) {
                return value;
            }
        }

        return undefined;
    };
}
