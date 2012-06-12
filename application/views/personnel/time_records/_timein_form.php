<div id="timein-dialog" class="hide">
    <?php echo form_open(site_url('employee/time_records/time_in'), array('id' => 'timein-form', 'data-remote' => 'true', 'data-type' => 'json')); ?>
        <div>
            <label><?php echo lang('select_employee'); ?></label>
            <select name="employee">
            <?php foreach ($this->employees as $emp) { ?>
                <option value="<?php echo $emp['id']; ?>"><?php echo $emp['first_name'].' '.$emp['last_name']; ?></option>
            <?php } ?>
            </select>
            <div class="timecheck-wrapper">
                <?php echo image_asset('icons/timecheck.png', '', array('id' => 'timecheck-img', 'width' => '32', 'height' => '32')); ?>
                <h3 class="timecheck">
                    Time Check:
                    <span class="current-time"></span>
                </h3>
            </div>

            <?php echo create_button(array('id' => 'checkin', 'type'=>'submit', 'text' => 'Check in user', 'data_attributes'=>array('data-disable-with'=>'true'))); ?>
        </div>
    <?php echo form_close(); ?>
</div>