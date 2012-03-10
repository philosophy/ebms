<article class="aside-left">

</article>
<article class="primary">

    <section id="company-info" class="aligned-details">
        <h3>
            Company Info
        </h3>
        <?php
        echo form_open('file_maintenance/company_info/update/' . $this->company_info->id, array('id' => 'edit-company-info'));
        ?>
        <fieldset>
            <label>Company Name:</label>
                <?php echo form_input(array('name' => 'name', 'id' => 'company_info-name', 'value' => $this->company_info->name)); ?>
        </fieldset>
        <fieldset>
            <label>Address:</label>
            <?php echo form_input(array('name' => 'address', 'id' => 'address', 'value' => $this->company_info->address)); ?>
        </fieldset>
        <fieldset>
            <label>Phone Number:</label>
            <?php echo form_input(array('name' => 'phone_no', 'id' => 'phone_no', 'value' => $this->company_info->phone_no)); ?>
        </fieldset>
        <fieldset>
            <label>Mobile Number:</label>
            <?php echo form_input(array('name' => 'mobile_no', 'id' => 'mobile_no', 'value' => $this->company_info->mobile_no)); ?>
        </fieldset>
        <fieldset>
            <label>Fax Number:</label>
            <?php echo form_input(array('name' => 'fax_no', 'id' => 'fax_no', 'value' => $this->company_info->fax_no)); ?>
        </fieldset>
        <fieldset>
            <label>Email Address:</label>
            <?php echo form_input(array('name' => 'email_address', 'id' => 'email_address', 'value' => $this->company_info->email_address)); ?>
        </fieldset>
        <fieldset>
            <label>Website:</label>
            <?php echo form_input(array('name' => 'website', 'id' => 'username', 'value' => $this->company_info->website)); ?>
        </fieldset>
        <fieldset>
            <label>Logo:</label>
            <?php echo form_input(array('name' => 'logo', 'id' => 'logo', 'value' => $this->company_info->logo)); ?>                
        </fieldset>

        <?php echo form_submit('edit_form_submit', 'Update', 'class="button-theme-a"'); ?>
        <?php echo anchor(site_url('file_maintenance/company_info'), 'Cancel', array('id' => 'cancel-update')); ?>
        <?php echo form_close(); ?>
    </section>
</article>