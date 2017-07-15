<?php //echo 123; exit();  ?>
<!-- Right side column. Contains the navbar and content of the page -->

<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Add Admin
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Admin Management</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <?php
                    if (validation_errors() || $this->session->flashdata('loginerr')) {
                        ?>
                        <div class="alert alert-danger alert-dismissable">
                            <i class="fa fa-ban"></i>
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <b>Error!</b> <?php echo validation_errors(); ?>
                            <?php echo $this->session->flashdata('loginerr'); ?>
                        </div>
                    <?php } ?>
                    <form  role="form" action="<?php echo base_url('admin/admin/add'); ?>" method="post">
                        <div class="box-body">
                            <div class="form-group">
                                <input type="text" name="username" value="<?php echo set_value('username'); ?>" class="form-control" placeholder="User name"/>
                            </div> 
                            <div class="form-group">
                                <input type="text" name="firstname" value="<?php echo set_value('firstname'); ?>" class="form-control" placeholder="Firstname"/>
                            </div> 
                            <div class="form-group">
                                <input type="text" name="lastname" value="<?php echo set_value('lastname'); ?>" class="form-control" placeholder="Lastname"/>
                            </div>
                            <div class="form-group">
                                <input type="text" name="email" value="<?php echo set_value('email'); ?>" class="form-control" placeholder="Admin Email"/>
                            </div> 
                            <div class="form-group">
                                <input type="password" name="password" value="<?php echo set_value('password'); ?>" class="form-control" placeholder="Admin Password"/>
                            </div> 
                            <div class="form-group">
                                <input type="text" name="phone" value="<?php echo set_value('phone'); ?>" class="form-control" placeholder="Admin Phone"/>
                            </div>                                

                            <div class="form-group">
                                <label>Manageable Area:</label>
                                
                                <table>
                                <tr>    
                                <td><label class="checkbox-inline"><input type="checkbox" name="add_edit_admin" value="1" checked>Add & Edit Admin</label></td>
                                <td><label class="checkbox-inline space14"><input type="checkbox" name="view_admin" value="1" checked>View Admin</label></td>
                                </tr>
                                
                                <tr>   
                                <td><label class="checkbox-inline space"><input type="checkbox" name="add_edit_member" value="1" checked>Add & Edit Member</label></td>
                                <td><label class="checkbox-inline "><input type="checkbox" name="view_member" value="1" checked>View Member</label></td>
                                </tr>   
                                
                                <tr>   
                                <td><label class="checkbox-inline space"><input type="checkbox" name="add_edit_location" value="1" checked>Add & Edit Location</label></td>
                                <td><label class="checkbox-inline space1"><input type="checkbox" name="view_location" value="1" checked>View Location</label></td>
                                </tr> 
                                
                                <tr>   
                                <td><label class="checkbox-inline space"><input type="checkbox" name="add_edit_settings" value="1" checked>Add & Edit Settings</label></td>
                                <td><label class="checkbox-inline space12"><input type="checkbox" name="view_settings" value="1" checked>View Settings</label></td>
                                </tr>  
                                
                                <tr>   
                                <td><label class="checkbox-inline space"><input type="checkbox" name="export_import_members" value="1" checked>Export/Import Members</label></td>
                                <td></td>
                                </tr>   
                                </table>
                            </div>

                            <div class="form-group">
                                <input type="text" name="type" value="Admin" class="form-control" readonly/>
                            </div> 
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Add Admin</button>
                            </div> 

                    </form>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!--/.col (left) -->
        <div class="col-md-3"></div>
        </div>   <!-- /.row -->
    </section><!-- /.content -->
</aside><!-- /.right-side -->


