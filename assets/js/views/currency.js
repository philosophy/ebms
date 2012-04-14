com.ebms.views.currency = {
    currencyTable: null,
    init: function() {
        this.currencyTable = $('#currencies-list');
        if ($('#wrapper.currency.index').length > 0) {
            var count = $('#currencies-list').attr('data-currencies-count');
            if (count > 0) {
                this.initCurrencyManagerIndex();
            }
            $('#currency-edit').live('submit', function() {
                var $this = $(this);
                $this.find('fieldset.form-buttons').append('<span class="loader"></span>');
                $this.find('input[type="submit"], a', 'fieldset.form-buttons').attr('disabled', 'disabled');
            });
        } else if ($('#wrapper.currency.archive').length > 0) {
            this.initCurrencyManagerArchive();
        }

        $('#dialog-confirm-btn.archive').live('ajax:success', this.archiveSuccessCallback);
        $('#dialog-confirm-btn.restore').live('ajax:success', this.restoreSuccessCallback);

        $('td.action.edit a').live('click', this.editCurrencyHandler);

        $('#currency-edit').live('ajax:success', this.updateCurrencySuccessCallback);
        $('#currency-edit').live('ajax:error', this.updateCurrencyErrorCallback);

        /* TODO: js validation for currencies (must not be null, must consist of atleast 5 characters) */
    },

    updateCurrencySuccessCallback: function(e, data) {
        if (data.code === 200) {
            /* flash success message and hide the form */
            var $row = $('tr[data-currency-id="'+data.data.currency_id+'"]');
            $row.find('td.name').text(data.data.currency_name);

            $('#edit-currency-wrapper form').fadeOut('slow', function() {
                $(this).parent().addClass('hide');
                $(this).remove();
                $('#currencies-table-wrapper').fadeIn().removeClass('hide');
            });

            com.ebms.widgets.flash.flashMessage(data.message, 'notif');
        } else {
            $('#currency-edit').find('fieldset.form-buttons span.loader').remove();
            $('#currency-edit').find('input[type="submit"], a', 'fieldset.form-buttons').removeAttr('disabled');
            com.ebms.widgets.flash.flashMessage(data.message, 'error');
        }
    },

    updateCurrencyErrorCallback: function() {

    },

    initCurrencyManagerIndex: function() {
        this.currencyTable.dataTable({
             "aoColumns": [
                null,
                null,
                {"asSorting": [ "asc", "desc"]}
            ]
        });
    },

    initCurrencyManagerArchive: function() {
        this.currencyTable.dataTable({
             "aoColumns": [
                null,
                {"asSorting": [ "asc", "desc"]}
            ]
        });
    },

    archiveSuccessCallback: function(e, data) {
        $('tr[data-currency-id="'+data.data.currency_id+'"]').fadeOut('slow', function() {
           $(this).remove();
        });
    },

    restoreSuccessCallback: function(e, data) {
        $('tr[data-currency-id="'+data.data.currency_id+'"]').fadeOut('slow', function() {
           $(this).remove();
        });
    },

    editCurrencyHandler: function(e) {
        e.preventDefault();
        var $this = $(this);

        $('#currencies-table-wrapper').hide();

        /* show loader */
        var $loaderContainer = $('div.loader-container', 'article.primary');
        $loaderContainer.removeClass('hide');

        /* get user form */
        $.ajax({
            url: $('#edit-currency-wrapper').attr('data-ajax-url') + '/' + $this.closest('tr').attr('data-currency-id'),
            dataType: 'json',
            type: 'GET',
            success: function(data) {
                $('#edit-currency-wrapper').append(data.data.html).removeClass('hide').find('form').attr('data-remote', true).attr('data-type', 'json');
            },
            error: function() {
                $('#edit-currency-wrapper').text('An error has occured, please refresh your page');
            },
            complete: function() {
                $loaderContainer.addClass('hide');
            }
        });

        return false;
    }

};