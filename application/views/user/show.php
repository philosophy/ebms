<?php $user = $this->user; ?>
<article class="aside-left">
    
</article>

<article class="primary">
    <div id="user-details">
        <h1>Profile</h1>
        <section id="personal-info">
            <h3>
                Account Info
                <?php echo anchor(site_url('users/edit/' . $user->id), 'Edit', array('class' => 'edit-link')); ?>
            </h3>
            <div class="details">
                <fieldset>
                    <label>Username:</label>
                    <span><?php echo $user->username; ?></span>
                </fieldset>
                <fieldset>
                    <label>Name:</label>
                    <span>
                        <?php
                        $name = $user->first_name . ' ' . $user->middle_name . ' ' . $user->last_name;
                        echo $name;
                        ?>
                    </span>
                </fieldset>
                <fieldset>
                    <label>Email:</label>
                    <span><?php echo $user->email; ?></span>
                </fieldset>
                <fieldset>
                    <label>Address:</label>
                    <span><?php echo $user->address; ?></span>
                </fieldset>
                <fieldset>
                    <label>Gender:</label>
                    <span>
                        <?php
                        if (isset($user->gender)) {
                            echo $this->gender[$user->gender];
                        }
                        ?>
                    </span>
                </fieldset>
                <fieldset>
                    <label>Birthdate:</label>
                    <span><?php echo $user->date_of_birth; ?></span>
                </fieldset>
                <fieldset>
                    <label>Marital Status:</label>
                    <span>
                        <?php
                        if (isset($user->status_id)) {
                            echo $this->status[$user->status_id];
                        }
                        ?>
                    </span>
                </fieldset>
                <fieldset>
                    <label>Home Phone:</label>
                    <span><?php echo $user->home_phone; ?></span>
                </fieldset>
                <fieldset>
                    <label>Work Phone:</label>
                    <span><?php echo $user->work_phone; ?></span>
                </fieldset>
        </section>
            
        <section id="password-settings">
            <h3>
                Password Settings
                <?php echo anchor(site_url('users/edit_password_settings/' . $user->id), 'Edit', array('class' => 'edit-link')); ?>
            </h3>
            <div class="details">
                <fieldset>
                    <label>Password:</label>
                    <span>**********</span>
                </fieldset>                
            </div>            
        </section>
        
        <section id="security-settings">
            <h3>
                Security Settings
                <?php echo anchor(site_url('users/edit_security_settings/' . $user->id), 'Edit', array('class' => 'edit-link')); ?>
            </h3>
            <div class="details">               
                <fieldset>
                    <label>Security Question:</label>
                    <span>
                        <?php 
                            if (isset($user->security_question_id)) {
                                echo $this->security_question[$user->security_question_id];
                            } else {
                                echo 'Nothing is set';
                            }
                        ?>
                    </span>
                </fieldset>
            </div>            
        </section>
            
        <section id="employment-info">
            <h3>Employment Info</h3>
            <fieldset>
                <label>Date Hired:</label>
                <span><?php echo $user->date_hired; ?></span>
            </fieldset>
            <fieldset>
                <label>SSS Number:</label>
                <span>
                    <?php echo $user->sss_no; ?>
                </span>
            </fieldset>
            <fieldset>
                <label>TIN Number:</label>
                <span><?php echo $user->tin_no; ?></span>
            </fieldset>
            <fieldset>
                <label>Philhealth Number:</label>
                <span><?php echo $user->philhealth; ?></span>
            </fieldset>
            <fieldset>
                <label>Pagibig:</label>
                <span><?php echo $user->pagibig; ?></span>
            </fieldset>
            <fieldset>
                <label>Salary:</label>
                <span><?php echo $user->salary; ?></span>
            </fieldset>
            <fieldset>
                <label>Employment Status:</label>
                <span>
                    <?php
                    if (isset($user->employee_status_id)) {
                        echo $this->employee_status[$user->employee_status_id];
                    }
                    ?>
                </span>
            </fieldset>           
        </section>
    </div>
</article>