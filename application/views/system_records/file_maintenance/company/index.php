<article class="aside-left">

</article>

<article class="primary">

<?php
    print_r($this->company);
?>
    <div id="company-details">
        <section id="employment-info">
            <h3>Company Info</h3>
            <fieldset>
                <label>Name:</label>
                <span><?php echo $this->company->name; ?></span>
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