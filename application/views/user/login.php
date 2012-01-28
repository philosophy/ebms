<div id='login'>
    <div id="info-message">
        <?php echo isset($message) ? $message : ''; ?>
    </div>
    
    <?php echo form_open("auth/login", array('id' => 'login-form')); ?>

    <p>
        <label for="email">Email:</label>
        <?php
            
            $email = isset($email) ? $email : '';            
            echo form_input(array(
                'name' => 'identity',
                'id' => 'user-email',
                'maxlength' => 30,
                'value' => $email
            ));
        ?>
    </p>

    <p>
        <label for="password">Password:</label>
        <?php   
            $password = isset($password) ? $password : '';            
            echo form_input(array(
                'name' => 'password',
                'id' => 'user-email',
                'maxlength' => 30,
                'value' => $password
            ));
        ?>
    </p>

    <p id="remember-me">
        <?php echo form_checkbox('remember', '1', FALSE); ?>
        <label for="remember">Remember Me:</label>
    </p>

    <button type="submit" id="btn-submit" class="buttons">Login</button>
    <?php echo form_close(); ?>

</div>
