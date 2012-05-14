<div id="list" class="list-primary">
    <table id="item-actions-list" class="table-list">
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
            <?php if (isset($this->employee_schedules) && !empty($this->employee_schedules) && $sched_len > 0) { ?>
                <tr>
<!--                    <td class="employee" colspan="6">$this->employee->first_name.' '.$this->employee->last_name</td>-->
                </tr>
                <?php foreach ($this->employee_schedules as $sched) {
                    $delete_url = site_url('employee_schedules/delete/'.$sched->id);
                    $restore_url = site_url('employee_schedules/restore/'.$sched->id);

                    $edit_url = site_url('employee_schedules/get_edit_employee_form/'.$sched->id);
                ?>
                    <tr data-employee-id ="<?php echo $sched->id; ?>" data-delete-url ="<?php echo $delete_url; ?>" data-restore-url = "<?php echo $restore_url;?>" data-edit-url = "<?php echo $edit_url;?>" class="<?php echo ($sched->active == true) ? 'active' : 'inactive' ?>">
                        <td class="background <?php echo $sched->gender == 0 ? 'male' : 'female'; ?>"></td>
                        <td><?php echo $sched->day ?></td>
                        <td class="name"><?php echo $sched->first_name . ' ' . $sched->last_name; ?></td>
                        <td class="dept"><?php echo $sched->department; ?></td>
                        <td class="pos"><?php echo $sched->position; ?></td>
                        <td class="status"><?php echo $sched->status ?></td>
                    </tr>
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