<?php
    $units_len = count($this->units);
?>

<article class="aside-left">

    <?php
        $data = array('list' => array('link' => 'file_maintenance/unit/index', 'text' => lang('unit_list')),
                      'create' => array('link' => 'file_maintenance/unit/new_unit', 'text' => lang('create_unit')),
                      'archive' => array('link' => 'file_maintenance/unit/archive', 'text' => lang('archive'))
            );
        $this->load->view('common/nav/left_nav_manager', $data);
    ?>
</article>
<article class="primary">
    <div id="units-table-wrapper" class="aligned-table table-list-wrapper hide">
        <?php if (isset($this->units) && !empty($this->units) && $units_len > 0) { ?>
            <table id="units-list" class="table-list" data-units-count=<?php echo $units_len; ?>>
                <thead>
                    <tr>
                        <th class="no-sort"></th>
                        <th class="no-sort"></th>
                        <th><?php echo lang('name'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->units as $unit) { ?>
                        <tr data-unit-id = <?php echo $unit->id; ?>>
                            <td class="action edit"><i></i><?php echo anchor('#', lang('edit'), array('class'=>'edit-data')); ?></td>
                            <td class="action delete"><i></i>
                                <?php
                                    echo anchor('file_maintenance/unit/delete/'.$unit->id, lang('delete'),
                                            array('class'=>'delete-data confirm-link',
                                                'data-dialog-confirm-message'=>lang('are_you_sure_to_delete_unit'),
                                                'data-dialog-method'=>'delete', 'data-dialog-remote'=>true, 'data-dialog-title'=>lang('delete_this_unit'),
                                                'data-dialog-type'=>'json', 'data-class'=>'archive'
                                         )); ?></td>
                            <td class="name"><?php echo $unit->name; ?></td>
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
    <div id="edit-unit-wrapper" class="hide aligned-details" data-ajax-url=<?php echo site_url("file_maintenance/unit/get_unit_edit_form/"); ?>>
        <h3>
            Edit Area Type
        </h3>
    </div>
</article>