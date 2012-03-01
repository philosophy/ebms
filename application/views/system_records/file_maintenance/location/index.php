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
        <?php if (isset($this->locations) && !empty($this->locations) && $locations_len > 0) { ?>
            <table id="locations-list" class="table-list" data-locations-count=<?php echo $locations_len; ?>>
                <thead>
                    <tr>
                        <th class="no-sort"></th>
                        <th class="no-sort"></th>
                        <th><?php echo lang('name'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->locations as $location) { ?>
                        <tr data-location-id = <?php echo $location->id; ?>>
                            <td class="action edit"><i></i><?php echo anchor('#', lang('edit'), array('class'=>'edit-data')); ?></td>
                            <td class="action delete"><i></i>
                                <?php
                                    echo anchor('file_maintenance/location/delete/'.$location->id, lang('delete'),
                                            array('class'=>'delete-data confirm-link',
                                                'data-dialog-confirm-message'=>lang('are_you_sure_to_delete_location'),
                                                'data-dialog-method'=>'delete', 'data-dialog-remote'=>true, 'data-dialog-title'=>lang('delete_this_location'),
                                                'data-dialog-type'=>'json', 'data-class'=>'archive'
                                         )); ?></td>
                            <td class="name"><?php echo $location->name; ?></td>
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
    <div id="edit-location-wrapper" class="hide aligned-details" data-ajax-url=<?php echo site_url("file_maintenance/location/get_location_edit_form/"); ?>>
        <h3>
            Edit Area Type
        </h3>
    </div>
</article>