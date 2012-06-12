<article class="primary">
    <section id="employee-time-sheets-list" class="items-list-wrapper">
        <header>
            <h1>
                <?php echo lang('employee_time_sheet_records'); ?>
            </h1>
            <div class="right-options">
                <?php $this->load->view('common/_search_form', array('url' => site_url('employee/time_sheets/browse'), 'id' => 'employee-time-sheets-search')); ?>
                <div id="print-report">
                    <?php echo image_asset('icons/pdf-icon.png', '', array('alt' => lang('report'))); ?>
                </div>
            </div>
        </header>
        <article class="container">
            <div class="table-wrapper">
                <?php $this->load->view('personnel/time_sheets/_list'); ?>
            </div>
        </article>

    </section>
</article>