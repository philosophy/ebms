com.ebms.views.location = {
    locationTable: null,
    init: function() {
        this.locationTable = $('#locations-list');
        if ($('#wrapper.location.index').length > 0) {
            var count = $('#locations-list').attr('data-locations-count');
            if (count > 0) {
                this.initLocationManagerIndex();
            }
            $('#location-edit').live('submit', function() {
                var $this = $(this);
                $this.find('fieldset.form-buttons').append('<span class="loader"></span>');
                $this.find('input[type="submit"], a', 'fieldset.form-buttons').attr('disabled', 'disabled');
            });
        } else if ($('#wrapper.location.archive').length > 0) {
            this.initLocationManagerArchive();
        }

        $('#dialog-confirm-btn.archive').live('ajax:success', this.archiveSuccessCallback);
        $('#dialog-confirm-btn.restore').live('ajax:success', this.restoreSuccessCallback);

        $('td.action.edit a').live('click', this.editLocationHandler);

        $('#location-edit').live('ajax:success', this.updateLocationSuccessCallback);
        $('#location-edit').live('ajax:error', this.updateLocationErrorCallback);

        /* TODO: js validation for location (must not be null, must consist of atleast 5 characters) */
    },

    updateLocationSuccessCallback: function(e, data) {
        if (data.code === 200) {
            /* flash success message and hide the form */
            var $row = $('tr[data-location-id="'+data.data.location_id+'"]');
            $row.find('td.name').text(data.data.location_name);

            $('#edit-location-wrapper form').fadeOut('slow', function() {
                $(this).parent().addClass('hide');
                $(this).remove();
                $('#location-table-wrapper').fadeIn().removeClass('hide');
            });

            com.ebms.widgets.flash.flashMessage(data.message, 'notif');
        } else {
            com.ebms.widgets.flash.flashMessage(data.message, 'error');
        }
    },

    updateLocationErrorCallback: function() {

    },

    initLocationManagerIndex: function() {
        this.locationTable.dataTable({
             "aoColumns": [
                null,
                null,
                {"asSorting": [ "asc", "desc"]}
            ]
        });
    },

    initLocationManagerArchive: function() {
        this.locationTable.dataTable({
             "aoColumns": [
                null,
                {"asSorting": [ "asc", "desc"]}
            ]
        });
    },

    archiveSuccessCallback: function(e, data) {
        $('tr[data-location-id="'+data.data.location_id+'"]').fadeOut('slow', function() {
           $(this).remove();
        });
    },

    restoreSuccessCallback: function(e, data) {
        $('tr[data-location-id="'+data.data.location_id+'"]').fadeOut('slow', function() {
           $(this).remove();
        });
    },

    editLocationHandler: function(e) {
        e.preventDefault();
        var $this = $(this);

        $('#location-table-wrapper').hide();

        /* show loader */
        var $loaderContainer = $('div.loader-container', 'article.primary');
        $loaderContainer.removeClass('hide');

        /* get user form */
        $.ajax({
            url: $('#edit-location-wrapper').attr('data-ajax-url') + '/' + $this.closest('tr').attr('data-location-id'),
            dataType: 'json',
            type: 'GET',
            success: function(data) {
                $('#edit-location-wrapper').append(data.data.html).removeClass('hide').find('form').attr('data-remote', true).attr('data-type', 'json');
            },
            error: function() {
                $('#edit-locations-wrapper').text('An error has occured, please refresh your page');
            },
            complete: function() {
                $loaderContainer.addClass('hide');
            }
        });

        return false;
    }

};