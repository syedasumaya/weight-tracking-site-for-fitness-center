<!-- Right side column. Contains the navbar and content of the page -->
<style>
    
    .space{
       // padding-left: 120px;
    }
    .space1{
       // padding-left : 17px;
    }
    .space12{
       // padding-left : 21px;
    }
    .space13{
       // padding-left : 36px;
    }
    .space14{
       // padding-left : 31px;
    }
</style>
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Update Admin Info
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
                    if (validation_errors() || $this->session->flashdata('validation_err')) {
                        ?>
                        <div class="alert alert-danger alert-dismissable">
                            <i class="fa fa-ban"></i>
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <b>Error!</b> <?php echo validation_errors(); ?>
                            <?php echo $this->session->flashdata('validation_err'); ?>
                        </div>
                    <?php } ?>
                    <form role="form" action="<?php echo base_url('admin/admin/update/' . $result->id) ?>" method="post">
                        <div class="box-body">
                            <div class="form-group">
                                <input type="text" name="username" value="<?php if (isset($result->username) != '') echo set_value('username', $result->username); ?>" class="form-control" placeholder="Username"/>
                            </div> 
                            <div class="form-group">
                                <input type="text" name="firstname" value="<?php if (isset($result->firstname) != '') echo set_value('firstname', $result->firstname); ?>" class="form-control" placeholder="Firstname"/>
                            </div> 
                            <div class="form-group">
                                <input type="text" name="lastname" value="<?php if (isset($result->lastname) != '') echo set_value('lastname', $result->lastname); ?>" class="form-control" placeholder="Lastname"/>
                            </div>
                            <div class="form-group">
                                <input type="text" name="email" value="<?php if (isset($result->email) != '') echo set_value('email', $result->email); ?>" class="form-control" placeholder="Admin Email"/>
                            </div> 

                            <div class="form-group">
                                <input type="text" name="phone" value="<?php if (isset($result->phone) != '') echo set_value('phone', $result->phone); ?>" class="form-control" placeholder="Phone"/>
                            </div>
                         
                            <?php if(!empty($settings)) { ?>
                            <div class="form-group">
                                <label>Manageable Area:</label>
                                <label class="checkbox-inline">
                                     <?php foreach ($settings as $value) { ?>
                                    <table>
                                        <tr>
                                            <td><label class="checkbox-inline"><input type="checkbox" name="add_edit_admin"  value="1" <?php if(isset($value['add_edit_admin']) != '' && $value['add_edit_admin'] == 1){echo 'checked'; }?>>Add & Edit Admin</label></td>
                                            <td><label class="checkbox-inline"><input type="checkbox" name="view_admin" value="1" <?php if(isset($value['view_admin']) != '' && $value['view_admin'] == 1){echo 'checked'; }?>>View Admin</label></td>
                                        </tr>
                                        <tr>
                                            <td><label class="checkbox-inline"><input type="checkbox" name="add_edit_member"  value="1" <?php if(isset($value['add_edit_member']) != '' && $value['add_edit_member'] == 1){echo 'checked'; }?>>Add & Edit Member</label></td>
                                            <td><label class="checkbox-inline"><input type="checkbox" name="view_member" value="1" <?php if(isset($value['view_member']) != '' && $value['view_member'] == 1){echo 'checked'; }?>>View Member</label></td>
                                        </tr>
                                        <tr>
                                            <td><label class="checkbox-inline"><input type="checkbox" name="add_edit_location" value="1" <?php if(isset($value['add_edit_location']) != '' && $value['add_edit_location'] == 1){echo 'checked'; }?>>Add & Edit Location</label></td>
                                            <td><label class="checkbox-inline"><input type="checkbox" name="view_location" value="1" <?php if(isset($value['view_location']) != '' && $value['view_location'] == 1){echo 'checked'; }?>>View Location</label></td>
                                        </tr>
                                        <tr>
                                            <td><label class="checkbox-inline"><input type="checkbox" name="add_edit_settings" value="1" <?php if(isset($value['add_edit_settings']) != '' && $value['add_edit_settings'] == 1){echo 'checked'; }?>>Add & Edit Settings</label></td>
                                            <td><label class="checkbox-inline"><input type="checkbox" name="view_settings" value="1" <?php if(isset($value['view_settings']) != '' && $value['view_settings'] == 1){echo 'checked'; }?>>View Settings</label></td>
                                        </tr>
                                        <tr>
                                           <td> <label class="checkbox-inline"><input type="checkbox" name="export_import_members" value="1" <?php if(isset($value['export_import_members']) != '' && $value['export_import_members'] == 1){echo 'checked'; }?>>Export/Import Members</label></td>
                                          
                                        </tr>
                                    </table> 
                                <?php } ?>
                            </div>
                            <input type="hidden" name="hidden_val" value="1">
                            <?php } else{ ?>
                             <div class="form-group">
                                <label>Manageable Area:</label>
                                <table>
                                        <tr>
                                            <td><label class="checkbox-inline"><input type="checkbox" name="add_edit_admin"  value="1" <?php if(isset($value['add_edit_admin']) != '' && $value['add_edit_admin'] == 1){echo 'checked'; }?>>Add & Edit Admin</label></td>
                                            <td><label class="checkbox-inline"><input type="checkbox" name="view_admin" value="1" <?php if(isset($value['view_admin']) != '' && $value['view_admin'] == 1){echo 'checked'; }?>>View Admin</label></td>
                                        </tr>
                                        <tr>
                                            <td><label class="checkbox-inline"><input type="checkbox" name="add_edit_member"  value="1" <?php if(isset($value['add_edit_member']) != '' && $value['add_edit_member'] == 1){echo 'checked'; }?>>Add & Edit Member</label></td>
                                            <td><label class="checkbox-inline"><input type="checkbox" name="view_member" value="1" <?php if(isset($value['view_member']) != '' && $value['view_member'] == 1){echo 'checked'; }?>>View Member</label></td>
                                        </tr>
                                        <tr>
                                            <td><label class="checkbox-inline"><input type="checkbox" name="add_edit_location" value="1" <?php if(isset($value['add_edit_location']) != '' && $value['add_edit_location'] == 1){echo 'checked'; }?>>Add & Edit Location</label></td>
                                            <td><label class="checkbox-inline"><input type="checkbox" name="view_location" value="1" <?php if(isset($value['view_location']) != '' && $value['view_location'] == 1){echo 'checked'; }?>>View Location</label></td>
                                        </tr>
                                        <tr>
                                            <td><label class="checkbox-inline"><input type="checkbox" name="add_edit_settings" value="1" <?php if(isset($value['add_edit_settings']) != '' && $value['add_edit_settings'] == 1){echo 'checked'; }?>>Add & Edit Settings</label></td>
                                            <td><label class="checkbox-inline"><input type="checkbox" name="view_settings" value="1" <?php if(isset($value['view_settings']) != '' && $value['view_settings'] == 1){echo 'checked'; }?>>View Settings</label></td>
                                        </tr>
                                        <tr>
                                           <td> <label class="checkbox-inline"><input type="checkbox" name="export_import_members" value="1" <?php if(isset($value['export_import_members']) != '' && $value['export_import_members'] == 1){echo 'checked'; }?>>Export/Import Members</label></td>
                                          
                                        </tr>
                                    </table> 
                            </div>
                            <input type="hidden" name="hidden_val" value="0">
                            <?php }?>
                            <div class="form-group">
                                <input type="text" name="type" value="<?php if (isset($result->type) != '') echo set_value('type', $result->type); ?>" class="form-control" placeholder="Type" readonly/>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                    </form>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!--/.col (left) -->
        <div class="col-md-3"></div>
        </div>   <!-- /.row -->
    </section><!-- /.content -->
</aside><!-- /.right-side -->

