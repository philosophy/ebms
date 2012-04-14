<?php
    $brands_len = count($this->brands);
?>
<article class="aside-left">
    <?php
        $data = array('list' => array('link' => 'file_maintenance/brand/index', 'text' => lang('brand_list')),
                      'create' => array('link' => 'file_maintenance/brand/new_brand', 'text' => lang('create_brand')),
                      'archive' => array('link' => 'file_maintenance/brand/archive', 'text' => lang('archive'))
            );
        $this->load->view('common/nav/left_nav_manager', $data);
    ?>
</article>
<article class="primary">
    <div id="brand-table-wrapper" class="aligned-table table-list-wrapper hide">
        <?php if(isset($this->brands) && !empty($this->brands)) { ?>
            <table id="brands-list" class="table-list" data-brands-count=<?php echo $brands_len; ?>>
                <thead>
                    <tr>
                        <th class="no-sort"></th>
                        <th><?php echo lang('brand'); ?></th>
                        <th><?php echo lang('sub_category'); ?></th>
                        <th><?php echo lang('category'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->brands as $brand) { ?>
                        <tr data-brand-id = <?php echo $brand->id; ?>>
                            <td class="action activate"><i></i>
                                <?php
                                    echo anchor('file_maintenance/brand/restore/'.$brand->id, lang('activate'),
                                            array('class'=>'activate-data confirm-link',
                                                'data-dialog-confirm-message'=> lang('are_you_sure_to_restore_brand'),
                                                'data-dialog-method'=>'PUT', 'data-dialog-remote'=>true, 'data-dialog-title'=> lang('restore_this_brand'),
                                                'data-dialog-type'=>'json', 'data-class'=>'restore'
                                         )); ?></td>
                            <td><?php echo $brand->name; ?></td>
                            <td><?php echo $brand->sub_category; ?></td>
                            <td><?php echo $brand->category; ?></td>
                        </tr>

                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p><?php echo lang('no_records_found'); ?></p>
        <?php } ?>
    </div>
</article>