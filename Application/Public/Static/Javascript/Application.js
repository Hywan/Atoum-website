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
