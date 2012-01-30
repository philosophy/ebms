<div id="nav">
    <div id="orb-cont">
        <a href=<?php echo base_url(); ?> >
            <?php echo image_asset('logo/orb.png', '', array('id' => 'orb-img')); ?>
        </a>
        
        <ul id="orb-nav" class="hide">
            <li id="orb-nav-list">
                <a href="#" id="orb-nav-a" class="quick-view" rel="user-guide" name="630">
                    <i></i>
                    <?php 
//                        echo image_asset('icons/guide-icon.png', '', array('title' => lang('user_guide'))); 
                        echo lang('user_guide');
                    ?>
                </a>
            </li>

            <li id="orb-nav-list">
                <a href="#" id="orb-nav-a" class="quick-view" rel="cheat-sheet" name="800">
                    <i></i>
                    <?php 
                        echo lang('cheat_sheet');
                    ?>
                </a>
            </li>

            <li id="orb-nav-list">
                <a href="#" id="orb-nav-a" class="quick-view" rel="about-us" name="500">
                    <i></i>
                    <?php 
                        echo lang('about_us');
                    ?>
                </a>
            </li>

            <li id="orb-nav-list">
                <a href="#" id="orb-nav-a" class="quick-view" rel="contact-us" name="500">
                    <i></i>
                    <?php 
                        echo lang('contact_us');
                    ?>
                </a>
            </li>

            <li id="orb-nav-list">
                <a href=<?php echo site_url('auth/logout'); ?> id="orb-nav-a" class="logout">
                    <i></i>
                    <?php
                        echo lang('logout');
                    ?>
                </a>
            </li>


        </ul>
    </div>
    <div id="main-menu">
        <ul>
            <li class="separate">
                <?php echo anchor('dashboard/index', lang('home'), array('class'=>($active_link == 'home') ? 'active' : '')); ?>
            </li>
            
            <li class="separate">
                <?php echo anchor('dashboard/index', lang('crm'), array('class'=>($active_link == 'crm') ? 'active' : '')); ?>
            </li>
            
            <li class="separate">
                <?php echo anchor('dashboard/index', lang('sales'), array('class'=>($active_link == 'sales') ? 'active' : '')); ?>
            </li>
            
            <li class="separate">
                <?php echo anchor('dashboard/index', lang('accounting'), array('class'=>($active_link == 'accounting') ? 'active' : '')); ?>
            </li>
            
            <li class="separate">
                <?php echo anchor('dashboard/index', lang('purchasing'), array('class'=>($active_link == 'purchasing') ? 'active' : '')); ?>
            </li>
            
            <li class="separate">
                <?php echo anchor('dashboard/index', lang('personnel'), array('class'=>($active_link == 'personnel') ? 'active' : '')); ?>
            </li>
            <li class="separate">
                <?php echo anchor('dashboard/index', lang('inventory'), array('class'=>($active_link == 'inventory') ? 'active' : '')); ?>
            </li>
            
            <li class="separate">
                <?php echo anchor('dashboard/index', lang('reports'), array('class'=>($active_link == 'reports') ? 'active' : '')); ?>
            </li>
            
            <li class="separate">
                <?php echo anchor('dashboard/index', lang('system_records'), array('class'=>($active_link == 'system_records') ? 'active' : '')); ?>
            </li>
        </ul>
    </div>
    <?php $this->load->view('layouts/application/notification'); ?>
</div>