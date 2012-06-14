<div id="orb-cont">
    <a href='#' id="orb-link">
        <?php echo image_asset('logo/orb.png', '', array('id' => 'orb-img')); ?>
    </a>

    <ul id="orb-nav" class="hide">
        <li id="orb-nav-list">
            <a href="#" id="user-guide-link" class="quick-view" rel="user-guide" name="630">
                <i></i>
                <?php echo lang('user_guide'); ?>
            </a>
        </li>

        <li id="orb-nav-list">
            <a href="#" id="cheat-sheet-link" class="quick-view" rel="cheat-sheet" name="800">
                <i></i>
                <?php echo lang('cheat_sheet'); ?>
            </a>
        </li>

        <li id="orb-nav-list">
            <a href="#" id="about-us-link" class="quick-view" rel="about-us" name="500">
                <i></i>
                <?php echo lang('about_us'); ?>
            </a>
        </li>

        <li id="orb-nav-list">
            <a href="#" id="contact-us-link" class="quick-view" rel="contact-us" name="500">
                <i></i>
                <?php echo lang('contact_us'); ?>
            </a>
        </li>

        <li id="orb-nav-list">
            <a href=<?php echo site_url('auth/logout'); ?> id="logout-link" class="logout">
                <i></i>
                <?php echo lang('logout'); ?>
            </a>
        </li>
    </ul>
</div>

<div id="about-us-dialog-info" class="hide tabs" data-ajax-url="<?php echo site_url('quick_view/about_us'); ?>">
    <span class="loader"></span>
</div>
<div id="cheat-sheet-dialog-info" class="hide" data-ajax-url="<?php echo site_url('quick_view/cheat_sheet'); ?>">
    <span class="loader"></span>
</div>
<div id="user-guide-dialog-info" class="hide tabs" data-ajax-url="<?php echo site_url('quick_view/user_guide'); ?>">
    <span class="loader"></span>
</div>
<?php echo $this->load->view('layouts/application/quick_view/_contact_us'); ?>