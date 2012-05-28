com.ebms.widgets.browse = {
    browseHandler: function(e) {
        e.preventDefault();
        var tableWrapper = $('div.table-wrapper');
        var $this = $(this);

        tableWrapper.html('<span class="loader"></span>');
//        var data = {
//            name: $.trim($('#search-input').val())
//        };
        $.ajax({
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
    }
};