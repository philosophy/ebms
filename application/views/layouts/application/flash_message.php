<div id="flash" class="hide" data-error-message = <?php echo lang('please_try_again'); ?>>
    <div data-content-key="flash" class= "content">
        <?php
            if(strlen($this->session->flashdata('msg')) > 0) {
                echo '<p class="'.$this->session->flashdata('msg_class').'">'.$this->session->flashdata('msg').'</p>';
            }
        ?>
        <a href="#" class="close">X</a>
    </div>
</div>