<?php //echo 123; exit();   ?>
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
                        <h3 class="box-title">Admin Add Location </h3>
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
                    if (validation_errors() || $this->session->flashdata('loginerr')) {
                        ?>
                        <div class="alert alert-danger alert-dismissable">
                            <i class="fa fa-ban"></i>
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <b>Error!</b> <?php echo validation_errors(); ?>
                        <?php echo $this->session->flashdata('loginerr'); ?>
                        </div>
<?php } ?>
                    <form  role="form" action="<?php echo base_url('admin/add_location'); ?>" method="post">
                        <div class="box-body">
                            <div class="form-group">
                                <div class="main-div">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <input type="text" name="location[]" value="<?php echo set_value('location'); ?>" class="form-control" placeholder="location"/>
                                        </div>
                                        <div class="col-md-2">
                                            <a id="plus-location" class="btn btn-primary">+</a>
                                        </div>
                                    </div> 
                                </div>
                                <div class="box-footer">
                                    <button type="submit" id="add-location" class="btn btn-primary">Add Location</button>
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
   var i = 0;
    $('#plus-location').click(function () {
        $('.main-div').append('<br><div class="row new_div_'+i+'"><div class="col-md-8"><input type="text" name="location[]" value="" class="form-control" placeholder="location"/></div><div class="col-md-2"><a  onClick="divFunction('+i+')" class="minus-location btn btn-danger">-</a></div></div>');
      i++;
    });
   function divFunction(i){
        $('.new_div_'+i).remove();
    }
   $('.minus-location').click(function () { 
      
   });
</script>

