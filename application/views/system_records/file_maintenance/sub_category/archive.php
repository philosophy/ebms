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
        <?php if(isset($this->sub_categories) && !empty($this->sub_categories)) { ?>
            <table id="sub-categories-list" class="table-list" data-sub-categories-count=<?php echo $sub_categories_len; ?>>
                <thead>
                    <tr>
                        <th class="no-sort"></th>
                        <th><?php echo lang('code'); ?></th>
                        <th><?php echo lang('sub_category_name'); ?></th>
                        <th><?php echo lang('category_name'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->sub_categories as $subCategory) { ?>
                        <tr data-sub-category-id = <?php echo $subCategory->id; ?>>
                            <td class="action activate"><i></i>
                                <?php
                                    echo anchor('file_maintenance/sub_category/restore/'.$subCategory->id, lang('activate'),
                                            array('class'=>'activate-data confirm-link',
                                                'data-dialog-confirm-message'=> lang('are_you_sure_to_restore_sub_category'),
                                                'data-dialog-method'=>'PUT', 'data-dialog-remote'=>true, 'data-dialog-title'=> lang('restore_this_sub_category'),
                                                'data-dialog-type'=>'json', 'data-class'=>'restore'
                                         )); ?></td>
                            <td><?php echo $subCategory->code; ?></td>
                            <td><?php echo $subCategory->name; ?></td>
                            <td><?php echo $subCategory->category; ?></td>
                        </tr>
                        
                    <?php } ?>
                </tbody>                
            </table>
        <?php } else { ?>
            <p><?php echo lang('no_records_found'); ?></p>
        <?php } ?>
    </div>
</article>