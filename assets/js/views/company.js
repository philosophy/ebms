com.ebms.views.company = {
    init: function() {
        this.initEditValidation();
    },
    
    initEditValidation: function() {
        var defaults = {
            rules: {
                /* todo add other validations - ms. she */
                name: {
                    required: true
                },
                email_address: {
                    required: true
                }
            },
            messages: {
                name: {
                    required: "Name can't be blank"
                },                
                email_address: {
                    required: "E-mail address can't be blank"
                }
            }
        };

        $('#edit-company-info').validate(defaults);
    }
};