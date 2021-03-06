com.ebms.widgets.base = {
    loader: '<span class="loader"></span>',
    nodata: '...',
    defaultErrorMsg: 'An error has occured',
    init: function() {
          $('.prettify-button').button();
    },

    initDatePicker: function(elem) {
        elem.datepicker({
            dateFormat: 'yy-mm-dd',
            defaultDate: elem.attr('data-default-date'),
            showOn: "button",
            buttonImage: elem.attr('data-datepicker-img-url'),
            buttonImageOnly: true,
            changeYear: true,
            changeMonth: true,
            yearRange: '1960:2012'
        });
    },

    errorMessage: function(msg) {
        var defaultMsg = com.ebms.widgets.base.defaultErrorMsg;
        if (msg !== undefined) {
            defaultMsg = msg;
        }
        alert(defaultMsg);
    },

    reAlignDialog: function(elem, position) {
        elem.dialog('option', 'position', position !== undefined ? position : 'center');
    },

    initButtons: function(selector, wrapper) {
        $(selector, wrapper).button();
    },

    initTimePicker: function(selector, wrapper) {
        $(selector, wrapper).timepicker({
            ampm: false,
            timeFormat: 'hh:mm:ss'
        });
    },

    destroyTimePicker: function(selector, wrapper) {
        $(selector, wrapper).timepicker('destroy');
    }
};

$(document).ready(function() {
    com.ebms.widgets.base.init();
});
