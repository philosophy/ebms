com.ebms.views.employees = {
    expCtr: 0,
    expPrefix: 'CTR_',
    expLen: 0,
    eduCtr: 0,
    eduPrefix: 'EDU_',
    eduLen: 0,
    newEmployeeTab: null,

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