<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Add Member
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
                        <h3 class="box-title">Member Management</h3>
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
                    <form  role="form" action="<?php echo base_url('admin/members/add'); ?>" method="post">
                        <div class="box-body">
                            <div class="form-group">
                                <input type="text" name="firstname" value="<?php echo set_value('firstname'); ?>" class="form-control" placeholder="Firstname"/>
                            </div> 
                            <div class="form-group">
                                <input type="text" name="lastname" value="<?php echo set_value('lastname'); ?>" class="form-control" placeholder="Lastname"/>
                            </div>

                            <div class="form-group">
                                <input type="text" name="memberid" value="<?php echo set_value('memberid'); ?>" class="form-control" placeholder="Member Id"/>
                            </div>   
                            
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Add Member</button>
                            </div> 

                    </form>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!--/.col (left) -->
        <div class="col-md-3"></div>
        </div>   <!-- /.row -->
    </section><!-- /.content -->
</aside><!-- /.right-side -->

