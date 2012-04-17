com.ebms.views.employees = {
    expCtr: 0,
    expPrefix: 'CTR_',
    expLen: 0,
    eduCtr: 0,
    eduPrefix: 'EDU_',
    eduLen: 0,
    newEmployeeTab: null,
    editEmployeeTab: null,
    editEmployeeDialog: null,
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
            });

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
        $('#edit-employee').click(function(e) {
            $('#edit-employee-dialog').dialog({
                title: $(this).attr('data-title'),
                resizable: false,
                draggable: false,
                modal: true,
                closeOnEscape: true,
                open: com.ebms.views.employees.getEditEmployeeForm,
                close: function() {
                    //destroy tabs
                    $(this).tabs('destroy');
                }
            })

            e.preventDefault();
            return false;
        });

        $('a.pagination-links').live('click', this.browseHandler);
        $('#search-employee-form').submit(this)
        $('#search-employee-form').live('ajax:success', this.successSearchHandler);

        //override destroy modal dialog in confirm js
        com.ebms.widgets.confirm.destroyModalDialog = this.destroyModalDialog;

        $('.close-button').live('click', function() {
           $(this).closest('.ui-dialog-content').dialog('close');
        });

        $('#general-info-form').live('ajax:success', this.successUpdateGenInfo);
        $('#edit-employment-info-form').live('ajax:success', this.successUpdateEmploymentInfo);
        this.initWorkExperience();
    },

    destroyModalDialog: function(e) {
        $('#confirm-dialog').dialog('destroy');
        e.preventDefault();

        //clean up class of buttons
        $('#dialog-confirm-btn').removeClass('archive restore');
        $('#dialog-tryagain-btn').removeClass('archive restore');
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
        var employeeWrapper = $('#edit-employee-dialog');
        var url = $('#edit-employee').data('edit-url');

        $.ajax({
            url: url,
            dataType: 'json',
            type: 'GET',
            success: function(data) {
                var ns = com.ebms.views.employees;
                employeeWrapper.find(".loader").remove().end();
                employeeWrapper.addClass('hide').html(data.data.html);

                ns.editEmployeeTab = employeeWrapper.tabs({
                    show: function() {
                        $(this).fadeIn();
                    }
                }).addClass('ui-tabs-vertical ui-helper-clearfix');
                ns.editEmployeeDialog = $('#edit-employee-dialog');
                ns.initEditEmployeeFormValidation();
		employeeWrapper.removeClass('ui-corner-top').addClass('ui-corner-left');

                /* realign the dialog to center */
                employeeWrapper.dialog('option', 'position', 'center');
                employeeWrapper.data('with-form', 'true');
                $('button, input[type="submit"]', employeeWrapper).button();

                //init datepicker
                com.ebms.widgets.base.initDatePicker($('.date-of-birth, .date-work-started, .date-work-ended, .date-hired', employeeWrapper));
//                com.ebms.views.employees.initEducationalBackground();
            },
            error: function() {
                alert('an error has occured');
            }
        })
    },

    successUpdateGenInfo: function(e, data) {
        if (data.code === 200) {
            /* update info in table */
            var table = $('#item-actions-list');
            table.find('tr[data-employee-id="'+ data.data.employee_id + '"]').find('td.name').text(data.data.first_name + ' ' + data.data.last_name);
            com.ebms.widgets.flash.flashMessage(data.message);
        } else if (data.code === 412) {
            com.ebms.widgets.flash.flashMessage(data.message, 'error');
        }
    },

    errorUpdateGenInfo: function() {
    },

    successUpdateEmploymentInfo: function(e, data) {
        if (data.code === 200) {
            /* update info in table */
            var ns = com.ebms.views.employees;
            var table = $('#item-actions-list');
            var row = table.find('tr[data-employee-id="'+data.data.employee_id+'"]');
            row.find('td.dept').text($('select[name="department"] option:selected', ns.editEmployeeDialog).text());
            row.find('td.pos').text($('select[name="position"] option:selected', ns.editEmployeeDialog).text());
            row.find('td.status').text($('select[name="employment_status"] option:selected', ns.editEmployeeDialog).text());

            com.ebms.widgets.flash.flashMessage(data.message);
        } else {
            com.ebms.widgets.flash.flashMessage(data.message, 'error');
        }
    },

    restoreEmployeeSuccessHandler: function(e, data) {
        if (data.code == 200) {
            var row = $('tr[data-employee-id="'+data.data.employee_id+'"]');
            // restore employee from list
            row.removeClass('inactive selected');
            row.addClass('active');
            $('#restore-employee').addClass('inactive');

            // flash message
            com.ebms.widgets.flash.flashMessage(data.message, 'info');
            com.ebms.views.employees.disableEditDeleteEmp();
        }
    },

    deleteEmployeeSuccessHandler: function(e, data) {
        if (data.code == 200) {
            // remove employee from list
//            $('tr[data-employee-id="'+data.data.employee_id+'"]').fadeOut('slow', function() {
//                $(this).remove();
//            });
            $('tr[data-employee-id="'+data.data.employee_id+'"]').removeClass('active').addClass('inactive');

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

        if (data.code == 200) {
            //TODO add employee to list
            $('#new-employee-dialog').dialog('destroy');

            //flash message
            com.ebms.widgets.flash.flashMessage(data.message, 'success');

            //reset dialog fields
            com.ebms.views.employees.resetNewEmployeeForm();
        } else {
            //flash message
            com.ebms.widgets.flash.flashMessage(data.message, 'error');
        }
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
        $('#general input, #general textarea', newEmpDialog).val('');

        $('#employment-info input, #employment-info textarea', newEmpDialog).val('');
        $('#work-experience-details', newEmpDialog).find('article ul li, article ul input').remove();

        $('#educational-background, #educational-background textarea', newEmpDialog).val('');
        $('#educational-background-details', newEmpDialog).find('article ul li, article ul input').remove();

        $('#payroll input, #payroll textarea', newEmpDialog).val('');
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
                var ns = com.ebms.views.employees;
                employeeWrapper.find(".loader").remove().end().addClass('no-loader');
                employeeWrapper.html(data.data.html).fadeIn();

                ns.newEmployeeTab = employeeWrapper.tabs({
                    select: ns.validateNewEmployeeForm
                }).addClass('ui-tabs-vertical ui-helper-clearfix');
                ns.initNewEmployeeFormValidation();
		employeeWrapper.removeClass('ui-corner-top').addClass('ui-corner-left');

                /* realign the dialog to center */
                employeeWrapper.dialog('option', 'position', 'center');
                employeeWrapper.data('with-form', 'true');
                $('button, input[type="submit"]', employeeWrapper).button();

                //init datepicker
                com.ebms.widgets.base.initDatePicker($('.date-of-birth, .date-work-started, .date-work-ended, .date-hired', employeeWrapper));
                com.ebms.views.employees.initEducationalBackground();
            },
            error: function() {
                alert('an error has occured');
            }
        })
    },

    initEditEmployeeFormValidation: function() {
        var generalInfo = {
            rules: {
                first_name: {
                    required: true
                },
                middle_name: {
                    required: true
                },
                last_name:{
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                address: {
                    required: true
                },
                date_of_birth: {
                    required:true
                }
            },

            messages: {
                first_name: {
                    required: "First name can't be blank"
                },
                middle_name: {
                    required: "Middle name can't be blank"
                },
                last_name: {
                    required: "Last name can't be blank"
                },
                email: {
                    required: "E-mail can't be blank",
                    rangelength: "Invaid email format"
                },
                address: {
                    required: "Address can't be blank"
                },
                date_of_birth: {
                    required: "Date of birth can't be blank"
                }
            }
        };

        var employmentInfo = {
            rule: {
                date_hired: {
                    required:true
                }
            },
            messages: {
                date_of_birth: {
                    required: "Date hired can't be blank"
                }
            }
        };

        var payroll = {
            rules: {
                salary: {
                    required:true
                }
            },
            messages: {
                salary: {
                    required: "Salary can't be blank"
                }
            }

        };

        $('#general-info-form').validate(generalInfo);
    },

    initNewEmployeeFormValidation: function() {
         var newEmployee = {
            rules: {
                first_name: {
                    required: true
                },
                middle_name: {
                    required: true
                },
                last_name:{
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                address: {
                    required: true
                },
                date_of_birth: {
                    required:true
                },
                date_hired: {
                    required:true
                },
                salary: {
                    required:true
                }

            },

            messages: {
                first_name: {
                    required: "First name can't be blank"
                },
                middle_name: {
                    required: "Middle name can't be blank"
                },
                last_name: {
                    required: "Last name can't be blank"
                },
                email: {
                    required: "E-mail can't be blank",
                    rangelength: "Invaid email format"
                },
                address: {
                    required: "Address can't be blank"
                },
                date_of_birth: {
                    required: "Date of birth can't be blank"
                },
                date_hired: {
                    required: "Date hired can't be blank"
                },
                salary: {
                    required: "Salary can't be blank"
                }

            }
        };

        $('#new-employee-form').validate(newEmployee);
    },

    validateNewEmployeeForm: function(e) {
        if (!$('#new-employee-form').valid()) {
            e.preventDefault();
        }
    },

    initWorkExperience: function() {
        $('.add-work-experience').live('click', function() {
            var form = $(this).closest('form');
            var ns = com.ebms.views.employees;
            ns.expCtr++;
            ns.expLen++;
            var company, dateWorkStarted, dateWorkEnded, workDescription, work = '';

            company = $('.company-name', form);
            dateWorkStarted = $('.date-work-started', form);
            dateWorkEnded = $('.date-work-ended', form);
            workDescription = $('.work-description', form);

            work += '<li><div class="delete-work-exp"><a href="#" class="delete-work" data-counter = "'+ ns.ctr +'">X</a></div>';
            work += ('<div class="company-work-exp">' + company.val() + '</div>');
            work += ('<div class="date-work-exp">' + dateWorkStarted.val() + '</div>');
            work += ('<div class="date-work-exp">' + dateWorkEnded.val() + '</div>');
            work += ('<div class="desc-work-exp">' + workDescription.val() + '</div></li>');

            $('.work-experience-details article ul', form).append(work);

            var work_exp = '<input type="hidden" name="work_exp['+ ns.expCtr +'][company_name]" value="' + company.val() + '" data-counter="' + ns.expPrefix + ns.expCtr +'" />';
            work_exp += '<input type="hidden" name="work_exp['+ ns.expCtr +'][date_started]" value="'+ dateWorkStarted.val() + '" data-counter="' + ns.expPrefix + ns.expCtr + '" />';
            work_exp += '<input type="hidden" name="work_exp['+ ns.expCtr +'][date_ended]" value="'+ dateWorkEnded.val() + '" data-counter="' + ns.expPrefix + ns.expCtr + '" />';
            work_exp += '<input type="hidden" name="work_exp['+ ns.expCtr +'][work_description]" value="'+ workDescription.val() + '" data-counter="' + ns.expPrefix + ns.expCtr + '" />';
            $('.work-experience-details article', form).append(work_exp);

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