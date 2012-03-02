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
    <div id="brands-table-wrapper" class="aligned-table table-list-wrapper hide">
        <?php if (isset($this->brands) && !empty($this->brands) && $brands_len > 0) { ?>
            <table id="brands-list" class="table-list" data-brands-count=<?php echo $brands_len; ?>>
                <thead>
                    <tr>
                        <th class="no-sort"></th>
                        <th class="no-sort"></th>
                        <th><?php echo lang('brand'); ?></th>
                        <th><?php echo lang('sub_category'); ?></th>
                        <th><?php echo lang('category'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->brands as $brand) { ?>
                        <tr data-brand-id = <?php echo $brand->id; ?>>
                            <td class="action edit"><i></i><?php echo anchor('#', lang('edit'), array('class'=>'edit-data')); ?></td>
                            <td class="action delete"><i></i>
                                <?php
                                    echo anchor('file_maintenance/brand/delete/'.$brand->id, lang('delete'),
                                            array('class'=>'delete-data confirm-link',
                                                'data-dialog-confirm-message'=>lang('are_you_sure_to_delete_brand'),
                                                'data-dialog-method'=>'delete', 'data-dialog-remote'=>true, 'data-dialog-title'=>lang('delete_this_brand'),
                                                'data-dialog-type'=>'json', 'data-class'=>'archive'
                                         )); ?></td>
                            <td class="name"><?php echo $brand->name; ?></td>
                            <td class="sub_category"><?php echo $brand->sub_category; ?></td>
                            <td class="category"><?php echo $brand->category; ?></td>
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
    <div id="edit-brand-wrapper" class="hide aligned-details" data-ajax-url=<?php echo site_url("file_maintenance/brand/get_brand_edit_form/"); ?>>
        <h3>
            Edit Brand
        </h3>
    </div>
</article>

<script>
    var sub_categories = <?php echo json_encode($this->sub_categories); ?>
</script>