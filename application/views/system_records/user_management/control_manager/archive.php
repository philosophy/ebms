<article class="aside-left">
    <?php
        $this->load->view('common/nav/control_manager');
    ?>
</article>
<article class="primary">
    <div id="user-table-wrapper" class="hide">
        <?php if(isset($this->users) && !empty($this->users) && count($this->users)) { ?>
            <table id="user-list">
                <thead>
                    <tr>
                        <th class="no-sort"></th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>User Level</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->users as $user) { ?>
                        <tr data-userid = <?php echo $user->id; ?>>
                            <td class="action activate"><i></i>
                                <?php
                                    echo anchor('users/activate/'.$user->id, lang('activate'),
                                            array('class'=>'delete-profile confirm-link',
                                                'data-dialog-confirm-message'=> lang('are_you_sure_to_restore_user'),
                                                'data-dialog-method'=>'PUT', 'data-dialog-remote'=>true, 'data-dialog-title'=>lang('restore_user'),
                                                'data-dialog-type'=>'json', 'data-class'=>'activate'
                                         )); ?></td>
                            <td><?php echo $user->first_name.' '.$user->last_name; ?></td>
                            <td><?php echo $user->email; ?></td>
                            <td><?php echo $user->group; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p><?php echo lang('no_records_found'); ?></p>
        <?php } ?>
            
    </div>
</article>