com.ebms.views.sub_category = {
    subCategoryTable: null,
    init: function() {
        this.subCategoryTable = $('#sub-categories-list');
        if ($('#wrapper.sub_category.index').length > 0) {
            var count = $('#sub-categories-list').attr('data-sub-categories-count');
            if (count > 0) {
                this.initSubCategoryManagerIndex();
            }
            $('#sub-category-edit').live('submit', function() {
                var $this = $(this);
                $this.find('fieldset.form-buttons').append('<span class="loader"></span>');
                $this.find('input[type="submit"], a', 'fieldset.form-buttons').attr('disabled', 'disabled');
            });
        } else if ($('#wrapper.sub_category.archive').length > 0) {
            this.initSubCategoryManagerArchive();
        }

        $('#dialog-confirm-btn.archive').live('ajax:success', this.archiveSuccessCallback);
        $('#dialog-confirm-btn.restore').live('ajax:success', this.restoreSuccessCallback);

        $('td.action.edit a').live('click', this.editSubCategoryHandler);

        $('#sub-category-edit').live('ajax:success', this.updateSubCategorySuccessCallback);
        $('#sub-category-edit').live('ajax:error', this.updateSubCategoryErrorCallback);

        /* TODO: js validation for sub_category (must not be null, must consist of atleast 5 characters) */
    },

    updateSubCategorySuccessCallback: function(e, data) {
        if (data.code === 200) {
            /* flash success message and hide the form */
            var $row = $('tr[data-sub-category-id="'+data.data.sub_category_id+'"]');
            $row.find('td.code').text(data.data.code);
            $row.find('td.name').text(data.data.sub_category_name);
            $row.find('td.category').text($('select option[value="'+data.data.category_id+'"]').text());

            $('#edit-sub-category-wrapper form').fadeOut('slow', function() {
                $(this).parent().addClass('hide');
                $(this).remove();
                $('#sub-categories-table-wrapper').fadeIn().removeClass('hide');
            });

            com.ebms.widgets.flash.flashMessage(data.message, 'notif');
        } else {
            $('#sub-category-edit').find('fieldset.form-buttons span.loader').remove();
            $('#sub-category-edit').find('input[type="submit"], a', 'fieldset.form-buttons').removeAttr('disabled');
            com.ebms.widgets.flash.flashMessage(data.message, 'error');
        }
    },

    updateSubCategoryErrorCallback: function() {

    },

    initSubCategoryManagerIndex: function() {
        this.subCategoryTable.dataTable({
             "aoColumns": [
                null,
                null,
                {"asSorting": [ "asc", "desc"]},
                {"asSorting": [ "asc", "desc"]},
                {"asSorting": [ "asc", "desc"]}
            ]
        });
    },

    initSubCategoryManagerArchive: function() {
        this.subCategoryTable.dataTable({
             "aoColumns": [
                null,
                {"asSorting": [ "asc", "desc"]},
                {"asSorting": [ "asc", "desc"]},
                {"asSorting": [ "asc", "desc"]}
            ]
        });
    },

    archiveSuccessCallback: function(e, data) {
        $('tr[data-sub-category-id="'+data.data.sub_category_id+'"]').fadeOut('slow', function() {
           $(this).remove();
        });
    },

    restoreSuccessCallback: function(e, data) {
        $('tr[data-sub-category-id="'+data.data.sub_category_id+'"]').fadeOut('slow', function() {
           $(this).remove();
        });
    },

    editSubCategoryHandler: function(e) {
        e.preventDefault();
        var $this = $(this);

        $('#sub-categories-table-wrapper').hide();

        /* show loader */
        var $loaderContainer = $('div.loader-container', 'article.primary');
        $loaderContainer.removeClass('hide');

        /* get user form */
        $.ajax({
            url: $('#edit-sub-category-wrapper').attr('data-ajax-url') + '/' + $this.closest('tr').attr('data-sub-category-id'),
            dataType: 'json',
            type: 'GET',
            success: function(data) {
                $('#edit-sub-category-wrapper').append(data.data.html).removeClass('hide').find('form').attr('data-remote', true).attr('data-type', 'json');
            },
            error: function() {
                $('#edit-sub-category-wrapper').text('An error has occured, please refresh your page');
            },
            complete: function() {
                $loaderContainer.addClass('hide');
            }
        });

        return false;
    }

};