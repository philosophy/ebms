com.ebms.views.control_manager = {
    userTable: null,

    init: function(){
        if ($('#wrapper.control_manager.index').length > 0) {
            this.initControlManagerIndex();
            $('#user-edit').live('submit', function() {
                var $this = $(this);
                $this.find('fieldset.form-buttons').append('<span class="loader"></span>');
                $this.find('input[type="submit"], a', 'fieldset.form-buttons').attr('disabled', 'disabled');
            });
        } else if ($('#wrapper.control_manager.archive').length > 0) {
            this.initControlManagerArchive();
        } else if ($('#wrapper.control_manager.new_user').length > 0) {
            com.ebms.widgets.base.initDatePicker($('#date_of_birth'));
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

        $('td.action.edit a').live('click', this.editUserHandler);

        /* make sure the cancel button is always handled */
        var $editUserWrapper = $('#edit-user-wrapper');
        $('.cancel-link', '#edit-user-wrapper').live('click', function(e) {
            e.preventDefault();
            $editUserWrapper.find('form').fadeOut('fast', function() {
                $(this).parent().addClass('hide');
                $(this).remove();
            });

            $('#user-table-wrapper').fadeIn().removeClass('hide');

            return false;
        });

        $('#user-edit').live('ajax:success', this.updateUserSuccessCallback);
        $('#user-edit').live('ajax:error', this.updateUserErrorCallback);
    },

    updateUserErrorCallback: function() {

    },

    updateUserSuccessCallback: function(event, data) {

        if (data.code === 200) {
            /* flash success message and hide the form */
            var $row = $('tr[data-userid="'+data.data.userid+'"]');
            $row.find('td.name').text(data.data.name);
            $row.find('td.email').text(data.data.email);

            $('#edit-user-wrapper form').fadeOut('slow', function() {
                $(this).parent().addClass('hide');
                $(this).remove();
                $('#user-table-wrapper').fadeIn().removeClass('hide');
            });

            com.ebms.widgets.flash.flashMessage(data.message, 'notif');
        } else {
            com.ebms.widgets.flash.flashMessage(data.message, 'error');
        }
    },

    editUserHandler: function(e) {
        e.preventDefault();
        var $this = $(this);

        $('#user-table-wrapper').hide();

        /* show loader */
        var $loaderContainer = $('div.loader-container');
        $loaderContainer.removeClass('hide');

        /* get user form */
        $.ajax({
            url: $('#edit-user-wrapper').attr('data-ajax-url') + '/' + $this.closest('tr').attr('data-userid'),
            dataType: 'json',
            type: 'GET',
            success: function(data) {
                $('#edit-user-wrapper').append(data.data.html).removeClass('hide').find('form').attr('data-remote', true).attr('data-type', 'json');
                com.ebms.widgets.base.initDatePicker($('#date_of_birth'));
            },
            error: function() {
                $('#edit-user-wrapper').text('An error has occured, please refresh your page');
            },
            complete: function() {
                $loaderContainer.addClass('hide');
            }
        });

        return false;

    },

    initControlManagerIndex: function() {
        this.userTable = $('#user-list').dataTable({
             "aoColumns": [
                null,
                null,
                {"asSorting": [ "desc", "asc"]},
                {"asSorting": [ "desc", "asc"]},
                {"asSorting": [ "desc", "asc"]}
            ]
        });
    },

    initControlManagerArchive: function() {
        this.userTable = $('#user-list').dataTable({
             "aoColumns": [
                null,
                {"asSorting": [ "desc", "asc"]},
                {"asSorting": [ "desc", "asc"]},
                {"asSorting": [ "desc", "asc"]}
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