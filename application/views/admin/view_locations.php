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
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Admin Locations Detail</h3>                                    
                    </div><!-- /.box-header -->	
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
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th>Location Name</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (is_array($result) && count($result))
                                    foreach ($result as $row) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row->location_name; ?> </td>
                                            <td>    
                                                <a href="<?php echo base_url('admin/view_location/' . $row->location_id); ?>" title="View and Add Location Sequence"><i class="fa fa-eye-slash"></i></a>

                                                <?php
                                                if ($this->session->userdata('usertype') != 'super-admin') {
                                                    $this->load->model('admin/admin_model');
                                                    $settings = $this->admin_model->getAdminsettingsInfoById($this->session->userdata('userid'));
                                                    foreach ($settings as $value) {
                                                        if ($value['add_edit_location'] == 1) {
                                                            ?>
                                                            <a href="<?php echo base_url('admin/edit_location/' . $row->location_id); ?>" title="Edit Location"><i class="fa fa-fw fa-edit"></i></a>
                                                            <a href="<?php echo base_url('admin/delete_location/' . $row->location_id); ?>" title="Delete Location" class="del-request" ><i class="fa fa-fw fa-trash-o"></i></a>
                                                        <?php }
                                                    }
                                                } else { ?>   
                                                    <a href="<?php echo base_url('admin/edit_location/' . $row->location_id); ?>" title="Edit Location"><i class="fa fa-fw fa-edit"></i></a>
                                                    <a href="<?php echo base_url('admin/delete_location/' . $row->location_id); ?>" title="Delete Location" class="del-request" ><i class="fa fa-fw fa-trash-o"></i></a>
                                                <?php } ?>
                                                </td>
                                            </tr>
        <?php } ?>
                            </tbody>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->

            </div>   <!-- /.12 -->
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
            text: "This Location will be deleted with all details!",
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
