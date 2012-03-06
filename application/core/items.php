<?php

    class Items extends Application {
        
        function __construct() {
            parent::__construct();
            Application::authenticate_user();
        }
        
    }
?>