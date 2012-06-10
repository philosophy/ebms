com.ebms.views.employee_schedules = {
    employeeData: null,
    init: function() {
        this.employeeData = $('h3.employee-name');

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

        var editEmployeeLink = $('#edit-employee-schedule');
        editEmployeeLink.customFormDialog('#edit-employee-sched-dialog', {
            title: editEmployeeLink.attr('data-title'),
            open: com.ebms.views.employee_schedules.getEditEmployeeSchedForm,
            close: function() {
                $('input[type="checkbox"]', '#edit-multiple-schedule').attr('checked', false);
                $('input.time-in, input.time-out, input.start-breaktime, input.end-breaktime')
           }
        });

        $('#new-employee-schedule-form').live('ajax:success', this.newSchedSuccessHandler);
        $('#edit-schedule-form').live('ajax:success', this.editSchedSuccessHandler);
        $('#edit-multiple-schedule-form').live('ajax:success', this.editMultipleSchedSuccessHandler);
        $('#edit-multiple-schedule-form').live('ajax:before', this.editMultipleSchedBeforeHandler);

        $('a.pagination-links', $('#wrapper.employee_schedules')).live('click', com.ebms.widgets.browse.browseHandler);
        com.ebms.widgets.browse.callback = function() {
            //update multiple emp sched data
            com.ebms.views.employee_schedules.updateEmpData($('#edit-multiple-sched-dialog'));
        }

        $('ul.employee-schedules.data li').live('click', function() {
            var $this = $(this);
            $this.siblings().removeClass('selected');
            $this.addClass('selected');

            //enable edit schedule
            $('#edit-employee-schedule, #delete-employee-schedule').removeClass('inactive');

            //append sched id to edit employee schedule action
            var ajaxUrl;
            ajaxUrl = $('#edit-employee-sched-dialog').attr('data-ajax-url').split('?')[0];
            $('#edit-employee-sched-dialog').attr('data-ajax-url', ajaxUrl+'?id='+$this.attr('data-sched-id'));

            $('#delete-employee-schedule').attr('href', $this.attr('data-delete-url'));
        });

        $('#dialog-confirm-btn.delete-sched').live('ajax:success', function(e, data) {
            var status = 'error';
            if (data.code === 200) {
                status = 'success';
                var list = $('li.selected[data-sched-id="'+ data.data.sched_id + '"]');
                list.fadeOut('slow', function() {
                    $(this).remove();
                    if ($('ul.employee-schedules.data li').length === 0) {
                        window.location.reload();
                    }
                });

                $('#edit-employee-schedule, #delete-employee-schedule').addClass('inactive');
            }

            com.ebms.widgets.flash.flashMessage(data.message, status);
        });
    },

    resetMultipleSchedFields: function() {
        //reset fields
        $('input[type="checkbox"]', '#edit-multiple-schedule').attr('checked', false);
        $('input.time-in, input.time-out, input.start-breaktime, input.end-breaktime')
    },

    editSchedSuccessHandler: function(e, data) {
        var status = 'error';
        if (data.code === 200) {
            status = 'success';

            // update table data
            var dialog = $('#edit-employee-sched-dialog');
            var schedId = dialog.find('.sched-id').val();
            var list = $('li.selected[data-sched-id="'+schedId+'"]');

            list.find('div.start-time').text(dialog.find('input.time-in').val());
            list.find('div.end-time').text(dialog.find('input.time-out').val());
            list.find('div.start-break-time').text(dialog.find('input.start-breaktime').val());
            list.find('div.end-break-time').text(dialog.find('input.end-breaktime').val());

            dialog.dialog('destroy');
        }
        com.ebms.widgets.flash.flashMessage(data.message, status);
    },

    editMultipleSchedBeforeHandler: function(e) {
        //add loader
    },

    editMultipleSchedSuccessHandler: function(e, data) {
        var status = 'error';
        if (data.code === 200) {
            status = 'success';
            com.ebms.widgets.flash.flashMessage(data.message, status);
            window.location.reload();
        } else {
            com.ebms.widgets.flash.flashMessage(data.message, status);
        }
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

    getEditEmployeeSchedForm: function() {
        var schedWrapper = $('#edit-employee-sched-dialog');
        schedWrapper.html(com.ebms.widgets.base.loader);

        $.ajax({
            url: schedWrapper.attr('data-ajax-url'),
            dataType: 'json',
            type: 'GET',
            before: function() {
                //destroy timepicker
                com.ebms.widgets.base.destroyTimePicker('.timepicker', schedWrapper);
            },
            success: function(data) {
                var ns = com.ebms.views.employee_schedules;
                schedWrapper.find('.loader').remove();
                schedWrapper.html(data.data.html).fadeIn();
                com.ebms.widgets.base.reAlignDialog(schedWrapper, 'center');

                com.ebms.widgets.base.initButtons('button, input[type="submit"]', schedWrapper);
                com.ebms.widgets.base.initTimePicker('.timepicker', schedWrapper);
                com.ebms.views.employee_schedules.updateEmpData(schedWrapper);
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
               com.ebms.views.employee_schedules.updateEmpData(schedWrapper);
               com.ebms.widgets.base.initButtons('button', schedWrapper);
               com.ebms.widgets.base.initTimePicker('.timepicker', schedWrapper);
           },
           error: function() {

           }
        });
    },

    updateEmpData: function(wrapper) {
        wrapper.find('span.emp-name').text($('h3.employee-name').text());
        $('input.emp-id', wrapper).val($('header > h3.employee-name').data('employee-id'));
        $('div.employee-select .emp-name', wrapper).text($('h3.employee-name[data-employee-id]').text());
    }
};