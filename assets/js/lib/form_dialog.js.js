(function($) {
    $.fn.extend({
        customFormDialog: function(formId, formSettings, elemClose) {
            if(formId === null || formId === undefined) {
                return false;
            }
            if (elemClose !== undefined) {
                $(elemClose).live('click', function() {
                    $(formId).dialog('close');
                });
            }

            $(this).live('click', function(e) {
                // default modal dialog settings
                var $modalbox = $(formId),
                dialogTitle = '',
                resizable = false,
                draggable = false,
                modal = true,
                closeOnEscape = true,
                closeCallback = '',
                minWidth = null,
                width = null,
                height = 'auto',
                openCallback = '';

                if(formSettings === undefined && formSettings === null) {
                    // set formSettings default to empty hash {}
                    formSettings = {};
                }

                if(formSettings.dialogTitle !== undefined && formSettings.dialogTitle !== null){
                    dialogTitle = formSettings.dialogTitle;
                }
                if(formSettings.resizable !== undefined && formSettings.resizable !== null){
                    resizable = formSettings.resizable;
                }
                if(formSettings.draggable !== undefined && formSettings.draggable !== null){
                    draggable = formSettings.draggable;
                }
                if(formSettings.modal !== undefined && formSettings.modal !== null){
                    modal = formSettings.modal;
                }
                if(formSettings.closeOnEscape !== undefined && formSettings.closeOnEscape !== null){
                    closeOnEscape = formSettings.closeOnEscape;
                }
                if(formSettings.close !== undefined && formSettings.close !== null) {
                    closeCallback = formSettings.close;
                }
                if(formSettings.minWidth !== undefined && formSettings.minWidth !== null) {
                    minWidth = formSettings.minWidth;
                }
                if(formSettings.open !== undefined && formSettings.open !== null){
                    openCallback = formSettings.open;
                }
                if(formSettings.width !== undefined && formSettings.height !== null) {
                    width = formSettings.width;
                }
                if(formSettings.height !== undefined && formSettings.height !== null) {
                    height= formSettings.height;
                }

                $modalbox.dialog({
                    title: dialogTitle,
                    resizable: resizable,
                    draggable: draggable,
                    modal: modal,
                    closeOnEscape: closeOnEscape,
                    close: closeCallback,
                    minWidth: minWidth,
                    open: openCallback,
                    width: width,
                    height: height
                });

                e.preventDefault();
            });
            return this;
        }
    });
})(jQuery);