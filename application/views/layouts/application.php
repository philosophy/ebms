<!DOCTYPE HTML>
<html>
    <head>
        <title><?php echo isset($title) ? $title : $this->lang->line('ebms_home'); ?></title>
        <?php
            echo css_asset('base.css');
            echo css_asset('reset.css');
            echo css_asset('body.css');
            echo css_asset('header.css');
            echo css_asset('button.css');
            echo css_asset('footer.css');
            echo css_asset('home/index.css');
            echo js_asset('vendor/jquery-1.7.1.min.js');            
            echo js_asset('vendor/jquery.hoverIntent.js');
        ?>
    </head>
    <body>
        <?php
            $classname = $this->router->class . ' ' . $this->router->method ;
        ?>
        <div id="wrapper" class="<?php echo $classname ?>">
                <?php if(Application::is_user_logged_in()) { ?>
                    <header>
                        <?php 
                            $data['active_link'] = isset($active_link) ? $active_link : '';
                            $this->load->view('layouts/application/header', $data);
                        ?>
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
                            $this->load->view('layouts/application/footer_logged_in');
                        ?>
                    </div> 
                <?php } ?>
                
        </div>

        <?php             
            echo js_asset('app.js');
            echo js_asset('lib/header.js');
        ?>
    </body>
</html>