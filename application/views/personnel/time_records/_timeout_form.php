<div id="timeout-dialog" class="hide">
    <?php echo form_open(site_url('employee/time_records/time_out'), array('id' => 'timeout-form', 'data-remote' => 'true', 'data-type' => 'json')); ?>
        <div>
            <label><?php echo lang('employee_name'); ?></label>
            <span class="emp-name"></span>
            <?php echo form_input(array('name' => 'employee', 'type' => 'hidden', 'class' => 'emp-id')); ?>
            <?php echo form_input(array('name' => 'record_id', 'type' => 'hidden', 'class' => 'time-record-id')); ?>
            
            <div class="timecheck-wrapper">
                <?php echo image_asset('icons/timecheck.png', '', array('id' => 'timecheck-img', 'width' => '32', 'height' => '32')); ?>
                <h3 class="timecheck">
                    Time Check:
                    <span class="current-time"></span>
                </h3>
            </div>

            <?php echo create_button(array('id' => 'checkout', 'type'=>'submit', 'text' => 'Check out user', 'data_attributes'=>array('data-disable-with'=>'true'))); ?>
        </div>
    <?php echo form_close(); ?>
</div>
