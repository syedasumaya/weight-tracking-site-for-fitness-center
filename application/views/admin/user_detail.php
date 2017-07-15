<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            User detail
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Users Management</h3>                                    
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
                    <div class="box-body table-responsive">
                        <?php //echo $this->uri->segment(4); exit;?>
                        <form action="<?php echo base_url('admin/membersfil/filter/' . $this->uri->segment(4)); ?>" method="get">
                            <div class="row" style="margin-bottom: 10px;">
                                <div class="col-md-3">
                                    Select Location:
                                    <select name="location">
                                        <?php foreach ($location as $value) {?> 
                                        <option value="<?php echo $value->location_name;?>"><?php echo $value->location_name;?></option>
                                        <?php }?>
                                       
                                    </select> 
                                </div>
                                <div class="col-md-3">
                                    Select Sequence:
                                    <select name="sequence">
                                        <?php for ($i = 1; $i <= $seq->total; $i++) { ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php } ?>
                                    </select> 
                                </div>
                                <div class="col-md-2">
                                    Select Kube:
                                    <select name="kubeid">
                                        <option value="all">All</option>
                                        <?php for ($i = 1; $i <= $kube->total; $i++) { ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php } ?>
                                    </select> 
                                </div>
                                <div class="col-md-2">
                                    <input type="submit" value="Submit">
                                </div>
                            </div>
                        </form>
                        <table id="notUse_example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Location</th>
                                    <th>Sequence</th>
                                    <th>Kube ID</th>
                                    <th>Exercise Name</th>
                                    <th>Weight</th>
                                    <th>Date</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (is_array($result) && count($result)>0){
                                    foreach ($result as $row) {
                                        //print_r($result); die();
                                        $name = $row->firstname . ' ' . $row->lastname;
                                        ?>
                                        <tr>
                                            <td><?php echo $name; ?> </td>
                                            <td><?php echo $row->location; ?> </td>
                                            <td><?php echo $row->sequence; ?> </td>
                                            <td><?php echo $row->kube_name; ?> </td>
                                            <td><?php echo $row->exercise_name;?></td>
                                            <td><?php echo $row->userweight; ?> </td>
                                            <td><?php echo $row->date; ?> </td>

                                        </tr>
                                <?php } }else{?>
                                        <tr><td colspan="7">No result found!!!</td></tr>
                                <?php }?>
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
                    </div><!-- /.box-body -->
                </div><!-- /.box -->

            </div>   <!-- /.12 -->
        </div>   <!-- /.row -->
    </section><!-- /.content -->
</aside><!-- /.right-side -->

<script type="text/javascript">
    function goBack() {
        window.history.back();
    }
</script>