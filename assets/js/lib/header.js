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
        
        $('#orb-cont').hoverIntent(orbSettings);
        
        $(document).click(this.toggleNotification);
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
    }
};