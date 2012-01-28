<footer>
    <ul>
        <li>
            <p>Copyright &#169 EBMS; 2012. All rights reserved.</p>
        </li>
        <li>
            <?php 
                if (Application::is_user_logged_in()) {
                    echo anchor('auth/logout', 'Logout', array('')); 
                }
            ?>
        </li>
    </ul>
</footer>