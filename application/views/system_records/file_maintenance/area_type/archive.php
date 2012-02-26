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
        <?php if(isset($this->areaTypes) && !empty($this->areaTypes)) { ?>
            <table id="area-type-list" class="table-list" data-area-type-count=<?php echo $area_type_len; ?>>
                <thead>
                    <tr>
                        <th class="no-sort"></th>
                        <th><?php echo lang('area_type_name'); ?></th>
                        <th><?php echo lang('description'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->areaTypes as $areaType) { ?>
                        <tr data-area-type-id = <?php echo $areaType->id; ?>>
                            <td class="action activate"><i></i>
                                <?php
                                    echo anchor('file_maintenance/area_type/restore/'.$areaType->id, lang('activate'),
                                            array('class'=>'activate-data confirm-link',
                                                'data-dialog-confirm-message'=> lang('are_you_sure_to_restore_area_type'),
                                                'data-dialog-method'=>'PUT', 'data-dialog-remote'=>true, 'data-dialog-title'=> lang('restore_this_area_type'),
                                                'data-dialog-type'=>'json', 'data-class'=>'restore'
                                         )); ?></td>
                            <td><?php echo $areaType->name; ?></td>
                            <td><?php echo $areaType->description; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p><?php echo lang('no_records_found'); ?></p>
        <?php } ?>
    </div>
</article>