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
        <?php if(isset($this->categories) && !empty($this->categories)) { ?>
            <table id="categories-list" class="table-list" data-categories-count=<?php echo $categories_len; ?>>
                <thead>
                    <tr>
                        <th class="no-sort"></th>
                        <th><?php echo lang('code'); ?></th>
                        <th><?php echo lang('category_name'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->categories as $category) { ?>
                        <tr data-category-id = <?php echo $category->id; ?>>
                            <td class="action activate"><i></i>
                                <?php
                                    echo anchor('file_maintenance/category/restore/'.$category->id, lang('activate'),
                                            array('class'=>'activate-data confirm-link',
                                                'data-dialog-confirm-message'=> lang('are_you_sure_to_restore_category'),
                                                'data-dialog-method'=>'PUT', 'data-dialog-remote'=>true, 'data-dialog-title'=> lang('restore_this_category'),
                                                'data-dialog-type'=>'json', 'data-class'=>'restore'
                                         )); ?></td>
                            <td><?php echo $category->code; ?></td>
                            <td><?php echo $category->name; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p><?php echo lang('no_records_found'); ?></p>
        <?php } ?>
    </div>
</article>