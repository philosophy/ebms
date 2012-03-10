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
        <?php if(isset($this->deductions) && !empty($this->deductions)) { ?>
            <table id="deductions-list" class="table-list" data-deductions-count=<?php echo $deductions_len; ?>>
                <thead>
                    <tr>
                        <th class="no-sort"></th>
                        <th><?php echo lang('deduction_name'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->deductions as $deduction) { ?>
                        <tr data-deduction-id = <?php echo $deduction->id; ?>>
                            <td class="action activate"><i></i>
                                <?php
                                    echo anchor('file_maintenance/deduction/restore/'.$deduction->id, lang('activate'),
                                            array('class'=>'activate-data confirm-link',
                                                'data-dialog-confirm-message'=> lang('are_you_sure_to_restore_deduction'),
                                                'data-dialog-method'=>'PUT', 'data-dialog-remote'=>true, 'data-dialog-title'=> lang('restore_this_deduction'),
                                                'data-dialog-type'=>'json', 'data-class'=>'restore'
                                         )); ?></td>
                            <td><?php echo $deduction->name; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p><?php echo lang('no_records_found'); ?></p>
        <?php } ?>
    </div>
</article>