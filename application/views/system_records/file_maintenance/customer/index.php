<?php
    $customers_len = count($this->customers);
?>

<article class="aside-left">

    <?php
        $data = array('list' => array('link' => 'file_maintenance/customer/index', 'text' => lang('customer_list')),
                      'create' => array('link' => 'file_maintenance/customer/new_customer', 'text' => lang('create_customer')),
                      'archive' => array('link' => 'file_maintenance/customer/archive', 'text' => lang('archive'))
            );
        $this->load->view('common/nav/left_nav_manager', $data);
    ?>
</article>
<article class="primary">
    <div id="customers-table-wrapper" class="aligned-table table-list-wrapper hide">
        <?php if (isset($this->customers) && !empty($this->customers) && $customers_len > 0) { ?>
            <table id="customers-list" class="table-list" data-customers-count=<?php echo $customers_len; ?>>
                <thead>
                    <tr>
                        <th class="no-sort"></th>
                        <th class="no-sort"></th>
                        <th><?php echo lang('name'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->customers as $customer) { ?>
                        <tr data-customer-id = <?php echo $customer->id; ?>>
                            <td class="action edit"><i></i><?php echo anchor('#', lang('edit'), array('class'=>'edit-data')); ?></td>
                            <td class="action delete"><i></i>
                                <?php
                                    echo anchor('file_maintenance/customer/delete/'.$customer->id, lang('delete'),
                                            array('class'=>'delete-data confirm-link',
                                                'data-dialog-confirm-message'=>lang('are_you_sure_to_delete_customer'),
                                                'data-dialog-method'=>'delete', 'data-dialog-remote'=>true, 'data-dialog-title'=>lang('delete_this_customer'),
                                                'data-dialog-type'=>'json', 'data-class'=>'archive'
                                         )); ?></td>
                            <td class="name"><?php echo $customer->name; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p><?php echo lang('no_records_found'); ?></p>
        <?php } ?>
    </div>
    <div class="loader loader-container hide">
    </div>
    <div id="edit-customer-wrapper" class="hide aligned-details" data-ajax-url=<?php echo site_url("file_maintenance/customer/get_customer_edit_form/"); ?>>
        <h3>
            Edit Area Type
        </h3>
    </div>
</article>