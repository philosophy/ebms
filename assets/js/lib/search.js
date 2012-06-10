com.ebms.widgets.search = {
    init: function() {
        $('form.search-form').live('ajax:success', this.successSearchHandler)
            .live('ajax:before', this.beforeSearchHandler);
    },

    beforeSearchHandler: function() {
        $('div.table-wrapper').html('<span class="loader"></span>');
    },

    successSearchHandler: function(e, data) {
        if (data.code === 200) {
            $('div.table-wrapper').html(data.data.html).fadeIn();
        }
    }
};