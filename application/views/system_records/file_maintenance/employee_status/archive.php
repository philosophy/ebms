<?php
    $employee_status_len = count($this->employeeStatus);
?>
<article class="aside-left">
    <?php
        $this->load->view('common/nav/employee_status_manager');
    ?>
</article>
<article class="primary">
    <div id="employee-status-table-wrapper" class="aligned-table table-list-wrapper hide">
        <?php if(isset($this->employeeStatus) && !empty($this->employeeStatus)) { ?>
            <table id="employee-status-list" class="table-list" data-employee-status-count=<?php echo $employee_status_len; ?>>
                <thead>
                    <tr>
                        <th class="no-sort"></th>
                        <th><?php echo lang('employee_status_name'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->employeeStatus as $employeeStatus) { ?>
                        <tr data-employee-status-id = <?php echo $employeeStatus->id; ?>>
                            <td class="action activate"><i></i>
                                <?php
                                    echo anchor('file_maintenance/employee_status/restore/'.$employeeStatus->id, lang('activate'),
                                            array('class'=>'activate-data confirm-link',
                                                'data-dialog-confirm-message'=> lang('are_you_sure_to_restore_employee_status'),
                                                'data-dialog-method'=>'PUT', 'data-dialog-remote'=>true, 'data-dialog-title'=> lang('restore_this_employee_status'),
                                                'data-dialog-type'=>'json', 'data-class'=>'restore'
                                         )); ?></td>
                            <td><?php echo $employeeStatus->name; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p><?php echo lang('no_records_found'); ?></p>
        <?php } ?>
    </div>
</article>