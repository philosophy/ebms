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