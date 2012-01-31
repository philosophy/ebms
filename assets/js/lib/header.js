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
        
        $('#orb-cont').hoverIntent(orbSettings);
        $('#main-menu .with-sub-nav').hoverIntent(navSettings);
        
        $(document).click(this.toggleNotification);
        $('ul.sub-nav .sub-nav-a, ul.sub-nav ul.inner-nav').mouseenter(function(e) {
            if($(e.target).hasClass('inner-nav')) {
                $(this).removeClass('hide');
            } else {
                $(this).siblings('ul.inner-nav').removeClass('hide');
            }            
        }).mouseout(function(e) {
            if($(e.target).hasClass('inner-nav')) {
                $(this).addClass('hide');
            } else {
                $(this).siblings('ul.inner-nav').addClass('hide');
            }            
        });
    },
    
    toggleNotification: function(e) {
        var elem = e.target;
        if (elem.id === 'notification-link' || elem.id === 'notif-img') {
            $('#notification-list').removeClass('hide');
        } else {
            $('#notification-list').addClass('hide');
        }
    },
    
    displayOrbNav: function() {
        $('#orb-nav').removeClass('hide');
    },
    
    hideOrbNav: function() {
        $('#orb-nav').addClass('hide');
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