<section class="left-sheet">
    <div id="home-sheet" class="page-cheats">
        <h3>Home</h3>
        <ul>
            <?php
                echo quick_view_label(array('class' => 'active-customer', 'label' => lang('active_customer')));
                echo quick_view_label(array('class' => 'inactive-customer', 'label' => lang('inactive_customer')));
                echo quick_view_label(array('class' => 'order-entry', 'label' => lang('order_entry')));
                echo quick_view_label(array('class' => 'total-collected', 'label' => lang('total_collected')));
                echo quick_view_label(array('class' => 'total-cash-on-hand', 'label' => lang('total_cash_on_hand')));
                echo quick_view_label(array('class' => 'total-sales', 'label' => lang('total_sales')));
                echo quick_view_label(array('class' => 'total-expense-voucher', 'label' => lang('total_expense_voucher')));
                echo quick_view_label(array('class' => 'total-expense-ap', 'label' => lang('total_expense_ap')));
                echo quick_view_label(array('class' => 'customer-relations-management', 'label' => lang('customer_relations_management')));
                echo quick_view_label(array('class' => 'sales-forecasting', 'label' => lang('sales_forecasting')));
            ?>
        </ul>
    </div>
    <div id="crud-options-sheet" class="page-cheats">
        <h3><?php echo lang('crud_options'); ?></h3>
        <ul>
            <?php
                echo quick_view_label(array('class' => 'add-new-record', 'label' => lang('add_new_record')));
                echo quick_view_label(array('class' => 'edit-existing-record', 'label' => lang('edit_existing_record')));
                echo quick_view_label(array('class' => 'delete-record', 'label' => lang('delete_record')));
                echo quick_view_label(array('class' => 'restore-deleted-record', 'label' => lang('restore_deleted_record')));
                echo quick_view_label(array('class' => 'edit-multiple-record', 'label' => lang('edit_multiple_record')));
                echo quick_view_label(array('class' => 'import-record', 'label' => lang('import_record')));
                echo quick_view_label(array('class' => 'transfer-asset', 'label' => lang('transfer_asset')));
            ?>
        </ul>
    </div>
    <div id="other-crud-options-sheet" class="page-cheats">
        <h3><?php echo lang('other_crud_options'); ?></h3>
        <ul>
            <?php
                echo quick_view_label(array('class' => 'add-record', 'label' => lang('add_record')));
                echo quick_view_label(array('class' => 'edit-record', 'label' => lang('edit_record')));
                echo quick_view_label(array('class' => 'delete-record', 'label' => lang('delete_record')));
                echo quick_view_label(array('class' => 'restore-record', 'label' => lang('restore_record')));
            ?>
        </ul>
    </div>
</section>
<section class="center-sheet">
    <div id="crm-sheet" class="page-cheats">
        <h3><?php echo lang('crm'); ?></h3>
        <ul>
            <?php
                echo quick_view_label(array('class' => 'location-icon', 'label' => lang('location_icon')));
                echo quick_view_label(array('class' => 'contact-per-location', 'label' => lang('contact_per_location')));
            ?>
        </ul>
    </div>
    <div id="sales-purchase-personnel-sheet" class="page-cheats">
        <h3><?php echo lang('sales_purchasing_personnel'); ?></h3>
        <ul>
            <?php
                echo quick_view_label(array('class' => 'pending-icon', 'label' => lang('pending_icon')));
                echo quick_view_label(array('class' => 'approved', 'label' => lang('approved')));
            ?>
        </ul>
    </div>
    <div id="accounting-sheet" class="page-cheats">
        <h3><?php echo lang('accounting'); ?></h3>
        <ul>
            <?php
                echo quick_view_label(array('class' => 'no-pending-cheques', 'label' => lang('no_pending_cheques')));
                echo quick_view_label(array('class' => 'with-pending-cheques', 'label' => lang('with_pending_cheques')));
                echo quick_view_label(array('class' => 'no-pending-cheques', 'label' => lang('no_pending_cheques')));
                echo quick_view_label(array('class' => 'ar-not-paid', 'label' => lang('ar_not_yet_paid')));
                echo quick_view_label(array('class' => 'cash-payment', 'label' => lang('cash_payment')));
                echo quick_view_label(array('class' => 'cheques-posted', 'label' => lang('cheques_that_are_already_posted')));
                echo quick_view_label(array('class' => 'cheques-not-posted', 'label' => lang('cheques_that_are_not_posted')));
                echo quick_view_label(array('class' => 'cheque-icon', 'label' => lang('cheque_icon')));
                echo quick_view_label(array('class' => 'expenses-icon', 'label' => lang('expenses_icon')));
                echo quick_view_label(array('class' => 'included-cheques', 'label' => lang('included_cheques_to_be_posted')));
                echo quick_view_label(array('class' => 'add-cheque', 'label' => lang('add_cheque')));
                echo quick_view_label(array('class' => 'add-record', 'label' => lang('add_record')));
                echo quick_view_label(array('class' => 'post-selected-cheques', 'label' => lang('post_selected_cheques')));
                echo quick_view_label(array('class' => 'clear-selected-cheques', 'label' => lang('clear_selected_cheques')));
                echo quick_view_label(array('class' => 'bank-record', 'label' => lang('bank_record')));
                echo quick_view_label(array('class' => 'bank-deposit-record', 'label' => lang('bank_deposit_record')));
                echo quick_view_label(array('class' => 'bank-withdrawal-record', 'label' => lang('bank_withdrawal_record')));
            ?>
        </ul>
    </div>
    <div id="purchasing-sheet" class="page-cheats">
        <h3><?php echo lang('purchasing'); ?></h3>
        <ul>
            <?php
                echo quick_view_label(array('class' => 'purchase-order-record', 'label' => lang('purchase_order_record')));
                echo quick_view_label(array('class' => 'supplier-record', 'label' => lang('supplier_record')));
            ?>
        </ul>
    </div>

</section>
<section class="right-sheet">
    <div id="personnel-sheet" class="page-cheats">
        <h3><?php echo lang('personnel'); ?></h3>
        <ul>
            <?php
                echo quick_view_label(array('class' => 'male-employee', 'label' => lang('male_employee')));
                echo quick_view_label(array('class' => 'female-employee', 'label' => lang('female_employee')));
                echo quick_view_label(array('class' => 'file-leave-record', 'label' => lang('file_leave_record')));
                echo quick_view_label(array('class' => 'employee-overtime-record', 'label' => lang('employee_overtime_record')));
                echo quick_view_label(array('class' => 'employee-work-experience', 'label' => lang('employee_work_experience')));
                echo quick_view_label(array('class' => 'educational-background-record', 'label' => lang('educational_background_record')));
                echo quick_view_label(array('class' => 'employee-icon', 'label' => lang('employee_icon')));
                echo quick_view_label(array('class' => 'day-schedule-record', 'label' => lang('day_schedule_record')));
                echo quick_view_label(array('class' => 'time-sheet-record', 'label' => lang('time_sheet_record')));
                echo quick_view_label(array('class' => 'payroll-record', 'label' => lang('payroll_record')));
                echo quick_view_label(array('class' => 'shortcut-for-payroll', 'label' => lang('add_records_shortcut_for_payroll')));
            ?>
        </ul>
    </div>
    <div id="inventory-sheet" class="page-cheats">
        <h3><?php echo lang('inventory'); ?></h3>
        <ul>
            <?php
                echo quick_view_label(array('class' => 'product-asset-record', 'label' => lang('product_asset_record')));
                echo quick_view_label(array('class' => 'maintenance-record', 'label' => lang('maintenance_record')));
            ?>
        </ul>
    </div>
    <div id="personnel-sheet" class="page-cheats">
        <h3><?php echo lang('other_icons'); ?></h3>
        <ul>
            <?php
                echo quick_view_label(array('class' => 'open-view-report', 'label' => lang('open_view_report')));
                echo quick_view_label(array('class' => 'delete-record', 'label' => lang('delete_record')));
                echo quick_view_label(array('class' => 'notifications', 'label' => lang('notifications')));
                echo quick_view_label(array('class' => 'completed-task', 'label' => lang('completed_task')));
                echo quick_view_label(array('class' => 'incomplete-task', 'label' => lang('incomplete_task')));
            ?>
        </ul>
    </div>

</section>