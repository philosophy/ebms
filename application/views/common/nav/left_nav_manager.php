<nav class="control-nav">
    <ul>
        <li class="list-tab">
            <?php echo anchor($list['link'], $list['text'], array('class' => ($active=='list') ? 'active' : '')); ?>
        </li>
        <li class="create-tab">
            <?php echo anchor($create['link'], $create['text'], array('class' => ($active=='create') ? 'active' : '')); ?>
        </li>
        <li class="archive-tab">
            <i></i>
            <?php echo anchor($archive['link'], $archive['text'], array('class' => ($active=='archive') ? 'active' : '')); ?>
        </li>
    </ul>
</nav>