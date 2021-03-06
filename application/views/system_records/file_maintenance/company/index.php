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
        <?php if (isset($this->companies) && !empty($this->companies) && $companies_len > 0) { ?>
            <table id="companies-list" class="table-list" data-companies-count=<?php echo $companies_len; ?>>
                <thead>
                    <tr>
                        <th class="no-sort"></th>
                        <th class="no-sort"></th>
                        <th><?php echo lang('name'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->companies as $company) { ?>
                        <tr data-company-id = <?php echo $company->id; ?>>
                            <td class="action edit"><i></i><?php echo anchor('#', lang('edit'), array('class'=>'edit-data')); ?></td>
                            <td class="action delete"><i></i>
                                <?php
                                    echo anchor('file_maintenance/company/delete/'.$company->id, lang('delete'),
                                            array('class'=>'delete-data confirm-link',
                                                'data-dialog-confirm-message'=>lang('are_you_sure_to_delete_company'),
                                                'data-dialog-method'=>'delete', 'data-dialog-remote'=>true, 'data-dialog-title'=>lang('delete_this_company'),
                                                'data-dialog-type'=>'json', 'data-class'=>'archive'
                                         )); ?></td>
                            <td class="name"><?php echo $company->name; ?></td>
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
    <div id="edit-company-wrapper" class="hide aligned-details" data-ajax-url=<?php echo site_url("file_maintenance/company/get_company_edit_form/"); ?>>
        <h3>
            Edit Area Type
        </h3>
    </div>
</article>