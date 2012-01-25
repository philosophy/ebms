<!DOCTYPE HTML>
<html>
    <head>
        <title><?php echo isset($title) ? $title : $this->lang->line('ebms_home'); ?></title>
        <?php
            echo css_asset('reset.css');
            echo css_asset('body.css');
            echo css_asset('base.css');
            echo css_asset('home/index.css');
        ?>
    </head>
    <body>
        <?php
            $classname = $this->router->class . ' ' . $this->router->method ;
        ?>
        <div id="wrapper" class="<?php // echo $classname ?>">
            <?php if ($this->session->userdata('user_id')) { ?>
                <header>
                    <?php // $this->load->view('layouts/application/header') ?>
                </header>
                <section class="body">
                    SECTION
                    <?php // $this->load->view($content); ?>
                </section>
                <footer>

                </footer>
                <div id="content-wrapper">
                    <?php
                        if(isset($content)) {
    //                        $this->load->view($content);
                        }
                    ?>
                </div>

                <div id="footer">
                    <?php
    //                    $this->load->view('layout/application/footer');
                    ?>
                </div>
            <?php } else { 
                $this->load->view('home/index');
            } ?>
        </div>

        <?php 
//            echo js_asset('views/vp_pricing_ui.js');
        ?>
    </body>
</html>