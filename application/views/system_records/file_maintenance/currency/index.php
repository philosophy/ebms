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
        <?php if (isset($this->currencies) && !empty($this->currencies) && $currencies_len > 0) { ?>
            <table id="currencies-list" class="table-list" data-currencies-count=<?php echo $currencies_len; ?>>
                <thead>
                    <tr>
                        <th class="no-sort"></th>
                        <th class="no-sort"></th>
                        <th><?php echo lang('name'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->currencies as $currency) { ?>
                        <tr data-currency-id = <?php echo $currency->id; ?>>
                            <td class="action edit"><i></i><?php echo anchor('#', lang('edit'), array('class'=>'edit-data')); ?></td>
                            <td class="action delete"><i></i>
                                <?php
                                    echo anchor('file_maintenance/currency/delete/'.$currency->id, lang('delete'),
                                            array('class'=>'delete-data confirm-link',
                                                'data-dialog-confirm-message'=>lang('are_you_sure_to_delete_currency'),
                                                'data-dialog-method'=>'delete', 'data-dialog-remote'=>true, 'data-dialog-title'=>lang('delete_this_currency'),
                                                'data-dialog-type'=>'json', 'data-class'=>'archive'
                                         )); ?></td>
                            <td class="name"><?php echo $currency->name; ?></td>
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
    <div id="edit-currency-wrapper" class="hide aligned-details" data-ajax-url=<?php echo site_url("file_maintenance/currency/get_currency_edit_form/"); ?>>
        <h3>
            Edit Area Type
        </h3>
    </div>
</article>