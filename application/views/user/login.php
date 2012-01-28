<div class='mainInfo'>

    <div class="pageTitle">Login</div>
    <div class="pageTitleBorder"></div>
    <p>Please login with your email address and password below.</p>

    <div id="infoMessage"><?php echo isset($message) ? $message : ''; ?></div>

    <?php echo form_open("auth/login"); ?>

    <p>
        <label for="email">Email:</label>
        <?php
            echo isset($email) ? form_input($email) : form_input(array(
                'name' => 'identity',
                'id' => 'user-email',
                'maxlength' => 30
            ));
        ?>
    </p>

    <p>
        <label for="password">Password:</label>
        <?php
            echo isset($password) ? form_input($password) : form_input(array(
                'name' => 'password',
                'id' => 'user-password'
            ));
        ?>
    </p>

    <p>
        <label for="remember">Remember Me:</label>
        <?php echo form_checkbox('remember', '1', FALSE); ?>
    </p>


    <p><?php echo form_submit('submit', 'Login'); ?></p>


    <?php echo form_close(); ?>

</div>
