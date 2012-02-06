$(function() {

    var timer;

    com.ebms.widgets.flash = {

        activate: function() {
            if( $('div#flash div.content > p').size() > 0) {
                var timeout = $('div#flash div.content > p').data('timeout') || 30000;
                $('div#flash').delay(500).slideDown('fast', function() {
                    timer = setTimeout(com.visualposter.widgets.flash.deactivate, timeout);
                });
            }
        },

        deactivate: function() {
            clearTimeout(timer);
            $('div#flash').slideUp('fast');
            $("div#flash").removeClass('over-overlay');
            return false;
        },

        flashMessage: function(msg, notificationType, timeout, overOverlay) {
            var content;
            var timeoutSpec = (timeout !== undefined && timeout !== null) ? 'data-timeout='+timeout : '';
            if(notificationType !== undefined && notificationType !== null) {
                content = '<p class="'+ notificationType +'"  ' + timeoutSpec + '>' + msg + '</p>';
            } else {
                content = '<p>' + msg + '</p>';
            }

            $("div#flash div.content").html(content);
            if (overOverlay !== undefined && overOverlay !== null && overOverlay) {
                $("div#flash").addClass('over-overlay');
            }
            com.visualposter.widgets.flash.activate();
        }
    };

    com.ebms.widgets.flash.activate();
    $('div#flash').bind('content-updated', com.ebms.widgets.flash.activate);
    $('div#flash a.close').live('click', com.ebms.widgets.flash.deactivate);
});