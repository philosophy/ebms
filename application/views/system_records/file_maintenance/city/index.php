<?php
    $cities_len = count($this->cities);
?>

<article class="aside-left">

    <?php
        $data = array('list' => array('link' => 'file_maintenance/city/index', 'text' => lang('city_list')),
                      'create' => array('link' => 'file_maintenance/city/new_city', 'text' => lang('create_city')),
                      'archive' => array('link' => 'file_maintenance/city/archive', 'text' => lang('archive'))
            );
        $this->load->view('common/nav/left_nav_manager', $data);
    ?>
</article>
<article class="primary">
    <div id="cities-table-wrapper" class="aligned-table table-list-wrapper hide">
        <?php if (isset($this->cities) && !empty($this->cities) && $cities_len > 0) { ?>
            <table id="cities-list" class="table-list" data-cities-count=<?php echo $cities_len; ?>>
                <thead>
                    <tr>
                        <th class="no-sort"></th>
                        <th class="no-sort"></th>
                        <th><?php echo lang('name'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->cities as $city) { ?>
                        <tr data-city-id = <?php echo $city->id; ?>>
                            <td class="action edit"><i></i><?php echo anchor('#', lang('edit'), array('class'=>'edit-data')); ?></td>
                            <td class="action delete"><i></i>
                                <?php
                                    echo anchor('file_maintenance/city/delete/'.$city->id, lang('delete'),
                                            array('class'=>'delete-data confirm-link',
                                                'data-dialog-confirm-message'=>lang('are_you_sure_to_delete_city'),
                                                'data-dialog-method'=>'delete', 'data-dialog-remote'=>true, 'data-dialog-title'=>lang('delete_this_city'),
                                                'data-dialog-type'=>'json', 'data-class'=>'archive'
                                         )); ?></td>
                            <td class="name"><?php echo $city->name; ?></td>
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
    <div id="edit-city-wrapper" class="hide aligned-details" data-ajax-url=<?php echo site_url("file_maintenance/city/get_city_edit_form/"); ?>>
        <h3>
            Edit Area Type
        </h3>
    </div>
</article>