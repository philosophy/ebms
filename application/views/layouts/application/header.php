<div id="nav">
    <div id="orb-cont">
        <a href='#' id="orb-link">
            <?php echo image_asset('logo/orb.png', '', array('id' => 'orb-img')); ?>
        </a>

        <ul id="orb-nav" class="hide">
            <li id="orb-nav-list">
                <a href="#" id="orb-nav-a" class="quick-view" rel="user-guide" name="630">
                    <i></i>
                    <?php echo lang('user_guide'); ?>
                </a>
            </li>

            <li id="orb-nav-list">
                <a href="#" id="orb-nav-a" class="quick-view" rel="cheat-sheet" name="800">
                    <i></i>
                    <?php echo lang('cheat_sheet'); ?>
                </a>
            </li>

            <li id="orb-nav-list">
                <a href="#" id="orb-nav-a" class="quick-view" rel="about-us" name="500">
                    <i></i>
                    <?php echo lang('about_us'); ?>
                </a>
            </li>

            <li id="orb-nav-list">
                <a href="#" id="orb-nav-a" class="quick-view" rel="contact-us" name="500">
                    <i></i>
                    <?php echo lang('contact_us'); ?>
                </a>
            </li>

            <li id="orb-nav-list">
                <a href=<?php echo site_url('auth/logout'); ?> id="orb-nav-a" class="logout">
                    <i></i>
                    <?php echo lang('logout'); ?>
                </a>
            </li>
        </ul>
    </div>
    <div id="main-menu">
        <ul>
            <li class="main-menu-item">
                <?php echo anchor('dashboard/index', lang('home'), array('class'=>($active_link == 'home') ? 'active' : '')); ?>
            </li>

            <li class="main-menu-item">
                <?php echo anchor('dashboard/index', lang('crm'), array('class'=>($active_link == 'crm') ? 'active' : '')); ?>
            </li>

            <li class="main-menu-item with-sub-nav">
                <?php echo anchor('dashboard/index', lang('sales'), array('class'=>($active_link == 'sales') ? '' : '')); ?>
                <ul class="sub-nav hide">
                    <li class="sub-nav-item">
                        <?php echo anchor('dashboard/index', lang('order_slip_records')); ?>
                    </li>
                    <li class="sub-nav-item">
                        <?php echo anchor('dashboard/index', lang('delivery_receipt_records')); ?>
                    </li>
                </ul>
            </li>

            <li class="main-menu-item with-sub-nav">
                <?php echo anchor('dashboard/index', lang('accounting'), array('class'=>($active_link == 'accounting') ? 'active' : '')); ?>
                <ul class="sub-nav hide">
                    <li class="sub-nav-item">
                        <?php echo anchor('dashboard/index', lang('accounts_receivable')); ?>
                    </li>
                    <li class="sub-nav-item">
                        <?php echo anchor('dashboard/index', lang('company_payables')); ?>
                    </li>
                    <li class="sub-nav-item">
                        <?php echo anchor('dashboard/index', lang('owners_equity')); ?>
                    </li>
                    <li class="sub-nav-item">
                        <?php echo anchor('dashboard/index', lang('check_records')); ?>
                    </li>
                    <li class="sub-nav-item">
                        <?php echo anchor('dashboard/index', lang('expenses')); ?>
                    </li>
                    <li class="sub-nav-item">
                        <?php echo anchor('dashboard/index', lang('general_ledger')); ?>
                    </li>
                    <li class="sub-nav-item">
                        <?php echo anchor('dashboard/index', lang('cash_flow')); ?>
                    </li>
                    <li class="sub-nav-item">
                        <?php echo anchor('dashboard/index', lang('income_statement')); ?>
                    </li>
                    <li class="sub-nav-item">
                        <?php echo anchor('dashboard/index', lang('balance_sheet')); ?>
                    </li>
                    <li class="sub-nav-item">
                        <?php echo anchor('dashboard/index', lang('posting_of_checks')); ?>
                    </li>
                    <li class="sub-nav-item">
                        <?php echo anchor('dashboard/index', lang('clearing_of_checks')); ?>
                    </li>
                    <li class="sub-nav-item">
                        <?php echo anchor('dashboard/index', lang('bank_records_and_transactions')); ?>
                    </li>
                </ul>
            </li>

            <li class="main-menu-item with-sub-nav">
                <?php echo anchor('dashboard/index', lang('purchasing'), array('class'=>($active_link == 'purchasing') ? 'active' : '')); ?>
                <ul class="sub-nav hide">
                    <li class="sub-nav-item">
                        <?php echo anchor('dashboard/index', lang('purchase_requisition')); ?>
                    </li>
                    <li class="sub-nav-item">
                        <?php echo anchor('dashboard/index', lang('purchase_order')); ?>
                    </li>
                    <li class="sub-nav-item">
                        <?php echo anchor('dashboard/index', lang('suppliers_management')); ?>
                    </li>
                </ul>
            </li>

            <li class="main-menu-item with-sub-nav">
                <?php echo anchor('dashboard/index', lang('personnel'), array('class'=>($active_link == 'personnel') ? 'active' : '')); ?>
                <ul class="sub-nav hide">
                    <li class="sub-nav-item">
                        <?php echo anchor('dashboard/index', lang('employee_profile')); ?>
                    </li>
                    <li class="sub-nav-item">
                        <?php echo anchor('dashboard/index', lang('employee_schedule')); ?>
                    </li>
                    <li class="sub-nav-item">
                        <?php echo anchor('dashboard/index', lang('employee_time_sheet_records')); ?>
                    </li>
                    <li class="sub-nav-item">
                        <?php echo anchor('dashboard/index', lang('employee_payroll')); ?>
                    </li>
                    <li class="sub-nav-item">
                        <?php echo anchor('dashboard/index', lang('employee_daily_time_records')); ?>
                    </li>
                    <li class="sub-nav-item">
                        <?php echo anchor('dashboard/index', lang('employee_cash_advance')); ?>
                    </li>
                </ul>
            </li>
            <li class="main-menu-item with-sub-nav">
                <?php echo anchor('dashboard/index', lang('inventory'), array('class'=>($active_link == 'inventory') ? 'active' : '')); ?>
                <ul class="sub-nav hide">
                    <li class="sub-nav-item">
                        <?php echo anchor('dashboard/index', lang('product_asset_list')); ?>
                    </li>
                    <li class="sub-nav-item">
                        <?php echo anchor('dashboard/index', lang('item_receiving')); ?>
                    </li>
                    <li class="sub-nav-item">
                        <?php echo anchor('dashboard/index', lang('item_withdrawal')); ?>
                    </li>
                    <li class="sub-nav-item">
                        <?php echo anchor('dashboard/index', lang('item_adjustment')); ?>
                    </li>
                </ul>
            </li>

            <li class="main-menu-item with-sub-nav">
                <?php echo anchor('dashboard/index', lang('reports'), array('class'=>($active_link == 'reports') ? 'active' : '')); ?>
                <ul class="sub-nav hide">
                    <li class="sub-nav-item">
                        <?php echo anchor('dashboard/index', lang('employee_profile_list')); ?>
                    </li>
                    <li class="sub-nav-item">
                        <?php echo anchor('dashboard/index', lang('employee_time_sheet_record')); ?>
                    </li>
                    <li class="sub-nav-item">
                        <?php echo anchor('dashboard/index', lang('customer_master_list')); ?>
                    </li>
                    <li class="sub-nav-item">
                        <?php echo anchor('dashboard/index', lang('customer_status_report')); ?>
                    </li>
                    <li class="sub-nav-item">
                        <?php echo anchor('dashboard/index', lang('customer_type_report')); ?>
                    </li>
                    <li class="sub-nav-item">
                        <?php echo anchor('dashboard/index', lang('industry_type_report')); ?>
                    </li>
                    <li class="sub-nav-item">
                        <?php echo anchor('dashboard/index', lang('customer_per_area_report')); ?>
                    </li>
                    <li class="sub-nav-item">
                        <?php echo anchor('dashboard/index', lang('sales_report')); ?>
                    </li>
                    <li class="sub-nav-item">
                        <?php echo anchor('dashboard/index', lang('product_list_report')); ?>
                    </li>
                    <li class="sub-nav-item">
                        <?php echo anchor('dashboard/index', lang('product_stock_report')); ?>
                    </li>
                    <li class="sub-nav-item">
                        <?php echo anchor('dashboard/index', lang('product_price_list_report')); ?>
                    </li>
                    <li class="sub-nav-item">
                        <?php echo anchor('dashboard/index', lang('supplies_list_report')); ?>
                    </li>
                    <li class="sub-nav-item">
                        <?php echo anchor('dashboard/index', lang('supplies_stock_report')); ?>
                    </li>
                    <li class="sub-nav-item">
                        <?php echo anchor('dashboard/index', lang('accounts_receivable_report')); ?>
                    </li><li class="sub-nav-item">
                        <?php echo anchor('dashboard/index', lang('accounts_receivable_summary')); ?>
                    </li>
                    <li class="sub-nav-item">
                        <?php echo anchor('dashboard/index', lang('company_payables_report')); ?>
                    </li>
                    <li class="sub-nav-item">
                        <?php echo anchor('dashboard/index', lang('sales_projection')); ?>
                    </li>
                    <li class="sub-nav-item">
                        <?php echo anchor('dashboard/index', lang('sales_forecasting')); ?>
                    </li>
                    <li class="sub-nav-item">
                        <?php echo anchor('dashboard/index', lang('income_statement')); ?>
                    </li>
                    <li class="sub-nav-item">
                        <?php echo anchor('dashboard/index', lang('balance_sheet')); ?>
                    </li>
                    <li class="sub-nav-item">
                        <?php echo anchor('dashboard/index', lang('cash_flow')); ?>
                    </li>
                </ul>
            </li>

            <li class="main-menu-item with-sub-nav">
                <?php echo anchor('dashboard/index', lang('system_records'), array('class'=>($active_link == 'system_records') ? 'active' : '')); ?>
                <ul class="sub-nav hide">
                    <li class="sub-nav-item">
                        <a href="#" class="sub-nav-a">File Maintenance</a>
                        <ul class="inner-nav hide">
                            <li>
                                <?php echo anchor('file_maintenance/company/index', lang('company_info')); ?>
                            </li>
                            <li>
                                <a href="Javascript:newPopup('/EBMS/apps/view/systemRecords/fileMaintenance/accountsManager/index.php',570,630)" id="sub-inner-a">
                                    Accounts Manager
                                </a>
                            </li>
                            <li>
                                <a href="Javascript:newPopup('/EBMS/apps/view/systemRecords/fileMaintenance/accountSubCategoryManager/index.php',570,630)" id="sub-inner-a">
                                    Account Sub Category Manager
                                </a>
                            </li>
                            <li>
                                <?php echo anchor('file_maintenance/employee_status/index', lang('employee_status_manager')); ?>
                            </li>
                            <li>
                                <?php echo anchor('file_maintenance/position/index', lang('position_manager')); ?>
                            </li>
                            <li>
                                <?php echo anchor('file_maintenance/department/index', lang('department_manager')); ?>
                            </li>
                            <li>
                                <?php echo anchor('file_maintenance/area_type/index', lang('area_type_manager')); ?>
                            </li>
                            <li>
                                <a href="Javascript:newPopup('/EBMS/apps/view/systemRecords/fileMaintenance/locationTypeManager/index.php',500,630)" id="sub-inner-a">
                                    Location Type Manager
                                </a>
                            </li>
                            <li>
                                <a href="Javascript:newPopup('/EBMS/apps/view/systemRecords/fileMaintenance/customerTypeManager/index.php',490,630)" id="sub-inner-a">
                                    Customer Type Manager
                                </a>
                            </li>
                            <li>
                                <a href="Javascript:newPopup('/EBMS/apps/view/systemRecords/fileMaintenance/industryTypeManager/index.php',490,630)" id="sub-inner-a">
                                    Industry Type Manager
                                </a>
                            </li>
                            <li>
                                <a href="Javascript:newPopup('/EBMS/apps/view/systemRecords/fileMaintenance/categoryManager/index.php',490,630)" id="sub-inner-a">
                                    Category Manager
                                </a>
                            </li>
                            <li >
                                <a href="Javascript:newPopup('/EBMS/apps/view/systemRecords/fileMaintenance/subCategoryManager/index.php',530,630)" id="sub-inner-a">
                                    Sub Category Manager
                                </a>
                            </li>
                            <li>
                                <a href="Javascript:newPopup('/EBMS/apps/view/systemRecords/fileMaintenance/brandManager/index.php',530,630)" id="sub-inner-a">
                                    Brand Manager
                                </a>
                            </li>
                            <li>
                                <a href="Javascript:newPopup('/EBMS/apps/view/systemRecords/fileMaintenance/itemFieldManager/index.php',530,630)" id="sub-inner-a">
                                    Item Field Manager
                                </a>
                            </li>
                            <li >
                                <a href="Javascript:newPopup('/EBMS/apps/view/systemRecords/fileMaintenance/employeeLeaveManager/index.php',500,630)" id="sub-inner-a">
                                    Employee Leave Manager
                                </a>
                            </li>
                            <li>
                                <?php echo anchor('file_maintenance/unit/index', lang('unit_manager')); ?>
                            </li>
                            <li>
                                <?php echo anchor('file_maintenance/city/index', lang('city_manager')); ?>
                            </li>
                            <li >
                                <a href="Javascript:newPopup('/EBMS/apps/view/systemRecords/fileMaintenance/deductionManager/index.php',570,630)" id="sub-inner-a">
                                    Deduction Manager
                                </a>
                            </li>
                            <li>
                                <a href="Javascript:newPopup('/EBMS/apps/view/systemRecords/fileMaintenance/earningManager/index.php',570,630)" id="sub-inner-a">
                                    Earning Manager
                                </a>
                            </li>
                            <li>
                                <a href="Javascript:newPopup('/EBMS/apps/view/systemRecords/fileMaintenance/currencyManager/index.php',570,630)" id="sub-inner-a">
                                    Currency Manager
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="sub-nav-item">
                        <a href="#" class="sub-nav-a"><?php echo lang('user_management'); ?></a>
                        <ul class="inner-nav hide" id="user-management-nav">
                            <li >
                                <?php echo anchor('user_management/control_manager/', lang('control_manager'), array('class' => 'sub-nav-a')); ?>
                            </li>
                            <li >
                                <?php echo anchor('user_management/audit_trail/', lang('audit_trail'), array('class' => 'sub-nav-a')); ?>
                            </li>
                            <li >
                                <a href="/EBMS/apps/view/systemRecords/userManagement/approvalList/?page=systemRecords&menu=approval-list" id="sub-inner-a">Approval's List</a>
                            </li>
                        </ul>
                    </li>

                    <li class="sub-nav-item">
                        <?php echo anchor('users/'.Application::current_user()->id, lang('profile'), array('class'=>($active_link == 'system_records') ? 'active' : '')); ?>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <?php $this->load->view('layouts/application/notification'); ?>
</div>