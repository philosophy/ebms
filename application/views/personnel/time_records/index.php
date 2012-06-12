<article class="primary">
    <section id="employee-time-records-list" class="items-list-wrapper">
        <header>
            <h1>
                <?php echo lang('employee_daily_time_records'); ?>
                <span class="current-date">(<?php echo date("F d, Y");?>)</span>
            </h1>
<!--            <div class="right-options">
                <?php //$this->load->view('common/_search_form', array('url' => site_url('employee/time_records/browse'), 'id' => 'employee-time-records-search')); ?>
                <div id="print-report">
                    <?php //echo image_asset('icons/pdf-icon.png', '', array('alt' => lang('report'))); ?>
                </div>
            </div>-->
        </header>
        <article class="container">
            <div class="items-nav">
                <ul>
                    <li>
                        <a href="#" id="timein" data-title="<?php echo lang('time_in'); ?>">
                            <?php echo image_asset('crud_icons/login-manager.png', '', array('title' => lang('time_in'))); ?>
                        </a>
                    </li>
                    <li>
                        <a href="#" id="timeout" class="inactive" data-title="<?php echo lang('time_out'); ?>">
                            <?php echo image_asset('crud_icons/logout.png', '', array('title' => lang('time_out'))); ?>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="table-wrapper">
                <?php $this->load->view('personnel/time_records/_list'); ?>
            </div>
        </article>

    </section>
</article>

<?php $this->load->view('personnel/time_records/_timein_form'); ?>
<?php $this->load->view('personnel/time_records/_timeout_form'); ?>
