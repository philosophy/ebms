com.ebms.views.employees.leaves = {
    init: function() {
        var leaveTypes = $('#leave-types');
        var leaveDialog = $('#file-leave-dialog');

        $('#new-leave').customFormDialog('#file-leave-dialog', {
            dialogTitle: 'File Leave',
            open: this.openFileLeaveCallback
        });

        leaveTypes.change(function() {
            $('.max-days', leaveDialog).val($(this).find('option:selected').attr('data-maximum-days'));
        });

        leaveTypes.trigger('change');
        com.ebms.widgets.base.initDatePicker($('.date-from, .date-to', leaveDialog));

        $('#employee-leave-form').submit(function(e) {
            var dateTo = $('.date-to').val();
            var dateFrom = $('.date-from').val();

            if (dateTo == '' || dateFrom == '') {
                com.ebms.widgets.flash.flashMessage('Please fill in all fields', 'error');
                return false;
            }

            var dateDiff = $.date_diff(dateTo, 'day', dateFrom);
            dateDiff += 1;
            
            if (dateDiff < 0) {
                com.ebms.widgets.flash.flashMessage('Invalid input dates', 'error');
                return false;
            }
        });
    },

    openFileLeaveCallback: function() {
        var $this = $(this);
        var employeeId = $this.find('.action-employee-id').val();

        $this.find('.employee-name').val($('tr[data-employee-id="'+employeeId+'"]').find('.name').text());
    }
};