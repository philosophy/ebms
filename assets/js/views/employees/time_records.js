com.ebms.views.time_records = {
    init: function() {
        $('#timein').customFormDialog('#timein-dialog', {
            dialogTitle: $('#timein').attr('data-title')
        });

        $('#timeout').customFormDialog('#timeout-dialog', {
           dialogTitle: $('#timeout').attr('data-title')
        });

        com.ebms.widgets.timetick.displayTime($('span.current-time'));

        $('#checkin, #checkout').button();
        $('#timein-form').live('ajax:success', this.timeinSuccessCallback);
        $('#timeout-form').live('ajax:success', this.timeoutSuccessCallback);
        $('ul.time-records.data li').live('click', this.listClickHandler);
    },

    listClickHandler: function() {
        var $this = $(this);

        $this.siblings().removeClass('selected');
        $this.addClass('selected');

        if ($this.find('.time-out-rec.info').text() !== '...') {
            $('#timeout').addClass('inactive');
            return false;
        } else {
            $('#timeout').removeClass('inactive');
        }

        //update timeout details
        var $timeoutContainer = $('#timeout-dialog');
        $timeoutContainer.find('input.emp-id').val($this.attr('data-employee-id'));
        $timeoutContainer.find('input.time-record-id').val($this.attr('data-record-id'));
        $timeoutContainer.find('span.emp-name').text($this.find('.emp-name').text());
    },

    timeinSuccessCallback: function(e, response) {
        $('#timein-dialog').dialog('destroy');
        var $recordsContainer = $('ul.time-records.data');
        if ($recordsContainer.find('li').length === 0) {
            $(this).find('[data-disable-with="true"]').attr('disabled', 'disabled');
            window.location.reload();
        } else {
            //append to list
            var list;
            list = $recordsContainer.find('li').first().clone();
            list.removeClass('selected');
            list.find('.time-out-rec').text(com.ebms.widgets.base.nodata);
            list.attr('data-record-id', response.data.record_id);
            list.find('.emp-name').text(response.data.name);
            list.find('.time-in-rec').text(response.data.time_in);

            $recordsContainer.prepend(list);

        }

    },

    timeoutSuccessCallback: function(e, response) {
        $('#timeout-dialog').dialog('destroy');
        var $recordsContainer = $('ul.time-records.data');

        var list = $recordsContainer.find('li[data-record-id="'+ response.data.record_id +'"]');
        list.find('.time-out-rec').text(response.data.time_out);

    }
};