<article class="aside-left">
    <?php $this->load->view('system_records/file_maintenance/leaves/_side_nav'); ?>
</article>

<article class="primary">
    <div id="leaves-table-wrapper" class="aligned-table table-list-wrapper hide">
        <?php if (isset($this->leaves_list) && !empty($this->leaves_list) && count($this->leaves_list) > 0) { ?>
            <table id="employee-leaves-list" class="table-list" data-employee-status-count=<?php echo count($this->leaves_list); ?>>
                <thead>
                    <tr>
                        <th class="no-sort"></th>
                        <th class="no-sort"></th>
                        <th><?php echo lang('name'); ?></th>
                        <th><?php echo lang('maximum_days'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->leaves_list as $leave) { ?>
                        <tr data-leave-id = <?php echo $leave->id; ?>>
                            <td class="action edit"><i></i><?php echo anchor('#', lang('edit'), array('class'=>'edit-data')); ?></td>
                            <td class="action delete"><i></i>
                                <?php
                                    echo anchor('file_maintenance/leaves/delete/'.$leave->id, lang('delete'),
                                            array('class'=>'delete-data confirm-link',
                                                'data-dialog-confirm-message'=>lang('are_you_sure_to_delete_leave'),
                                                'data-dialog-method'=>'delete', 'data-dialog-remote'=>true, 'data-dialog-title'=>lang('delete_this_leave'),
                                                'data-dialog-type'=>'json', 'data-class'=>'archive'
                                         )); ?></td>
                            <td class="name"><?php echo $leave->name; ?></td>
                            <td class="days"><?php echo $leave->days; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else {
            $this->load->view('common/_no_records_found');
        } ?>
    </div>
    <div class="loader loader-container hide">
    </div>
    <div id="edit-leave-wrapper" class="hide aligned-details" data-ajax-url=<?php echo site_url("file_maintenance/leaves/get_leave_edit_form/"); ?>>
        <h3>
            Edit Area Type
        </h3>
    </div>
</article>