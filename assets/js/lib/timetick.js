com.ebms.widgets.timetick = {
    displayTime: function(elem) {
        setInterval(function() {
            var date = new Date();
            elem.text(date.toLocaleTimeString());
        }, 1000);
    }
};