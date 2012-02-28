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
        <?php if(isset($this->cities) && !empty($this->cities)) { ?>
            <table id="cities-list" class="table-list" data-cities-count=<?php echo $cities_len; ?>>
                <thead>
                    <tr>
                        <th class="no-sort"></th>
                        <th><?php echo lang('city_name'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->cities as $city) { ?>
                        <tr data-city-id = <?php echo $city->id; ?>>
                            <td class="action activate"><i></i>
                                <?php
                                    echo anchor('file_maintenance/city/restore/'.$city->id, lang('activate'),
                                            array('class'=>'activate-data confirm-link',
                                                'data-dialog-confirm-message'=> lang('are_you_sure_to_restore_city'),
                                                'data-dialog-method'=>'PUT', 'data-dialog-remote'=>true, 'data-dialog-title'=> lang('restore_this_city'),
                                                'data-dialog-type'=>'json', 'data-class'=>'restore'
                                         )); ?></td>
                            <td><?php echo $city->name; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p><?php echo lang('no_records_found'); ?></p>
        <?php } ?>
    </div>
</article>