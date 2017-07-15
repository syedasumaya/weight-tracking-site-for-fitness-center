<!-- Left side column. contains the logo and sidebar -->
<?php $con = $this->uri->segment(1); ?>
<aside class="left-side sidebar-offcanvas">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url(); ?>assets/admin/img/default_photo.png" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>Hello, <?php echo $this->session->userdata('username'); ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i>Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <?php
        $this->load->model('admin/admin_model');
        $settings = $this->admin_model->getAdminsettingsInfoById($this->session->userdata('userid')); //print_r($settings);exit;
        $admin_id = $this->session->userdata('userid');
        if ($this->session->userdata('usertype') == 'super-admin') {
            $menu_array = array();
            $menu_array = array(
                //start dashboard
                array(
                        'menu_href' => 'admin/dashboard',
                        'icon' => '<i class="fa fa-tachometer" aria-hidden="true"></i>
                                <span>Dashboard</span>
                                <i class=""></i>',
                        'submenu' => 'true',
                        'condition' => 'Admin',
                        'permission_href' => 'admin/dashboard'
                    ),
                //start of my add part
                array(
                    'menu_href' => '',
                    'icon' => '<i class="fa fa-male"></i>
                                <span>Profile </span>
                                <i class="fa fa-angle-left pull-right"></i>',
                    'submenu' => 'true',
                    'condition' => 'Admin',
                    'permission_href' => '',
                    'submenu_arr' => array(
                        array(
                            'submenu_href' => 'admin/profile/' . $admin_id,
                            'submenu_icon' => '<i class="fa fa-angle-double-right"></i> Edit Profile',
                            'permission_href' => 'admin/profile/' . $admin_id
                        ),
                        array(
                            'submenu_href' => 'admin/change_pass/' . $admin_id,
                            'submenu_icon' => '<i class="fa fa-angle-double-right"></i>Change Password',
                            'permission_href' => 'admin/change_pass/' . $admin_id
                        ),
                    ),
                ), //end profile part
                array(
                    'menu_href' => '',
                    'icon' => '<i class="fa fa-fw fa-user"></i>
                                <span>Admin </span>
                                <i class="fa fa-angle-left pull-right"></i>',
                    'submenu' => 'true',
                    'condition' => 'super-admin',
                    'permission_href' => '',
                    'submenu_arr' => array(
                        array(
                            'submenu_href' => 'admin/admin/add',
                            'submenu_icon' => '<i class="fa fa-angle-double-right"></i> Add Admin',
                            'permission_href' => 'admin/admin/add'
                        ),
                        array(
                            'submenu_href' => 'admin/admin/detail',
                            'submenu_icon' => '<i class="fa fa-angle-double-right"></i>View Admins',
                            'permission_href' => 'admin/admin/detail'
                        ),
                    ),
                ), //end of my add part
                array(
                    'menu_href' => '',
                    'icon' => '<i class="fa fa-users"></i>
                                <span>Members</span>
                                <i class="fa fa-angle-left pull-right"></i>',
                    'submenu' => 'true',
                    'condition' => 'users',
                    'permission_href' => '',
                    'submenu_arr' => array(
                        array(
                            'submenu_href' => 'admin/members/add',
                            'submenu_icon' => '<i class="fa fa-angle-double-right"></i> Add Members',
                            'permission_href' => 'admin/members/add'
                        ),
                        array(
                            'submenu_href' => 'admin/members',
                            'submenu_icon' => '<i class="fa fa-angle-double-right"></i>View Members',
                            'permission_href' => 'admin/members'
                        ),
                    ),
                ),
                //start add location
                array(
                    'menu_href' => '',
                    'icon' => '<i class="fa fa-thumb-tack"></i>
                                <span>Location</span>
                                <i class="fa fa-angle-left pull-right"></i>',
                    'submenu' => 'true',
                    'condition' => 'weight',
                    'permission_href' => '',
                    'submenu_arr' => array(
                        array(
                            'submenu_href' => 'admin/location',
                            'submenu_icon' => '<i class="fa fa-angle-double-right"></i> Add location',
                            'permission_href' => 'admin/location'
                        ),
                        array(
                            'submenu_href' => 'admin/location_detail',
                            'submenu_icon' => '<i class="fa fa-angle-double-right"></i> View All locations',
                            'permission_href' => 'admin/location_detail'
                        ),
                    ),
                ),
                //end add location
                array(
                    'menu_href' => '',
                    'icon' => '<i class="fa fa-fw fa-wrench"></i> <span>Settings</span><i class="fa fa-angle-left pull-right"></i>',
                    'submenu' => 'true',
                    'condition' => 'Settings',
                    'permission_href' => '',
                    'submenu_arr' => array(
                        array(
                            'submenu_href' => 'admin/settings',
                            'submenu_icon' => '<i class="fa fa-angle-double-right"></i> View Settings',
                            'permission_href' => 'admin/settings'
                        ),
                        array(
                            'submenu_href' => 'admin/add_settings',
                            'submenu_icon' => '<i class="fa fa-angle-double-right"></i>Add More',
                            'permission_href' => 'admin/add_settings'
                        ),
                    ),
                ),
                array(
                    'menu_href' => '',
                    'icon' => '<i class="fa fa-fw fa-exchange"></i>
                                <span>Export/Import </span>
                                <i class="fa fa-angle-left pull-right"></i>',
                    'submenu' => 'true',
                    'condition' => 'export',
                    'permission_href' => '',
                    'submenu_arr' => array(
                        array(
                            'submenu_href' => 'admin/members/export',
                            'submenu_icon' => '<i class="fa fa-angle-double-right"></i> Export Members',
                            'permission_href' => 'admin/tools/export'
                        ),
                        array(
                            'submenu_href' => 'admin/members/import',
                            'submenu_icon' => '<i class="fa fa-angle-double-right"></i>Import Members',
                            'permission_href' => 'admin/members'
                        ),
                    ),
                ),
            );
        } else {

            $menu_array = array();
            $menu_array[] = array(
                        'menu_href' => 'admin/dashboard',
                        'icon' => '<i class="fa fa-tachometer" aria-hidden="true"></i>
                                <span>Dashboard</span>
                                <i class=""></i>',
                        'submenu' => 'true',
                        'condition' => 'Admin',
                        'permission_href' => 'admin/dashboard'
                    );
            $menu_array[] = array(
                'menu_href' => '',
                'icon' => '<i class="fa fa-male"></i>
                                <span>Profile </span>
                                <i class="fa fa-angle-left pull-right"></i>',
                'submenu' => 'true',
                'condition' => 'Admin',
                'permission_href' => '',
                'submenu_arr' => array(
                    array(
                        'submenu_href' => 'admin/profile/' . $admin_id,
                        'submenu_icon' => '<i class="fa fa-angle-double-right"></i> Edit Profile',
                        'permission_href' => 'admin/profile/' . $admin_id
                    ),
                    array(
                        'submenu_href' => 'admin/change_pass/' . $admin_id,
                        'submenu_icon' => '<i class="fa fa-angle-double-right"></i>Change Password',
                        'permission_href' => 'admin/change_pass/' . $admin_id
                    ),
                ),
            ); //end profile part

            foreach ($settings as $value) {

                // start view admin
                if ($value['add_edit_admin'] == 1) {
                    $menu_array[] = array(
                        'menu_href' => '',
                        'icon' => '<i class="fa fa-fw fa-user"></i>
                                <span>Admin </span>
                                <i class="fa fa-angle-left pull-right"></i>',
                        'submenu' => 'true',
                        'condition' => 'super-admin',
                        'permission_href' => '',
                        'submenu_arr' => array(
                            array(
                                'submenu_href' => 'admin/admin/add',
                                'submenu_icon' => '<i class="fa fa-angle-double-right"></i> Add Admin',
                                'permission_href' => 'admin/admin/add'
                            ),
                            array(
                                'submenu_href' => 'admin/admin/detail',
                                'submenu_icon' => '<i class="fa fa-angle-double-right"></i>View Admins',
                                'permission_href' => 'admin/admin/detail'
                            ),
                        ),
                    );
                }
                if (($value['add_edit_admin'] == 0) && ($value['view_admin'] == 1)) {
                    $menu_array[] = array(
                        'menu_href' => 'admin/admin/detail',
                        'icon' => '<i class="fa fa-fw fa-user"></i>
                                <span>View All Admins</span>
                                <i class=""></i>',
                        'submenu' => 'true',
                        'condition' => 'Admin',
                        'permission_href' => 'admin/admin/detail'
                    );
                }//end admin
                //start member
                if ($value['add_edit_member'] == 1) {
                    $menu_array[] = array(
                        'menu_href' => '',
                        'icon' => '<i class="fa fa-users" aria-hidden="true"></i>
                         <span>Members</span>
                         <i class="fa fa-angle-left pull-right"></i>',
                        'submenu' => 'true',
                        'condition' => 'users',
                        'permission_href' => '',
                        'submenu_arr' => array(
                            array(
                                'submenu_href' => 'admin/members/add',
                                'submenu_icon' => '<i class="fa fa-angle-double-right"></i> Add Members',
                                'permission_href' => 'admin/members/add'
                            ),
                            array(
                                'submenu_href' => 'admin/members',
                                'submenu_icon' => '<i class="fa fa-angle-double-right"></i>View Members',
                                'permission_href' => 'admin/members'
                            ),
                        ),
                    );
                }
                if (($value['add_edit_member'] == 0) && ($value['view_member'] == 1)) {
                    $menu_array[] = array(
                        'menu_href' => 'admin/members',
                        'icon' => '<i class="fa fa-users"></i>
                                <span>View Members</span>
                                <i class=""></i>',
                        'submenu' => 'true',
                        'condition' => 'Admin',
                        'permission_href' => 'admin/members'
                    );
                }//end member
                
               //start location
                if ($value['add_edit_location'] == 1) {
                    $menu_array[] = array(
                    'menu_href' => '',
                    'icon' => '<i class="fa fa-thumb-tack"></i>
                                <span>Location</span>
                                <i class="fa fa-angle-left pull-right"></i>',
                    'submenu' => 'true',
                    'condition' => 'weight',
                    'permission_href' => '',
                    'submenu_arr' => array(
                        array(
                            'submenu_href' => 'admin/location',
                            'submenu_icon' => '<i class="fa fa-angle-double-right"></i> Add location',
                            'permission_href' => 'admin/location'
                        ),
                        array(
                            'submenu_href' => 'admin/location_detail',
                            'submenu_icon' => '<i class="fa fa-angle-double-right"></i> View All locations',
                            'permission_href' => 'admin/location_detail'
                        ),
                    ),
                );
                }
                if (($value['add_edit_location'] == 0) && ($value['view_location'] == 1)) {
                    $menu_array[] = array(
                        'menu_href' => 'admin/location_detail',
                        'icon' => '<i class="fa fa-thumb-tack"></i>
                                <span>View Location</span>
                                <i class=""></i>',
                        'submenu' => 'true',
                        'condition' => 'Admin',
                        'permission_href' => 'admin/location_detail'
                    );
                }//end location  
                
                //start settings
                if ($value['add_edit_settings'] == 1) {
                  $menu_array[] =  array(
                    'menu_href' => '',
                    'icon' => '<i class="fa fa-fw fa-wrench"></i> <span>Settings</span><i class="fa fa-angle-left pull-right"></i>',
                    'submenu' => 'true',
                    'condition' => 'Settings',
                    'permission_href' => '',
                    'submenu_arr' => array(
                        array(
                            'submenu_href' => 'admin/settings',
                            'submenu_icon' => '<i class="fa fa-angle-double-right"></i> View Settings',
                            'permission_href' => 'admin/settings'
                        ),
                        array(
                            'submenu_href' => 'admin/add_settings',
                            'submenu_icon' => '<i class="fa fa-angle-double-right"></i>Add More',
                            'permission_href' => 'admin/add_settings'
                        ),
                    ),
                );
                }
                  if (($value['add_edit_settings'] == 0) && ($value['view_settings'] == 1)) {
                    $menu_array[] = array(
                        'menu_href' => 'admin/settings',
                        'icon' => '<i class="fa fa-fw fa-wrench"></i>
                                <span>View Settings</span>
                                <i class=""></i>',
                        'submenu' => 'true',
                        'condition' => 'Admin',
                        'permission_href' => 'admin/settings'
                    );
                }//end settings
                
                //start export/import
                if ($value['export_import_members'] == 1) {
                  $menu_array[] = array(
                    'menu_href' => '',
                    'icon' => '<i class="fa fa-fw fa-exchange"></i>
                                <span>Export/Import </span>
                                <i class="fa fa-angle-left pull-right"></i>',
                    'submenu' => 'true',
                    'condition' => 'export',
                    'permission_href' => '',
                    'submenu_arr' => array(
                        array(
                            'submenu_href' => 'admin/members/export',
                            'submenu_icon' => '<i class="fa fa-angle-double-right"></i> Export Members',
                            'permission_href' => 'admin/tools/export'
                        ),
                        array(
                            'submenu_href' => 'admin/members/import',
                            'submenu_icon' => '<i class="fa fa-angle-double-right"></i>Import Members',
                            'permission_href' => 'admin/members'
                        ),
                    ),
                );
                }
            }/* end foreach settings */
        }
        ?>
        <ul class="sidebar-menu">
            <?php
            //print_r($menu_array);exit;
            foreach ($menu_array as $key => $menu) {


                if ($menu['permission_href'] == '') {
                    ?>
                    <li <?php
                    if ($con == '' . $menu['condition'] . '' && $menu['submenu'] == 'true') {
                        echo 'class="treeview active"';
                    } elseif ($menu['submenu'] == 'false') {
                        
                    } else {
                        echo 'class="treeview"';
                    }
                    ?>>
                            <?php
                            echo '<a href="' . base_url('' . $menu['menu_href'] . '') . '">' . $menu['icon'] . '</a>';
                            if ($menu['submenu'] == 'true') {
                                echo '<ul class="treeview-menu">';
                                foreach ($menu['submenu_arr'] as $sub) {

                                    echo '<li> <a href="' . base_url('' . $sub['submenu_href'] . '') . '">' . $sub['submenu_icon'] . '</a> </li>';
                                }
                                echo '</ul>';
                            }
                            echo '</li>';
                        } else {
                            ?>
                    <li>
                        <?php
                        echo '<a href="' . base_url('' . $menu['menu_href'] . '') . '">' . $menu['icon'] . '</a>';
                        echo '</li>';
                    }
                }
                ?>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

