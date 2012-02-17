<article class="aside-left">

</article>
<article class="primary">
    
    <section id="company-info" class="aligned-details">
        <h3>
            Company Info
        </h3>
        <?php
        echo form_open('file_maintenance/company/update/'.$this->companyId, array('id' => 'edit-company-info'));
        ?>
            <fieldset>
                <label>Company Name:</label>
                <?php echo form_input(array('name' => 'name', 'id' => 'company-name', 'value' => set_value('name'))); ?>
            </fieldset>
            <fieldset>
                <label>Address:</label>
                <?php echo form_input(array('name' => 'address', 'id' => 'address', 'value' => set_value('address'))); ?>
            </fieldset>
            <fieldset>
                <label>Phone Number:</label>
                <?php echo form_input(array('name' => 'phone_no', 'id' => 'phone_no', 'value' => set_value('phone_no'))); ?>
            </fieldset>
            <fieldset>
                <label>Mobile Number:</label>
                <?php echo form_input(array('name' => 'mobile_no', 'id' => 'mobile_no')); ?>
            </fieldset>
            <fieldset>
                <label>Fax Number:</label>
                <?php echo form_input(array('name' => 'fax_no', 'id' => 'fax_no')); ?>
            </fieldset>
            <fieldset>
                <label>Email Address:</label>
                <?php echo form_input(array('name' => 'email_address', 'id' => 'email_address')); ?>
            </fieldset>
            <fieldset>
                <label>Website:</label>
                <?php echo form_input(array('name' => 'website', 'id' => 'username')); ?>
            </fieldset>
            <fieldset>
                <label>Logo:</label>
                <?php echo form_input(array('name' => 'logo', 'id' => 'logo')); ?>
            </fieldset>

            <?php echo form_submit('edit_form_submit', 'Update', 'class="button-theme-a"'); ?>
            <?php echo anchor(site_url('file_maintenance/company'), 'Cancel', array('id' => 'cancel-update')); ?>
        <?php echo form_close(); ?>
    </section>
</article>