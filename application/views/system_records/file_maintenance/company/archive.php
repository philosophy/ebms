<?php
    $companies_len = count($this->companies);
?>
<article class="aside-left">
    <?php
        $data = array('list' => array('link' => 'file_maintenance/company/index', 'text' => lang('company_list')),
                      'create' => array('link' => 'file_maintenance/company/new_company', 'text' => lang('create_company')),
                      'archive' => array('link' => 'file_maintenance/company/archive', 'text' => lang('archive'))
            );
        $this->load->view('common/nav/left_nav_manager', $data);
    ?>
</article>
<article class="primary">
    <div id="companies-table-wrapper" class="aligned-table table-list-wrapper hide">
        <?php if(isset($this->companies) && !empty($this->companies)) { ?>
            <table id="companies-list" class="table-list" data-companies-count=<?php echo $companies_len; ?>>
                <thead>
                    <tr>
                        <th class="no-sort"></th>
                        <th><?php echo lang('company_name'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->companies as $company) { ?>
                        <tr data-company-id = <?php echo $company->id; ?>>
                            <td class="action activate"><i></i>
                                <?php
                                    echo anchor('file_maintenance/company/restore/'.$company->id, lang('activate'),
                                            array('class'=>'activate-data confirm-link',
                                                'data-dialog-confirm-message'=> lang('are_you_sure_to_restore_company'),
                                                'data-dialog-method'=>'PUT', 'data-dialog-remote'=>true, 'data-dialog-title'=> lang('restore_this_company'),
                                                'data-dialog-type'=>'json', 'data-class'=>'restore'
                                         )); ?></td>
                            <td><?php echo $company->name; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p><?php echo lang('no_records_found'); ?></p>
        <?php } ?>
    </div>
</article>