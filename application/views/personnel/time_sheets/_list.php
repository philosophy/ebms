<div id="list" class="list-primary no-sidenav">
    <section class="grid-list">
        <ul class="header">
            <li class="name"><h2>Employee Name</h2></li>
            <li class="department"><h2>Department</h2></li>
            <li class="date"><h2>Date</h2></li>
            <li class="time-in"><h2>Time In</h2></li>
            <li class="time-out"><h2>Time Out</h2></li>
        </ul>

        <?php if (isset($this->time_sheet_list) && !empty($this->time_sheet_list) && count($this->time_sheet_list) > 0) { ?>
            <div class="grid-list-data">
                <ul class="time-sheets data">
                <?php foreach (array_to_object($this->time_sheet_list) as $rec) {
                    $emp = $this->Employees_model->getEmployeeDetails(array('employee_id' => $rec->employee_id));
                ?>
                    <li data-record-id="<?php echo $rec->id; ?>" data-employee-id="<?php echo $rec->employee_id; ?>">
                        <span class="time-icon-wrapper"><i class="icon"></i></span>
                        <div class="emp-name info"><?php echo $emp->first_name . ' ' . $emp->last_name; ?></div>
                        <div class="department info"><?php echo $this->Department_model->getDepartment($emp->department_id)->name; ?></div>
                        <div class="date info"><?php echo readable_time(array('format' => 'D M d, Y', 'date' => $rec->record_date)); ?></div>
                        <div class="time-in-rec info"><?php echo readable_time(array('date' => $rec->time_in)); ?></div>
                        <div class="time-out-rec info"><?php echo readable_time(array('date' => $rec->time_out)); ?></div>
                    </li>
                <?php } ?>
                </ul>
            </div>
        <?php } else {
            $this->load->view('common/_no_data');
        } ?>
    </section>
</div>
<div id="pagination">
    <?php //echo $pagination_links; ?>
</div>