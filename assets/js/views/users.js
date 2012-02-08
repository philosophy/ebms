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
                    required: true
                },
                email: {
                    required: true
                }
            },
            messages: {
                username: {
                    required: "User can't be blank"
                },
                email: {
                    required: "Email can't be blank"
                }
            },
            submitHandler: function(form, e) {
                if( $('#personal-info div.error_tip:visible').length > 0 ) {
                    return false;
                } else {
                    com.ebms.views.users.updateProfileSubmitHandler();
                }
            }
        };

        $('#user-edit').validate(editProfile);
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