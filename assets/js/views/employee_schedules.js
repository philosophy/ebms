com.ebms.views.employee_schedules = {
    init: function() {
        /* new employee form */
        $('#new-employee-schedule').click(function() {
            $('#new-employee-sched-dialog').dialog({
                title: $(this).attr('data-title'),
                resizable: false,
                draggable: false,
                modal: true,
                closeOnEscape: true,
                open: com.ebms.views.employee_schedules.getNewEmployeeSchedForm
            });
        });

        $('#new-employee-schedule-form').live('ajax:success', this.newSchedSuccessHandler);

        $('a.pagination-links', $('#wrapper.employee_schedules')).live('click', com.ebms.widgets.browse.browseHandler);
    },

    newSchedSuccessHandler: function(e, data) {

        if (data.code === 200) {
            com.ebms.widgets.flash.flashMessage(data.message, 'success')
            $('#new-employee-sched-dialog').dialog('destroy');
            window.location.reload();
        } else if (data.code === 412) {
            com.ebms.widgets.flash.flashMessage(data.message, 'error');
        }
    },

    getNewEmployeeSchedForm: function() {
        var schedWrapper = $('#new-employee-sched-dialog');
        if (schedWrapper.data('with-form') === 'true') {return;}
        $.ajax({
            url: schedWrapper.attr('data-ajax-url'),
            dataType: 'json',
            type: 'GET',
            success: function(data) {
                var ns = com.ebms.views.employee_schedules;
                schedWrapper.find('.loader').remove().end().addClass('no-loader');
                schedWrapper.html(data.data.html).fadeIn();
                com.ebms.widgets.base.reAlignDialog(schedWrapper, 'center');

//                schedWrapper.data('with-form', 'true');
                $('button, input[type="submit"]', schedWrapper).button();
                $('.timepicker').timepicker({
                    ampm: false,
                    timeFormat: 'hh:mm:ss'
                });
            },
            error: function() {
                com.ebms.widgets.base.errorMessage();
            }
        });
    }
};