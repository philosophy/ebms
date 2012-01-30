com = {
    ebms: {
        widgets: {},
        util: {},
        init: function() {
           this.widgets.header.init();
        }
    }
}

jQuery(document).ready(function() {
   com.ebms.init(); 
});