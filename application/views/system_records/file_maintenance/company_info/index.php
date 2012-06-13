<article class="aside-left">

</article>

<article class="primary">
    
    <section id="company-info" class="aligned-details">
        <h3>
            Company Info
            <?php echo anchor(site_url('file_maintenance/company_info/edit/' . $this->company_info->id), 'Edit', array('class' => 'edit-link')); ?>
        </h3>
        <fieldset>
            <label>Name:</label>
            <span><?php echo $this->company_info->name; ?></span>
        </fieldset>
        <fieldset>
            <label>Address:</label>
            <span>
                <?php echo $this->company_info->address; ?>
            </span>
        </fieldset>
        <fieldset>
            <label>Phone Number</label>
            <span><?php echo $this->company_info->phone_no; ?></span>
        </fieldset>
        <fieldset>
            <label>Mobile Number:</label>
            <span><?php echo $this->company_info->mobile_no; ?></span>
        </fieldset>
        <fieldset>
            <label>Fax Number:</label>
            <span><?php echo $this->company_info->fax_no; ?></span>
        </fieldset>
        <fieldset>
            <label>Email:</label>
            <span><?php echo $this->company_info->email_address; ?></span>
        </fieldset>
        <fieldset>
            <label>Website</label>
            <span><?php echo $this->company_info->website; ?></span>
        </fieldset>
    </section>
</article>