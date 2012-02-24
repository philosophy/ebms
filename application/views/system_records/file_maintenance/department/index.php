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
        <?php if (isset($this->departments) && !empty($this->departments) && $department_len > 0) { ?>
            <table id="department-list" class="table-list" data-department-count=<?php echo $department_len; ?>>
                <thead>
                    <tr>
                        <th class="no-sort"></th>
                        <th class="no-sort"></th>
                        <th>Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->departments as $dept) { ?>
                        <tr data-deptid = <?php echo $dept->id; ?>>
                            <td class="action edit"><i></i><?php echo anchor('#', lang('edit'), array('class'=>'edit-data')); ?></td>
                            <td class="action delete"><i></i>
                                <?php
                                    echo anchor('file_maintenance/department/delete/'.$dept->id, lang('delete'),
                                            array('class'=>'delete-data confirm-link',
                                                'data-dialog-confirm-message'=>'Are you sure you want to delete this user?',
                                                'data-dialog-method'=>'delete', 'data-dialog-remote'=>true, 'data-dialog-title'=>'Delete this user',
                                                'data-dialog-type'=>'json', 'data-class'=>'archive'
                                         )); ?></td>
                            <td class="name"><?php echo $dept->name; ?></td>
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
    <div id="edit-department-wrapper" class="hide aligned-details" data-ajax-url=<?php echo site_url("file_maintenance/department/get_deptedit_form/"); ?>>
        <h3>
            Edit User
        </h3>
    </div>
</article>