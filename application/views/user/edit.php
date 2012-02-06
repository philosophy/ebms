<?php $user = $this->user; ?>
<article class="aside-left">
    
</article>

<article class="primary">
    <div id="user-details">
        <section id="personal-info">
            <h3>
                <?php echo lang('account_info'); ?>
            </h3>
            <?php 
                $hidden = array('user_id' => $user->id);
                echo form_open('users/update/'.$user->id , array('id' => 'user-edit'));
            ?>            
            <fieldset>
                <label>Username:</label>
                <?php echo form_input(array('name' => 'username', 'id' => 'username', 'value' => $user->username)); ?>
            </fieldset>
            <fieldset>
                <label>First Name:</label>
                <?php echo form_input(array('name' => 'first_name', 'id' => 'first_name', 'value' => $user->first_name)); ?>
            </fieldset>
            <fieldset>
                <label>Middle Name:</label>
                <?php echo form_input(array('name' => 'middle_name', 'id' => 'middle_name', 'value' => $user->middle_name)); ?>
            </fieldset>
            <fieldset>
                <label>Last Name:</label>
                <?php echo form_input(array('name' => 'last_name', 'id' => 'last_name', 'value' => $user->last_name)); ?>
            </fieldset>
            <fieldset>
                <label>Email:</label>
                <?php echo form_input(array('name' => 'email', 'id' => 'email', 'value' => $user->email)); ?>
            </fieldset>
            <fieldset>
                <label>Address:</label>
                <?php echo form_input(array('name' => 'address', 'id' => 'address', 'value' => $user->address)); ?>
            </fieldset>
            <fieldset>
                <label>Gender:</label>
                <select name="gender">
                    <option value="0" selected=<?php echo ($user->gender==0) ? 'selected' : ''; ?>>Male</option>
                    <option value="1" selected=<?php echo ($user->gender==1) ? 'selected' : ''; ?>>Female</option>
                </select>
            </fieldset>
            <fieldset>
                <label>Birthdate:</label>
                <?php echo form_input(array('name' => 'date_of_birth', 'id' => 'date_of_birth', 'value' => $user->date_of_birth)); ?>
            </fieldset>
            <fieldset id="marital-status"> 
                <label>Marital Status:</label>
                <div class="marital-stat-group">
                    <?php echo form_radio(array('name' => 'status_id', 'class' => 'status_id', 'value' => '0', 'checked' => ($user->status_id == 0) ? TRUE : FALSE)); ?>
                    <span>Single</span>
                </div>
                <div class="marital-stat-group">
                    <?php echo form_radio(array('name' => 'status_id', 'class' => 'status_id', 'value' => '1', 'checked' => ($user->status_id == 1) ? TRUE : FALSE)); ?>
                    <span>Married</span>
                </div>
                <div class="marital-stat-group">
                    <?php echo form_radio(array('name' => 'status_id', 'class' => 'status_id', 'value' => '2', 'checked' => ($user->status_id == 2) ? TRUE : FALSE)); ?>
                    <span>Widowed</span>
                </div>
                
            </fieldset>
            <fieldset>
                <label>Home Phone:</label>
                <?php echo form_input(array('name' => 'home_phone', 'id' => 'home_phone', 'value' => $user->home_phone)); ?>
            </fieldset>
            <fieldset>
                <label>Work Phone:</label>
                <?php echo form_input(array('name' => 'work_phone', 'id' => 'work_phone', 'value' => $user->work_phone)); ?>
            </fieldset>
            <?php echo form_submit('edit_form_submit', 'Update'); ?>
            <?php echo anchor(site_url('users/'.$user->id), 'Cancel', array('id' => 'cancel-update'));?>
            <?php echo form_close(); ?>
        </section>
    </div>    
</article>
