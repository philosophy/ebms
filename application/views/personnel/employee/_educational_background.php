<span class="tips">
    Note: <?php echo lang('with_asterisk_required'); ?>
</span>
<fieldset>
    <label>School Name:</label>
    <?php echo form_input(array('id' => 'school-name', 'placeholder' => lang('school_name'))); ?>
</fieldset>
<fieldset>
    <label>Year Graduated:</label>
    <?php echo form_input(array('id' => 'year-graduated', 'placeholder' => lang('year_graduated'))); ?>
</fieldset>
<fieldset>
    <label>Remarks:</label>
    <?php echo form_textarea(array('name' => 'remarks', 'id' => 'remarks', 'placeholder' => lang('remarks'), 'rows' => '5')); ?>
</fieldset>
<?php echo form_button(array('id'=>'add-educational-background', 'content' => lang('add'))); ?>
<div id="educational-background-details">
    <header>
        <ul>
            <li id="school-name">School Name</li>
            <li id="year-graduated">Year Graduated</li>
            <li id="remarks">Remarks</li>
        </ul>
    </header>
    <article>
        <ul>
        </ul>
    </article>
</div>
<div class="buttons-wrapper">
    <?php echo form_button(array('class' => 'previous-button', 'data-step' => '1', 'content' => 'Previous')); ?>
    <?php echo form_button(array('class' => 'next-button', 'data-step' => '3', 'content' => 'Next')); ?>
</div>