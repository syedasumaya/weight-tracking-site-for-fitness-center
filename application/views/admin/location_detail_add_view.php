<?php //echo 123; exit();              ?>
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
            <!--<div class="col-md-3"></div>-->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">View <?php echo $location->location_name; ?> Sequences</h3>
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


                    <div class="box-body table-responsive">
                        <table  class="table table-bordered table-striped">
                            <thead>
                                <tr>

                                    <th>Location Name</th>
                                    <th>Sequence</th>
                                    <th>Kube Name</th>
                                    <th>Exercise Name </th>
                                    <th>Weight Increment Rate</th>
                                    <th>Sort Order</th>

                                    <?php
                                    if ($this->session->userdata('usertype') != 'super-admin') {
                                        $this->load->model('admin/admin_model');
                                        $settings = $this->admin_model->getAdminsettingsInfoById($this->session->userdata('userid'));
                                        foreach ($settings as $value) {
                                            if ($value['add_edit_location'] == 1) {
                                                ?>
                                                <th>Action</th>
                                                <?php
                                            }
                                        }
                                    } else {
                                        ?> 
                                        <th>Action</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <style>
                                td.test { 
                                    word-break: break-all !important;
                                }
                            </style>
                            <tbody>
                                <?php
                                if (is_array($result) && count($result))
                                    foreach ($result as $row) {
                                        ?>
                                        <tr>
                                            <td><?php echo $location->location_name; ?></td>
                                            <td><?php echo $row->location_seq; ?> </td>
                                            <td><?php echo $row->kube_name; ?> </td>
                                            <td><?php echo $row->exercise_name; ?> </td>
                                            <td class="test"><?php echo $row->wgt_inc; ?> </td>
                                            <td><?php echo $row->sort_order; ?> </td>


                                            <?php
                                            if ($this->session->userdata('usertype') != 'super-admin') {
                                                $this->load->model('admin/admin_model');
                                                $settings = $this->admin_model->getAdminsettingsInfoById($this->session->userdata('userid'));
                                                foreach ($settings as $value) {
                                                    if ($value['add_edit_location'] == 1) {
                                                        ?> <td>  
                                                            <a href="<?php echo base_url('admin/edit_sequence/' . $row->description_id); ?>" title="Edit Sequence"><i class="fa fa-fw fa-edit"></i></a>
                                                            <a href="<?php echo base_url('admin/delete_sequence/' . $row->location_id . '/' . $row->description_id); ?>" title="Delete Sequence" class="del-request" ><i class="fa fa-fw fa-trash-o"></i></a>
                                                        </td>
                                                    <?php
                                                    }
                                                }
                                            } else {
                                                ?>   <td>
                                                    <a href="<?php echo base_url('admin/edit_sequence/' . $row->description_id); ?>" title="Edit Sequence"><i class="fa fa-fw fa-edit"></i></a>
                                                    <a href="<?php echo base_url('admin/delete_sequence/' . $row->location_id . '/' . $row->description_id); ?>" title="Delete Sequence" class="del-request" ><i class="fa fa-fw fa-trash-o"></i></a>  
                                                </td> <?php } ?>            

                                        </tr>
    <?php } ?>
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-md-4">
                                <button class="btn btn-primary btn-lg" onclick="goBack()" style="margin:24px 0 !important;">Go Back</button>
                            </div>

                            <div class="col-md-4"></div>

                            <!-- Pagination Small -->                            
                            <div class="col-md-4">
                                <ul class="pagination pagination-sm" style="float:right; margin: 10px 0 !important;">
<?php echo $pagination; ?>
                                </ul>
                            </div>

                        </div>
                        <hr/>

                        <?php
                        $this->load->model('admin/admin_model');
                        $settings = $this->admin_model->getAdminsettingsInfoById($this->session->userdata('userid'));
                        if ($this->session->userdata('usertype') == 'super-admin') {
                            $add_edit_location = 1;
                        } else {
                            foreach ($settings as $value) {

                                $add_edit_location = $value['add_edit_location'];
                            }
                        }
                        if ($add_edit_location == 1) {
                            ?>
                            <form  class="form-inline" role="form" action="<?php echo base_url('admin/add_location_sequence/' . $this->uri->segment(3)); ?>" method="post">     

                                <div class="main-div"> 
                                    <div class="box-header">
                                        <h3 class="box-title">Add Location Sequence</h3>
                                    </div><!-- /.box-header -->
                                    <input type="hidden" name="location_id" value="<?php echo $this->uri->segment(3); ?>" class="form-control" />
                                    <div class="form-group">
                                        <input type="text" name="location_seq" value="<?php echo set_value('location_seq'); ?>" class="form-control" placeholder="Location Sequence"/>
                                    </div> 

                                    <div class="form-group">
                                        <input type="text" name="kube_name" value="<?php echo set_value('kube_name'); ?>" class="form-control" placeholder="Kube Name"/>
                                    </div> 

                                    <div class="form-group">
                                        <input type="text" name="exercise_name" value="<?php echo set_value('exercise_name'); ?>" class="form-control" placeholder="Exercise Name"/>
                                    </div> 


                                    <div class="form-group">
                                        <input type="text" name="wgt_inc" value="<?php echo set_value('wgt_inc'); ?>" class="form-control" placeholder="Weight Increment Value"/>
                                    </div> 

                                    <div class="form-group">
                                        <input type="text" name="sort_order" value="<?php echo set_value('sort_order'); ?>" class="form-control" placeholder="Sort Order"/>
                                    </div> 
                                </div><!--main-div-->
                                <div class="box-footer">
                                    <button type="submit" id="add-location" class="btn btn-primary">Add Sequence</button>
                                </div>
                            </form>
<?php } ?>
                    </div><!-- /.box-body -->


                </div><!-- /.box -->
            </div><!--/.col (left) -->
            <!--<div class="col-md-3"></div>-->
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




