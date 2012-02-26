<?php
    $area_type_len = count($this->areaTypes);
?>

<article class="aside-left">

    <?php
        $this->load->view('common/nav/area_type_manager');
    ?>
</article>
<article class="primary">
    <div id="area-type-table-wrapper" class="aligned-table table-list-wrapper hide">
        <?php if (isset($this->areaTypes) && !empty($this->areaTypes) && $area_type_len > 0) { ?>
            <table id="area-type-list" class="table-list" data-area-type-count=<?php echo $area_type_len; ?>>
                <thead>
                    <tr>
                        <th class="no-sort"></th>
                        <th class="no-sort"></th>
                        <th><?php echo lang('name'); ?></th>
                        <th><?php echo lang('description'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->areaTypes as $areaType) { ?>
                        <tr data-area-type-id = <?php echo $areaType->id; ?>>
                            <td class="action edit"><i></i><?php echo anchor('#', lang('edit'), array('class'=>'edit-data')); ?></td>
                            <td class="action delete"><i></i>
                                <?php
                                    echo anchor('file_maintenance/area_type/delete/'.$areaType->id, lang('delete'),
                                            array('class'=>'delete-data confirm-link',
                                                'data-dialog-confirm-message'=>lang('are_you_sure_to_delete_area_type'),
                                                'data-dialog-method'=>'delete', 'data-dialog-remote'=>true, 'data-dialog-title'=>lang('delete_this_area_type'),
                                                'data-dialog-type'=>'json', 'data-class'=>'archive'
                                         )); ?></td>
                            <td class="name"><?php echo $areaType->name; ?></td>
                            <td class="description"><?php echo $areaType->description; ?></td>
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
    <div id="edit-area-type-wrapper" class="hide aligned-details" data-ajax-url=<?php echo site_url("file_maintenance/area_type/get_area_type_edit_form/"); ?>>
        <h3>
            Edit Area Type
        </h3>
    </div>
</article>