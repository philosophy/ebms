com.ebms.views.employees = {
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
                com.ebms.widgets.base.initDatePicker($('#date-of-birth'));
            },
            error: function() {
                alert('an error has occured');
            }
        })
    }
    
};