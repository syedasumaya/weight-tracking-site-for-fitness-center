<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?php
            if (isset($title)) {
                echo $title;
            }
            ?>
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
                        <h3 class="box-title">Edit Password</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
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
                    <form role="form" action="<?php echo base_url('admin/update_pass/' . $result->id) ?>" method="post">
                        <div class="box-body">
                            <div class="form-group">
                                <input type="password" name="current_pass" value="" class="form-control" placeholder="Type current password"/>
                            </div> 
                            <div class="form-group">
                                <input type="password" name="new_pass" value="" class="form-control" placeholder="Type new password"/>
                            </div> 
                            <div class="form-group">
                                <input type="password" name="retype_new_pass" value="" class="form-control" placeholder="Retype new password"/>
                            </div>

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Update Password</button>
                            </div>
                        </div><!-- /.box-body -->
                    </form>

                </div><!-- /.box -->
            </div><!--/.col (left) -->
            <div class="col-md-3"></div>
        </div>   <!-- /.row -->
    </section><!-- /.content -->
</aside><!-- /.right-side -->

