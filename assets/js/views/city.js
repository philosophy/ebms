com.ebms.views.city = {
    cityTable: null,
    init: function() {
        this.cityTable = $('#cities-list');
        if ($('#wrapper.city.index').length > 0) {
            var count = $('#cities-list').attr('data-cities-count');
            if (count > 0) {
                this.initCityManagerIndex();
            }
            $('#city-edit').live('submit', function() {
                var $this = $(this);
                $this.find('fieldset.form-buttons').append('<span class="loader"></span>');
                $this.find('input[type="submit"], a', 'fieldset.form-buttons').attr('disabled', 'disabled');
            });
        } else if ($('#wrapper.city.archive').length > 0) {
            this.initCityManagerArchive();
        }

        $('#dialog-confirm-btn.archive').live('ajax:success', this.archiveSuccessCallback);
        $('#dialog-confirm-btn.restore').live('ajax:success', this.restoreSuccessCallback);

        $('td.action.edit a').live('click', this.editCityHandler);

        $('#city-edit').live('ajax:success', this.updateCitySuccessCallback);
        $('#city-edit').live('ajax:error', this.updateCityErrorCallback);

        /* TODO: js validation for cities (must not be null, must consist of atleast 5 characters) */
    },

    updateCitySuccessCallback: function(e, data) {
        if (data.code === 200) {
            /* flash success message and hide the form */
            var $row = $('tr[data-city-id="'+data.data.city_id+'"]');
            $row.find('td.name').text(data.data.city_name);

            $('#edit-city-wrapper form').fadeOut('slow', function() {
                $(this).parent().addClass('hide');
                $(this).remove();
                $('#cities-table-wrapper').fadeIn().removeClass('hide');
            });

            com.ebms.widgets.flash.flashMessage(data.message, 'notif');
        } else {
            $('#city-edit').find('fieldset.form-buttons span.loader').remove();
            $('#city-edit').find('input[type="submit"], a', 'fieldset.form-buttons').removeAttr('disabled');
            com.ebms.widgets.flash.flashMessage(data.message, 'error');
        }
    },

    updateCityErrorCallback: function() {

    },

    initCityManagerIndex: function() {
        this.cityTable.dataTable({
             "aoColumns": [
                null,
                null,
                {"asSorting": [ "asc", "desc"]}
            ]
        });
    },

    initCityManagerArchive: function() {
        this.cityTable.dataTable({
             "aoColumns": [
                null,
                {"asSorting": [ "asc", "desc"]}
            ]
        });
    },

    archiveSuccessCallback: function(e, data) {
        $('tr[data-city-id="'+data.data.city_id+'"]').fadeOut('slow', function() {
           $(this).remove();
        });
    },

    restoreSuccessCallback: function(e, data) {
        $('tr[data-city-id="'+data.data.city_id+'"]').fadeOut('slow', function() {
           $(this).remove();
        });
    },

    editCityHandler: function(e) {
        e.preventDefault();
        var $this = $(this);

        $('#cities-table-wrapper').hide();

        /* show loader */
        var $loaderContainer = $('div.loader-container', 'article.primary');
        $loaderContainer.removeClass('hide');

        /* get user form */
        $.ajax({
            url: $('#edit-city-wrapper').attr('data-ajax-url') + '/' + $this.closest('tr').attr('data-city-id'),
            dataType: 'json',
            type: 'GET',
            success: function(data) {
                $('#edit-city-wrapper').append(data.data.html).removeClass('hide').find('form').attr('data-remote', true).attr('data-type', 'json');
            },
            error: function() {
                $('#edit-city-wrapper').text('An error has occured, please refresh your page');
            },
            complete: function() {
                $loaderContainer.addClass('hide');
            }
        });

        return false;
    }

};