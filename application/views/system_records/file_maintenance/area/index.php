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
        <?php if (isset($this->areas) && !empty($this->areas) && $areas_len > 0) { ?>
            <table id="areas-list" class="table-list" data-areas-count=<?php echo $areas_len; ?>>
                <thead>
                    <tr>
                        <th class="no-sort"></th>
                        <th class="no-sort"></th>
                        <th><?php echo lang('name'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->areas as $area) { ?>
                        <tr data-area-id = <?php echo $area->id; ?>>
                            <td class="action edit"><i></i><?php echo anchor('#', lang('edit'), array('class'=>'edit-data')); ?></td>
                            <td class="action delete"><i></i>
                                <?php
                                    echo anchor('file_maintenance/area/delete/'.$area->id, lang('delete'),
                                            array('class'=>'delete-data confirm-link',
                                                'data-dialog-confirm-message'=>lang('are_you_sure_to_delete_area'),
                                                'data-dialog-method'=>'delete', 'data-dialog-remote'=>true, 'data-dialog-title'=>lang('delete_this_area'),
                                                'data-dialog-type'=>'json', 'data-class'=>'archive'
                                         )); ?></td>
                            <td class="name"><?php echo $area->name; ?></td>
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
    <div id="edit-area-wrapper" class="hide aligned-details" data-ajax-url=<?php echo site_url("file_maintenance/area/get_area_edit_form/"); ?>>
        <h3>
            Edit Area Type
        </h3>
    </div>
</article>