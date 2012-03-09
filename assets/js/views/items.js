com.ebms.views.items = {
    init: function() {

        $('a.inactive').live('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            e.cancelBubble = true;
            return false;
        });

        //        var newProduct = $('#new-product');
        //        newProduct.customFormDialog('#new-product-wrapper', {
        //            dialogTitle: newProduct.attr('data-title')
        //        });

        /* new product form */
        $('#new-product').live('click', function() {
            $('#new-product-wrapper').dialog({
                title: $(this).attr('data-title'),
                resizable: false,
                draggable: false,
                modal: true,
                closeOnEscape: true,
                open: com.ebms.views.items.getNewItemForm
            })
        });

        var editProduct = $('#edit-product');
        editProduct.customFormDialog('#edit-product-wrapper', {
            dialogTitle: editProduct.attr('data-title')
        });

        var deleteProduct = $('#delete-product');
        deleteProduct.customFormDialog('#delete-product-wrapper', {
            dialogTitle: deleteProduct.attr('data-title')
        });

        var restoreProduct = $('#restore-product');
        restoreProduct.customFormDialog('#restore-product-wrapper', {
            dialogTitle: restoreProduct.attr('data-title')
        });

        var transferProduct = $('#transfer-product');
        transferProduct.customFormDialog('#transfer-product-wrapper', {
            dialogTitle: transferProduct.attr('data-title')
        });
    },

    getNewItemForm: function() {
        var productWrapper = $('#new-product-wrapper');
        if (productWrapper.data('with-form') === 'true') {return;}
        $.ajax({
            url: productWrapper.attr('data-ajax-url'),
            dataType: 'json',
            type: 'GET',
            success: function(data) {
                productWrapper.find(".loader").remove().end().addClass('no-loader');
                productWrapper.html(data.data.html).fadeIn();

                productWrapper.dialog('option', 'position', 'center');
                productWrapper.data('with-form', 'true');
            },
            error: function() {

            }
        })
    },

    resetNewItemFields: function() {

    }
};