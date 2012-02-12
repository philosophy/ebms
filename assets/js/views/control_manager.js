com.ebms.views.control_manager = {
    userTable: null,

    init: function(){
        if ($('#wrapper.control_manager.index').length > 0) {
            this.initControlManagerIndex();
        } else if (('#wrapper.control_manager.archive').length > 0) {
            this.initControlManagerArchive();
        }

        $("#user-list tbody tr").click( function( e ) {
            if ( $(this).hasClass('row_selected') ) {
                $(this).removeClass('row_selected');
            }
            else {
                com.ebms.views.control_manager.userTable.$('tr.row_selected').removeClass('row_selected');
                $(this).addClass('row_selected');
            }
        });

        $('#user-table-wrapper').fadeIn();

        $('#user-list').click(this.enableModifyUser);

        $('#dialog-confirm-btn.archive').live('ajax:success', this.archiveSuccessCallback);
        $('#dialog-confirm-btn.activate').live('ajax:success', this.activateSuccessCallback);
    },

    initControlManagerIndex: function() {
        this.userTable = $('#user-list').dataTable({
             "aoColumns": [
                null,
                null,
                { "asSorting": [ "desc", "asc"] },
                { "asSorting": [ "desc", "asc"] },
                { "asSorting": [ "desc", "asc"] }
            ]
        });
    },

    initControlManagerArchive: function() {
        this.userTable = $('#user-list').dataTable({
             "aoColumns": [
                null,
                { "asSorting": [ "desc", "asc"] },
                { "asSorting": [ "desc", "asc"] },
                { "asSorting": [ "desc", "asc"] }
            ]
        });
    },

    activateSuccessCallback: function(e, data) {
        $('tr[data-userid="'+data.data.user_id+'"]').fadeOut('slow', function() {
           $(this).remove();
        });
    },

    archiveSuccessCallback: function(e, data) {
        console.log('data', data);
//        console.log('row to be deleted', $('tr[data-userid="'+data.data.user_id+'"]'));
//        com.ebms.views.control_manager.userTable.fnDeleteRow($('tr[data-userid="'+data.data.user_id+'"]'));
        $('tr[data-userid="'+data.data.user_id+'"]').fadeOut('slow', function() {
           $(this).remove();
        });
    },

    enableModifyUser: function(e) {
        var target = e.target.parentElement;

        $(target)
    }
};