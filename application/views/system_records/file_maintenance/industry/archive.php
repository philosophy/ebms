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
        <?php if(isset($this->industries) && !empty($this->industries)) { ?>
            <table id="industries-list" class="table-list" data-industries-count=<?php echo $industries_len; ?>>
                <thead>
                    <tr>
                        <th class="no-sort"></th>
                        <th><?php echo lang('industry_name'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->industries as $industry) { ?>
                        <tr data-industry-id = <?php echo $industry->id; ?>>
                            <td class="action activate"><i></i>
                                <?php
                                    echo anchor('file_maintenance/industry/restore/'.$industry->id, lang('activate'),
                                            array('class'=>'activate-data confirm-link',
                                                'data-dialog-confirm-message'=> lang('are_you_sure_to_restore_industry'),
                                                'data-dialog-method'=>'PUT', 'data-dialog-remote'=>true, 'data-dialog-title'=> lang('restore_this_industry'),
                                                'data-dialog-type'=>'json', 'data-class'=>'restore'
                                         )); ?></td>
                            <td><?php echo $industry->name; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p><?php echo lang('no_records_found'); ?></p>
        <?php } ?>
    </div>
</article>