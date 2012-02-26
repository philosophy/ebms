com.ebms.views.area_type = {
    areaTypeTable: null,
    init: function() {
        this.areaTypeTable = $('#area-type-list');
        if ($('#wrapper.area_type.index').length > 0) {
            var count = $('#area-type-list').attr('data-area-type-count');
            if (count > 0) {
                this.initAreaTypeManagerIndex();
            }
            $('#area-type-edit').live('submit', function() {
                var $this = $(this);
                $this.find('fieldset.form-buttons').append('<span class="loader"></span>');
                $this.find('input[type="submit"], a', 'fieldset.form-buttons').attr('disabled', 'disabled');
            });
        } else if ($('#wrapper.area_type.archive').length > 0) {
            this.initAreaTypeManagerArchive();
        }

        $('#dialog-confirm-btn.archive').live('ajax:success', this.archiveSuccessCallback);
        $('#dialog-confirm-btn.restore').live('ajax:success', this.restoreSuccessCallback);

        $('td.action.edit a').live('click', this.editAreaTypeHandler);

        $('#area-type-edit').live('ajax:success', this.updateAreaTypeSuccessCallback);
        $('#area-type-edit').live('ajax:error', this.updateAreaTypeErrorCallback);

        /* TODO: js validation for area type (must not be null, must consist of atleast 5 characters) */
    },

    updateAreaTypeSuccessCallback: function(e, data) {
        if (data.code === 200) {
            /* flash success message and hide the form */
            var $row = $('tr[data-area-type-id="'+data.data.area_type_id+'"]');
            $row.find('td.name').text(data.data.area_type_name);

            $('#edit-area-type-wrapper form').fadeOut('slow', function() {
                $(this).parent().addClass('hide');
                $(this).remove();
                $('#area-type-table-wrapper').fadeIn().removeClass('hide');
            });

            com.ebms.widgets.flash.flashMessage(data.message, 'notif');
        } else {
            com.ebms.widgets.flash.flashMessage(data.message, 'error');
        }
    },

    updateAreaTypeErrorCallback: function() {

    },

    initAreaTypeManagerIndex: function() {
        this.areaTypeTable.dataTable({
             "aoColumns": [
                null,
                null,
                {"asSorting": [ "asc", "desc"]},
                {"asSorting": [ "asc", "desc"]}
            ]
        });
    },

    initAreaTypeManagerArchive: function() {
        this.areaTypeTable.dataTable({
             "aoColumns": [
                null,
                {"asSorting": [ "asc", "desc"]},
                {"asSorting": [ "asc", "desc"]}
            ]
        });
    },

    archiveSuccessCallback: function(e, data) {
        $('tr[data-area-type-id="'+data.data.area_type_id+'"]').fadeOut('slow', function() {
           $(this).remove();
        });
    },

    restoreSuccessCallback: function(e, data) {
        $('tr[data-area-type-id="'+data.data.area_type_id+'"]').fadeOut('slow', function() {
           $(this).remove();
        });
    },

    editAreaTypeHandler: function(e) {
        e.preventDefault();
        var $this = $(this);

        $('#area-type-table-wrapper').hide();

        /* show loader */
        var $loaderContainer = $('div.loader-container', 'article.primary');
        $loaderContainer.removeClass('hide');

        /* get user form */
        $.ajax({
            url: $('#edit-area-type-wrapper').attr('data-ajax-url') + '/' + $this.closest('tr').attr('data-area-type-id'),
            dataType: 'json',
            type: 'GET',
            success: function(data) {
                $('#edit-area-type-wrapper').append(data.data.html).removeClass('hide').find('form').attr('data-remote', true).attr('data-type', 'json');
            },
            error: function() {
                $('#edit-area-type-wrapper').text('An error has occured, please refresh your page');
            },
            complete: function() {
                $loaderContainer.addClass('hide');
            }
        });

        return false;
    }

};