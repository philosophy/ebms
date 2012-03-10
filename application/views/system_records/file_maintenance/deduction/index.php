<?php
    $deductions_len = count($this->deductions);
?>

<article class="aside-left">

    <?php
        $data = array('list' => array('link' => 'file_maintenance/deduction/index', 'text' => lang('deduction_list')),
                      'create' => array('link' => 'file_maintenance/deduction/new_deduction', 'text' => lang('create_deduction')),
                      'archive' => array('link' => 'file_maintenance/deduction/archive', 'text' => lang('archive'))
            );
        $this->load->view('common/nav/left_nav_manager', $data);
    ?>
</article>
<article class="primary">
    <div id="deductions-table-wrapper" class="aligned-table table-list-wrapper hide">
        <?php if (isset($this->deductions) && !empty($this->deductions) && $deductions_len > 0) { ?>
            <table id="deductions-list" class="table-list" data-deductions-count=<?php echo $deductions_len; ?>>
                <thead>
                    <tr>
                        <th class="no-sort"></th>
                        <th class="no-sort"></th>
                        <th><?php echo lang('name'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->deductions as $deduction) { ?>
                        <tr data-deduction-id = <?php echo $deduction->id; ?>>
                            <td class="action edit"><i></i><?php echo anchor('#', lang('edit'), array('class'=>'edit-data')); ?></td>
                            <td class="action delete"><i></i>
                                <?php
                                    echo anchor('file_maintenance/deduction/delete/'.$deduction->id, lang('delete'),
                                            array('class'=>'delete-data confirm-link',
                                                'data-dialog-confirm-message'=>lang('are_you_sure_to_delete_deduction'),
                                                'data-dialog-method'=>'delete', 'data-dialog-remote'=>true, 'data-dialog-title'=>lang('delete_this_deduction'),
                                                'data-dialog-type'=>'json', 'data-class'=>'archive'
                                         )); ?></td>
                            <td class="name"><?php echo $deduction->name; ?></td>
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
    <div id="edit-deduction-wrapper" class="hide aligned-details" data-ajax-url=<?php echo site_url("file_maintenance/deduction/get_deduction_edit_form/"); ?>>
        <h3>
            Edit Area Type
        </h3>
    </div>
</article>