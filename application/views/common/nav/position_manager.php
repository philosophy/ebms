<nav id="position-manager-nav" class="control-nav">
    <ul>
        <li id="position-list-tab" class="list-tab">
            <?php echo anchor('file_maintenance/position/index', lang('position_list'), array('class' => ($active=='list') ? 'active' : '')); ?>
        </li>
        <li id="create-position-tab" class="create-tab">
            <?php echo anchor('file_maintenance/position/new_position', lang('create_position'), array('class' => ($active=='create') ? 'active' : '')); ?>
        </li>
        <li id="archive-tab" class="archive-tab">
            <i></i>
            <?php echo anchor('file_maintenance/position/archive', lang('archive'), array('class' => ($active=='archive') ? 'active' : '')); ?>
        </li>
    </ul>
</nav>