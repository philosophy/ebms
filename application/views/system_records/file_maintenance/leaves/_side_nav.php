<?php
   $data = array('list' => array('link' => 'file_maintenance/leaves/index', 'text' => lang('leaves_list')),
                  'create' => array('link' => 'file_maintenance/leaves/new_leave', 'text' => lang('create_leave')),
                  'archive' => array('link' => 'file_maintenance/leaves/archive', 'text' => lang('archive'))
        );
   $this->load->view('common/nav/left_nav_manager', $data);
?>