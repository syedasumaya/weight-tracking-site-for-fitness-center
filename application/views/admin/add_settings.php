<?php //echo 123; exit();          ?>
<style>
    .top-cls{
        margin-top: 10px;
    }
</style>
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
            <div class="col-md-4">
                <!-- general form elements -->
                <div class="box box-primary">
                    
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
                    if (validation_errors() || $this->session->flashdata('loginerr')) {
                        ?>
                        <div class="alert alert-danger alert-dismissable">
                            <i class="fa fa-ban"></i>
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <b>Error!</b> <?php echo validation_errors(); ?>
                            <?php echo $this->session->flashdata('loginerr'); ?>
                        </div>
                    <?php } ?>


                    <div class="box-body">
                 
                       <form role="form" action="<?php echo base_url('admin/new_settings_add') ?>" method="post">
                         

                                <div class="form-group">
                                    <label>Location</label><input type="text" name="location" value="<?php echo set_value('location');  ?>" class="form-control" placeholder="Location" />
                                </div> 
                                <div class="form-group">
                                    <label>Total Kube</label><input type="text" name="total_kube" value="<?php echo set_value('total_kube');  ?>" class="form-control" placeholder="kube"/>
                                </div> 
                                <div class="form-group">

                                    <label>Total Sequence</label><input type="number" name="total_seq" value="<?php echo set_value('total_seq');  ?>" class="form-control" placeholder="Sequence"/>
                                </div> 

                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary">Add More</button>
                                </div>

                                <div class="box-footer">

                                </div>

                        
                        </form>    
                    </div><!-- /.box-body -->


                </div><!-- /.box -->
            </div><!--/.col (left) -->
           <div class="col-md-3"></div>
        </div>   <!-- /.row -->
    </section><!-- /.content -->
</aside><!-- /.right-side -->

<script type="text/javascript">
    function goBack() {
        window.history.back();
    }

    // Delete Confirmation Sweet Alert Popup

    jQuery('body').delegate('.del-request', 'click', function () {

        var $thisLayoutBtn = jQuery(this);
        var $href = jQuery(this).attr('href');
        //var makeChange = true;

        swal({
            title: 'Are you sure?',
            text: "This Sequence will be deleted!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            closeOnConfirm: false
        }).then(function (isConfirm) {
            if (isConfirm) {
                window.location.href = $href;
            }
        });


        return false;
    });
</script>      




