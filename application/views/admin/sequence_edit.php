<?php //echo 123; exit();     ?>
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?php if(isset($title)){ echo $title;}?>
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
                        <h3 class="box-title">Edit <b><?php echo $result->location_name;?></b> Sequence</h3>
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
                    <form  role="form" action="<?php echo base_url('admin/update_sequence/'.$weight->description_id); ?>" method="post">
                        <?php //print_r($weight);?>
                        <div class="box-body">
                        <div class="form-group">
                            <div class="form-inline">
                                <label style="padding-right:15px;">Exercise name:</label>
                                <input style="width:315px" type="text" name="exercise_name" value="<?php echo $weight->exercise_name; ?>" class="form-control" placeholder="Exercise name"/>
                            </div> 
                        </div>
                        
                            <div class="form-group">
                                <div class="form-inline">
                                    <label style="padding-right:71px;">Kube:</label>
                                    <input style="width:110px" type="text" name="kube_name" value="<?php echo $weight->kube_name; ?>" class="form-control" placeholder="Kube" />
                                </div> 
                            </div>
                             <div class="form-group">
                                <div class="form-inline">
                                    <label style="padding-right:44px;">Sequence:</label>
                                    <input style="width:110px" type="text" name="location_seq" value="<?php echo $weight->location_seq; ?>" class="form-control" placeholder="Sequence" />
                                </div> 
                            </div>

                            <div class="form-group">
                                <div class="form-inline">
                                    <label style="padding-right:40px">Increment:</label>
                                    <input style="width:325px" type="text" name="wgt_inc[]" value="<?php echo $weight->wgt_inc; ?>" class="form-control" placeholder="Weight Increment"/>
                                    &nbsp;<span>lbs</span>
                                </div> 
                            </div>
                            <div class="form-group">
                                <div class="form-inline">
                                    <label style="padding-right:39px;">Sort Order:</label>
                                    <input style="width:110px" type="text" name="sort_order" value="<?php echo $weight->sort_order; ?>" class="form-control" placeholder="Sort Order" />
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


