<article class="aside-left">

    <?php
        $this->load->view('common/nav/control_manager');
    ?>
</article>
<article class="primary">
    <section id="account-details">
        <h3>Create Account</h3>

        <div class="user-details">
            <?php echo validation_errors();?>
            <?php $this->load->view('user/_new'); ?>
        </div>
    </section>
</article>