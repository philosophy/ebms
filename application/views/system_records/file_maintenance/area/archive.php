<?php
    $areas_len = count($this->areas);
?>
<article class="aside-left">
    <?php
        $data = array('list' => array('link' => 'file_maintenance/area/index', 'text' => lang('area_list')),
                      'create' => array('link' => 'file_maintenance/area/new_area', 'text' => lang('create_area')),
                      'archive' => array('link' => 'file_maintenance/area/archive', 'text' => lang('archive'))
            );
        $this->load->view('common/nav/left_nav_manager', $data);
    ?>
</article>
<article class="primary">
    <div id="areas-table-wrapper" class="aligned-table table-list-wrapper hide">
        <?php if(isset($this->areas) && !empty($this->areas)) { ?>
            <table id="areas-list" class="table-list" data-areas-count=<?php echo $areas_len; ?>>
                <thead>
                    <tr>
                        <th class="no-sort"></th>
                        <th><?php echo lang('area_name'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->areas as $area) { ?>
                        <tr data-area-id = <?php echo $area->id; ?>>
                            <td class="action activate"><i></i>
                                <?php
                                    echo anchor('file_maintenance/area/restore/'.$area->id, lang('activate'),
                                            array('class'=>'activate-data confirm-link',
                                                'data-dialog-confirm-message'=> lang('are_you_sure_to_restore_area'),
                                                'data-dialog-method'=>'PUT', 'data-dialog-remote'=>true, 'data-dialog-title'=> lang('restore_this_area'),
                                                'data-dialog-type'=>'json', 'data-class'=>'restore'
                                         )); ?></td>
                            <td><?php echo $area->name; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p><?php echo lang('no_records_found'); ?></p>
        <?php } ?>
    </div>
</article>