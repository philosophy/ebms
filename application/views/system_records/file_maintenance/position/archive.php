<?php
    $position_len = count($this->positions);
?>
<article class="aside-left">
    <?php
        $this->load->view('common/nav/position_manager');
    ?>
</article>
<article class="primary">
    <div id="position-table-wrapper" class="aligned-table table-list-wrapper hide">
        <?php if(isset($this->positions) && !empty($this->positions)) { ?>
            <table id="position-list" class="table-list" data-position-count=<?php echo $position_len; ?>>
                <thead>
                    <tr>
                        <th class="no-sort"></th>
                        <th><?php echo lang('position_name'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->positions as $position) { ?>
                        <tr data-position-id = <?php echo $position->id; ?>>
                            <td class="action activate"><i></i>
                                <?php
                                    echo anchor('file_maintenance/position/restore/'.$position->id, lang('activate'),
                                            array('class'=>'activate-data confirm-link',
                                                'data-dialog-confirm-message'=> lang('are_you_sure_to_restore_position'),
                                                'data-dialog-method'=>'PUT', 'data-dialog-remote'=>true, 'data-dialog-title'=> lang('restore_this_position'),
                                                'data-dialog-type'=>'json', 'data-class'=>'restore'
                                         )); ?></td>
                            <td><?php echo $position->name; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p><?php echo lang('no_records_found'); ?></p>
        <?php } ?>
    </div>
</article>