<div id="notifications">
    <a href="#" id="notification-link">
        <?php
            echo image_asset('icons/notifIcon.png', '', array('title' => lang('user_guide'), 'id' => 'notif-img'));
        ?>
    </a>
    <ul id="notification-list" class="hide">
        <li class='notif-items'>
            <a href='/EBMS/apps/view/accounting/companyPayables/?page=accounting&menu=company-payables' id="notif-payables">
                <i></i>
                <span class='title'><?php echo lang('payables'); ?></span>
                <span class='count'>0</span>
            </a>
        </li>
        <li class='notif-items'>
            <a href='/EBMS/apps/view/accounting/companyPayables/?page=accounting&menu=company-payables' id="notif-receivables">
                <i></i>
                <span class='title'><?php echo lang('receivables'); ?></span>
                <span class='count'>0</span>
            </a>
        </li>
        <li class='notif-items'>
            <a href='/EBMS/apps/view/accounting/companyPayables/?page=accounting&menu=company-payables' id="notif-task-reminder">
                <i></i>
                <span class='title'><?php echo lang('task_reminder'); ?></span>
                <span class='count'>0</span>
            </a>
        </li>
        <li class='notif-items'>
            <a href='/EBMS/apps/view/accounting/companyPayables/?page=accounting&menu=company-payables' id="notif-approvals">
                <i></i>
                <span class='title'><?php echo lang('approvals'); ?></span>
                <span class='count'>0</span>
            </a>
        </li>
        <li class='notif-items'>
            <a href='/EBMS/apps/view/accounting/companyPayables/?page=accounting&menu=company-payables' id="notif-critical-stock">
                <i></i>
                <span class='title'><?php echo lang('critical_stock_level'); ?></span>
                <span class='count'>0</span>
            </a>
        </li>
    </ul>
</div>