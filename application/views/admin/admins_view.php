<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            All Admins
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Admin Management</h3>                                    
                    </div><!-- /.box-header -->	
                    <?php
                    if ($this->session->flashdata('success')) {
                        ?>
                        <div class="alert alert-success alert-dismissable">
                            <i class="fa fa-check"></i>
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <b>Success!</b> 
                            <?php echo $this->session->flashdata('success'); ?>
                        </div>
                    <?php } ?>
                    <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <?php if ($this->session->userdata('usertype') == 'super-admin') { ?>
                                        <th>Username</th>
                                    <?php } ?>
                                    <th>Firstname</th>
                                    <th>Lastname</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Manageable Area</th>
                                    <th>Type</th>
                                    <?php  if ($this->session->userdata('usertype') != 'super-admin') {
                                    $this->load->model('admin/admin_model');
                                    $settings = $this->admin_model->getAdminsettingsInfoById($this->session->userdata('userid'));
                                    foreach ($settings as $value) {
                                        if ($value['add_edit_admin'] == 1) {
                                            ?> 
                                            <th>action</th>
                                        <?php }
                                    }
                                    }else{ ?>
                                        <th>action</th>
                                 <?php   }
                                    ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (is_array($result) && count($result))
                                    foreach ($result as $row) {
                                        ?>
                                        <tr>
                                            <?php if ($this->session->userdata('usertype') == 'super-admin') { ?>
                                                <td><?php echo $row->username; ?> </td>
        <?php } ?>
                                            <td><?php echo $row->firstname; ?> </td>
                                            <td><?php echo $row->lastname; ?> </td>
                                            <td><?php echo $row->email; ?> </td>
                                            <td><?php echo $row->phone; ?> </td>
                                            <td><?php
                                                $settings = $this->admin_model->getAdminsettingsInfoById($row->id);
                                                if (!empty($settings)) {
                                                    foreach ($settings as $set) {
                                                        if ($set['add_edit_admin'] == 1) {
                                                            echo 'Add and Edit Admin' . '<br/>';
                                                        }
                                                        if ($set['view_admin'] == 1) {
                                                            echo 'View Admin' . '<br/>';
                                                        }
                                                        if ($set['add_edit_member'] == 1) {
                                                            echo 'Add and Edit Member' . '<br/>';
                                                        }
                                                        if ($set['view_member'] == 1) {
                                                            echo 'View Member' . '<br/>';
                                                        }
                                                        if ($set['add_edit_location'] == 1) {
                                                            echo 'Add and Edit Location' . '<br/>';
                                                        }
                                                        if ($set['view_location'] == 1) {
                                                            echo 'View Location' . '<br/>';
                                                        }
                                                        if ($set['add_edit_settings'] == 1) {
                                                            echo 'Add and Edit Settings' . '<br/>';
                                                        }
                                                        if ($set['view_settings'] == 1) {
                                                            echo 'View Settings' . '<br/>';
                                                        }
                                                        if ($set['export_import_members'] == 1) {
                                                            echo 'Export/Import Members' . '<br/>';
                                                        }
                                                    }
                                                } else {
                                                    ?>
                                                    <i class="fa fa-times" aria-hidden="true"></i>

                                                <?php }
                                                ?> </td>
                                            <td><?php echo $row->type; ?> </td>
                                            <?php
                                            if ($this->session->userdata('usertype') != 'super-admin') {
                                                $this->load->model('admin/admin_model');
                                                $settings = $this->admin_model->getAdminsettingsInfoById($this->session->userdata('userid'));
                                                foreach ($settings as $value) {
                                                    if ($value['add_edit_admin'] == 1) {
                                                        ?> 
                                                        <td>                            
                                                            <a href="<?php echo base_url('admin/admin/' . $row->id); ?>" title="Edit Admin"><i class="fa fa-fw fa-edit"></i></a>
                                                            <a href="<?php echo base_url('admin/admin/delete/' . $row->id); ?>" title="Delete Admin" onclick="return delete_data();" ><i class="fa fa-fw fa-trash-o"></i></a>
                                                        </td>
                <?php }
            }
        } else {
            ?>
                                                <td>                            
                                                    <a href="<?php echo base_url('admin/admin/' . $row->id); ?>" title="Edit Admin"><i class="fa fa-fw fa-edit"></i></a>
                                                    <a href="<?php echo base_url('admin/admin/delete/' . $row->id); ?>" title="Delete Admin" onclick="return delete_data();" ><i class="fa fa-fw fa-trash-o"></i></a>
                                                </td>  
        <?php } ?>
                                        </tr>
    <?php } ?>
                            </tbody>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->

            </div>   <!-- /.12 -->
        </div>   <!-- /.row -->
    </section><!-- /.content -->
</aside><!-- /.right-side -->

