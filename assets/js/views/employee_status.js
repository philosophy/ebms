com.ebms.views.employee_status = {
    employeeStatusTable: null,
    init: function() {
        this.employeeStatusTable = $('#employee-status-list');
        if ($('#wrapper.employee_status.index').length > 0) {
            var count = $('#employee-status-list').attr('data-employee-status-count');
            if (count > 0) {
                this.initEmployeeStatusManagerIndex();
            }
            $('#employee-status-edit').live('submit', function() {
                var $this = $(this);
                $this.find('fieldset.form-buttons').append('<span class="loader"></span>');
                $this.find('input[type="submit"], a', 'fieldset.form-buttons').attr('disabled', 'disabled');
            });
        } else if ($('#wrapper.employee_status.archive').length > 0) {
            this.initEmployeeStatusManagerArchive();
        }

        $('#dialog-confirm-btn.archive').live('ajax:success', this.archiveSuccessCallback);
        $('#dialog-confirm-btn.restore').live('ajax:success', this.restoreSuccessCallback);

        $('td.action.edit a').live('click', this.editEmployeeStatusHandler);

        $('#employee-status-edit').live('ajax:success', this.updateEmployeeStatusSuccessCallback);
        $('#employee-status-edit').live('ajax:error', this.updateEmployeeStatusErrorCallback);

        /* TODO: js validation for employee status (must not be null, must consist of atleast 5 characters) */
    },

    updateEmployeeStatusSuccessCallback: function(e, data) {
        if (data.code === 200) {
            /* flash success message and hide the form */
            var $row = $('tr[data-employee-status-id="'+data.data.employee_status_id+'"]');
            $row.find('td.name').text(data.data.employee_status_name);

            $('#edit-employee-status-wrapper form').fadeOut('slow', function() {
                $(this).parent().addClass('hide');
                $(this).remove();
                $('#employee-status-table-wrapper').fadeIn().removeClass('hide');
            });

            com.ebms.widgets.flash.flashMessage(data.message, 'notif');
        } else {
            com.ebms.widgets.flash.flashMessage(data.message, 'error');
        }
    },

    updateEmployeeStatusErrorCallback: function() {

    },

    initEmployeeStatusManagerIndex: function() {
        this.employeeStatusTable.dataTable({
             "aoColumns": [
                null,
                null,
                {"asSorting": [ "asc", "desc"]}
            ]
        });
    },

    initEmployeeStatusManagerArchive: function() {
        this.employeeStatusTable.dataTable({
             "aoColumns": [
                null,
                {"asSorting": [ "asc", "desc"]}
            ]
        });
    },

    archiveSuccessCallback: function(e, data) {
        $('tr[data-employee-status-id="'+data.data.employee_status_id+'"]').fadeOut('slow', function() {
           $(this).remove();
        });
    },

    restoreSuccessCallback: function(e, data) {
        $('tr[data-employee-status-id="'+data.data.employee_status_id+'"]').fadeOut('slow', function() {
           $(this).remove();
        });
    },

    editEmployeeStatusHandler: function(e) {
        e.preventDefault();
        var $this = $(this);

        $('#employee-status-table-wrapper').hide();

        /* show loader */
        var $loaderContainer = $('div.loader-container', 'article.primary');
        $loaderContainer.removeClass('hide');

        /* get user form */
        $.ajax({
            url: $('#edit-employee-status-wrapper').attr('data-ajax-url') + '/' + $this.closest('tr').attr('data-employee-status-id'),
            dataType: 'json',
            type: 'GET',
            success: function(data) {
                $('#edit-employee-status-wrapper').append(data.data.html).removeClass('hide').find('form').attr('data-remote', true).attr('data-type', 'json');
            },
            error: function() {
                $('#edit-employee-status-wrapper').text('An error has occured, please refresh your page');
            },
            complete: function() {
                $loaderContainer.addClass('hide');
            }
        });

        return false;
    }

};