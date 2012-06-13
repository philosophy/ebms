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
        <?php if (isset($this->employeeStatus) && !empty($this->employeeStatus) && $employee_status_len > 0) { ?>
            <table id="employee-status-list" class="table-list" data-employee-status-count=<?php echo $employee_status_len; ?>>
                <thead>
                    <tr>
                        <th class="no-sort"></th>
                        <th class="no-sort"></th>
                        <th><?php echo lang('name'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->employeeStatus as $status) { ?>
                        <tr data-employee-status-id = <?php echo $status->id; ?>>
                            <td class="action edit"><i></i><?php echo anchor('#', lang('edit'), array('class'=>'edit-data')); ?></td>
                            <td class="action delete"><i></i>
                                <?php
                                    echo anchor('file_maintenance/employee_status/delete/'.$status->id, lang('delete'),
                                            array('class'=>'delete-data confirm-link',
                                                'data-dialog-confirm-message'=>lang('are_you_sure_to_delete_employee_status'),
                                                'data-dialog-method'=>'delete', 'data-dialog-remote'=>true, 'data-dialog-title'=>lang('delete_this_employee_status'),
                                                'data-dialog-type'=>'json', 'data-class'=>'archive'
                                         )); ?></td>
                            <td class="name"><?php echo $status->name; ?></td>
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
    <div id="edit-employee-status-wrapper" class="hide aligned-details" data-ajax-url=<?php echo site_url("file_maintenance/employee_status/get_employee_status_edit_form/"); ?>>
        <h3>
            Edit Employee Status
        </h3>
    </div>
</article>