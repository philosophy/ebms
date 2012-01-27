<div id="login-wrapper">
    <div id="login-content">
        <div id="company-logo">
            <?php echo image_asset('logo/ebms.png', '', array('title' => 'EBMS')); ?>
            <span><?php echo $this->lang->line('ebms_subtitle'); ?></span>
        </div>
        <?php
            $data['message'] = $message;
            $this->load->view('user/login', $data);
        ?>
    </div>
    <div id="login-footer">

    </div>
</div>