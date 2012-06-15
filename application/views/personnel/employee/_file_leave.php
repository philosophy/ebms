x`<div class="actions top-nav">
    <a href="#" class="action-items disabled" id="new-leave"></a>
    <a href="#" class="action-items disabled" id="edit-leave"></a>
    <a href="#" class="action-items disabled" id="delete-leave"></a>
</div>

<div id="filed-leaves-list" class="list-primary">
    <section class="grid-list">
        <ul class="header">
            <li class="leave-type"><h2>Leave Type</h2></li>
            <li class="leave-from"><h2>From</h2></li>
            <li class="leave-to"><h2>To</h2></li>
        </ul>

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
        <?php } else {
            echo $this->load->view('common/_no_data');
        } ?>
    </section>
</div>
<div id="pagination">
    <?php //echo $pagination_links; ?>
</div>

<div id="file-leave-dialog" class="hide">
    <?php echo $this->load->view('personnel/employee/_leave_dialog'); ?>
</div>