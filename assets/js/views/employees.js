com.ebms.views.employees = {
    expCtr: 0,
    expPrefix: 'CTR_',
    expLen: 0,
    eduCtr: 0,
    eduPrefix: 'EDU_',
    eduLen: 0,
    newEmployeeTab: null,
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

                //update edit-employee href
            } else if ($this.hasClass('inactive')) {
                com.ebms.views.employees.enableRestoreEmp();
                $('#restore-employee').attr('href', $this.data('restore-url'));
            }

        });

        $('#dialog-confirm-btn.archive').live('ajax:success', this.deleteEmployeeSuccessHandler);
        $('#delete-employee.inactive').live('click', function(e){
            e.preventDefault();
            e.stopPropagation();
            if (e.cancelBubble) {
                e.cancelBubble = true;
            }
            return false;
        });
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
        com.ebms.widgets.flash.flashMessage(data.data.message, 'info');

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
                com.ebms.widgets.base.initDatePicker($('#date-of-birth, #date-work-started, #date-work-ended, #date-hired'));
                com.ebms.views.employees.initWorkExperience();
                com.ebms.views.employees.initEducationalBackground();
            },
            error: function() {
                alert('an error has occured');
            }
        })
    },

    initWorkExperience: function() {
        $('#add-work-experience').live('click', function() {
            var ns = com.ebms.views.employees;
            ns.expCtr++;
            ns.expLen++;
            var company, dateWorkStarted, dateWorkEnded, workDescription, work = '';

            company = $('#company-name');
            dateWorkStarted = $('#date-work-started');
            dateWorkEnded = $('#date-work-ended');
            workDescription = $('#work-description');

            work += '<li><div class="delete-work-exp"><a href="#" class="delete-work" data-counter = "'+ ns.ctr +'">X</a></div>';
            work += ('<div class="company-work-exp">' + company.val() + '</div>');
            work += ('<div class="date-work-exp">' + dateWorkStarted.val() + '</div>');
            work += ('<div class="date-work-exp">' + dateWorkEnded.val() + '</div>');
            work += ('<div class="desc-work-exp">' + workDescription.val() + '</div></li>');

            $('#work-experience-details article ul').append(work);

            var index = $('')

            var work_exp = '<input type="hidden" name="work_exp['+ ns.expCtr +'][company_name]" value="' + company.val() + '" data-counter="' + ns.expPrefix + ns.expCtr +'" />';
            work_exp += '<input type="hidden" name="work_exp['+ ns.expCtr +'][date_started]" value="'+ dateWorkStarted.val() + '" data-counter="' + ns.expPrefix + ns.expCtr + '" />';
            work_exp += '<input type="hidden" name="work_exp['+ ns.expCtr +'][date_ended]" value="'+ dateWorkEnded.val() + '" data-counter="' + ns.expPrefix + ns.expCtr + '" />';
            work_exp += '<input type="hidden" name="work_exp['+ ns.expCtr +'][work_description]" value="'+ workDescription.val() + '" data-counter="' + ns.expPrefix + ns.expCtr + '" />';
            $('#work-experience-details article').append(work_exp);

            // clear the fields
            company.val('');
            dateWorkStarted.val('');
            dateWorkEnded.val('');
            workDescription.val('');
        });

        $('a.delete-work').live('click', function(e) {
            var $link = $(this);

            $('input[data-counter="'+ com.ebms.views.employees.ctrPrefix + $link.data('counter') +'"]').remove();
            com.ebms.views.employees.expLen--;

            $link.closest('li').fadeOut('slow', function() {
               $(this).remove();
            });



            e.preventDefault();
            return false;
        });
    },

    initEducationalBackground: function() {
        $('#add-educational-background').live('click', function() {
            var school, yearGraduated, remarks, background = '';
            var ns = com.ebms.views.employees;
                ns.eduCtr++;

            school = $('#school-name');
            yearGraduated = $('#year-graduated');
            remarks = $('#remarks');

            background += '<li><div class="delete-edu-background"><a href="#" class="delete-edu" data-counter="' + ns.eduCtr + '">X</a></div>';
            background += ('<div class="school-name-background">' + school.val() + '</div>');
            background += ('<div class="year-graduated-background">' + yearGraduated.val() + '</div>');
            background += ('<div class="remarks-background">' + remarks.val() + '</div>');

            $('#educational-background-details article ul').append(background);

            var edu_background = '<input type="hidden" name="educational_background['+ ns.eduCtr +'][school_name]" value="' + school.val() + '" data-counter="' + ns.eduPrefix + ns.eduCtr +'" />';
            edu_background += '<input type="hidden" name="educational_background['+ ns.eduCtr +'][date_graduated]" value="'+ yearGraduated.val() + '" data-counter="' + ns.eduPrefix + ns.eduCtr + '" />';
            edu_background += '<input type="hidden" name="educational_background['+ ns.eduCtr +'][remarks]" value="'+ remarks.val() + '" data-counter="' + ns.eduPrefix + ns.eduCtr + '" />';
            $('#educational-background-details article').append(edu_background);

            // clear the fields
            school.val('');
            yearGraduated.val('');
            remarks.val('');
        });

        $('a.delete-edu').live('click', function(e) {
            var $link = $(this);
            $('input[data-counter="'+ com.ebms.views.employees.eduPrefix + $link.data('counter') +'"]').remove();
            com.ebms.views.employees.eduLen--;
            $link.closest('li').fadeOut('slow', function() {
               $(this).remove();
            });

            e.preventDefault();
            return false;
        });
    }

};