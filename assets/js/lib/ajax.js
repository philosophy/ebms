com.ebms.widgets.ajax = {
    init: function() {
        $('[data-remote="true"], [data-disable-with="true"]').live('ajax:before', this.disableButton);
        $('[data-remote="true"], [data-disable-with="true"]').live('ajax:success', this.success);
        $('[data-remote="true"], [data-disable-with="true"]').live('ajax:error', this.error);
    },

    disableButton: function(e) {
        var $this = $(this);
        if ($this.data('sending')) {
            return false;
        } else  {
            $this.data('sending', true);
        }

        if ($(this).is('form')) {
            $this.find('*[data-disable-with="true"]').attr('disabled', 'disabled').addClass('with-loader').prepend(com.ebms.widgets.base.loader);
        }
    },

    success: function(e, data) {
        var $this = $(this);
        if (data.data.force_refresh) {
            com.ebms.widgets.flash.flashMessage(data.message, 'alert');
            //force logout user
            setInterval(function() {
                window.location.reload();
            }, 3000);

        } else if (data.data && data.data.flash_message) {
            com.ebms.widgets.flash.flashMessage(data.message, data.status);
        }

        $this.find('*[data-disable-with="true"]').removeAttr('disabled').removeClass('with-loader').find('span.loader').remove();
        $this.removeData('sending');
    },

    error: function() {
        var $this = $(this);
        $this.removeData('sending');
        if ($(this).is('form')) {
            $this.find('*[data-disable-with="true"]').removeAttr('disabled').removeClass('with-loader').find('span.loader').remove();
        }
    }
};