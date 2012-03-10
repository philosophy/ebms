com.ebms.views.company = {
    companyTable: null,
    init: function() {
        this.companyTable = $('#companies-list');
        if ($('#wrapper.company.index').length > 0) {
            var count = $('#companies-list').attr('data-companies-count');
            if (count > 0) {
                this.initCompanyManagerIndex();
            }
            $('#company-edit').live('submit', function() {
                var $this = $(this);
                $this.find('fieldset.form-buttons').append('<span class="loader"></span>');
                $this.find('input[type="submit"], a', 'fieldset.form-buttons').attr('disabled', 'disabled');
            });
        } else if ($('#wrapper.company.archive').length > 0) {
            this.initCompanyManagerArchive();
        }

        $('#dialog-confirm-btn.archive').live('ajax:success', this.archiveSuccessCallback);
        $('#dialog-confirm-btn.restore').live('ajax:success', this.restoreSuccessCallback);

        $('td.action.edit a').live('click', this.editCompanyHandler);

        $('#company-edit').live('ajax:success', this.updateCompanySuccessCallback);
        $('#company-edit').live('ajax:error', this.updateCompanyErrorCallback);

        /* TODO: js validation for companies (must not be null, must consist of atleast 5 characters) */
    },

    updateCompanySuccessCallback: function(e, data) {
        if (data.code === 200) {
            /* flash success message and hide the form */
            var $row = $('tr[data-company-id="'+data.data.company_id+'"]');
            $row.find('td.name').text(data.data.company_name);

            $('#edit-company-wrapper form').fadeOut('slow', function() {
                $(this).parent().addClass('hide');
                $(this).remove();
                $('#companies-table-wrapper').fadeIn().removeClass('hide');
            });

            com.ebms.widgets.flash.flashMessage(data.message, 'notif');
        } else {
            com.ebms.widgets.flash.flashMessage(data.message, 'error');
        }
    },

    updateCompanyErrorCallback: function() {

    },

    initCompanyManagerIndex: function() {
        this.companyTable.dataTable({
             "aoColumns": [
                null,
                null,
                {"asSorting": [ "asc", "desc"]}
            ]
        });
    },

    initCompanyManagerArchive: function() {
        this.companyTable.dataTable({
             "aoColumns": [
                null,
                {"asSorting": [ "asc", "desc"]}
            ]
        });
    },

    archiveSuccessCallback: function(e, data) {
        $('tr[data-company-id="'+data.data.company_id+'"]').fadeOut('slow', function() {
           $(this).remove();
        });
    },

    restoreSuccessCallback: function(e, data) {
        $('tr[data-company-id="'+data.data.company_id+'"]').fadeOut('slow', function() {
           $(this).remove();
        });
    },

    editCompanyHandler: function(e) {
        e.preventDefault();
        var $this = $(this);

        $('#companies-table-wrapper').hide();

        /* show loader */
        var $loaderContainer = $('div.loader-container', 'article.primary');
        $loaderContainer.removeClass('hide');

        /* get user form */
        $.ajax({
            url: $('#edit-company-wrapper').attr('data-ajax-url') + '/' + $this.closest('tr').attr('data-company-id'),
            dataType: 'json',
            type: 'GET',
            success: function(data) {
                $('#edit-company-wrapper').append(data.data.html).removeClass('hide').find('form').attr('data-remote', true).attr('data-type', 'json');
            },
            error: function() {
                $('#edit-company-wrapper').text('An error has occured, please refresh your page');
            },
            complete: function() {
                $loaderContainer.addClass('hide');
            }
        });

        return false;
    }

};