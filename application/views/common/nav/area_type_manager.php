<nav id="area-type-manager-nav" class="control-nav">
    <ul>
        <li id="area-type-list-tab" class="list-tab">
            <?php echo anchor('file_maintenance/area_type/index', lang('area_type_list'), array('class' => ($active=='list') ? 'active' : '')); ?>
        </li>
        <li id="create-area-type-tab" class="create-tab">
            <?php echo anchor('file_maintenance/area_type/new_area_type', lang('create_area_type'), array('class' => ($active=='create') ? 'active' : '')); ?>
        </li>
        <li id="archive-tab" class="archive-tab">
            <i></i>
            <?php echo anchor('file_maintenance/area_type/archive', lang('archive'), array('class' => ($active=='archive') ? 'active' : '')); ?>
        </li>
    </ul>
</nav>