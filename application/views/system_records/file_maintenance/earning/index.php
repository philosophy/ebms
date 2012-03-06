<?php
    $earnings_len = count($this->earnings);
?>

<article class="aside-left">

    <?php
        $data = array('list' => array('link' => 'file_maintenance/earning/index', 'text' => lang('earning_list')),
                      'create' => array('link' => 'file_maintenance/earning/new_earning', 'text' => lang('create_earning')),
                      'archive' => array('link' => 'file_maintenance/earning/archive', 'text' => lang('archive'))
            );
        $this->load->view('common/nav/left_nav_manager', $data);
    ?>
</article>
<article class="primary">
    <div id="earnings-table-wrapper" class="aligned-table table-list-wrapper hide">
        <?php if (isset($this->earnings) && !empty($this->earnings) && $earnings_len > 0) { ?>
            <table id="earnings-list" class="table-list" data-earnings-count=<?php echo $earnings_len; ?>>
                <thead>
                    <tr>
                        <th class="no-sort"></th>
                        <th class="no-sort"></th>
                        <th><?php echo lang('name'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->earnings as $earning) { ?>
                        <tr data-earning-id = <?php echo $earning->id; ?>>
                            <td class="action edit"><i></i><?php echo anchor('#', lang('edit'), array('class'=>'edit-data')); ?></td>
                            <td class="action delete"><i></i>
                                <?php
                                    echo anchor('file_maintenance/earning/delete/'.$earning->id, lang('delete'),
                                            array('class'=>'delete-data confirm-link',
                                                'data-dialog-confirm-message'=>lang('are_you_sure_to_delete_earning'),
                                                'data-dialog-method'=>'delete', 'data-dialog-remote'=>true, 'data-dialog-title'=>lang('delete_this_earning'),
                                                'data-dialog-type'=>'json', 'data-class'=>'archive'
                                         )); ?></td>
                            <td class="name"><?php echo $earning->name; ?></td>
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
    <div id="edit-earning-wrapper" class="hide aligned-details" data-ajax-url=<?php echo site_url("file_maintenance/earning/get_earning_edit_form/"); ?>>
        <h3>
            Edit Area Type
        </h3>
    </div>
</article>