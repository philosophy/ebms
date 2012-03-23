com.ebms.widgets.confirm = function() {
  var $modalbox;
  var self;

  // element ids
  var dialogConfirmBtn = 'dialog-confirm-btn',
      dialogCancelBtn = 'dialog-cancel-btn',
      dialogTryAgainBtn = 'dialog-tryagain-btn';

  return {
    init: function() {
      self = this;
      self.bindBehaviors();
    },

    bindBehaviors: function() {
      $('#'+dialogCancelBtn).live('click', self.destroyModalDialog);
      $('#'+dialogConfirmBtn).live('click', self.processRequest);

      $('a.confirm-link').live('click', self.showModalDialog);

      $('#confirm-dialog').live('ajax:success', function() {
        self.destroyModalDialog();
      }).live('ajax:error', function() {
        self.handleAjaxError();
      });
    },

    processRequest: function(e) {
      $('#' + dialogCancelBtn).closest('li').addClass('disabled');

      var $this = $(this);
      if($this.closest('li').hasClass('disabled')) {
        /* hack prevent multiple request */
        $this.attr('href', '#');

        //e.preventDefault();
        //TODO somehow this is not working, need to investigate
      }
    },

    showModalDialog: function(e) {
      if($(this).hasClass('inactive')){return false;}

      e.stopPropagation();
      e.preventDefault();
      var $confirmLink = $(this);
      $modalbox = $('#confirm-dialog');
      $modalbox.dialog('destroy');                                 // destroy modal dialog

      var dialogTitle = $confirmLink.data('dialog-title');             // set modal title
      var dialogMessage = $confirmLink.data('dialog-confirm-message'); // set modal message.
      var deletePath = $confirmLink.attr('href');                      // set delete path
      var remote = $confirmLink.data('dialog-remote');                 // set remote attr
      var methodType = $confirmLink.data('dialog-method');             // set method type
      var dialogIcon = $confirmLink.data('dialog-icon');               // set the icon
      var dataType = $confirmLink.data('dialog-type');                 // set the data type
      var ajaxBind = $confirmLink.data('ajax-bind');                 // set the ajax bind handle
      var additionalClass = $confirmLink.data('class');                      // set delete path

      $('.dialog-body p', $modalbox).html(dialogMessage);
      $('.icon', $modalbox).remove();
      $modalbox.dialog({
        title: dialogTitle,
        resizable: false,
        draggable: false,
        modal: true,
        closeOnEscape: true,
        open: function() {
            $('#'+dialogConfirmBtn).button();
            $('#'+dialogTryAgainBtn).button();
            $('#'+dialogCancelBtn).button();
        },
        close: function() {
          $('#'+dialogConfirmBtn).closest('.link').show();
          $('#'+dialogTryAgainBtn).closest('.link').hide();
        }
      });

      $modalbox.css('height', 'auto');          //override height of confirm-dialog

      var btnTryConfirm = $('#'+dialogConfirmBtn+', #'+dialogTryAgainBtn);
      // Reset confirm dialog OK button
      if(btnTryConfirm.data('type') != 'undefined'){
        btnTryConfirm.removeData('type');
      }
      if (btnTryConfirm.data('method') != 'undefined') {
        btnTryConfirm.removeData('data-method');
      }

      // set up confirm dialog OK button
      if(deletePath && deletePath !== undefined) {
        btnTryConfirm.attr('href', deletePath);
      }
      if(methodType && methodType !== undefined) {
        btnTryConfirm.removeData('method');
        btnTryConfirm.data('method', methodType);
      }
      if(!!remote) {
        btnTryConfirm.attr('data-remote', remote);
      }
      if(dataType && dataType !== undefined) {
        btnTryConfirm.removeData('data-type');
        btnTryConfirm.data('type', dataType);
      }
      if (ajaxBind && ajaxBind !== undefined) {
        btnTryConfirm.removeData('ajax-bind');
        btnTryConfirm.data('ajax-bind', ajaxBind);
      }
      if (additionalClass && additionalClass !== undefined) {
        btnTryConfirm.addClass(additionalClass);
      }
      $('.ui-dialog-titlebar').removeClass('ui-corner-all').addClass('ui-corner-top');

      // check if dialog is with icon
      if(!!dialogIcon) {
        var iconHtml = $('<div>').addClass('icon').append($('<img>').attr('src', dialogIcon));
        $('.dialog_body', $modalbox).prepend(iconHtml);
      }
    },

    destroyModalDialog: function(e) {
      $modalbox.dialog('close');
      e.preventDefault();
    },

    handleAjaxError: function() {
      $('#'+dialogConfirmBtn).addClass('hide');
      $('#'+dialogTryAgainBtn).removeClass('hide');
    }
  };
}();