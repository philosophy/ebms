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

        $('#about-us-link').customFormDialog('#about-us-dialog-info', {
            open: this.openQuickViewCallback,
            dialogTitle: 'About Us'
        });

        $('#contact-us-link').customFormDialog('#contact-us-dialog-info', {
            dialogTitle: 'Contact Us'
        });

        $('#cheat-sheet-link').customFormDialog('#cheat-sheet-dialog-info', {
            dialogTitle: 'Cheat Sheet',
            open: this.openQuickViewCallback
        });

        $('#user-guide-link').customFormDialog('#user-guide-dialog-info', {
           dialogTitle: 'User Guide',
           open: this.openQuickViewCallback
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
    },

    openQuickViewCallback: function() {
        var $this = $(this);
        if ($this.data('attached')) { return false; }
        $.ajax({
            url: $this.attr('data-ajax-url'),
            success: function(data) {
                $this.html(data);
                if ($this.hasClass('tabs')) {
                    $this.tabs({
                        show: function() {
                            $(this).fadeIn();
                        }
                    }).addClass('ui-tabs-vertical ui-helper-clearfix');
                }
                com.ebms.widgets.base.reAlignDialog($this, 'center');
                $this.data('attached', true);
            }
        });
    }

};