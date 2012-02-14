<article class="aside-left">

</article>

<article class="primary">

    <section id="company-info" class="aligned-details">
        <h3>
            Company Info
            <?php echo anchor(site_url('file_maintenance/company/edit/' . $this->company->id), 'Edit', array('class' => 'edit-link')); ?>
        </h3>
        <fieldset>
            <label>Name:</label>
            <span><?php echo $this->company->name; ?></span>
        </fieldset>
        <fieldset>
            <label>Address:</label>
            <span>
                <?php echo $this->company->address; ?>
            </span>
        </fieldset>
        <fieldset>
            <label>Phone Number</label>
            <span><?php echo $this->company->phone_no; ?></span>
        </fieldset>
        <fieldset>
            <label>Mobile Number:</label>
            <span><?php echo $this->company->mobile_no; ?></span>
        </fieldset>
        <fieldset>
            <label>Fax Number:</label>
            <span><?php echo $this->company->fax_no; ?></span>
        </fieldset>
        <fieldset>
            <label>Email:</label>
            <span><?php echo $this->company->email_address; ?></span>
        </fieldset>
        <fieldset>
            <label>Website</label>
            <span><?php echo $this->company->website; ?></span>
        </fieldset>
    </section>
</article>