<div id="search">
    <?php echo form_open($url, array('id' => $id)); ?>
        <input type="text" id="search-input" name="name" />
        <button type="submit" id="go">search</button>
    <?php echo form_close(); ?>
</div>