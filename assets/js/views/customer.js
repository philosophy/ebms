com.ebms.views.customer = {
    customerTable: null,
    init: function() {
        this.customerTable = $('#customers-list');
        if ($('#wrapper.customer.index').length > 0) {
            var count = $('#customers-list').attr('data-customers-count');
            if (count > 0) {
                this.initCustomerManagerIndex();
            }
            $('#customer-edit').live('submit', function() {
                var $this = $(this);
                $this.find('fieldset.form-buttons').append('<span class="loader"></span>');
                $this.find('input[type="submit"], a', 'fieldset.form-buttons').attr('disabled', 'disabled');
            });
        } else if ($('#wrapper.customer.archive').length > 0) {
            this.initCustomerManagerArchive();
        }

        $('#dialog-confirm-btn.archive').live('ajax:success', this.archiveSuccessCallback);
        $('#dialog-confirm-btn.restore').live('ajax:success', this.restoreSuccessCallback);

        $('td.action.edit a').live('click', this.editCustomerHandler);

        $('#customer-edit').live('ajax:success', this.updateCustomerSuccessCallback);
        $('#customer-edit').live('ajax:error', this.updateCustomerErrorCallback);

        /* TODO: js validation for customers (must not be null, must consist of atleast 5 characters) */
    },

    updateCustomerSuccessCallback: function(e, data) {
        if (data.code === 200) {
            /* flash success message and hide the form */
            var $row = $('tr[data-customer-id="'+data.data.customer_id+'"]');
            $row.find('td.name').text(data.data.customer_name);

            $('#edit-customer-wrapper form').fadeOut('slow', function() {
                $(this).parent().addClass('hide');
                $(this).remove();
                $('#customers-table-wrapper').fadeIn().removeClass('hide');
            });

            com.ebms.widgets.flash.flashMessage(data.message, 'notif');
        } else {
            com.ebms.widgets.flash.flashMessage(data.message, 'error');
        }
    },

    updateCustomerErrorCallback: function() {

    },

    initCustomerManagerIndex: function() {
        this.customerTable.dataTable({
             "aoColumns": [
                null,
                null,
                {"asSorting": [ "asc", "desc"]}
            ]
        });
    },

    initCustomerManagerArchive: function() {
        this.customerTable.dataTable({
             "aoColumns": [
                null,
                {"asSorting": [ "asc", "desc"]}
            ]
        });
    },

    archiveSuccessCallback: function(e, data) {
        $('tr[data-customer-id="'+data.data.customer_id+'"]').fadeOut('slow', function() {
           $(this).remove();
        });
    },

    restoreSuccessCallback: function(e, data) {
        $('tr[data-customer-id="'+data.data.customer_id+'"]').fadeOut('slow', function() {
           $(this).remove();
        });
    },

    editCustomerHandler: function(e) {
        e.preventDefault();
        var $this = $(this);

        $('#customers-table-wrapper').hide();

        /* show loader */
        var $loaderContainer = $('div.loader-container', 'article.primary');
        $loaderContainer.removeClass('hide');

        /* get user form */
        $.ajax({
            url: $('#edit-customer-wrapper').attr('data-ajax-url') + '/' + $this.closest('tr').attr('data-customer-id'),
            dataType: 'json',
            type: 'GET',
            success: function(data) {
                $('#edit-customer-wrapper').append(data.data.html).removeClass('hide').find('form').attr('data-remote', true).attr('data-type', 'json');
            },
            error: function() {
                $('#edit-customer-wrapper').text('An error has occured, please refresh your page');
            },
            complete: function() {
                $loaderContainer.addClass('hide');
            }
        });

        return false;
    }

};