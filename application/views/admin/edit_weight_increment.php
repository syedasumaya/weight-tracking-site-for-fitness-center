<?php //echo 123; exit();     ?>
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Edit Weight
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
                        <h3 class="box-title">Edit Weight Increment</h3>
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
                    <form  role="form" action="<?php echo base_url('admin/update/'.$weight->description_id); ?>" method="post">
                        <?php //print_r($weight);?>
                        <div class="box-body">
                        <div class="form-group">
                            <div class="form-inline">
                                <?php if($weight->location_id == 1){?>
                                <label style="padding-right:">Exercise name:</label>
                                <input style="width:315px" type="text" name="exercise_name" value="<?php echo $weight->exercise_name; ?>" class="form-control" placeholder="Exercise name"/>
                                <?php }else{?>
                                  <label style="padding-right:">Equipment name:</label>
                                <input style="width:299px" type="text" name="exercise_name" value="<?php echo $weight->exercise_name; ?>" class="form-control" placeholder="Equipment name"/>   
                                <?php } ?>

                            </div> 
                        </div>
                        
                            <div class="form-group">
                                <div class="form-inline">
                                    <label style="padding-right:54px;">Kube:</label>
                                    <input style="width:110px" type="text" name="kube_name" value="<?php echo $weight->kube_name; ?>" class="form-control" placeholder="Kube" readonly/>
                                    <label style="padding-right:24px;padding-left:5px;">Sequence:</label>
                                    <input style="width:110px" type="text" name="location_seq" value="<?php echo $weight->location_seq; ?>" class="form-control" placeholder="Sequence" readonly/>
                                </div> 
                            </div>


                            <div class="form-group">
                                <div class="form-inline">
                                    <label>Weight Range:</label>
                                    <input style="width:155px" type="text" name="low_wgt_range" value="<?php echo $weight->low_wgt_range; ?>" class="form-control" placeholder="Low range"/>
                                    <span>-</span>
                                    <input style="width:155px" type="text" name="high_wgt_range" value="<?php echo $weight->high_wgt_range; ?>" class="form-control" placeholder="High range"/>
                                    &nbsp;<span>lbs</span>
                                </div> 
                            </div> 
                            <div class="form-group">
                                <div class="form-inline">
                                    <label style="padding-right:21px">Increment:</label>
                                    <input style="width:319px" type="text" name="wgt_inc[]" value="<?php echo $weight->wgt_inc; ?>" class="form-control" placeholder="Weight Increment"/>
                                    &nbsp;<span>lbs</span>
                                </div> 
                            </div>
                            <input type="hidden" name="location_id" value="<?php echo $weight->location_id; ?>">
                            <input type="hidden" name="kube_name" value="<?php echo $weight->kube_name; ?>">
                            
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


