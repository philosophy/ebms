<div id="nav">
    <?php $this->load->view('layouts/application/_quick_view_nav'); ?>
    <div id="main-menu">
        <ul>
            <li class="main-menu-item">
                <?php echo anchor('dashboard/index', lang('home'), array('class' => ($active_link == 'home') ? 'active' : '')); ?>
            </li>

            <li class="main-menu-item">
                <?php echo anchor('dashboard/index', lang('crm'), array('class' => ($active_link == 'crm') ? 'active' : '')); ?>
            </li>

            <li class="main-menu-item with-sub-nav">
                <?php echo anchor('dashboard/index', lang('sales'), array('class' => ($active_link == 'sales') ? '' : '')); ?>
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
                <?php echo anchor('dashboard/index', lang('accounting'), array('class' => ($active_link == 'accounting') ? 'active' : '')); ?>
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
                <?php echo anchor('dashboard/index', lang('purchasing'), array('class' => ($active_link == 'purchasing') ? 'active' : '')); ?>
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
                <?php echo anchor('employees/p', lang('personnel'), array('class' => ($active_link == 'personnel') ? 'active' : '')); ?>
                <ul class="sub-nav hide">
                    <li class="sub-nav-item">
                        <?php echo anchor('employees/profile', lang('employee_profile')); ?>
                    </li>
                    <li class="sub-nav-item">
                        <?php echo anchor('employee_schedules', lang('employee_schedule')); ?>
                    </li>
                    <li class="sub-nav-item">
                        <?php echo anchor('employee/time_sheets', lang('employee_time_sheet_records')); ?>
                    </li>
                    <li class="sub-nav-item">
                        <?php echo anchor('dashboard/index', lang('employee_payroll')); ?>
                    </li>
                    <li class="sub-nav-item">
                        <?php echo anchor('employee/time_records', lang('employee_daily_time_records')); ?>
                    </li>
                    <li class="sub-nav-item">
                        <?php echo anchor('dashboard/index', lang('employee_cash_advance')); ?>
                    </li>
                </ul>
            </li>
            <li class="main-menu-item with-sub-nav">
                <?php echo anchor('dashboard/index', lang('inventory'), array('class' => ($active_link == 'inventory') ? 'active' : '')); ?>
                <ul class="sub-nav hide">
                    <li class="sub-nav-item">
                        <?php echo anchor('inventory/items', lang('product_asset_list')); ?>
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
                <?php echo anchor('dashboard/index', lang('reports'), array('class' => ($active_link == 'reports') ? 'active' : '')); ?>
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
                <?php echo anchor('file_maintenance/company_info/index', lang('system_records'), array('class' => ($active_link == 'system_records') ? 'active' : '')); ?>
                <ul class="sub-nav hide">
                    <li class="sub-nav-item">
                        <a href="#" class="sub-nav-a">File Maintenance</a>
                        <ul class="inner-nav hide">

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
                                <?php echo anchor('file_maintenance/area/index', lang('area_manager')); ?>
                            </li>
                            <li>
                                <?php echo anchor('file_maintenance/brand/index', lang('brand_manager')); ?>
                            </li>
                            <li>
                                <?php echo anchor('file_maintenance/category/index', lang('category_manager')); ?>
                            </li>
                            <li>
                                <?php echo anchor('file_maintenance/city/index', lang('city_manager')); ?>
                            </li>
                            <li>
                                <?php echo anchor('file_maintenance/company_info/index', lang('company_info')); ?>
                            </li>
                            <li>
                                <?php echo anchor('file_maintenance/currency/index', lang('currency_manager')); ?>
                            </li>
                            <li>
                                <?php echo anchor('file_maintenance/customer/index', lang('customer_manager')); ?>
                            </li>
                            <li>
                                <?php echo anchor('file_maintenance/deduction/index', lang('deduction_manager')); ?>
                            </li>
                            <li>
                                <?php echo anchor('file_maintenance/department/index', lang('department_manager')); ?>
                            </li>
                            <li>
                                <?php echo anchor('file_maintenance/earning/index', lang('earning_manager')); ?>
                            </li>
                            <li>
                                <?php echo anchor('file_maintenance/leaves', lang('employee_leave_manager')); ?>
                            </li>
                            <li>
                                <?php echo anchor('file_maintenance/industry/index', lang('industry_manager')); ?>
                            </li>
                            <li>
                                <a href="Javascript:newPopup('/EBMS/apps/view/systemRecords/fileMaintenance/itemFieldManager/index.php',530,630)" id="sub-inner-a">
                                    Item Field Manager
                                </a>
                            </li>
                            <li>
                                <?php echo anchor('file_maintenance/location/index', lang('location_manager')); ?>
                            </li>
                            <li>
                                <?php echo anchor('file_maintenance/position/index', lang('position_manager')); ?>
                            </li>
                            <li >
                                <?php echo anchor('file_maintenance/sub_category/index', lang('sub_category_manager')); ?>
                            </li>
                            <li>
                                <?php echo anchor('file_maintenance/unit/index', lang('unit_manager')); ?>
                            </li>




                        </ul>
                    </li>
                    <li class="sub-nav-item">
                        <a href="#" class="sub-nav-a"><?php echo lang('user_management'); ?></a>
                        <ul class="inner-nav hide" id="user-management-nav">
                            <!-- update this condition - quick fix for now -->
                            <?php if ($this->current_avatar->id == 1) { ?>
                                <li>
                                    <?php echo anchor('file_maintenance/company/index', lang('company_manager')); ?>
                                </li>
                                <li >
                                    <?php echo anchor('user_management/control_manager/', lang('control_manager'), array('class' => 'sub-nav-a')); ?>
                                </li>
                            <?php } ?>
                            <li >
                                <?php echo anchor('user_management/audit_trail/', lang('audit_trail'), array('class' => 'sub-nav-a')); ?>
                            </li>
                            <li >
                                <a href="/EBMS/apps/view/systemRecords/userManagement/approvalList/?page=systemRecords&menu=approval-list" id="sub-inner-a">Approval's List</a>
                            </li>
                        </ul>
                    </li>

                    <li class="sub-nav-item">
                        <?php echo anchor('users/' . Application::current_user()->id, lang('profile'), array('class' => ($active_link == 'system_records') ? 'active' : '')); ?>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <?php $this->load->view('layouts/application/notification'); ?>
</div>