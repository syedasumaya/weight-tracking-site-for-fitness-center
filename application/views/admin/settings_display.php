<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
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

                    <div  class="box-body">
                        <table  id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Location Name</th>
                                    <th>Sequence</th>
                                    <th>Kube</th>
                                     <?php if ($this->session->userdata('usertype') != 'super-admin') {
                                            $this->load->model('admin/admin_model');
                                            $settings = $this->admin_model->getAdminsettingsInfoById($this->session->userdata('userid'));
                                            foreach ($settings as $value) {
                                                if ($value['add_edit_settings'] == 1) {
                                                    ?>
                                    <th>Action</th>
                                     <?php }}}else{?>
                                         <th>Action</th>
                                  <?php   } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (is_array($result) && count($result)) {
                                    foreach ($result as $row) {
                                        //foreach ($row as $r) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['location']; ?></td>
                                            <td><?php echo $row['total_seq']; ?> </td>
                                            <td><?php echo $row['total_kube']; ?> </td>
                                            <?php  if ($this->session->userdata('usertype') != 'super-admin') {
                                            $this->load->model('admin/admin_model');
                                            $settings = $this->admin_model->getAdminsettingsInfoById($this->session->userdata('userid'));
                                            foreach ($settings as $value) {
                                                if ($value['add_edit_settings'] == 1) {
                                                    ?>
                                            <td>    
                                                <a href="<?php echo base_url('admin/edit_settings/' . $row['location']); ?>" title="Edit Settings"><i class="fa fa-fw fa-edit"></i></a>
                                                <a href="<?php echo base_url('admin/delete_settings/' . $row['location']);  ?>" title="Delete Settings" class="del-request" ><i class="fa fa-fw fa-trash-o"></i></a>
                                            </td>
                                            <?php }}}else{?>
                                            <td>    
                                                <a href="<?php echo base_url('admin/edit_settings/' . $row['location']); ?>" title="Edit Settings"><i class="fa fa-fw fa-edit"></i></a>
                                                <a href="<?php echo base_url('admin/delete_settings/' . $row['location']);  ?>" title="Delete Settings" class="del-request" ><i class="fa fa-fw fa-trash-o"></i></a>
                                            </td>
                                            <?php }?>
                                        </tr>
                                    <?php }
                                } ?>
                            </tbody>
                        </table>
                    </div><!-- /.box-body -->

                </div><!-- /.box -->
            </div><!--/.col (left) -->

            <div class="col-md-3"></div>
        </div>   <!-- /.row -->
        <div class="col-md-3"></div>
        </div>   <!-- /.row -->
    </section><!-- /.content -->
</aside><!-- /.right-side -->


<script type="text/javascript">
   
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


