<ul class="tabs-left-vertical">
    <li><a href="#who-we-are"><?php echo lang('who_we_are'); ?></a></li>
    <li><a href="#mission-vision"><?php echo lang('mission_vision'); ?></a></li>
    <li><a href="#company-core-values"><?php echo lang('core_values'); ?></a></li>
</ul>

<div id="who-we-are">
    <div id="who-we-are-wrapper">
        <?php echo image_asset('who_we_are.png', '', array('id'=>'who-we-are-img')); ?>
    </div>
    <h1 class="small-title"><?php echo lang('who_we_are'); ?></h1>
    <p class="description">
        <?php echo lang('company_description'); ?>
    </p>
</div>

<div id="mission-vision">
    <div class="contents">
        <div id="mission-wrapper">
            <h1 class="small-title"><?php echo lang('mission'); ?></h1>
            <ul class="list">
                <li>
                    <i class="icon"></i>
                    <p><?php echo lang('mission_to_be_primary_provider'); ?></p>
                </li>
                <li>
                    <i class="icon"></i>
                    <p><?php echo lang('mission_to_train_it_talents'); ?></p>
                </li>
            </ul>
        </div>
        <div id="vision-wrapper">
            <h1 class="small-title"><?php echo lang('vision'); ?></h1>
            <ul class="list">
                <li>
                    <i class="icon"></i>
                    <p><?php echo lang('vision_to_seek_partnership'); ?></p>
                </li>
                <li>
                    <i class="icon"></i>
                    <p><?php echo lang('vision_to_reach_out'); ?></p>
                </li>
            </ul>
       </div>
    </div>
    <div class="big-icon">
        <?php echo image_asset('mission_vision.png', '', array('id'=>'mission-vision-img')); ?>
    </div>
</div>

<div id="company-core-values">
    <div class="big-icon-left">
        <?php echo image_asset('core_values.jpg', '', array('id'=>'core-values-img')); ?>
    </div>
    <div class="contents">
        <ul class="list">
            <li>
                <i class="icon"></i>
                <p><?php echo lang('values_humility'); ?></p>
            </li>
            <li>
                <i class="icon"></i>
                <p><?php echo lang('values_responsibility'); ?></p>
            </li>
            <li>
                <i class="icon"></i>
                <p><?php echo lang('values_punctuality'); ?></p>
            </li>
            <li>
                <i class="icon"></i>
                <p><?php echo lang('values_respect'); ?></p>
            </li>
            <li>
                <i class="icon"></i>
                <p><?php echo lang('values_organized'); ?></p>
            </li>
        </ul>
    </div>
</div>