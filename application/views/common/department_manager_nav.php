<nav id="control-manager-nav" class="control-nav">
    <ul>
        <li id="department-list-tab" class="list-tab">
            <?php echo anchor('user_management/control_manager/list', lang('department_list'), array('class' => ($active=='list') ? 'active' : '')); ?>
        </li>
        <li id="create-department-tab" class="create-tab">
            <?php echo anchor('user_management/control_manager/new_user', lang('create_department'), array('class' => ($active=='create') ? 'active' : '')); ?>
        </li>
        <li id="archive-tab" class="archive-tab">
            <i></i>
            <?php echo anchor('user_management/control_manager/archive', lang('archive'), array('class' => ($active=='archive') ? 'active' : '')); ?>
        </li>
    </ul>
</nav>