<script language="javascript">

App = Em.Application.create();

App.ApplicationController = Em.Controller.extend();
App.ApplicationView = Em.View.extend({
    templateName: 'application'
});

App.HomeController = Em.Controller.extend();
App.HomeView = Em.View.extend({
    templateName: 'home'
});

App.NavbarController = Em.Controller.extend();
App.NavbarView = Em.View.extend({
    templateName: 'navbar'
});

App.StartingController = Em.Controller.extend();
App.StartingView = Em.View.extend({
    templateName: 'starting'
});


App.StartingMenuController = Em.Controller.extend();
App.StartingMenuView = Em.View.extend({
    templateName: 'getting-started-menu'
});

App.AboutMVCController = Em.Controller.extend();
App.AboutMVCView = Em.View.extend({
    templateName: 'about-mvc'
});

App.AboutEmberController = Em.Controller.extend();
App.AboutEmberView = Em.View.extend({
    templateName: 'about-ember'
});

App.CommunityModel = Em.Object.extend({
    displayName: null,
    linkUrl: null,
    imageUrl: null
});

App.CommunityController = Em.ArrayController.extend({
    content: [],
    init: function() {
        this._super();
        this.pushObject(
        App.CommunityModel.create({
            displayName: 'Twitter',
            linkUrl: 'https://twitter.com/#!/emberjs',
            imageUrl: 'http://icons.iconarchive.com/icons/iconshots/social-media-network/32/twitter-icon.png'
        }));
        this.pushObject(
        App.CommunityModel.create({
            displayName: 'GitHub',
            linkUrl: 'https://github.com/emberjs/ember.js',
            imageUrl: 'http://www.workinprogress.ca/wp-content/uploads/github.png'
        }));
    }
});

App.CommunityView = Em.View.extend({
    templateName: 'community',
    contentBinding: 'App.CommunityController.content'
});

App.Router = Em.Router.extend({
    enableLogging: true,
    location: 'hash',

    root: Em.Route.extend({
        // EVENTS
        gotoHome: Ember.Route.transitionTo('home'),
        gotoStarting: Ember.Route.transitionTo('starting.index'),
        gotoCommunity: Ember.Route.transitionTo('community.index'),

        // STATES
        home: Em.Route.extend({
            route: '/',
            connectOutlets: function(router, context) {
                router.get('applicationController').connectOutlet('home');
            }
        }),
        starting: Em.Route.extend({
            // SETUP
            route: '/starting',
            connectOutlets: function(router, context) {
                router.get('applicationController').connectOutlet('starting');
            },
            // EVENTS
            gotoMVC: Ember.Route.transitionTo('mvc'),
            gotoEmber: Ember.Route.transitionTo('ember'),
            gotoIndex: Ember.Route.transitionTo('index'),

            // STATES
            index: Em.Route.extend({
                route: '/',
                connectOutlets: function(router, context) {
                    router.get('applicationController').connectOutlet('starting');
                }
            }),
            mvc: Em.Route.extend({
                route: '/mvc',
                connectOutlets: function(router, context) {
                    router.get('applicationController').connectOutlet('aboutMVC');
                }
            }),
            ember: Em.Route.extend({
                route: '/ember',
                connectOutlets: function(router, context) {
                    router.get('applicationController').connectOutlet('aboutEmber');
                }
            })
        }),
        community: Em.Route.extend({
            // SETUP
            route: '/community',
            connectOutlets: function(router, context) {
                router.get('applicationController').connectOutlet('community');
            },
            // EVENTS
            // STATES
            index: Em.Route.extend({
                route: '/',
                connectOutlets: function(router, context) {
                    router.get('applicationController').connectOutlet('community');
                }
            })
        })
    })
});
App.initialize();​
</script>






<script type="text/x-handlebars" data-template-name="application">
    <h1>My Ember Application</h1>
    {{view App.NavbarView controllerBinding="controller.controllers.navbarController"}}
    <br /><hr />
    <div class="content">
        {{outlet}}
    </div>
</script>

<script type="text/x-handlebars" data-template-name="navbar">
    <ul>
        <li><a href="#" {{action gotoHome}}>Home</a></li>
        <li><a href="#" {{action gotoStarting}}>Getting Started</a></li>
        <li><a href="#" {{action gotoCommunity}}>Community</a></li>
    </ul>
</script>

<script type="text/x-handlebars" data-template-name="getting-started-menu">
    <ul>
        <li><a href="#" {{action gotoIndex}}>Overview</a></li>
        <li><a href="#" {{action gotoMVC}}>About MVC</a></li>
        <li><a href="#" {{action gotoEmber}}>About Ember</a></li>
    </ul>
</script>

<script type="text/x-handlebars" data-template-name="home">
    <h2>Welcome</h2>
    <br />
    <img src="http://emberjs.com/images/about/ember-productivity-sm.png" alt="ember logo" />
    <br />
    <br />
    <p>Bacon ipsum dolor sit amet qui ullamco exercitation, shankle beef sed bacon ground round kielbasa in. Prosciutto pig bresaola, qui meatloaf ea tongue non dolore et pork belly andouille ribeye spare ribs enim. Enim exercitation elit, brisket nisi ex swine in jerky consequat pastrami dolore sed ad. In drumstick cow, salami swine fatback short ribs ham ut in shankle consequat corned beef id. Deserunt prosciutto beef speck. Sirloin incididunt kielbasa excepteur irure.</p>
    <p>Do beef ribs dolore swine chicken shankle, venison officia qui magna ea anim. Jerky shank shankle, tongue in pork loin commodo boudin elit cupidatat turducken id capicola meatball. Strip steak ham hock tenderloin, id chicken drumstick sint jerky. Dolore veniam cillum minim, pariatur est beef. Sunt fatback tri-tip ex chuck.</p>
    <br />
    <br />
    <strong>Note</strong>: This is a basic template with no <i>bindings</i>
</script>

<script type="text/x-handlebars" data-template-name="starting">
    <h2>Getting Started with Ember</h2>
    {{view App.StartingMenuView}}
    <br />
    <br />
    <br />
    <p>Bacon ipsum dolor sit amet qui ullamco exercitation, shankle beef sed bacon ground round kielbasa in. Prosciutto pig bresaola, qui meatloaf ea tongue non dolore et pork belly andouille ribeye spare ribs enim. Enim exercitation elit, brisket nisi ex swine in jerky consequat pastrami dolore sed ad. In drumstick cow, salami swine fatback short ribs ham ut in shankle consequat corned beef id. Deserunt prosciutto beef speck. Sirloin incididunt kielbasa excepteur irure.</p>
    <p>Do beef ribs dolore swine chicken shankle, venison officia qui magna ea anim. Jerky shank shankle, tongue in pork loin commodo boudin elit cupidatat turducken id capicola meatball. Strip steak ham hock tenderloin, id chicken drumstick sint jerky. Dolore veniam cillum minim, pariatur est beef. Sunt fatback tri-tip ex chuck.</p>
    <br />
    <br />
    <strong>Note</strong>: This is a basic template has a menu view embedded
</script>

<script type="text/x-handlebars" data-template-name="about-mvc">
    <h2>About MVC</h2>
    {{view App.StartingMenuView}}
    <br /><br />
    <br /><p>
        Model–View–Controller (MVC) is a software design for interactive computer user interfaces that separates the representation of  information from the user's interaction with it.[1][8] The model consists of application data and business rules, and the controller mediates input, converting it to commands for the model or view.[3] A view can be any output representation of data, such as a chart or a diagram. Multiple views of the same data are possible, such as a pie chart for management and a tabular view for accountants.
    </p>
    Read more at <a href="http://en.wikipedia.org/wiki/Model%E2%80%93view%E2%80%93controller" target="_blank">Wikipedia</a>
    <br />
    <br />
    <strong>Note</strong>: This is a basic template has a menu view embedded
</script>

<script type="text/x-handlebars" data-template-name="about-ember">
    <h2>About Ember</h2>
    {{view App.StartingMenuView}}
    <br /><br />
    <br />
    <p>A framework for creating <strong>ambitious</strong> web applications</p>
    Read more at <a href="http://emberjs.com/about/" target="_blank">emberjs.com</a>
    <br />
    <br />
    <p>Bacon ipsum dolor sit amet qui ullamco exercitation, shankle beef sed bacon ground round kielbasa in. Prosciutto pig bresaola, qui meatloaf ea tongue non dolore et pork belly andouille ribeye spare ribs enim. Enim exercitation elit, brisket nisi ex swine in jerky consequat pastrami dolore sed ad. In drumstick cow, salami swine fatback short ribs ham ut in shankle consequat corned beef id. Deserunt prosciutto beef speck. Sirloin incididunt kielbasa excepteur irure.</p>
    <p>Do beef ribs dolore swine chicken shankle, venison officia qui magna ea anim. Jerky shank shankle, tongue in pork loin commodo boudin elit cupidatat turducken id capicola meatball. Strip steak ham hock tenderloin, id chicken drumstick sint jerky. Dolore veniam cillum minim, pariatur est beef. Sunt fatback tri-tip ex chuck.</p><br />
    <br />
    <strong>Note</strong>: This is a basic template has a menu view embedded
</script>

<script type="text/x-handlebars" data-template-name="community">
    <h1>Ember Community</h1>
    <p>
        Get in touch with the community
    </p>
    <p>Featured contact info:</p>
    {{#each item in content}}
        <a {{bindAttr href="item.linkUrl" }} target="_blank">
            <img height="32" width="32" {{bindAttr src="item.imageUrl" title="item.displayName" alt="item.displayName"}} /><br />
            {{item.displayName}}
        </a><br />
    {{/each}}
    <br />
    Check more information about ember community at <a href="http://emberjs.com/community/" target="_blank">emberjs.com</a>
    <br />
    <br />
    <strong>Note</strong>: This is a template with a <i>foreach</i> type of loop
</script>​