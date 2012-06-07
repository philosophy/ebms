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

        $('#edit-multiple-employee-schedule').customFormDialog('#edit-multiple-sched-dialog', {
            title: $('a#edit-multiple-employee-schedule').attr('data-title'),
            open: com.ebms.views.employee_schedules.getEditMultipleSchedForm,
            close: com.ebms.views.employee_schedules.resetMultipleSchedFields
        });

        $('#new-employee-schedule-form').live('ajax:success', this.newSchedSuccessHandler);
        $('#edit-multiple-schedule-form').live('ajax:success', this.editMultipleSchedSuccessHandler);
        $('#edit-multiple-schedule-form').live('ajax:before', this.editMultipleSchedBeforeHandler);

        $('a.pagination-links', $('#wrapper.employee_schedules')).live('click', com.ebms.widgets.browse.browseHandler);
        com.ebms.widgets.browse.callback = function() {
            //success callback
            com.ebms.views.employee_schedules.updateEmpData();
        }

        $('ul.employee-schedules.data li').live('click', function() {
            var $this = $(this);
            $this.siblings().removeClass('selected');
            $this.addClass('selected');
//            //reset
//            $this.siblings().removeClass('selected');
//            com.ebms.views.employees.disableEditDeleteEmp();
//            com.ebms.views.employees.disableRestoreEmp();
//
//            $this.addClass('selected');
//            if($this.hasClass('active')) {
//                com.ebms.views.employees.enableEditDeleteEmp();
//                $('#delete-employee').attr('href', $this.data('delete-url'));
//                $('#edit-employee').data('edit-url', $this.data('edit-url'));
//
//                //update edit-employee href
//            } else if ($this.hasClass('inactive')) {
//                com.ebms.views.employees.enableRestoreEmp();
//                $('#restore-employee').attr('href', $this.data('restore-url'));
//            }

        });
    },

    resetMultipleSchedFields: function() {
        //reset fields
        $('input[type="checkbox"]', '#edit-multiple-schedule').attr('checked', false);
        $('input.time-in, input.time-out, input.start-breaktime, input.end-breaktime')
    },

    editMultipleSchedBeforeHandler: function(e) {
        //add loader
    },

    editMultipleSchedSuccessHandler: function(e, data) {
        var status = 'error';
        if (data.code === 200) {
            status = 'success';
        }
        com.ebms.widgets.flash.flashMessage(data.message, status);
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
    },

    getEditMultipleSchedForm: function() {
        var schedWrapper = $('#edit-multiple-sched-dialog');
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
               schedWrapper.data('with-form', 'true');
               schedWrapper.find('span.emp-name').text($('h3.employee-name').text());
               com.ebms.views.employee_schedules.updateEmpData();
               com.ebms.widgets.base.initButtons('button', schedWrapper);
               com.ebms.widgets.base.initTimePicker('.timepicker', schedWrapper);
           },
           error: function() {

           }
        });
    },

    updateEmpData: function() {
        $('input.emp-id').val($('header > h3.employee-name').data('employee-id'));
        $('div#employee-select .emp-name').text($('h3.employee-name[data-employee-id]').text());
    }
};