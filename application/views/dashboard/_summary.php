<div id="dashboard-summary">
    <header>
        <h2>SUMMARY</h2>
    </header>
    <p class="summary-date">As of <span><?php echo readable_time(array('format' => 'm/d/Y', 'date' => date($this->config->item('date_format')))); ?><span></p>
    <ul>
        <li class="header">
            <div class="context name">Name</div>
            <div class="value">Value</div>
        </li>
        <?php
            $context = array(
                array('context' => lang('new_customer'), 'context_class' => 'new-customer', 'value' => 0),
                array('context' => lang('total_active'), 'context_class' => 'total-active', 'value' => 0),
                array('context' => lang('total_inactive'), 'context_class' => 'total-inactive', 'value' => 0),
                array('context' => lang('total_order'), 'context_class' => 'total-order', 'value' => 0),
                array('context' => lang('total_collected'), 'context_class' => 'total-collected', 'value' => 0),
                array('context' => lang('cash_on_hand'), 'context_class' => 'cash-on-hand', 'value' => 0),
                array('context' => lang('total_sales'), 'context_class' => 'total-sales', 'value' => 0),
                array('context' => lang('exp_voucher'), 'context_class' => 'exp-voucher', 'value' => 0),
                array('context' => lang('exp_ap'), 'context_class' => 'exp-ap', 'value' => 0)
            );
            foreach($context as $con) {
                $this->load->view('dashboard/_summary_details', array('context' => $con['context'], 'context_class' => $con['context_class'], 'context_value' => $con['value']));
            }
        ?>
    </ul>
</div>