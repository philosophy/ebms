<nav id="control-manager-nav" class="control-nav">
    <ul>
        <li id="department-list-tab" class="list-tab">
            <?php echo anchor('file_maintenance/department/index', lang('department_list'), array('class' => ($active=='list') ? 'active' : '')); ?>
        </li>
        <li id="create-department-tab" class="create-tab">
            <?php echo anchor('file_maintenance/department/new_department', lang('create_department'), array('class' => ($active=='create') ? 'active' : '')); ?>
        </li>
        <li id="archive-tab" class="archive-tab">
            <i></i>
            <?php echo anchor('file_maintenance/department/archive', lang('archive'), array('class' => ($active=='archive') ? 'active' : '')); ?>
        </li>
    </ul>
</nav>