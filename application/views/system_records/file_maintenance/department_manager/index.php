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
                    <th>Name</th>
                    <th>Email</th>
                    <th>User Level</th>
                </tr>
            </thead>
            <tbody>
                 <?php if (isset($this->departments) && !empty($this->departments) && count($this->departments) > 0) { ?>
                    <?php foreach ($this->departments as $dept) { ?>
                        <tr data-userid = <?php echo $dept->id; ?>>
                            <td class="action edit"><i></i><?php echo anchor('#', lang('edit'), array('class'=>'edit-profile')); ?></td>
                            <td class="action delete"><i></i>
                                <?php
                                    echo anchor('users/delete/'.$dept->id, lang('delete'),
                                            array('class'=>'delete-profile confirm-link',
                                                'data-dialog-confirm-message'=>'Are you sure you want to delete this user?',
                                                'data-dialog-method'=>'delete', 'data-dialog-remote'=>true, 'data-dialog-title'=>'Delete this user',
                                                'data-dialog-type'=>'json', 'data-class'=>'archive'
                                         )); ?></td>
                            <td class="name"><?php echo $dept->first_name.' '.$dept->last_name; ?></td>
                            <td class="email"><?php echo $dept->email; ?></td>
                            <td class="access-level"><?php echo $dept->group; ?></td>
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