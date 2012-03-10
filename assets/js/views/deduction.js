com.ebms.views.deduction = {
    deductionTable: null,
    init: function() {
        this.deductionTable = $('#deductions-list');
        if ($('#wrapper.deduction.index').length > 0) {
            var count = $('#deductions-list').attr('data-deductions-count');
            if (count > 0) {
                this.initDeductionManagerIndex();
            }
            $('#deduction-edit').live('submit', function() {
                var $this = $(this);
                $this.find('fieldset.form-buttons').append('<span class="loader"></span>');
                $this.find('input[type="submit"], a', 'fieldset.form-buttons').attr('disabled', 'disabled');
            });
        } else if ($('#wrapper.deduction.archive').length > 0) {
            this.initDeductionManagerArchive();
        }

        $('#dialog-confirm-btn.archive').live('ajax:success', this.archiveSuccessCallback);
        $('#dialog-confirm-btn.restore').live('ajax:success', this.restoreSuccessCallback);

        $('td.action.edit a').live('click', this.editDeductionHandler);

        $('#deduction-edit').live('ajax:success', this.updateDeductionSuccessCallback);
        $('#deduction-edit').live('ajax:error', this.updateDeductionErrorCallback);

        /* TODO: js validation for deductions (must not be null, must consist of atleast 5 characters) */
    },

    updateDeductionSuccessCallback: function(e, data) {
        if (data.code === 200) {
            /* flash success message and hide the form */
            var $row = $('tr[data-deduction-id="'+data.data.deduction_id+'"]');
            $row.find('td.name').text(data.data.deduction_name);

            $('#edit-deduction-wrapper form').fadeOut('slow', function() {
                $(this).parent().addClass('hide');
                $(this).remove();
                $('#deductions-table-wrapper').fadeIn().removeClass('hide');
            });

            com.ebms.widgets.flash.flashMessage(data.message, 'notif');
        } else {
            com.ebms.widgets.flash.flashMessage(data.message, 'error');
        }
    },

    updateDeductionErrorCallback: function() {

    },

    initDeductionManagerIndex: function() {
        this.deductionTable.dataTable({
             "aoColumns": [
                null,
                null,
                {"asSorting": [ "asc", "desc"]}
            ]
        });
    },

    initDeductionManagerArchive: function() {
        this.deductionTable.dataTable({
             "aoColumns": [
                null,
                {"asSorting": [ "asc", "desc"]}
            ]
        });
    },

    archiveSuccessCallback: function(e, data) {
        $('tr[data-deduction-id="'+data.data.deduction_id+'"]').fadeOut('slow', function() {
           $(this).remove();
        });
    },

    restoreSuccessCallback: function(e, data) {
        $('tr[data-deduction-id="'+data.data.deduction_id+'"]').fadeOut('slow', function() {
           $(this).remove();
        });
    },

    editDeductionHandler: function(e) {
        e.preventDefault();
        var $this = $(this);

        $('#deductions-table-wrapper').hide();

        /* show loader */
        var $loaderContainer = $('div.loader-container', 'article.primary');
        $loaderContainer.removeClass('hide');

        /* get user form */
        $.ajax({
            url: $('#edit-deduction-wrapper').attr('data-ajax-url') + '/' + $this.closest('tr').attr('data-deduction-id'),
            dataType: 'json',
            type: 'GET',
            success: function(data) {
                $('#edit-deduction-wrapper').append(data.data.html).removeClass('hide').find('form').attr('data-remote', true).attr('data-type', 'json');
            },
            error: function() {
                $('#edit-deduction-wrapper').text('An error has occured, please refresh your page');
            },
            complete: function() {
                $loaderContainer.addClass('hide');
            }
        });

        return false;
    }

};