<?php
    $currencies_len = count($this->currencies);
?>
<article class="aside-left">
    <?php
        $data = array('list' => array('link' => 'file_maintenance/currency/index', 'text' => lang('currency_list')),
                      'create' => array('link' => 'file_maintenance/currency/new_currency', 'text' => lang('create_currency')),
                      'archive' => array('link' => 'file_maintenance/currency/archive', 'text' => lang('archive'))
            );
        $this->load->view('common/nav/left_nav_manager', $data);
    ?>
</article>
<article class="primary">
    <div id="currencies-table-wrapper" class="aligned-table table-list-wrapper hide">
        <?php if(isset($this->currencies) && !empty($this->currencies)) { ?>
            <table id="currencies-list" class="table-list" data-currencies-count=<?php echo $currencies_len; ?>>
                <thead>
                    <tr>
                        <th class="no-sort"></th>
                        <th><?php echo lang('currency_name'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->currencies as $currency) { ?>
                        <tr data-currency-id = <?php echo $currency->id; ?>>
                            <td class="action activate"><i></i>
                                <?php
                                    echo anchor('file_maintenance/currency/restore/'.$currency->id, lang('activate'),
                                            array('class'=>'activate-data confirm-link',
                                                'data-dialog-confirm-message'=> lang('are_you_sure_to_restore_currency'),
                                                'data-dialog-method'=>'PUT', 'data-dialog-remote'=>true, 'data-dialog-title'=> lang('restore_this_currency'),
                                                'data-dialog-type'=>'json', 'data-class'=>'restore'
                                         )); ?></td>
                            <td><?php echo $currency->name; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p><?php echo lang('no_records_found'); ?></p>
        <?php } ?>
    </div>
</article>