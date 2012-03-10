<span class="tips">
    Note: <?php echo lang('with_asterisk_required'); ?>
</span>

<fieldset>
    <label>Date Hired:</label>
    <?php echo form_input(array('name' => 'date_of_birth', 'id' => 'date-of-birth', 'placeholder' => lang('date_of_birth'), 'data-datepicker-img-url' => image_asset_url('calendar.gif'))); ?>
</fieldset>
<fieldset>
    <label>Department:</label>
    <select name="gender">
        <option value="0">Male</option>
        <option value="1">Female</option>
    </select>
</fieldset>   
<fieldset>
    <label>Position:</label>
    <select name="gender">
        <option value="0">Male</option>
        <option value="1">Female</option>
    </select>
</fieldset>   
<fieldset>
    <label>Employment Status:</label>
    <select name="gender">
        <option value="0">Male</option>
        <option value="1">Female</option>
    </select>
</fieldset> 
<section id="work-experience">
    <h1>Work Experience</h1>
    <fieldset>
        <label>Company Name:</label>
        <?php echo form_input(array('name' => 'company_name', 'id' => 'company-name', 'placeholder' => lang('company_name'))); ?>
    </fieldset>
    <fieldset>
        <label>Date Started:</label>
        <?php echo form_input(array('name' => 'date_of_birth', 'id' => 'date-of-birth', 'placeholder' => lang('date_of_birth'), 'data-datepicker-img-url' => image_asset_url('calendar.gif'))); ?>
    </fieldset>
    <fieldset>
        <label>Date Ended:</label>
        <?php echo form_input(array('name' => 'date_of_birth', 'id' => 'date-of-birth', 'placeholder' => lang('date_of_birth'), 'data-datepicker-img-url' => image_asset_url('calendar.gif'))); ?>
    </fieldset>
    <fieldset>
        <label>Work Description:</label>
        <?php echo form_textarea(array('name' => 'work_description', 'id' => 'work-description', 'placeholder' => lang('work_description'), 'rows' => '2')); ?>
    </fieldset>  
    <?php echo form_button(array('id'=>'add-work-experience', 'content' => 'Add')); ?>
    
    <div id="work-experience-details">
        <header>
            <ul>
                <li id="company-title">Company Name</li>
                <li id="start-date">Start Date</li>
                <li id="end-date">End Date</li>
                <li id="work-desc">Work Description</li>
            </ul>
        </header>        
        <article>
            <ul>
                <li>      
                    <div class="delete-work-exp">
                        <a href="#" class="delete-work">X</a>
                    </div>
                    <div class="company-work-exp">
                        Test
                    </div>
                    <div class="date-work-exp">
                        01203423
                    </div>
                    <div class="date-work-exp">
                        01203423
                    </div>
                    <div class="desc-work-exp">
                        Loremipsum
                    </div>                    
                </li>
            </ul>
        </article>
    </div>
</section>

<div class="buttons-wrapper">
    <?php echo form_button(array('class' => 'previous-button', 'data-step' => '0', 'content' => 'Previous')); ?>
    <?php echo form_button(array('class' => 'next-button', 'data-step' => '2', 'content' => 'Next')); ?>
</div>