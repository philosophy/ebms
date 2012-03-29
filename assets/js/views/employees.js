com.ebms.views.employees = {
    expCtr: 0,
    expPrefix: 'CTR_',
    expLen: 0,
    eduCtr: 0,
    eduPrefix: 'EDU_',
    eduLen: 0,
    newEmployeeTab: null,
    editEmployeeTab: null,
    // TODO add validation for creating an employee!

    init: function() {
        /* new employee form */
        $('#new-employee').live('click', function(e) {
            $('#new-employee-dialog').dialog({
                title: $(this).attr('data-title'),
                resizable: false,
                draggable: false,
                modal: true,
                closeOnEscape: true,
                open: com.ebms.views.employees.getNewEmployeeForm
            })

            e.preventDefault();
            return false;
        });

        $('.previous-button, .next-button').live('click', this.pagiForm);

        $('#new-employee-form').live('ajax:before', this.newEmployeeBeforeHandler);
        $('#new-employee-form').live('ajax:success', this.newEmployeeSuccessHandler);
        $('#new-employee-form').live('ajax:error', this.newEmployeeErrorHandler);
        $('#new-employee-form').live('ajax:complete', this.newEmployeeCompleteHandler);

        $('#item-actions-list').delegate('tr', 'click', function() {
            var $this = $(this);
            //reset
            $this.siblings().removeClass('selected');
            com.ebms.views.employees.disableEditDeleteEmp();
            com.ebms.views.employees.disableRestoreEmp();

            $this.addClass('selected');
            if($this.hasClass('active')) {
                com.ebms.views.employees.enableEditDeleteEmp();
                $('#delete-employee').attr('href', $this.data('delete-url'));
                $('#edit-employee').data('edit-url', $this.data('edit-url'));

                //update edit-employee href
            } else if ($this.hasClass('inactive')) {
                com.ebms.views.employees.enableRestoreEmp();
                $('#restore-employee').attr('href', $this.data('restore-url'));
            }

        });

        $('#dialog-confirm-btn.archive').live('ajax:success', this.deleteEmployeeSuccessHandler);
        $('#dialog-confirm-btn.restore').live('ajax:success', this.restoreEmployeeSuccessHandler);
        $('#edit-employee').click(this.getEditEmployeeForm);

        $('a.pagination-links').live('click', this.browseHandler);
        $('#search-employee-form').submit(this)
        $('#search-employee-form').live('ajax:success', this.successSearchHandler);

    },

    beforeSearchHandler: function() {
        //display loader and hide contents
        $('div.table-wrapper').html('<span class="loader"></span>');
    },

    successSearchHandler: function(e, data) {
        if (data.code === 200) {
            $('div.table-wrapper').html(data.data.html).fadeIn();
        }
    },

    browseHandler: function(e) {
        e.preventDefault();
        var tableWrapper = $('div.table-wrapper');
        var $this = $(this);

        tableWrapper.html('<span class="loader"></span>');
        var data = {
            name: $.trim($('#search-input').val())
        };
        $.ajax({
           data: data,
           dataType: 'json',
           type: 'GET',
           url: $this.attr('href'),
           success: function(data) {
               if (data.code === 200) {
                    tableWrapper.html(data.data.html).fadeIn();
               }
           },
           error: function() {
               alert('An error has occured, please refresh your page');
           }

        });
        //make an ajax request to fetch new set of tables
        return false;
    },

    getEditEmployeeForm: function(e) {
        e.preventDefault();
        var emp_id;
        var $this = $(this);
        if ($this.hasClass('inactive')) { return false; }

        var editEmployeeWrapper = $('#edit-employee-dialog');

        $('#edit-employee-dialog').dialog({
            closeOnEscape: true,
            modal: true,
            title: $(this).attr('data-title'),
            resizable: false,
            draggable: false,
            open: function() {
                // fetch edit form
                $.ajax({
                    url: $this.data('edit-url'),
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        editEmployeeWrapper.find(".loader").remove().end().addClass('no-loader');
                        editEmployeeWrapper.html(data.data.html).fadeIn();
                        com.ebms.views.employees.editEmployeeTab = editEmployeeWrapper.tabs('destroy').tabs().addClass('ui-tabs-vertical ui-helper-clearfix');
                        editEmployeeWrapper.removeClass('ui-corner-top').addClass('ui-corner-left');

                        /* realign the dialog to center */
                        editEmployeeWrapper.dialog('option', 'position', 'center');
                        $('button, input[type="submit"]', editEmployeeWrapper).button();

                        //init datepicker
                        com.ebms.widgets.base.initDatePicker($('#date-of-birth, #date-work-started, #date-work-ended, #date-hired', editEmployeeWrapper));
                        com.ebms.views.employees.initWorkExperience(editEmployeeWrapper);
                        com.ebms.views.employees.initEducationalBackground(editEmployeeWrapper);
                    },
                    error: function() {
                        alert($('#error-messages').data('generic-error-msg'));
                    },
                    complete: function() {

                    }
                });
            },
            close: function() {
                $('#edit-employee-dialog').dialog('destroy');
            }
        });
    },

    restoreEmployeeSuccessHandler: function(e, data) {
        if (data.code == 200) {
            var row = $('tr[data-employee-id="'+data.data.employee_id+'"]');
            // restore employee from list
            row.removeClass('inactive selected');
            $('#restore-employee').addClass('inactive');

            // flash message
            com.ebms.widgets.flash.flashMessage(data.message, 'info');
            com.ebms.views.employees.disableEditDeleteEmp();
        }
    },

    deleteEmployeeSuccessHandler: function(e, data) {
        if (data.code == 200) {
            // remove employee from list
            $('tr[data-employee-id="'+data.data.employee_id+'"]').fadeOut('slow', function() {
                $(this).remove();
            });

            // flash message
            com.ebms.widgets.flash.flashMessage(data.message, 'info');
            com.ebms.views.employees.disableEditDeleteEmp();
        }
    },

    enableEditDeleteEmp: function() {
        $('#edit-employee').removeClass('inactive');
        $('#delete-employee').removeClass('inactive');
    },

    disableEditDeleteEmp: function() {
        $('#edit-employee').addClass('inactive');
        $('#delete-employee').addClass('inactive');
    },

    enableRestoreEmp: function() {
        $('#restore-employee').removeClass('inactive');
    },

    disableRestoreEmp: function() {
        $('#restore-employee').addClass('inactive');
    },

    newEmployeeBeforeHandler: function() {
        var $payroll = $('#new-employee-form #payroll');
        $('.buttons-wrapper button, .buttons-wrapper input', $payroll).addClass('hide');
        $('.buttons-wrapper span.loader', $payroll).removeClass('hide');
    },

    newEmployeeSuccessHandler: function(e, data) {
        //TODO add employee to list

        $('#new-employee-dialog').dialog('destroy');

        //flash message
        com.ebms.widgets.flash.flashMessage(data.message, 'success');

        //reset dialog fields
        com.ebms.views.employees.resetNewEmployeeForm();
    },

    newEmployeeCompleteHandler: function() {
        var $payroll = $('#new-employee-form #payroll');
        $('.buttons-wrapper button, .buttons-wrapper input', $payroll).removeClass('hide');
        $('.buttons-wrapper span.loader', $payroll).addClass('hide');
    },

    newEmployeeErrorHandler: function() {
        //flash message
        com.ebms.widgets.flash.flashMessage($('#flash').data('error-message'), 'info');
    },

    resetNewEmployeeForm: function() {
        var newEmpDialog = $('#new-employee-dialog');
        $('.general input, .general textarea', newEmpDialog).val('');

        $('.employment-info input, .employment-info textarea', newEmpDialog).val('');
        $('.work-experience-details', newEmpDialog).find('article ul li, article ul input').remove();

        $('.educational-background, .educational-background textarea', newEmpDialog).val('');
        $('.educational-background-details', newEmpDialog).find('article ul li, article ul input').remove();

        $('.payroll input, .payroll textarea', newEmpDialog).val('');
    },

    pagiForm: function(e) {
        var $this = $(this);
        com.ebms.views.employees.newEmployeeTab.tabs('select', parseInt($this.attr('data-step')));
    },

    getNewEmployeeForm: function() {
        var employeeWrapper = $('#new-employee-dialog');
        if (employeeWrapper.data('with-form') === 'true') {return;}
        $.ajax({
            url: employeeWrapper.attr('data-ajax-url'),
            dataType: 'json',
            type: 'GET',
            success: function(data) {
                employeeWrapper.find(".loader").remove().end().addClass('no-loader');
                employeeWrapper.html(data.data.html).fadeIn();

                com.ebms.views.employees.newEmployeeTab = employeeWrapper.tabs().addClass('ui-tabs-vertical ui-helper-clearfix');
		employeeWrapper.removeClass('ui-corner-top').addClass('ui-corner-left');

                /* realign the dialog to center */
                employeeWrapper.dialog('option', 'position', 'center');
                employeeWrapper.data('with-form', 'true');
                $('button, input[type="submit"]', employeeWrapper).button();

                //init datepicker
                com.ebms.widgets.base.initDatePicker($('#date-of-birth, #date-work-started, #date-work-ended, #date-hired', employeeWrapper));
                com.ebms.views.employees.initWorkExperience(employeeWrapper);
                com.ebms.views.employees.initEducationalBackground(employeeWrapper);
            },
            error: function() {
                alert('an error has occured');
            }
        });
    },

    initWorkExperience: function(wrapper) {
        $('#add-work-experience', wrapper).live('click', function() {
            var ns = com.ebms.views.employees;
            ns.expCtr++;
            ns.expLen++;
            var company, dateWorkStarted, dateWorkEnded, workDescription, work = '';

            company = $('#company-name', wrapper);
            dateWorkStarted = $('#date-work-started', wrapper);
            dateWorkEnded = $('#date-work-ended', wrapper);
            workDescription = $('#work-description', wrapper);

            work += '<li><div class="delete-work-exp"><a href="#" class="delete-work" data-counter = "'+ ns.expCtr +'">X</a></div>';
            work += ('<div class="company-work-exp">' + company.val() + '</div>');
            work += ('<div class="date-work-exp">' + dateWorkStarted.val() + '</div>');
            work += ('<div class="date-work-exp">' + dateWorkEnded.val() + '</div>');
            work += ('<div class="desc-work-exp">' + workDescription.val() + '</div></li>');

            $('#work-experience-details article ul', wrapper).append(work);

            var work_exp = '<input type="hidden" name="work_exp['+ ns.expCtr +'][company_name]" value="' + company.val() + '" data-counter="' + ns.expPrefix + ns.expCtr +'" />';
            work_exp += '<input type="hidden" name="work_exp['+ ns.expCtr +'][date_started]" value="'+ dateWorkStarted.val() + '" data-counter="' + ns.expPrefix + ns.expCtr + '" />';
            work_exp += '<input type="hidden" name="work_exp['+ ns.expCtr +'][date_ended]" value="'+ dateWorkEnded.val() + '" data-counter="' + ns.expPrefix + ns.expCtr + '" />';
            work_exp += '<input type="hidden" name="work_exp['+ ns.expCtr +'][work_description]" value="'+ workDescription.val() + '" data-counter="' + ns.expPrefix + ns.expCtr + '" />';
            $('#work-experience-details article', wrapper).append(work_exp);

            // clear the fields
            company.val('');
            dateWorkStarted.val('');
            dateWorkEnded.val('');
            workDescription.val('');
        });

        $('a.delete-work', wrapper).not('.current').die().live('click', function(e) {
            var $link = $(this);

            $('input[data-counter="'+ com.ebms.views.employees.ctrPrefix + $link.data('counter') +'"]', wrapper).remove();
            com.ebms.views.employees.expLen--;

            $link.closest('li').fadeOut('slow', function() {
               $(this).remove();
            });



            e.preventDefault();
            return false;
        });
    },

    initEducationalBackground: function(wrapper) {
        $('#add-educational-background', wrapper).live('click', function() {
            var school, yearGraduated, remarks, background = '';
            var ns = com.ebms.views.employees;
                ns.eduCtr++;

            school = $('#school-name', wrapper);
            yearGraduated = $('#year-graduated', wrapper);
            remarks = $('#remarks', wrapper);

            background += '<li><div class="delete-edu-background"><a href="#" class="delete-edu" data-counter="' + ns.eduCtr + '">X</a></div>';
            background += ('<div class="school-name-background">' + school.val() + '</div>');
            background += ('<div class="year-graduated-background">' + yearGraduated.val() + '</div>');
            background += ('<div class="remarks-background">' + remarks.val() + '</div>');

            $('#educational-background-details article ul', wrapper).append(background);

            var edu_background = '<input type="hidden" name="educational_background['+ ns.eduCtr +'][school_name]" value="' + school.val() + '" data-counter="' + ns.eduPrefix + ns.eduCtr +'" />';
            edu_background += '<input type="hidden" name="educational_background['+ ns.eduCtr +'][date_graduated]" value="'+ yearGraduated.val() + '" data-counter="' + ns.eduPrefix + ns.eduCtr + '" />';
            edu_background += '<input type="hidden" name="educational_background['+ ns.eduCtr +'][remarks]" value="'+ remarks.val() + '" data-counter="' + ns.eduPrefix + ns.eduCtr + '" />';
            $('#educational-background-details article', wrapper).append(edu_background);

            // clear the fields
            school.val('');
            yearGraduated.val('');
            remarks.val('');
        });

        $('a.delete-edu', wrapper).not('.current').die().live('click', function(e) {
            var $link = $(this);
            $('input[data-counter="'+ com.ebms.views.employees.eduPrefix + $link.data('counter') +'"]', wrapper).remove();
            com.ebms.views.employees.eduLen--;
            $link.closest('li').fadeOut('slow', function() {
               $(this).remove();
            });

            e.preventDefault();
            return false;
        });
    }

};