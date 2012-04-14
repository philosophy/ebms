com.ebms.views.industry = {
    industryTable: null,
    init: function() {
        this.industryTable = $('#industries-list');
        if ($('#wrapper.industry.index').length > 0) {
            var count = $('#industries-list').attr('data-industries-count');
            if (count > 0) {
                this.initIndustryManagerIndex();
            }
            $('#industry-edit').live('submit', function() {
                var $this = $(this);
                $this.find('fieldset.form-buttons').append('<span class="loader"></span>');
                $this.find('input[type="submit"], a', 'fieldset.form-buttons').attr('disabled', 'disabled');
            });
        } else if ($('#wrapper.industry.archive').length > 0) {
            this.initIndustryManagerArchive();
        }

        $('#dialog-confirm-btn.archive').live('ajax:success', this.archiveSuccessCallback);
        $('#dialog-confirm-btn.restore').live('ajax:success', this.restoreSuccessCallback);

        $('td.action.edit a').live('click', this.editIndustryHandler);

        $('#industry-edit').live('ajax:success', this.updateIndustrySuccessCallback);
        $('#industry-edit').live('ajax:error', this.updateIndustryErrorCallback);

        /* TODO: js validation for industries (must not be null, must consist of atleast 5 characters) */
    },

    updateIndustrySuccessCallback: function(e, data) {
        if (data.code === 200) {
            /* flash success message and hide the form */
            var $row = $('tr[data-industry-id="'+data.data.industry_id+'"]');
            $row.find('td.name').text(data.data.industry_name);

            $('#edit-industry-wrapper form').fadeOut('slow', function() {
                $(this).parent().addClass('hide');
                $(this).remove();
                $('#industries-table-wrapper').fadeIn().removeClass('hide');
            });

            com.ebms.widgets.flash.flashMessage(data.message, 'notif');
        } else {
            $('#industry-edit').find('fieldset.form-buttons span.loader').remove();
            $('#industry-edit').find('input[type="submit"], a', 'fieldset.form-buttons').removeAttr('disabled');
            com.ebms.widgets.flash.flashMessage(data.message, 'error');
        }
    },

    updateIndustryErrorCallback: function() {

    },

    initIndustryManagerIndex: function() {
        this.industryTable.dataTable({
             "aoColumns": [
                null,
                null,
                {"asSorting": [ "asc", "desc"]}
            ]
        });
    },

    initIndustryManagerArchive: function() {
        this.industryTable.dataTable({
             "aoColumns": [
                null,
                {"asSorting": [ "asc", "desc"]}
            ]
        });
    },

    archiveSuccessCallback: function(e, data) {
        $('tr[data-industry-id="'+data.data.industry_id+'"]').fadeOut('slow', function() {
           $(this).remove();
        });
    },

    restoreSuccessCallback: function(e, data) {
        $('tr[data-industry-id="'+data.data.industry_id+'"]').fadeOut('slow', function() {
           $(this).remove();
        });
    },

    editIndustryHandler: function(e) {
        e.preventDefault();
        var $this = $(this);

        $('#industries-table-wrapper').hide();

        /* show loader */
        var $loaderContainer = $('div.loader-container', 'article.primary');
        $loaderContainer.removeClass('hide');

        /* get user form */
        $.ajax({
            url: $('#edit-industry-wrapper').attr('data-ajax-url') + '/' + $this.closest('tr').attr('data-industry-id'),
            dataType: 'json',
            type: 'GET',
            success: function(data) {
                $('#edit-industry-wrapper').append(data.data.html).removeClass('hide').find('form').attr('data-remote', true).attr('data-type', 'json');
            },
            error: function() {
                $('#edit-industry-wrapper').text('An error has occured, please refresh your page');
            },
            complete: function() {
                $loaderContainer.addClass('hide');
            }
        });

        return false;
    }

};