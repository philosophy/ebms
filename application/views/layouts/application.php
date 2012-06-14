<!DOCTYPE HTML>
<html>
    <head>
        <link rel="shortcut icon" href=<?php echo image_asset_url('logo/ebms-logo-mini.png'); ?> />
        <title><?php echo isset($title) ? $title : $this->lang->line('ebms_home'); ?></title>
        <?php $this->load->view('layouts/application/_css_files'); ?>

            <!--[if lt IE 9]>
            <script>
            document.createElement('header');
            document.createElement('nav');
            document.createElement('section');
            document.createElement('article');
            document.createElement('aside');
            document.createElement('footer');
            document.createElement('hgroup');
            </script>
            <![endif]-->
        <?php
            echo js_asset('vendor/jquery-1.7.1.min.js');
            echo js_asset('vendor/jquery-ui-1.8.17.custom.min.js');
            echo js_asset('vendor/jquery.hoverIntent.js');
            echo js_asset('vendor/jquery.rotate.1-1.js');
            echo js_asset('vendor/jquery.validate.js');
            echo js_asset('vendor/jquery.dataTables.min.js');
            echo js_asset('vendor/rails.js');
            echo js_asset('vendor/jquery-ui-timepicker-addon.js');
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
            $this->load->view('layouts/application/_js_files');
            $this->load->view('layouts/application/page_specific_javascript');
            $this->load->view('layouts/application/flash_message');
            $this->load->view('common/dialogs/_confirm_dialog');
            $this->load->view('layouts/application/_js_translations');

            $this->load->view('layouts/application/quick_view/_about_us');
            $this->load->view('layouts/application/quick_view/_contact_us');
            $this->load->view('layouts/application/quick_view/_cheat_sheet');
        ?>
    </body>
</html>
