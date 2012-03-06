com.ebms.views.earning = {
    earningTable: null,
    init: function() {
        this.earningTable = $('#earnings-list');
        if ($('#wrapper.earning.index').length > 0) {
            var count = $('#earnings-list').attr('data-earnings-count');
            if (count > 0) {
                this.initEarningManagerIndex();
            }
            $('#earning-edit').live('submit', function() {
                var $this = $(this);
                $this.find('fieldset.form-buttons').append('<span class="loader"></span>');
                $this.find('input[type="submit"], a', 'fieldset.form-buttons').attr('disabled', 'disabled');
            });
        } else if ($('#wrapper.earning.archive').length > 0) {
            this.initEarningManagerArchive();
        }

        $('#dialog-confirm-btn.archive').live('ajax:success', this.archiveSuccessCallback);
        $('#dialog-confirm-btn.restore').live('ajax:success', this.restoreSuccessCallback);

        $('td.action.edit a').live('click', this.editEarningHandler);

        $('#earning-edit').live('ajax:success', this.updateEarningSuccessCallback);
        $('#earning-edit').live('ajax:error', this.updateEarningErrorCallback);

        /* TODO: js validation for earnings (must not be null, must consist of atleast 5 characters) */
    },

    updateEarningSuccessCallback: function(e, data) {
        if (data.code === 200) {
            /* flash success message and hide the form */
            var $row = $('tr[data-earning-id="'+data.data.earning_id+'"]');
            $row.find('td.name').text(data.data.earning_name);

            $('#edit-earning-wrapper form').fadeOut('slow', function() {
                $(this).parent().addClass('hide');
                $(this).remove();
                $('#earnings-table-wrapper').fadeIn().removeClass('hide');
            });

            com.ebms.widgets.flash.flashMessage(data.message, 'notif');
        } else {
            com.ebms.widgets.flash.flashMessage(data.message, 'error');
        }
    },

    updateEarningErrorCallback: function() {

    },

    initEarningManagerIndex: function() {
        this.earningTable.dataTable({
             "aoColumns": [
                null,
                null,
                {"asSorting": [ "asc", "desc"]}
            ]
        });
    },

    initEarningManagerArchive: function() {
        this.earningTable.dataTable({
             "aoColumns": [
                null,
                {"asSorting": [ "asc", "desc"]}
            ]
        });
    },

    archiveSuccessCallback: function(e, data) {
        $('tr[data-earning-id="'+data.data.earning_id+'"]').fadeOut('slow', function() {
           $(this).remove();
        });
    },

    restoreSuccessCallback: function(e, data) {
        $('tr[data-earning-id="'+data.data.earning_id+'"]').fadeOut('slow', function() {
           $(this).remove();
        });
    },

    editEarningHandler: function(e) {
        e.preventDefault();
        var $this = $(this);

        $('#earnings-table-wrapper').hide();

        /* show loader */
        var $loaderContainer = $('div.loader-container', 'article.primary');
        $loaderContainer.removeClass('hide');

        /* get user form */
        $.ajax({
            url: $('#edit-earning-wrapper').attr('data-ajax-url') + '/' + $this.closest('tr').attr('data-earning-id'),
            dataType: 'json',
            type: 'GET',
            success: function(data) {
                $('#edit-earning-wrapper').append(data.data.html).removeClass('hide').find('form').attr('data-remote', true).attr('data-type', 'json');
            },
            error: function() {
                $('#edit-earning-wrapper').text('An error has occured, please refresh your page');
            },
            complete: function() {
                $loaderContainer.addClass('hide');
            }
        });

        return false;
    }

};