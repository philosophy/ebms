com.ebms.views.category = {
    categoryTable: null,
    init: function() {
        this.categoryTable = $('#categories-list');
        if ($('#wrapper.category.index').length > 0) {
            var count = $('#categories-list').attr('data-categories-count');
            if (count > 0) {
                this.initCategoryManagerIndex();
            }
            $('#category-edit').live('submit', function() {
                var $this = $(this);
                $this.find('fieldset.form-buttons').append('<span class="loader"></span>');
                $this.find('input[type="submit"], a', 'fieldset.form-buttons').attr('disabled', 'disabled');
            });
        } else if ($('#wrapper.category.archive').length > 0) {
            this.initCategoryManagerArchive();
        }

        $('#dialog-confirm-btn.archive').live('ajax:success', this.archiveSuccessCallback);
        $('#dialog-confirm-btn.restore').live('ajax:success', this.restoreSuccessCallback);

        $('td.action.edit a').live('click', this.editCategoryHandler);

        $('#category-edit').live('ajax:success', this.updateCategorySuccessCallback);
        $('#category-edit').live('ajax:error', this.updateCategoryErrorCallback);

        /* TODO: js validation for category (must not be null, must consist of atleast 5 characters) */
    },

    updateCategorySuccessCallback: function(e, data) {
        if (data.code === 200) {
            /* flash success message and hide the form */
            var $row = $('tr[data-category-id="'+data.data.category_id+'"]');
            $row.find('td.code').text(data.data.code);
            $row.find('td.name').text(data.data.category_name);

            $('#edit-category-wrapper form').fadeOut('slow', function() {
                $(this).parent().addClass('hide');
                $(this).remove();
                $('#categories-table-wrapper').fadeIn().removeClass('hide');
            });

            com.ebms.widgets.flash.flashMessage(data.message, 'notif');
        } else {
            $('#category-edit').find('fieldset.form-buttons span.loader').remove();
            $('#category-edit').find('input[type="submit"], a', 'fieldset.form-buttons').removeAttr('disabled');
            com.ebms.widgets.flash.flashMessage(data.message, 'error');
        }
    },

    updateCategoryErrorCallback: function() {

    },

    initCategoryManagerIndex: function() {
        this.categoryTable.dataTable({
             "aoColumns": [
                null,
                null,
                {"asSorting": [ "asc", "desc"]},
                {"asSorting": [ "asc", "desc"]}
            ]
        });
    },

    initCategoryManagerArchive: function() {
        this.categoryTable.dataTable({
             "aoColumns": [
                null,
                {"asSorting": [ "asc", "desc"]},
                {"asSorting": [ "asc", "desc"]}
            ]
        });
    },

    archiveSuccessCallback: function(e, data) {
        $('tr[data-category-id="'+data.data.category_id+'"]').fadeOut('slow', function() {
           $(this).remove();
        });
    },

    restoreSuccessCallback: function(e, data) {
        $('tr[data-category-id="'+data.data.category_id+'"]').fadeOut('slow', function() {
           $(this).remove();
        });
    },

    editCategoryHandler: function(e) {
        e.preventDefault();
        var $this = $(this);

        $('#categories-table-wrapper').hide();

        /* show loader */
        var $loaderContainer = $('div.loader-container', 'article.primary');
        $loaderContainer.removeClass('hide');

        /* get user form */
        $.ajax({
            url: $('#edit-category-wrapper').attr('data-ajax-url') + '/' + $this.closest('tr').attr('data-category-id'),
            dataType: 'json',
            type: 'GET',
            success: function(data) {
                $('#edit-category-wrapper').append(data.data.html).removeClass('hide').find('form').attr('data-remote', true).attr('data-type', 'json');
            },
            error: function() {
                $('#edit-categories-wrapper').text('An error has occured, please refresh your page');
            },
            complete: function() {
                $loaderContainer.addClass('hide');
            }
        });

        return false;
    }

};