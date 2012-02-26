<nav id="employee-status-manager-nav" class="control-nav">
    <ul>
        <li id="employee-status-list-tab" class="list-tab">
            <?php echo anchor('file_maintenance/employee_status/index', lang('employee_status_list'), array('class' => ($active=='list') ? 'active' : '')); ?>
        </li>
        <li id="create-employee-status-tab" class="create-tab">
            <?php echo anchor('file_maintenance/employee_status/new_employee_status', lang('create_employee_status'), array('class' => ($active=='create') ? 'active' : '')); ?>
        </li>
        <li id="archive-tab" class="archive-tab">
            <i></i>
            <?php echo anchor('file_maintenance/employee_status/archive', lang('archive'), array('class' => ($active=='archive') ? 'active' : '')); ?>
        </li>
    </ul>
</nav>