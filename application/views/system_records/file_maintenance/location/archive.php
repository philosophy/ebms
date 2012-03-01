<?php
    $locations_len = count($this->locations);
?>
<article class="aside-left">
    <?php
        $data = array('list' => array('link' => 'file_maintenance/location/index', 'text' => lang('location_list')),
                      'create' => array('link' => 'file_maintenance/location/new_location', 'text' => lang('create_location')),
                      'archive' => array('link' => 'file_maintenance/location/archive', 'text' => lang('archive'))
            );
        $this->load->view('common/nav/left_nav_manager', $data);
    ?>
</article>
<article class="primary">
    <div id="locations-table-wrapper" class="aligned-table table-list-wrapper hide">
        <?php if(isset($this->locations) && !empty($this->locations)) { ?>
            <table id="locations-list" class="table-list" data-locations-count=<?php echo $locations_len; ?>>
                <thead>
                    <tr>
                        <th class="no-sort"></th>
                        <th><?php echo lang('location_name'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->locations as $location) { ?>
                        <tr data-location-id = <?php echo $location->id; ?>>
                            <td class="action activate"><i></i>
                                <?php
                                    echo anchor('file_maintenance/location/restore/'.$location->id, lang('activate'),
                                            array('class'=>'activate-data confirm-link',
                                                'data-dialog-confirm-message'=> lang('are_you_sure_to_restore_location'),
                                                'data-dialog-method'=>'PUT', 'data-dialog-remote'=>true, 'data-dialog-title'=> lang('restore_this_location'),
                                                'data-dialog-type'=>'json', 'data-class'=>'restore'
                                         )); ?></td>
                            <td><?php echo $location->name; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p><?php echo lang('no_records_found'); ?></p>
        <?php } ?>
    </div>
</article>