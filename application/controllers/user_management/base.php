<?php
    class Base extends Application {

        function __construct() {
            parent::__construct();
            Application::authenticate_user();
        }
    }
?>