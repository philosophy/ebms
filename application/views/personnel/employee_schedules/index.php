<?php
    $emp_len = count($this->employees);
?>
<article class="primary">
    <section id="employee-schedule-list" class="items-list-wrapper">
        <header>
            <h1>
                Employee Schedule
            </h1>
            <div class="right-options">
                <?php $this->load->view('common/_search_form', array('url' => site_url('employee_schedules/browse'), 'id' => 'search-employee-form')); ?>
                <div id="print-report">
                    <?php echo image_asset('icons/pdf-icon.png', '', array('alt' => lang('report'))); ?>
                </div>
            </div>
        </header>
        <article class="container">
            <div class="items-nav">
                <ul>
                    <li>
                        <a href="#" id="new-employee-schedule" data-title=<?php echo lang('new_schedule'); ?>>
                            <?php echo image_asset('crud_icons/newIcon.png', '', array('title' => lang('new_schedule'))); ?>
                        </a>
                    </li>
                    <li>
                        <a href="#" id="edit-employee-schedule" class="inactive" data-title=<?php echo lang('edit_schedule'); ?>>
                            <?php echo image_asset('crud_icons/editIcon.png', '', array('title' => lang('edit_schedule'))); ?>
                        </a>
                    </li>
                    <li>
                        <a href="#" id="edit-multiple-employee-schedule" class="edit-multiple-data" data-title="<?php echo lang('edit_multiple_schedule'); ?>">
                            <?php echo image_asset('crud_icons/multipleEditIcon.png', '', array('title' => lang('edit_multiple_schedule'))); ?>
                        </a>
                    </li>
                    <li>
                        <a href="#" id="delete-employee-schedule" class="inactive delete-data confirm-link" data-title="<?php echo lang('delete_employee'); ?>" data-dialog-confirm-message="<?php echo lang('are_you_sure_you_want_to_delete_employee'); ?>" data-dialog-method="delete" data-dialog-remote='true' data-dialog-title="<?php echo lang('delete_employee');?>" data-dialog-type='json' data-class='archive'>
                            <?php echo image_asset('crud_icons/deleteIcon.png', '', array('title' => lang('delete_employee'))); ?>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="table-wrapper">
                <?php $this->load->view('personnel/employee_schedules/_employee_schedule_list', array('emp_len' => $emp_len)); ?>
            </div>
        </article>

    </section>
<!--    <section id="employee-items">
        <?php //$this->load->view('personnel/employee/_employee_items'); ?>
    </section>-->
</article>

<div id="new-employee-sched-dialog" class="hide" data-ajax-url=<?php echo site_url('employee_schedules/get_new_employee_sched_form'); ?>>
    <span class="loader"></span>
</div>

<div id="edit-employee-sched-dialog" class="hide" data-ajax-url=<?php echo site_url('employee_schedules/get_edit_employee_sched_form/'.$this->employees[0]->id); ?>>
    <span class="loader"></span>
</div>

<div id="edit-multiple-sched-dialog" class="hide" data-ajax-url=<?php echo site_url('employee_schedules/get_edit_multiple_sched'); ?>>
    <span class="loader"></span>
</div>

<div id="delete-employee-dialog" class="hide">
    <span class="loader"></span>
</div>


<!--<script>
    var employmentStatus = <?php //echo json_encode($this->employment_status); ?>;
    var departments = <?php //echo json_encode($this->departments); ?>;
    var positions = <?php //echo json_encode($this->positions); ?>;
</script>-->
