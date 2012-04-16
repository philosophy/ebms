<div id="list" class="list-primary">
    <table id="item-actions-list" class="table-list">
        <thead>
            <tr>
                <th></th>
                <th>Employee No.</th>
                <th>Name</th>
                <th>Department</th>
                <th>Position</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($this->employees) && !empty($this->employees) && $employees_len > 0) { ?>
                <?php foreach ($this->employees as $emp) {
                    $delete_url = site_url('employees/delete/'.$emp->id);
                    $restore_url = site_url('personnel/employees/restore/'.$emp->id);

                    $edit_url = site_url('employees/get_edit_employee_form/'.$emp->id);
                ?>
                    <tr data-employee-id ="<?php echo $emp->id; ?>" data-delete-url ="<?php echo $delete_url; ?>" data-restore-url = "<?php echo $restore_url;?>" data-edit-url = "<?php echo $edit_url;?>" class="<?php echo ($emp->active == true) ? 'active' : 'inactive' ?>">
                        <td class="background <?php echo $emp->gender == 0 ? 'male' : 'female'; ?>"></td>
                        <td><?php echo $emp->employee_code ?></td>
                        <td class="name"><?php echo $emp->first_name . ' ' . $emp->last_name; ?></td>
                        <td><?php echo $emp->department; ?></td>
                        <td><?php echo $emp->position; ?></td>
                        <td><?php echo $emp->status ?></td>
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