<?php if (isset($this->employees) && !empty($this->employees) && $employees_len > 0) { ?>
    <?php foreach ($this->employees as $emp) { ?>
        <tr data-employee-id ="<?php echo $emp->id; ?>" data-delete-url ="<?php echo site_url('employees/delete/'.$emp->id); ?>" class="<?php echo ($emp->active == true) ? 'active' : 'inactive' ?>">
            <td class="background <?php echo $emp->gender == 0 ? 'male' : 'female'; ?>"></td>
            <td><?php echo $emp->employee_code ?></td>
            <td><?php echo $emp->first_name . ' ' . $emp->last_name; ?></td>
            <td><?php echo $emp->department; ?></td>
            <td><?php echo $emp->position; ?></td>
            <td><?php echo $emp->status ?></td>
        </tr>
    <?php } ?>
<?php } else { ?>
    <tr>
        <td colspan="5">
            <h3>No data found.</h3>
        </td>
    </tr>
<?php } ?>