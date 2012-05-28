<div id="list" class="list-primary">
    <section class="grid-list">
        <ul class="header">
            <li class="day"><h2>Days</h2></li>
            <li class="start-time"><h2>Start Time</h2></li>
            <li class="end-time"><h2>End Time</h2></li>
            <li class="start-break-time"><h2>Start Break Time</h2></li>
            <li class="end-break-time"><h2>End Break Time</h2></li>
        </ul>
        <?php if (isset($this->employees) && !empty($this->employees) && $emp_len > 0) { ?>
            <div class="grid-list-data">
                <?php foreach ($this->employees as $emp) {
                    $delete_url = site_url('employee_schedules/delete/'.$emp->id);
                    $restore_url = site_url('employee_schedules/restore/'.$emp->id);
                    $edit_url = site_url('employee_schedules/get_edit_employee_form/'.$emp->id);
                    $scheds = $this->Employee_Schedules_model->getEmployeeSched(array('employee_id' => $emp->id));
                    $scheds = array_to_object($scheds);
                ?>
                    <header class="employee">
                        <span>
                            <i class="icon"></i>
                        </span>
                        <h3 class="employee-name"><?php echo $emp->first_name.' '.$emp->last_name ?></h3>
                    </header>
                    <ul class="employee-schedules data">
                        <?php foreach($scheds as $sched) { ?>
                            <li>
                                <span class="schedule"><i class="icon"></i></span>
                                <div class="day info"><?php echo $this->Employee_Schedules_model->days_of_week[$sched->day]; ?></div>
                                <div class="start-time info"><?php echo $sched->start_time; ?></div>
                                <div class="end-time info"><?php echo $sched->end_time; ?></div>
                                <div class="start-break-time info"><?php echo $sched->start_break_time; ?></div>
                                <div class="end-break-time info"><?php echo $sched->end_break_time; ?></div>
                            </li>
                        <?php } ?>
                    </ul>
                <?php } ?>
            </div>
        <?php } else { ?>
            <p>No data found.</p>
        <?php } ?>
    </section>
    <table id="item-actions-list" class="table-list hide">
        <thead>
            <tr>
                <th></th>
                <th>Days</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Start Break Time</th>
                <th>End Break Time</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($this->employees) && !empty($this->employees) && $emp_len > 0) { ?>

                <?php /*foreach ($this->employee_schedules as $sched) {
                    $delete_url = site_url('employee_schedules/delete/'.$sched->id);
                    $restore_url = site_url('employee_schedules/restore/'.$sched->id);

                    $edit_url = site_url('employee_schedules/get_edit_employee_form/'.$sched->id);
                ?>
                    <tr data-employee-id ="//<?php echo $sched->id; ?>" data-delete-url ="<?php echo $delete_url; ?>" data-restore-url = "<?php echo $restore_url;?>" data-edit-url = "<?php echo $edit_url;?>" class="<?php echo ($sched->active == true) ? 'active' : 'inactive' ?>">
                        <td class="background //<?php echo $sched->gender == 0 ? 'male' : 'female'; ?>"></td>
                        <td>//<?php echo $sched->day ?></td>
                        <td class="name">//<?php echo $sched->first_name . ' ' . $sched->last_name; ?></td>
                        <td class="dept">//<?php echo $sched->department; ?></td>
                        <td class="pos">//<?php echo $sched->position; ?></td>
                        <td class="status">//<?php echo $sched->status ?></td>
                    </tr>
                <?php } */?>
                <?php foreach ($this->employees as $emp) {
                    $delete_url = site_url('employee_schedules/delete/'.$emp->id);
                    $restore_url = site_url('employee_schedules/restore/'.$emp->id);
                    $edit_url = site_url('employee_schedules/get_edit_employee_form/'.$emp->id);
                    $scheds = $this->Employee_Schedules_model->getEmployeeSched(array('employee_id' => $emp->id));
                    $scheds = array_to_object($scheds);
                ?>
                    <tr><td colspan="6"><?php echo $emp->first_name.' '.$emp->last_name ?></td></tr>
                    <?php foreach($scheds as $sched) { ?>
                        <tr>
                            <td class="img-wrapper"><span><?php echo image_asset('icons/schedule-icon.png', '', array('class' => 'sched-img')); ?></span></td>
                            <td><span><?php echo $sched->day; ?></span></td>
                            <td><span><?php echo $sched->start_time; ?></span></td>
                            <td><span><?php echo $sched->end_time; ?></span></td>
                            <td><span><?php echo $sched->start_break_time; ?></span></td>
                            <td><span><?php echo $sched->end_break_time; ?></span></td>
                        </tr>
                    <?php } ?>
                    <tr></tr>
                    <?php /*
<!--                    <tr data-employee-id ="<?php echo $emp->id; ?>" data-delete-url ="<?php //echo $delete_url; ?>" data-restore-url = "<?php //echo $restore_url;?>" data-edit-url = "<?php //echo $edit_url;?>" class="<?php //echo ($sched->active == true) ? 'active' : 'inactive' ?>">
                        <td class="background <?php echo $sched->gender == 0 ? 'male' : 'female'; ?>"></td>
                        <td><?php echo $sched->day ?></td>
                        <td class="name"><?php echo $sched->first_name . ' ' . $sched->last_name; ?></td>
                        <td class="dept"><?php echo $sched->department; ?></td>
                        <td class="pos"><?php echo $sched->position; ?></td>
                        <td class="status"><?php echo $sched->status ?></td>
                    </tr>-->*/?>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="6">
                        <h3>No data found.</h3>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<div id="pagination">
    <?php echo $pagination_links; ?>
</div>