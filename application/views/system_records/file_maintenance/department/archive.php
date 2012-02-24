<?php
    $department_len = count($this->departments);
?>
<article class="aside-left">
    <?php
        $this->load->view('common/nav/department_manager');
    ?>
</article>
<article class="primary">
    <div id="department-table-wrapper" class="aligned-table table-list-wrapper hide">
        <?php if(isset($this->departments) && !empty($this->departments)) { ?>
            <table id="department-list" class="table-list" data-department-count=<?php echo $department_len; ?>>
                <thead>
                    <tr>
                        <th class="no-sort"></th>
                        <th><?php echo lang('department_name'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->departments as $dept) { ?>
                        <tr data-deptid = <?php echo $dept->id; ?>>
                            <td class="action activate"><i></i>
                                <?php
                                    echo anchor('file_maintenance/department/restore/'.$dept->id, lang('activate'),
                                            array('class'=>'activate-data confirm-link',
                                                'data-dialog-confirm-message'=> lang('are_you_sure_to_restore_department'),
                                                'data-dialog-method'=>'PUT', 'data-dialog-remote'=>true, 'data-dialog-title'=> lang('restore_this_department'),
                                                'data-dialog-type'=>'json', 'data-class'=>'restore'
                                         )); ?></td>
                            <td><?php echo $dept->name; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p><?php echo lang('no_records_found'); ?></p>
        <?php } ?>
    </div>
</article>