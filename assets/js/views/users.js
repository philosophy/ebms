com.ebms.views.users = {
    init: function() {
        $('.edit-link').click(this.displayEditAccount);
        $('.cancel-link').live('click', this.hideEditForm);

    },

    updateProfileSubmitHandler: function() {

        var $personalInfo = $('#personal-info');
        var $buttonsContainer = $personalInfo.find('fieldset.form-buttons');

        /* disable buttons */
        $buttonsContainer.find('input, a').attr('disabled', 'disabled');

        /* show loader */
        $buttonsContainer.append('<span class="loader"></span>');

        var username = $.trim($('#username').val()),
            firstName = $.trim($('#first_name').val()),
            lastName = $.trim($('#last_name').val()),
            middleName = $.trim($('#middle_name').val()),
            email = $.trim($('#email').val()),
            address = $.trim($('#address').val()),
            gender = $.trim($('select[name="gender"] option:selected').val()),
            dateOfBirth = $.trim($('#date_of_birth').val()),
            statusId = $.trim($('input:radio[name=status_id]:checked').val()),
            homePhone = $.trim($('#home_phone').val()),
            workPhone = $.trim($('#work_phone').val());

        var data = {
            username: username,
            first_name: firstName,
            last_name: lastName,
            middle_name: middleName,
            email: email,
            address: address,
            gender: gender,
            date_of_birth: dateOfBirth,
            status_id: statusId,
            home_phone: homePhone,
            work_phone: workPhone
        }
        $.ajax({
            url: $('#user-edit', $personalInfo).attr('action'),
            dataType: 'json',
            data: data,
            type: 'POST',
            success: function(data) {
                if(data.code === 200) {
                    $('#username-text').text(username);
                    $('#name-text').text(firstName+' '+middleName+' '+lastName);
                    $('#email-text').text(email);
                    $('#address-text').text(address);

                    gender = (gender==='0') ? 'Male' : 'Female';
                    $('#gender-text').text(gender);
                    $('#birthdate-text').text(dateOfBirth);

                    var status;
                    if (statusId === '0') {
                        status = 'Single';
                    } else if (statusId === '1') {
                        status = 'Married';
                    } else if (statusId === '2') {
                        status = 'Widowed';
                    }
                    $('#status-text').text(status);

                    $('#home-phone-text').text(homePhone);
                    $('#work-phone-text').text(workPhone);

                    /* remove the form */
                    $('#user-edit').fadeOut('slow', function() {
                        $(this).remove();
                    });

                    /* show details */
                    $personalInfo.find('div.details').show();
                    $personalInfo.find('a.edit-link').show();
                    com.ebms.widgets.flash.flashMessage(data.message)
                } else if (data.code == 412) {
                    com.ebms.widgets.flash.flashMessage(data.message)
                }
            },
            complete: function() {
                $('#personal-info').find('fieldset.form-buttons')
                .find('input, a').removeAttr('disabled')
                .end().find('span.loader').remove();
            },
            error: function() {
                alert('An error has occured, please refresh your page!');
            }
        });

        return false;
    },

    initEditProfileValidations: function() {
        var editProfile = {
            rules: {
                /* todo add other validations - ms. she */
                username: {
                    required: true,
                    rangelength: [5,32]
                },
                first_name: {
                    required: true,
                    number: false,
                    rangelength: [1,32]
                },
                middle_name: {
                    required: true,
                    rangelength: [1,32]
                },
                last_name:{
                    required: true,
                    rangelength: [2,32]
                },
                email: {
                    required: true,
                    email: true
                },
                address: {
                    required: true,
                    rangelength: [5,32]
                },
                date_of_birth: {
                    required:true
                }

            },

            messages: {
                username: {
                    required: "Username can't be blank",
                    rangelength: "Please enter a valid username"
                },
                first_name: {
                    required: "First name can't be blank",
                    number: "First name can't contain numbers",
                    rangelength: "Please enter a valid first name"
                },
                middle_name: {
                    required: "Middle name can't be blank",
                    max: "Please enter a valid middle name"
                },
                last_name: {
                    required: "Last name can't be blank",
                    rangelength: "Please enter a valid last name"
                },
                email: {
                    required: "E-mail can't be blank",
                    rangelength: "Invaid email format"
                },
                address: {
                    required: "Address can't be blank",
                    rangelength: "Please enter a valid address"
                },
                date_of_birth: {
                    required: "Date of birth can't be blank"
                }

            },
            submitHandler: function(form) {
                if( $('#personal-info label.error:visible').length > 0 ) {
                    return false;
                } else {
                    com.ebms.views.users.updateProfileSubmitHandler();
                }
            }
        };

        $('#user-edit').validate(editProfile);
    },

    initEditPasswordValidations: function() {
        var editPasswordSettings = {
            rules: {
                current_password: {
                    required: true
                },
                new_password: {
                    required: true
                },
                confirm_password: {
                    required: true
                }
            },
            messages: {
                current_password: {
                    required: "Current password can't be blank"
                },
                new_password: {
                    required: "New password can't be blank"
                },
                confirm_password: {
                    required: "Confirm password can't be blank"
                }
            },
            submitHandler: function(form) {
                if( $('#password-settings label.error:visible').length > 0) {
                    return false;
                } else {
                    com.ebms.views.users.updatePasswordSubmitHandler();
                }
            }
        };

        $('#user-edit-password-settings').validate(editPasswordSettings);
    },

    initEditSecuritySettingsValidation: function() {
        var editSecuritySettingsValidation = {
            rules: {
                security_answer: {
                    required: true
                }
            },
            messages: {
                security_answer: {
                    required: "Security answer can't be blank"
                }
            },
            submitHandler: function(form) {
                if( $('#security-settings label.error:visible').length > 0) {
                    return false;
                } else {
                    com.ebms.views.users.updateSecuritySubmitHandler();
                }
            }
        };

        $('#user-edit-security-settings').validate(editSecuritySettingsValidation);
    },

    updateSecuritySubmitHandler: function() {
        var $securitySettingsWrapper = $('#security-settings');
        var $buttonsContainer = $securitySettingsWrapper.find('fieldset.form-buttons');

        /* disable buttons */
        $buttonsContainer.find('input, a').attr('disabled', 'disabled');

        /* show loader */
        $buttonsContainer.append('<span class="loader"></span>');

        var securityAnswer = $.trim($('#security-answer').val()),
            securityQuestionId = $.trim($('select[name="security_question"] option:selected').val());

        var data = {
            security_answer: securityAnswer,
            security_question_id: securityQuestionId
        };

        $.ajax({
            url: $('#user-edit-security-settings', $securitySettingsWrapper).attr('action'),
            dataType: 'json',
            data: data,
            type: 'POST',
            success: function(data) {
                if(data.code === 200) {
                    var txt;
                    if (data.data.security_question_id === '0') {
                        txt = 'What is your favorite snack?';
                    } else if (data.data.security_question_id === '1') {
                        txt = "What is your mother's maiden name?";
                    }  else if (data.data.security_question_id === '2') {
                        txt = "What is your pet's name?";
                    }
                    
                    $('#security-question').text(txt);
                    /* remove the form */
                    $('#user-edit-security-settings').fadeOut('slow', function() {
                        $(this).remove();
                    });

                    /* show details */
                    $securitySettingsWrapper.find('div.details').show();
                    $securitySettingsWrapper.find('a.edit-link').show();
                    com.ebms.widgets.flash.flashMessage(data.message)
                } else if (data.code == 412) {
                    com.ebms.widgets.flash.flashMessage(data.message)
                }
            },
            complete: function() {
                $('#security-settings').find('fieldset.form-buttons')
                .find('input, a').removeAttr('disabled')
                .end().find('span.loader').remove();
            },
            error: function() {
                alert('An error has occured, please refresh your page!');
            }
        });

        return false;
    },

    updatePasswordSubmitHandler: function() {

        var $passwordSettingsWrapper = $('#password-settings');
        var $buttonsContainer = $passwordSettingsWrapper.find('fieldset.form-buttons');

        /* disable buttons */
        $buttonsContainer.find('input, a').attr('disabled', 'disabled');

        /* show loader */
        $buttonsContainer.append('<span class="loader"></span>');

        var currentPassword = $.trim($('#current-password').val()),
            newPassword = $.trim($('#new-password').val()),
            confirmPassword = $.trim($('#confirm-password').val());

        var data = {
            current_password: currentPassword,
            new_password: newPassword,
            confirm_password: confirmPassword
        }
        $.ajax({
            url: $('#user-edit-password-settings', $passwordSettingsWrapper).attr('action'),
            dataType: 'json',
            data: data,
            type: 'POST',
            success: function(data) {
                if(data.code === 200) {
                    $('#current-password').text('');
                    $('#new-password').text('');
                    $('#confirm-password').text('');

                    /* remove the form */
                    $('#user-edit-password-settings').fadeOut('slow', function() {
                        $(this).remove();
                    });

                    /* show details */
                    $passwordSettingsWrapper.find('div.details').show();
                    $passwordSettingsWrapper.find('a.edit-link').show();
                    com.ebms.widgets.flash.flashMessage(data.message)
                } else if (data.code == 412) {
                    com.ebms.widgets.flash.flashMessage(data.message)
                }
            },
            complete: function() {
                $('#password-settings').find('fieldset.form-buttons')
                .find('input, a').removeAttr('disabled')
                .end().find('span.loader').remove();
            },
            error: function() {
                alert('An error has occured, please refresh your page!');
            }
        });

        return false;
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

                /* initialize datepicker */
                com.ebms.widgets.base.initDatePicker($('#date_of_birth'));

                var id = $(data.data.html).attr('id');
                if (id === 'user-edit') {
                    com.ebms.views.users.initEditProfileValidations();
                } else if (id === 'user-edit-password-settings') {
                    com.ebms.views.users.initEditPasswordValidations();
                } else if (id === 'user-edit-security-settings') {
                    com.ebms.views.users.initEditSecuritySettingsValidation();
                }
            },
            complete: function() {
                $this.removeData('sending');
            },
            error: function() {
                alert('An error has occured, please refresh your page!');
            }
        })
        return false;
    }

};