<?php
    $industries_len = count($this->industries);
?>

<article class="aside-left">

    <?php
        $data = array('list' => array('link' => 'file_maintenance/industry/index', 'text' => lang('industry_list')),
                      'create' => array('link' => 'file_maintenance/industry/new_industry', 'text' => lang('create_industry')),
                      'archive' => array('link' => 'file_maintenance/industry/archive', 'text' => lang('archive'))
            );
        $this->load->view('common/nav/left_nav_manager', $data);
    ?>
</article>
<article class="primary">
    <div id="industries-table-wrapper" class="aligned-table table-list-wrapper hide">
        <?php if (isset($this->industries) && !empty($this->industries) && $industries_len > 0) { ?>
            <table id="industries-list" class="table-list" data-industries-count=<?php echo $industries_len; ?>>
                <thead>
                    <tr>
                        <th class="no-sort"></th>
                        <th class="no-sort"></th>
                        <th><?php echo lang('name'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->industries as $industry) { ?>
                        <tr data-industry-id = <?php echo $industry->id; ?>>
                            <td class="action edit"><i></i><?php echo anchor('#', lang('edit'), array('class'=>'edit-data')); ?></td>
                            <td class="action delete"><i></i>
                                <?php
                                    echo anchor('file_maintenance/industry/delete/'.$industry->id, lang('delete'),
                                            array('class'=>'delete-data confirm-link',
                                                'data-dialog-confirm-message'=>lang('are_you_sure_to_delete_industry'),
                                                'data-dialog-method'=>'delete', 'data-dialog-remote'=>true, 'data-dialog-title'=>lang('delete_this_industry'),
                                                'data-dialog-type'=>'json', 'data-class'=>'archive'
                                         )); ?></td>
                            <td class="name"><?php echo $industry->name; ?></td>
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
    <div id="edit-industry-wrapper" class="hide aligned-details" data-ajax-url=<?php echo site_url("file_maintenance/industry/get_industry_edit_form/"); ?>>
        <h3>
            Edit Area Type
        </h3>
    </div>
</article>