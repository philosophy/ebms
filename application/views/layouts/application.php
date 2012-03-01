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
            echo css_asset('lib/clock.css');
            echo css_asset('lib/flash.css');
            echo css_asset('lib/dialog.css');
//            $index_css = $this->router->class.'/index.css';
//            echo css_asset($index_css);
            echo css_asset('home/index.css');
            echo css_asset('dashboard/index.css');
            echo css_asset('user/index.css');
            echo css_asset('user/edit.css');
            echo css_asset('user_management/control_manager/list.css');
            echo css_asset('user_management/audit_trail/index.css');
            echo css_asset('lib/table_list.css');
            echo css_asset('vendor/jquery-ui-1.8.17.custom.css');
            echo css_asset('vendor/jquery.dataTables.css');
            echo css_asset('lib/datepicker.css');
        ?>

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
            echo js_asset('lib/base.js');
            echo js_asset('lib/clock.js');
            echo js_asset('lib/header.js');
            echo js_asset('lib/confirm.js');
            echo js_asset('util/namespace_checker.js');
            echo js_asset('util/html5.js');
            echo js_asset('views/dashboard.js');
            echo js_asset('views/users.js');
            echo js_asset('views/control_manager.js');
            echo js_asset('views/company.js');
            echo js_asset('views/department.js');
            echo js_asset('views/area_type.js');
            echo js_asset('views/employee_status.js');
            echo js_asset('views/position.js');
            echo js_asset('views/unit.js');
            echo js_asset('views/category.js');
            echo js_asset('views/city.js');
            echo js_asset('views/industry.js');
            echo js_asset('views/location.js');
            echo js_asset('views/customer.js');
            echo js_asset('views/sub_category.js');
            echo js_asset('views/brand.js');
            echo js_asset('lib/flash.js');
        ?>
        <?php $this->load->view('layouts/application/page_specific_javascript'); ?>
        <?php $this->load->view('layouts/application/flash_message'); ?>
        <?php $this->load->view('common/dialogs/_confirm_dialog'); ?>
    </body>
</html>
