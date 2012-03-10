com.ebms.views.brand = {
    brandTable: null,
    init: function() {
        this.brandTable = $('#brands-list');
        if ($('#wrapper.brand.index').length > 0) {
            var count = $('#brands-list').attr('data-brands-count');
            if (count > 0) {
                this.initBrandManagerIndex();
            }
            $('#brand-edit').live('submit', function() {
                var $this = $(this);
                $this.find('fieldset.form-buttons').append('<span class="loader"></span>');
                $this.find('input[type="submit"], a', 'fieldset.form-buttons').attr('disabled', 'disabled');
            });
            
            $('#brand-edit').live('ajax:success', this.updatebrandSuccessCallback);
            $('#brand-edit').live('ajax:error', this.updateBrandErrorCallback);
            
        } else if ($('#wrapper.brand.archive').length > 0) {
            this.initBrandManagerArchive();
        }

        $('#dialog-confirm-btn.archive').live('ajax:success', this.archiveSuccessCallback);
        $('#dialog-confirm-btn.restore').live('ajax:success', this.restoreSuccessCallback);

        $('td.action.edit a').live('click', this.editBrandHandler);
            
        $('#category').live('change', function(e) {
            var categoryId = $(this).val();
            var options = '<option>Select Sub Category</option>';
            $.each(sub_categories, function(i, sub) {                
                if (sub.category_id === categoryId) {
                    options += '<option value="'+ sub.id +'">' + sub.name + '</option>';
                }
            });
            
            $('#sub-category').html(options);
        });
        /* TODO: js validation for unit (must not be null, must consist of atleast 5 characters) */
    },

    updateBrandSuccessCallback: function(e, data) {
        if (data.code === 200) {
            /* flash success message and hide the form */
            var $row = $('tr[data-brand-id="'+data.data.brand_id+'"]');
            $row.find('td.name').text(data.data.brand_name);

            $('#edit-brand-wrapper form').fadeOut('slow', function() {
                $(this).parent().addClass('hide');
                $(this).remove();
                $('#brands-table-wrapper').fadeIn().removeClass('hide');
            });

            com.ebms.widgets.flash.flashMessage(data.message, 'notif');
        } else {
            com.ebms.widgets.flash.flashMessage(data.message, 'error');
        }
    },

    updateBrandErrorCallback: function() {

    },

    initBrandManagerIndex: function() {
        this.brandTable.dataTable({
             "aoColumns": [
                null,
                null,
                {"asSorting": [ "asc", "desc"]},
                {"asSorting": [ "asc", "desc"]},
                {"asSorting": [ "asc", "desc"]}
            ]
        });
    },

    initBrandManagerArchive: function() {
        this.brandTable.dataTable({
             "aoColumns": [
                null,
                {"asSorting": [ "asc", "desc"]},
                {"asSorting": [ "asc", "desc"]},
                {"asSorting": [ "asc", "desc"]}
            ]
        });
    },

    archiveSuccessCallback: function(e, data) {
        $('tr[data-brand-id="'+data.data.brand_id+'"]').fadeOut('slow', function() {
           $(this).remove();
        });
    },

    restoreSuccessCallback: function(e, data) {
        $('tr[data-brand-id="'+data.data.brand_id+'"]').fadeOut('slow', function() {
           $(this).remove();
        });
    },

    editBrandHandler: function(e) {
        e.preventDefault();
        var $this = $(this);

        $('#brands-table-wrapper').hide();

        /* show loader */
        var $loaderContainer = $('div.loader-container', 'article.primary');
        $loaderContainer.removeClass('hide');

        /* get user form */
        $.ajax({
            url: $('#edit-brand-wrapper').attr('data-ajax-url') + '/' + $this.closest('tr').attr('data-brand-id'),
            dataType: 'json',
            type: 'GET',
            success: function(data) {
                $('#edit-brand-wrapper').append(data.data.html).removeClass('hide').find('form').attr('data-remote', true).attr('data-type', 'json');
            },
            error: function() {
                $('#edit-brand-wrapper').text('An error has occured, please refresh your page');
            },
            complete: function() {
                $loaderContainer.addClass('hide');
            }
        });

        return false;
    }

};