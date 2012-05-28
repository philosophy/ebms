com.ebms.widgets.header = {
    init: function() {
        /* initialize orb hover */
        var orbSettings = {
            sensitivity: 2,
            interval: 100,
            over: com.ebms.widgets.header.displayOrbNav,
            timeout: 300,
            out: com.ebms.widgets.header.hideOrbNav
        };

        var navSettings = {
            sensitivity: 2,
            interval: 100,
            over: this.displaySubNav,
            timeout: 300,
            out: this.hideSubNav
        }

//        $('#orb-cont').hoverIntent(orbSettings);
        $('#main-menu .with-sub-nav').hoverIntent(navSettings);

        $(document).click(this.toggleMenu);

        $('ul.sub-nav li.sub-nav-item').mouseenter(function(e) {
            $(this).find('ul.inner-nav').removeClass('hide');
        }).mouseleave(function(e) {
            $(this).find('ul.inner-nav').addClass('hide');
        });
    },

    toggleMenu: function(e) {
        var elem = e.target;
        var ns = com.ebms.widgets.header;
        if (elem.id === 'notification-link' || elem.id === 'notif-img') {
            ns.displayNotificationNav();
            ns.hideOrbNav();
        } else if (elem.id === 'orb-link' || elem.id === 'orb-img') {
            ns.displayOrbNav();
            ns.hideNotificationNav();
        } else {
            ns.hideOrbNav();
            ns.hideNotificationNav();
        }
    },

    displayOrbNav: function() {
        $('#orb-nav').removeClass('hide');
    },

    hideOrbNav: function() {
        $('#orb-nav').addClass('hide');
    },

    displayNotificationNav: function() {
        $('#notification-list').removeClass('hide');
    },

    hideNotificationNav: function() {
        $('#notification-list').addClass('hide');
    },

    displaySubNav: function(elem) {
        var $this = $(elem.target);
        $this.closest('ul > li.main-menu-item').find('> ul').removeClass('hide');
    },

    hideSubNav: function(elem) {
        var $this = $(elem.target);
        $this.closest('ul > li.main-menu-item').find('> ul').addClass('hide');
    }
};