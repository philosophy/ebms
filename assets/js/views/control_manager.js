com.ebms.views.control_manager = {
    init: function(){
        $('#user-list').dataTable({
             "aoColumns": [
                null,
                null,
                { "asSorting": [ "desc", "asc"] },
                { "asSorting": [ "desc", "asc"] },
                { "asSorting": [ "desc", "asc"] }
            ]
        });
        $('#user-table-wrapper').fadeIn();
        
        $('#user-list').click(this.enableModifyUser);
    },
    
    enableModifyUser: function(e) {
        var target = e.target.parentElement;
        
        $(target)
    }
};