com.ebms.widgets.base = {
    init: function() {
    },

    initDatePicker: function(elem) {
        elem.datepicker({
            dateFormat: 'yy-mm-dd',
            defaultDate: elem.attr('data-dateofbirth'),
            showOn: "button",
            buttonImage: elem.attr('data-datepicker-img-url'),
            buttonImageOnly: true,
            changeYear: true,
            changeMonth: true,
            yearRange: '1960:2012'
        });
    }
};

$(document).ready(function() {
    com.ebms.widgets.base.init();
});
