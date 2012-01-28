<!DOCTYPE HTML>
<html>
    <head>
        <title><?php echo isset($title) ? $title : $this->lang->line('ebms_home'); ?></title>
        <?php
            echo css_asset('base.css');
            echo css_asset('reset.css');
            echo css_asset('body.css');
            echo css_asset('button.css');
            echo css_asset('home/index.css');
        ?>
    </head>
    <body>
        <?php
            $classname = $this->router->class . ' ' . $this->router->method ;
        ?>
        <div id="wrapper" class="<?php echo $classname ?>">
                <?php if(Application::is_user_logged_in()) { ?>
                    <header>
                        <?php $this->load->view('layouts/application/header') ?>
                    </header>
                <?php } ?>
                <div id="content-wrapper">
                    <?php
                        if(isset($content)) {
                            $this->load->view($content);
                        }
                    ?>
                </div>
                <?php if(Application::is_user_logged_in()) { ?>
                   <div id="footer">
                        <?php
                            $this->load->view('layouts/application/footer');
                        ?>
                    </div> 
                <?php } ?>
                
        </div>

        <?php 
//            echo js_asset('views/vp_pricing_ui.js');
        ?>
    </body>
</html>