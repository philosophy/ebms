com.ebms.views.users = {
  init: function() {
    $('.edit-link').click(this.displayEditAccount);
    $('.cancel-link').live('click', this.hideEditForm);
    
  },
  
  initEditProfileValidations: function() {
        var editProfile = {
            errorClass: 'invalid',
            errorElement: 'div',
            wrapper: '<div class="error_tip" />',
            wrapSelector: 'div.error_tip',
            rules: {
                /* todo add other validations - ms. she */
                username: {
                    required: true
                }
            },
            messages: {
                username: {
                    required: "User can't be blank."
                }
            },
            submitHandler: function(form) {
                var $personalInfo = $('#personal-info');
                var $buttonsContainer = $personalInfo.find('fieldset.form-buttons');
                
                var ns = com.ebms.views.users;
                
                if( $('#personal-info div.error_tip:visible').length > 0 ) {                    
                    return false;
                } else {
                    form.submit();
//                    form.preventDefault();
//                    /* disable buttons */
//                    $buttonsContainer.find('input, a').attr('disabled', 'disabled');                    
//                    
//                    /* show loader */
//                    $buttonsContainer.append('<span class="loader"></span>');
//                    
//                    var data = {
//                        username: $.trim($('#username').val()),
//                        first_name: $.trim($('#first_name').val()),
//                        last_name: $.trim($('#last_name').val()),
//                        middle_name: $.trim($('#middle_name').val()),
//                        email: $.trim($('#email').val()),
//                        address: $.trim($('#address').val()),
//                        gender: $.trim('select[name="gender"] option:selected').val(),
//                        date_of_birth: $.trim($('#date_of_birth').val()),
//                        status_id: $('input:radio[name=status_id]:checked').val(),
//                        home_phone: $.trim($('#home_phone').val()),
//                        work_phone: $.trim($('#work_phone').val())
//                    }
//                    $.ajax({
//                       url: $personalInfo.attr('action'),
//                       dataType: 'json',
//                       data: data,
//                       type: 'POST',
//                       success: ns.updateProfileSuccessCallback,
//                       complete: ns.updateProfileCompleteCallback,
//                       error: ns.updateProfileErrorCallback
//                    });          
//                    return false;
                }
            }
        };
        
        $('#user-edit').validate(editProfile);
  },
  
  updateProfileSuccessCallback: function(data) {
      
  },
  
  updateProfileCompleteCallback: function(data) {
    $('#personal-info').find('fieldset.form-buttons')
        .find('input, a').removeAttr('disabled')
        .end().find('span.loader').remove();
    
  },
  
  updateProfileErrorCallback: function() {
      alert('An error has occured, please refresh your page!');
  },
  
  hideEditForm: function(e) {
      e.preventDefault();
      var $this = $(this);
      var $editForm = $this.closest('form');
      var $details = $editForm.closest('section').find('.details');
      
      $this.closest('section').find('h3 > a.edit-link').show();
      $editForm.remove();
      $details.show();
      
      return false;
  },
  
  displayEditAccount: function(e) {
      e.preventDefault();
      
      var $this = $(this);
      var $info = $this.closest('section');
      
      /* hide other forms */
      $('section .details').show();
      $('section form').remove();
      $('section a.edit-link').show();
      
      $this.hide();
      if ($this.data('sending')) {
          return false;
      } else {
          $this.data('sending', 'true');
      }
      
      /* display loader */
      $('div.details', $info).hide();
      $info.append('<div class="loader"></div>');
      
      /* fetch edit account partial */
      $.ajax({
          url: $(this).attr('href'),
          type: 'GET',
          dataType: 'json',
          success: function(data) {
              $info.find('div.loader').hide();              
              $info.append(data.data.html).fadeIn();
          },
          complete: function() {
              $this.removeData('sending');
              com.ebms.views.users.initEditProfileValidations();
          },
          error: function() {
              alert('An error has occured, please refresh your page!');
          }
      })
      return false;
  }
  
};