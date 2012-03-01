<?php
    $sub_categories_len = count($this->sub_categories);
?>

<article class="aside-left">

    <?php
        $data = array('list' => array('link' => 'file_maintenance/sub_category/index', 'text' => lang('sub_category_list')),
                      'create' => array('link' => 'file_maintenance/sub_category/new_sub_category', 'text' => lang('create_sub_category')),
                      'archive' => array('link' => 'file_maintenance/sub_category/archive', 'text' => lang('archive'))
            );
        $this->load->view('common/nav/left_nav_manager', $data);
    ?>
</article>
<article class="primary">
    <div id="sub-categories-table-wrapper" class="aligned-table table-list-wrapper hide">
        <?php if (isset($this->sub_categories) && !empty($this->sub_categories) && $sub_categories_len > 0) { ?>
            <table id="sub-categories-list" class="table-list" data-sub-categories-count=<?php echo $sub_categories_len; ?>>
                <thead>
                    <tr>
                        <th class="no-sort"></th>
                        <th class="no-sort"></th>
                        <th><?php echo lang('code'); ?></th>
                        <th><?php echo lang('sub_category'); ?></th>
                        <th><?php echo lang('category'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->sub_categories as $sub_category) { ?>
                        <tr data-sub-category-id = <?php echo $sub_category->id; ?>>
                            <td class="action edit"><i></i><?php echo anchor('#', lang('edit'), array('class'=>'edit-data')); ?></td>
                            <td class="action delete"><i></i>
                                <?php
                                    echo anchor('file_maintenance/sub_category/delete/'.$sub_category->id, lang('delete'),
                                            array('class'=>'delete-data confirm-link',
                                                'data-dialog-confirm-message'=>lang('are_you_sure_to_delete_sub_category'),
                                                'data-dialog-method'=>'delete', 'data-dialog-remote'=>true, 'data-dialog-title'=>lang('delete_this_sub_category'),
                                                'data-dialog-type'=>'json', 'data-class'=>'archive'
                                         )); ?></td>
                            <td class="code"><?php echo $sub_category->code; ?></td>
                            <td class="name"><?php echo $sub_category->name; ?></td>
                            <td class="category"><?php echo $sub_category->category; ?></td>
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
    <div id="edit-sub-category-wrapper" class="hide aligned-details" data-ajax-url=<?php echo site_url("file_maintenance/sub_category/get_sub_category_edit_form/"); ?>>
        <h3>
            Edit Area Type
        </h3>
    </div>
</article>