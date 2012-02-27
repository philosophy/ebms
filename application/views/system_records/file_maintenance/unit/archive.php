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
        <?php if(isset($this->units) && !empty($this->units)) { ?>
            <table id="units-list" class="table-list" data-units-count=<?php echo $units_len; ?>>
                <thead>
                    <tr>
                        <th class="no-sort"></th>
                        <th><?php echo lang('unit_name'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->units as $unit) { ?>
                        <tr data-unit-id = <?php echo $unit->id; ?>>
                            <td class="action activate"><i></i>
                                <?php
                                    echo anchor('file_maintenance/unit/restore/'.$unit->id, lang('activate'),
                                            array('class'=>'activate-data confirm-link',
                                                'data-dialog-confirm-message'=> lang('are_you_sure_to_restore_unit'),
                                                'data-dialog-method'=>'PUT', 'data-dialog-remote'=>true, 'data-dialog-title'=> lang('restore_this_unit'),
                                                'data-dialog-type'=>'json', 'data-class'=>'restore'
                                         )); ?></td>
                            <td><?php echo $unit->name; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p><?php echo lang('no_records_found'); ?></p>
        <?php } ?>
    </div>
</article>