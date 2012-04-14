com.ebms.views.area = {
    areaTable: null,
    init: function() {
        this.areaTable = $('#areas-list');
        if ($('#wrapper.area.index').length > 0) {
            var count = $('#areas-list').attr('data-areas-count');
            if (count > 0) {
                this.initAreaManagerIndex();
            }
            $('#area-edit').live('submit', function() {
                var $this = $(this);
                $this.find('fieldset.form-buttons').append('<span class="loader"></span>');
                $this.find('input[type="submit"], a', 'fieldset.form-buttons').attr('disabled', 'disabled');
            });
        } else if ($('#wrapper.area.archive').length > 0) {
            this.initAreaManagerArchive();
        }

        $('#dialog-confirm-btn.archive').live('ajax:success', this.archiveSuccessCallback);
        $('#dialog-confirm-btn.restore').live('ajax:success', this.restoreSuccessCallback);

        $('td.action.edit a').live('click', this.editAreaHandler);

        $('#area-edit').live('ajax:success', this.updateAreaSuccessCallback);
        $('#area-edit').live('ajax:error', this.updateAreaErrorCallback);

        /* TODO: js validation for areas (must not be null, must consist of atleast 5 characters) */
    },

    updateAreaSuccessCallback: function(e, data) {
        if (data.code === 200) {
            /* flash success message and hide the form */
            var $row = $('tr[data-area-id="'+data.data.area_id+'"]');
            $row.find('td.name').text(data.data.area_name);

            $('#edit-area-wrapper form').fadeOut('slow', function() {
                $(this).parent().addClass('hide');
                $(this).remove();
                $('#areas-table-wrapper').fadeIn().removeClass('hide');
            });

            com.ebms.widgets.flash.flashMessage(data.message, 'notif');
        } else {
            $('#area-edit').find('fieldset.form-buttons span.loader').remove();
            $('#area-edit').find('input[type="submit"], a', 'fieldset.form-buttons').removeAttr('disabled');
            com.ebms.widgets.flash.flashMessage(data.message, 'error');
        }
    },

    updateAreaErrorCallback: function() {

    },

    initAreaManagerIndex: function() {
        this.areaTable.dataTable({
             "aoColumns": [
                null,
                null,
                {"asSorting": [ "asc", "desc"]}
            ]
        });
    },

    initAreaManagerArchive: function() {
        this.areaTable.dataTable({
             "aoColumns": [
                null,
                {"asSorting": [ "asc", "desc"]}
            ]
        });
    },

    archiveSuccessCallback: function(e, data) {
        $('tr[data-area-id="'+data.data.area_id+'"]').fadeOut('slow', function() {
           $(this).remove();
        });
    },

    restoreSuccessCallback: function(e, data) {
        $('tr[data-area-id="'+data.data.area_id+'"]').fadeOut('slow', function() {
           $(this).remove();
        });
    },

    editAreaHandler: function(e) {
        e.preventDefault();
        var $this = $(this);

        $('#areas-table-wrapper').hide();

        /* show loader */
        var $loaderContainer = $('div.loader-container', 'article.primary');
        $loaderContainer.removeClass('hide');

        /* get user form */
        $.ajax({
            url: $('#edit-area-wrapper').attr('data-ajax-url') + '/' + $this.closest('tr').attr('data-area-id'),
            dataType: 'json',
            type: 'GET',
            success: function(data) {
                $('#edit-area-wrapper').append(data.data.html).removeClass('hide').find('form').attr('data-remote', true).attr('data-type', 'json');
            },
            error: function() {
                $('#edit-area-wrapper').text('An error has occured, please refresh your page');
            },
            complete: function() {
                $loaderContainer.addClass('hide');
            }
        });

        return false;
    }

};