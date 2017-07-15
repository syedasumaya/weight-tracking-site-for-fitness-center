<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Weight detail
        </h1>
    </section>
   
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Weight Increment</h3>   

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
                        <form action="<?php //echo base_url('admin/membersfil/filter/' . $this->uri->segment(4));    ?>" method="get">
                            <div class="row" style="margin-bottom: 10px;">
                                <div class="col-md-3">
                                </div>
                                <div class="col-md-3">


                                </div>
                                <div class="col-md-2">

                                </div>
                                <div class="col-md-2">

                                </div>
                            </div>
                        </form>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Location Name</th>
                                    <th>Sequence</th>
                                    <th>Kube Name</th>
                                    <th><?php if($this->uri->segment(2) == 'sgu_weight'){?>
                                        Exercise Name
                                    <?php }else{?>
                                        Equipment Name
                                    <?php }?>
                                    </th>
                                    <th>Weight Range</th>
                                    <th>Weight Increment</th>
                                    <th>Action</th>

                                </tr>
                            </thead>

                            <tbody>      
                               <?php if($this->uri->segment(2) == 'sgu_weight'){ ?>
                                <?php foreach ($sgu as $value) { ?>
                                    <tr>
                                        <td><?php echo 'SGU'; ?></td> 
                                        <td><?php echo $value->location_seq; ?></td> 
                                        <td><?php echo 'kube' . ' ' . $value->kube_name; ?></td> 
                                        <td><?php echo $value->exercise_name; ?></td> 
<?php if((($value->location_seq == 1) && (($value->kube_name == 21) || ($value->kube_name == 10) || ($value->kube_name == 26) || ($value->kube_name == 28))) || (($value->location_seq == 2) && (($value->kube_name == 8) || ($value->kube_name == 11) || ($value->kube_name == 27))) || (($value->location_seq == 3) && (($value->kube_name == 10) || ($value->kube_name == 27) || ($value->kube_name == 26)))){?>
                                        <td><?php echo $value->low_wgt_range . '-' . $value->end_range_1 . ' ' . 'lbs'; ?> & <?php echo $value->start_range_2 . '-' . $value->high_wgt_range . ' ' . 'lbs'; ?></td>
                                        <td><?php echo $value->wgt_inc; ?> & <?php echo $value->wgt_inc_2; ?></td> 

<?php }else{?>
                                        <td><?php echo $value->low_wgt_range . '-' . $value->high_wgt_range . ' ' . 'lbs'; ?></td> 
                                        <td><?php echo $value->wgt_inc; ?></td> 
<?php }?>
                                        <td><a href="<?php echo base_url();?>admin/edit_sgu/<?php echo $value->description_id;?>" title="Edit SGU Weight"><i class="fa fa-pencil-square-o"></i></a></td>
                                    </tr>                      
                               <?php } }else{?>   
                                    <?php foreach ($ogd as $value) { ?>
                                    <tr>
                                        <td><?php echo 'OGD'; ?></td> 
                                        <td><?php echo $value->location_seq; ?></td> 
                                        <td><?php echo 'kube' . ' ' . $value->kube_name; ?></td> 
                                        <td><?php echo $value->exercise_name; ?></td>                                         
                                        <td><?php echo $value->low_wgt_range . '-' . $value->high_wgt_range . ' ' . 'lbs'; ?></td> 
                                        <td><?php echo $value->wgt_inc.' '.'lbs'; ?></td> 
                                 
                                        <td><a href="<?php echo base_url();?>admin/edit_ogd/<?php echo $value->description_id;?>" title="Edit OGD Weight"><i class="fa fa-pencil-square-o"></i></a></td>
                                    </tr>                      
                                <?php } ?>
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
    $(document).ready(function () {
       
        function goBack() {
            window.history.back();
        }
    });
</script>