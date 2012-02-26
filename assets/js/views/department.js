com.ebms.views.department = {
    deptTable: null,
    init: function() {
        this.deptTable = $('#department-list');

        if ($('#wrapper.department.index').length > 0) {
            var count = $('#department-list').attr('data-department-count');
            if (count > 0) {
                this.initDepartmentManagerIndex();
            }
            $('#department-edit').live('submit', function() {
                var $this = $(this);
                $this.find('fieldset.form-buttons').append('<span class="loader"></span>');
                $this.find('input[type="submit"], a', 'fieldset.form-buttons').attr('disabled', 'disabled');
            });
        } else if ($('#wrapper.department.archive').length > 0) {
            this.initDepartmentManagerArchive();
        }
        $('#department-table-wrapper').fadeIn();

        $('#dialog-confirm-btn.archive').live('ajax:success', this.archiveSuccessCallback);
        $('#dialog-confirm-btn.restore').live('ajax:success', this.restoreSuccessCallback);

        $('td.action.edit a').live('click', this.editDepartmentHandler);

        $('#department-edit').live('ajax:success', this.updateDepartmentSuccessCallback);
        $('#department-edit').live('ajax:error', this.updateDepartmentErrorCallback);

        /* TODO: js validation for department (must not be null, must consist of atleast 5 characters) */
    },

    updateDepartmentSuccessCallback: function(e, data) {
        if (data.code === 200) {
            /* flash success message and hide the form */
            var $row = $('tr[data-deptid="'+data.data.department_id+'"]');
            $row.find('td.name').text(data.data.department_name);

            $('#edit-department-wrapper form').fadeOut('slow', function() {
                $(this).parent().addClass('hide');
                $(this).remove();
                $('#department-table-wrapper').fadeIn().removeClass('hide');
            });

            com.ebms.widgets.flash.flashMessage(data.message, 'notif');
        } else {
            com.ebms.widgets.flash.flashMessage(data.message, 'error');
        }
    },

    updateDepartmentErrorCallback: function() {

    },

    editDepartmentHandler: function(e) {
        e.preventDefault();
        var $this = $(this);

        $('#department-table-wrapper').hide();

        /* show loader */
        var $loaderContainer = $('div.loader-container', 'article.primary');
        $loaderContainer.removeClass('hide');

        /* get user form */
        $.ajax({
            url: $('#edit-department-wrapper').attr('data-ajax-url') + '/' + $this.closest('tr').attr('data-deptid'),
            dataType: 'json',
            type: 'GET',
            success: function(data) {
                $('#edit-department-wrapper').append(data.data.html).removeClass('hide').find('form').attr('data-remote', true).attr('data-type', 'json');
            },
            error: function() {
                $('#edit-department-wrapper').text('An error has occured, please refresh your page');
            },
            complete: function() {
                $loaderContainer.addClass('hide');
            }
        });

        return false;
    },

    initDepartmentManagerIndex: function() {
        this.deptTable.dataTable({
             "aoColumns": [
                null,
                null,
                {"asSorting": [ "asc", "desc"]}
            ]
        });
    },

    initDepartmentManagerArchive: function() {
        this.deptTable.dataTable({
             "aoColumns": [
                null,
                {"asSorting": [ "asc", "desc"]}
            ]
        });
    },

    archiveSuccessCallback: function(e, data) {
        $('tr[data-deptid="'+data.data.department_id+'"]').fadeOut('slow', function() {
           $(this).remove();
        });
    },

    restoreSuccessCallback: function(e, data) {
        $('tr[data-deptid="'+data.data.department_id+'"]').fadeOut('slow', function() {
           $(this).remove();
        });
    }

};