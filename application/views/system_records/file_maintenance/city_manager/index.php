<article class="aside-left">

    <?php
        $this->load->view('common/department_manager_nav');
    ?>
</article>
<article class="primary">
    <div id="user-table-wrapper" class="hide">
        <table id="user-list">
            <thead>
                <tr>
                    <th class="no-sort"></th>
                    <th class="no-sort"></th>
                    <th>ID</th>
                    <th>Name</th>                    
                </tr>
            </thead>
            <tbody>
                 <?php if (isset($this->city) && !empty($this->city) && count($this->city) > 0) { ?>
                    <?php foreach ($this->city as $city_manager) { ?>
                        <tr data-userid = <?php echo $city_manager->id; ?>>
                            <td class="action edit"><i></i><?php echo anchor('#', lang('edit'), array('class'=>'edit-profile')); ?></td>
                            <td class="action delete"><i></i>
                                <?php
                                    echo anchor('users/delete/'.$city->id, lang('delete'),
                                            array('class'=>'delete-profile confirm-link',
                                                'data-dialog-confirm-message'=>'Are you sure you want to delete this user?',
                                                'data-dialog-method'=>'delete', 'data-dialog-remote'=>true, 'data-dialog-title'=>'Delete this user',
                                                'data-dialog-type'=>'json', 'data-class'=>'archive'
                                         )); ?></td>
                            <td class="name"><?php echo $city_manager->name.' '.$city_manager->name; ?></td>                            
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="6">  No user.</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="loader loader-container hide">
    </div>
    <div id="edit-user-wrapper" class="hide aligned-details" data-ajax-url=<?php echo site_url("user_management/control_manager/get_useredit_form/"); ?>>
        <h3>
            Edit User
        </h3>
    </div>
</article>