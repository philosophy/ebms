com.ebms.views.leaves = {
    init: function() {
        if ($('#wrapper.leaves.index').length > 0) {
            this.initLeavesTableIndex();

            $('#leave-edit').live('submit', function() {
                var $this = $(this);
                $this.find('fieldset.form-buttons').append('<span class="loader"></span>');
                $this.find('input[type="submit"], a', 'fieldset.form-buttons').attr('disabled', 'disabled');
            });
        } else {
            this.initLeavesTableArchive();
        }

        $('td.action.edit a').live('click', this.editLeaveHandler);
        $('#leave-edit').live('ajax:success', this.updateLeaveSuccessCallback);

        $('#dialog-confirm-btn.archive').live('ajax:success', this.archiveSuccessCallback);
        $('#dialog-confirm-btn.restore').live('ajax:success', this.restoreSuccessCallback);
    },

    initLeavesTableIndex: function() {
        $('#employee-leaves-list').dataTable({
             "aoColumns": [
                null,
                null,
                {"asSorting": [ "asc", "desc"]},
                {"asSorting": [ "asc", "desc"]}
            ]
        });
    },

    initLeavesTableArchive: function() {
        $('#employee-leaves-list').dataTable({
             "aoColumns": [
                null,
                {"asSorting": [ "asc", "desc"]},
                {"asSorting": [ "asc", "desc"]}
            ]
        });
    },

    editLeaveHandler: function(e) {
        e.preventDefault();
        var $this = $(this);

        $('#leaves-table-wrapper').hide();

        /* show loader */
        var $loaderContainer = $('div.loader-container', 'article.primary');
        $loaderContainer.removeClass('hide');

        /* get user form */
        $.ajax({
            url: $('#edit-leave-wrapper').attr('data-ajax-url') + '/' + $this.closest('tr').attr('data-leave-id'),
            dataType: 'json',
            type: 'GET',
            success: function(data) {
                $('#edit-leave-wrapper').append(data.data.html).removeClass('hide').find('form').attr('data-remote', true).attr('data-type', 'json');
            },
            error: function() {
                $('#edit-leave-wrapper').text(com.ebms.widgets.base.defaultErrorMsg);
            },
            complete: function() {
                $loaderContainer.addClass('hide');
            }
        });

        return false;
    },

    updateLeaveSuccessCallback: function(e, data) {
        if (data.code === 200) {
            /*  hide the form */
            var $row = $('tr[data-leave-id="'+data.data.leave_id+'"]');
            $row.find('td.name').text(data.data.name);
            $row.find('td.days').text(data.data.days);

            $('#edit-leave-wrapper form').fadeOut('slow', function() {
                $(this).parent().addClass('hide');
                $(this).remove();
                $('#leaves-table-wrapper').fadeIn().removeClass('hide');
            });

            com.ebms.widgets.flash.flashMessage(data.message, 'success');
        } else {
            $('#leave-edit').find('fieldset.form-buttons span.loader').remove();
            $('#leave-edit').find('input[type="submit"], a', 'fieldset.form-buttons').removeAttr('disabled');
            com.ebms.widgets.flash.flashMessage(data.message, 'error');
        }
    },

    archiveSuccessCallback: function(e, data) {
        $('tr[data-leave-id="'+data.data.leave_id+'"]').fadeOut('slow', function() {
           $(this).remove();

           if ($('tr[data-leave-id]').length == 0) {
               window.location.reload();
           }
        });
    },

    restoreSuccessCallback: function(e, data) {
        $('tr[data-leave-id="'+data.data.leave_id+'"]').fadeOut('slow', function() {
           $(this).remove();

           if ($('tr[data-leave-id]').length == 0) {
               window.location.reload();
           }
        });
    }
};