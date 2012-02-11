<article class="aside-left">

    <?php
        $this->load->view('common/control_manager_nav');
    ?>
</article>
<article class="primary">
    <div id="user-table-wrapper" class="hide">
        <table id="user-list">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>User Level</th>
                </tr>
            </thead>
            <tbody>
                 <?php if (isset($this->users) && !empty($this->users) && count($this->users) > 0) { ?>
                    <?php foreach ($this->users as $user) { ?>
                        <tr>
                            <td><?php echo $user->first_name.' '.$user->last_name; ?></td>
                            <td><?php echo $user->email; ?></td>
                            <td><?php echo $user->group; ?></td>
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
</article>