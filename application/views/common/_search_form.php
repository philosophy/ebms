<div id="search">
    <?php echo form_open($url, array('id' => $id, 'data-remote' => 'true', 'data-type' => 'json', 'method' => 'GET')); ?>
        <input type="text" id="search-input" name="name" />
        <input type="hidden" id="search-input-flag" />
        <button type="submit" id="go">search</button>
    <?php echo form_close(); ?>
</div>
