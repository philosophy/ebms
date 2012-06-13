<article class="aside-left">
    <?php $this->load->view('system_records/file_maintenance/leaves/_side_nav'); ?>
</article>
<article class="primary">
    <div id="leave-table-wrapper" class="aligned-table table-list-wrapper hide">
        <?php if(isset($this->leaves_list) && !empty($this->leaves_list)) { ?>
            <table id="employee-leaves-list" class="table-list" data-leaves-count=<?php echo count($this->leaves_list); ?>>
                <thead>
                    <tr>
                        <th class="no-sort"></th>
                        <th><?php echo lang('leave_name'); ?></th>
                        <th><?php echo lang('maximum_days'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->leaves_list as $leave) { ?>
                        <tr data-leave-id = <?php echo $leave->id; ?>>
                            <td class="action activate"><i></i>
                                <?php
                                    echo anchor('file_maintenance/leaves/restore/'.$leave->id, lang('activate'),
                                            array('class'=>'activate-data confirm-link',
                                                'data-dialog-confirm-message'=> lang('are_you_sure_to_restore_leave'),
                                                'data-dialog-method'=>'PUT', 'data-dialog-remote'=>true, 'data-dialog-title'=> lang('restore_this_leave'),
                                                'data-dialog-type'=>'json', 'data-class'=>'restore'
                                         )); ?></td>
                            <td><?php echo $leave->name; ?></td>
                            <td><?php echo $leave->days; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else {
            $this->load->view('common/_no_records_found');
        } ?>
    </div>
</article>