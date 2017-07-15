<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Settings Info
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
                        <h3 class="box-title">Settings Management</h3>
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

                    <div class="box-body">
                        <?php
                        //print_r($result); 
                        foreach ($result as $value) {
                            //print_r($value);
                        ?>
                        <form role="form" action="<?php echo base_url('admin/update_settings/'.$value['location']) ?>" method="post">
                            <div class="box-body">

                                <div class="form-group">
                                    <label>Location</label><input type="text" name="location" value="<?php echo $value['location'];  ?>" class="form-control" placeholder="Location" readonly/>
                                </div> 
                                <div class="form-group">
                                    <label>Total Kube</label><input type="text" name="total_kube" value="<?php echo $value['total_kube'];  ?>" class="form-control" placeholder="kube" />
                                </div> 
                                <div class="form-group">

                                    <label>Total Sequence</label><input type="number" name="total_seq" value="<?php echo $value['total_seq'];  ?>" class="form-control" placeholder="Sequence" />
                                </div> 

                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>

                                <div class="box-footer">

                                </div>

                            </div><!-- /.box-body -->
                        </form>    
                        <?php }?>

                    </div><!-- /.box -->
                </div><!--/.col (left) -->

                <div class="col-md-3"></div>
            </div>   <!-- /.row -->
            <div class="col-md-3"></div>
        </div>   <!-- /.row -->
    </section><!-- /.content -->
</aside><!-- /.right-side -->

