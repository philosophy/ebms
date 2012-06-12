<div id="list" class="list-primary">
    <section class="grid-list">
        <ul class="header">
            <li class="name"><h2>Name</h2></li>
            <li class="time-in"><h2>Time In</h2></li>
            <li class="time-out"><h2>Time Out</h2></li>
        </ul>

        <?php
//            print_r($this->time_record_list);
//            echo 'records ........';
        ?>
        <?php if (isset($this->time_record_list) && !empty($this->time_record_list) && count($this->time_record_list) > 0) { ?>
            <div class="grid-list-data">
                <ul class="time-records data">
                <?php foreach (array_to_object($this->time_record_list) as $rec) {
                    $emp = $this->Employees_model->getEmployeeDetails(array('employee_id' => $rec->employee_id));
                ?>
                    <li data-record-id="<?php echo $rec->id; ?>" data-employee-id="<?php echo $rec->employee_id; ?>">
                        <span class="time-icon-wrapper"><i class="icon"></i></span>
                        <div class="emp-name info"><?php echo $emp->first_name . ' ' . $emp->last_name; ?></div>
                        <div class="time-in-rec info"><?php echo readable_time(array('date' => $rec->time_in)); ?></div>
                        <div class="time-out-rec info"><?php echo readable_time(array('date' => $rec->time_out)); ?></div>
                    </li>
                <?php } ?>
                </ul>
            </div>
        <?php } else { ?>
            <p class="no-data">No data found.</p>
        <?php } ?>
    </section>
</div>
<div id="pagination">
    <?php //echo $pagination_links; ?>
</div>