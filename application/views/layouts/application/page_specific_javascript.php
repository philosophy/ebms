<script type="text/javascript">com.ebms.init();</script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        if(com.ebms.util.namespace_checker('com.ebms.views.' + "<?php echo $this->router->class; ?>")) {

                com.ebms.views.<?php echo $this->router->class; ?>.init();
        }
    });
</script>