<?php
    $data['message'] = isset($message) ? $message : '';
    $data['email'] = isset($email) ? $email : '';
    $data['password'] = isset($password) ? $password : '';
    $this->load->view('home/index', $data);
?>

<!--<div id="login-wrapper">
    <section id="login-content">
        <div id="company-logo">
            <h1>Successfully logged out!</h1>
        </div>
        <?php
//            $data['message'] = isset($message) ? $message : '';
//            $data['email'] = isset($email) ? $email : '';
//            $data['password'] = isset($password) ? $password : '';
//            $this->load->view('user/login');
        ?>
    </section>
    <div id="login-footer">

    </div>
</div>-->