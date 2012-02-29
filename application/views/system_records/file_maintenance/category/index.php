<?php
    $categories_len = count($this->categories);
?>

<article class="aside-left">

    <?php
        $data = array('list' => array('link' => 'file_maintenance/category/index', 'text' => lang('category_list')),
                      'create' => array('link' => 'file_maintenance/category/new_category', 'text' => lang('create_category')),
                      'archive' => array('link' => 'file_maintenance/category/archive', 'text' => lang('archive'))
            );
        $this->load->view('common/nav/left_nav_manager', $data);
    ?>
</article>
<article class="primary">
    <div id="categories-table-wrapper" class="aligned-table table-list-wrapper hide">
        <?php if (isset($this->categories) && !empty($this->categories) && $categories_len > 0) { ?>
            <table id="categories-list" class="table-list" data-categories-count=<?php echo $categories_len; ?>>
                <thead>
                    <tr>
                        <th class="no-sort"></th>
                        <th class="no-sort"></th>
                        <th><?php echo lang('code'); ?></th>
                        <th><?php echo lang('name'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->categories as $category) { ?>
                        <tr data-category-id = <?php echo $category->id; ?>>
                            <td class="action edit"><i></i><?php echo anchor('#', lang('edit'), array('class'=>'edit-data')); ?></td>
                            <td class="action delete"><i></i>
                                <?php
                                    echo anchor('file_maintenance/category/delete/'.$category->id, lang('delete'),
                                            array('class'=>'delete-data confirm-link',
                                                'data-dialog-confirm-message'=>lang('are_you_sure_to_delete_category'),
                                                'data-dialog-method'=>'delete', 'data-dialog-remote'=>true, 'data-dialog-title'=>lang('delete_this_category'),
                                                'data-dialog-type'=>'json', 'data-class'=>'archive'
                                         )); ?></td>
                            <td class="code"><?php echo $category->code; ?></td>
                            <td class="name"><?php echo $category->name; ?></td>
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
    <div id="edit-category-wrapper" class="hide aligned-details" data-ajax-url=<?php echo site_url("file_maintenance/category/get_category_edit_form/"); ?>>
        <h3>
            Edit Area Type
        </h3>
    </div>
</article>