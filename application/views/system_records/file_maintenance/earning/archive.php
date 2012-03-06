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
        <?php if(isset($this->earnings) && !empty($this->earnings)) { ?>
            <table id="earnings-list" class="table-list" data-earnings-count=<?php echo $earnings_len; ?>>
                <thead>
                    <tr>
                        <th class="no-sort"></th>
                        <th><?php echo lang('earning_name'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->earnings as $earning) { ?>
                        <tr data-earning-id = <?php echo $earning->id; ?>>
                            <td class="action activate"><i></i>
                                <?php
                                    echo anchor('file_maintenance/earning/restore/'.$earning->id, lang('activate'),
                                            array('class'=>'activate-data confirm-link',
                                                'data-dialog-confirm-message'=> lang('are_you_sure_to_restore_earning'),
                                                'data-dialog-method'=>'PUT', 'data-dialog-remote'=>true, 'data-dialog-title'=> lang('restore_this_earning'),
                                                'data-dialog-type'=>'json', 'data-class'=>'restore'
                                         )); ?></td>
                            <td><?php echo $earning->name; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p><?php echo lang('no_records_found'); ?></p>
        <?php } ?>
    </div>
</article>