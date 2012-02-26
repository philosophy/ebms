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
        <?php if (isset($this->positions) && !empty($this->positions) && $position_len > 0) { ?>
            <table id="position-list" class="table-list" data-position-count=<?php echo $position_len; ?>>
                <thead>
                    <tr>
                        <th class="no-sort"></th>
                        <th class="no-sort"></th>
                        <th><?php echo lang('name'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->positions as $position) { ?>
                        <tr data-position-id = <?php echo $position->id; ?>>
                            <td class="action edit"><i></i><?php echo anchor('#', lang('edit'), array('class'=>'edit-data')); ?></td>
                            <td class="action delete"><i></i>
                                <?php
                                    echo anchor('file_maintenance/position/delete/'.$position->id, lang('delete'),
                                            array('class'=>'delete-data confirm-link',
                                                'data-dialog-confirm-message'=>lang('are_you_sure_to_delete_position'),
                                                'data-dialog-method'=>'delete', 'data-dialog-remote'=>true, 'data-dialog-title'=>lang('delete_this_position'),
                                                'data-dialog-type'=>'json', 'data-class'=>'archive'
                                         )); ?></td>
                            <td class="name"><?php echo $position->name; ?></td>
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
    <div id="edit-position-wrapper" class="hide aligned-details" data-ajax-url=<?php echo site_url("file_maintenance/position/get_position_edit_form/"); ?>>
        <h3>
            Edit Area Type
        </h3>
    </div>
</article>