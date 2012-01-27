<?php
    echo form_open(site_url('users', 'sign_in'), array('id' => 'login_form'));
        echo form_label('Email', 'email');
        echo form_input(array('id' => 'email', 'name' => 'email'));
        echo form_label('Password', 'password');
        echo form_input(array('id' => 'password', 'name' => 'password'));
        echo form_button(array('id' => 'login_button', 'value' => 'Login', 'type' => 'submit', 'content' => 'Login'));
    echo form_close();
?>