<nav id="control-manager-nav">
    <ul>
        <li id="user-list-tab">
            <?php echo anchor('user_management/control_manager/list', lang('user_list'), array('class' => ($active=='list') ? 'active' : '')); ?>
        </li>
        <li id="create-user-tab">
            <?php echo anchor('user_management/control_manager/new_user', lang('create_user'), array('class' => ($active=='create') ? 'active' : '')); ?>
        </li>
        <li id="archive-tab">
            <i></i>
            <?php echo anchor('user_management/control_manager/archive', lang('archive'), array('class' => ($active=='archive') ? 'active' : '')); ?>
        </li>
    </ul>
</nav>