<div id="login-wrapper">
    <section>
        <article class="primary">
            <div id="company-logo">
                <?php echo image_asset('logo/ebms.png', '', array('title' => 'EBMS')); ?>
                <span id="manage"><?php echo lang('ebms_subtitle'); ?></span>
            </div>
            <div id="building">
                <?php echo image_asset('building.PNG', '', array('title' => 'EBMS')); ?>
            </div>
        </article>
        <article class="aside">
            <?php
                $data['message'] = isset($message) ? $message : $this->session->flashdata('message');
                $data['email'] = isset($email) ? $email : '';
                $data['password'] = isset($password) ? $password : '';
                $this->load->view('user/login', $data);
            ?>
        </article>
    </section>
    <footer>
        <?php $this->load->view('layouts/application/login_footer'); ?>
    </footer>
</div>