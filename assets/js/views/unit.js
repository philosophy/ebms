com.ebms.views.unit = {
    unitTable: null,
    init: function() {
        this.unitTable = $('#units-list');
        if ($('#wrapper.unit.index').length > 0) {
            var count = $('#units-list').attr('data-units-count');
            if (count > 0) {
                this.initUnitManagerIndex();
            }
            $('#unit-edit').live('submit', function() {
                var $this = $(this);
                $this.find('fieldset.form-buttons').append('<span class="loader"></span>');
                $this.find('input[type="submit"], a', 'fieldset.form-buttons').attr('disabled', 'disabled');
            });
        } else if ($('#wrapper.unit.archive').length > 0) {
            this.initUnitManagerArchive();
        }

        $('#dialog-confirm-btn.archive').live('ajax:success', this.archiveSuccessCallback);
        $('#dialog-confirm-btn.restore').live('ajax:success', this.restoreSuccessCallback);

        $('td.action.edit a').live('click', this.editUnitHandler);

        $('#unit-edit').live('ajax:success', this.updateUnitSuccessCallback);
        $('#unit-edit').live('ajax:error', this.updateUnitErrorCallback);

        /* TODO: js validation for unit (must not be null, must consist of atleast 5 characters) */
    },

    updateUnitSuccessCallback: function(e, data) {
        if (data.code === 200) {
            /* flash success message and hide the form */
            var $row = $('tr[data-unit-id="'+data.data.unit_id+'"]');
            $row.find('td.name').text(data.data.unit_name);

            $('#edit-unit-wrapper form').fadeOut('slow', function() {
                $(this).parent().addClass('hide');
                $(this).remove();
                $('#units-table-wrapper').fadeIn().removeClass('hide');
            });

            com.ebms.widgets.flash.flashMessage(data.message, 'notif');
        } else {
            $('#unit-edit').find('fieldset.form-buttons span.loader').remove();
            $('#unit-edit').find('input[type="submit"], a', 'fieldset.form-buttons').removeAttr('disabled');
            com.ebms.widgets.flash.flashMessage(data.message, 'error');
        }
    },

    updateUnitErrorCallback: function() {

    },

    initUnitManagerIndex: function() {
        this.unitTable.dataTable({
             "aoColumns": [
                null,
                null,
                {"asSorting": [ "asc", "desc"]}
            ]
        });
    },

    initUnitManagerArchive: function() {
        this.unitTable.dataTable({
             "aoColumns": [
                null,
                {"asSorting": [ "asc", "desc"]}
            ]
        });
    },

    archiveSuccessCallback: function(e, data) {
        $('tr[data-unit-id="'+data.data.unit_id+'"]').fadeOut('slow', function() {
           $(this).remove();
        });
    },

    restoreSuccessCallback: function(e, data) {
        $('tr[data-unit-id="'+data.data.unit_id+'"]').fadeOut('slow', function() {
           $(this).remove();
        });
    },

    editUnitHandler: function(e) {
        e.preventDefault();
        var $this = $(this);

        $('#units-table-wrapper').hide();

        /* show loader */
        var $loaderContainer = $('div.loader-container', 'article.primary');
        $loaderContainer.removeClass('hide');

        /* get user form */
        $.ajax({
            url: $('#edit-unit-wrapper').attr('data-ajax-url') + '/' + $this.closest('tr').attr('data-unit-id'),
            dataType: 'json',
            type: 'GET',
            success: function(data) {
                $('#edit-unit-wrapper').append(data.data.html).removeClass('hide').find('form').attr('data-remote', true).attr('data-type', 'json');
            },
            error: function() {
                $('#edit-units-wrapper').text('An error has occured, please refresh your page');
            },
            complete: function() {
                $loaderContainer.addClass('hide');
            }
        });

        return false;
    }

};