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
        <?php if(isset($this->customers) && !empty($this->customers)) { ?>
            <table id="customers-list" class="table-list" data-customers-count=<?php echo $customers_len; ?>>
                <thead>
                    <tr>
                        <th class="no-sort"></th>
                        <th><?php echo lang('customer_name'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->customers as $customer) { ?>
                        <tr data-customer-id = <?php echo $customer->id; ?>>
                            <td class="action activate"><i></i>
                                <?php
                                    echo anchor('file_maintenance/customer/restore/'.$customer->id, lang('activate'),
                                            array('class'=>'activate-data confirm-link',
                                                'data-dialog-confirm-message'=> lang('are_you_sure_to_restore_customer'),
                                                'data-dialog-method'=>'PUT', 'data-dialog-remote'=>true, 'data-dialog-title'=> lang('restore_this_customer'),
                                                'data-dialog-type'=>'json', 'data-class'=>'restore'
                                         )); ?></td>
                            <td><?php echo $customer->name; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p><?php echo lang('no_records_found'); ?></p>
        <?php } ?>
    </div>
</article>