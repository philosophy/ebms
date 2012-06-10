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
                    $scheds = $this->Employee_Schedules_model->getEmployeeSched(array('employee_id' => $emp->id));
                    $scheds = array_to_object($scheds);
                ?>
                    <header class="employee">
                        <span>
                            <i class="icon"></i>
                        </span>
                        <h3 class="employee-name" data-employee-id="<?php echo $emp->id; ?>"><?php echo $emp->first_name.' '.$emp->last_name ?></h3>
                    </header>
                    <ul class="employee-schedules data">
                        <?php foreach($scheds as $sched) {
                            $delete_url = site_url('employee_schedules/delete/'.$sched->id);
                        ?>

                            <li data-sched-id="<?php echo $sched->id; ?>" data-delete-url="<?php echo $delete_url; ?>">
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
</div>
<div id="pagination">
    <?php echo $pagination_links; ?>
</div>