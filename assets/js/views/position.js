com.ebms.views.position = {
    positionTable: null,
    init: function() {
        this.positionTable = $('#position-list');
        if ($('#wrapper.position.index').length > 0) {
            var count = $('#position-list').attr('data-position-count');
            if (count > 0) {
                this.initPositionManagerIndex();
            }
            $('#position-edit').live('submit', function() {
                var $this = $(this);
                $this.find('fieldset.form-buttons').append('<span class="loader"></span>');
                $this.find('input[type="submit"], a', 'fieldset.form-buttons').attr('disabled', 'disabled');
            });
        } else if ($('#wrapper.position.archive').length > 0) {
            this.initPositionManagerArchive();
        }

        $('#dialog-confirm-btn.archive').live('ajax:success', this.archiveSuccessCallback);
        $('#dialog-confirm-btn.restore').live('ajax:success', this.restoreSuccessCallback);

        $('td.action.edit a').live('click', this.editPositionHandler);

        $('#position-edit').live('ajax:success', this.updatePositionSuccessCallback);
        $('#position-edit').live('ajax:error', this.updatePositionErrorCallback);

        /* TODO: js validation for position (must not be null, must consist of atleast 5 characters) */
    },

    updatePositionSuccessCallback: function(e, data) {
        if (data.code === 200) {
            /* flash success message and hide the form */
            var $row = $('tr[data-position-id="'+data.data.position_id+'"]');
            $row.find('td.name').text(data.data.position_name);

            $('#edit-position-wrapper form').fadeOut('slow', function() {
                $(this).parent().addClass('hide');
                $(this).remove();
                $('#position-table-wrapper').fadeIn().removeClass('hide');
            });

            com.ebms.widgets.flash.flashMessage(data.message, 'notif');
        } else {
            $('#position-edit').find('fieldset.form-buttons span.loader').remove();
            $('#position-edit').find('input[type="submit"], a', 'fieldset.form-buttons').removeAttr('disabled');
            com.ebms.widgets.flash.flashMessage(data.message, 'error');
        }
    },

    updatePositionErrorCallback: function() {

    },

    initPositionManagerIndex: function() {
        this.positionTable.dataTable({
             "aoColumns": [
                null,
                null,
                {"asSorting": [ "asc", "desc"]}
            ]
        });
    },

    initPositionManagerArchive: function() {
        this.positionTable.dataTable({
             "aoColumns": [
                null,
                {"asSorting": [ "asc", "desc"]}
            ]
        });
    },

    archiveSuccessCallback: function(e, data) {
        $('tr[data-position-id="'+data.data.position_id+'"]').fadeOut('slow', function() {
           $(this).remove();
        });
    },

    restoreSuccessCallback: function(e, data) {
        $('tr[data-position-id="'+data.data.position_id+'"]').fadeOut('slow', function() {
           $(this).remove();
        });
    },

    editPositionHandler: function(e) {
        e.preventDefault();
        var $this = $(this);

        $('#position-table-wrapper').hide();

        /* show loader */
        var $loaderContainer = $('div.loader-container', 'article.primary');
        $loaderContainer.removeClass('hide');

        /* get user form */
        $.ajax({
            url: $('#edit-position-wrapper').attr('data-ajax-url') + '/' + $this.closest('tr').attr('data-position-id'),
            dataType: 'json',
            type: 'GET',
            success: function(data) {
                $('#edit-position-wrapper').append(data.data.html).removeClass('hide').find('form').attr('data-remote', true).attr('data-type', 'json');
            },
            error: function() {
                $('#edit-position-wrapper').text('An error has occured, please refresh your page');
            },
            complete: function() {
                $loaderContainer.addClass('hide');
            }
        });

        return false;
    }

};