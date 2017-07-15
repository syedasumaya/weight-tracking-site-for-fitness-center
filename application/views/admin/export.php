<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Export User Information
        </h1>
        <ol class="breadcrumb">

            <?php
            if (isset($breadcumbs)) {
                foreach ($breadcumbs as $val) {
                    echo '<li>' . $val . '</li>';
                }
            }
            ?>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <!-- form start -->
            <?php if ($this->session->flashdata('success') != '') { ?>
                <div class="alert alert-success alert-dismissable">
                    <i class="fa fa-check"></i>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <b>Success!</b> <?php echo $this->session->flashdata('success'); ?>
                </div>
            <?php
            }

            if (validation_errors() || $this->session->flashdata('err')) {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <i class="fa fa-ban"></i>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <b>Error!</b> <?php echo validation_errors(); ?>
                <?php echo $this->session->flashdata('err'); ?>
                </div>
<?php } ?>		

            <form role="form" action="<?php echo base_url('export/data') ?>" method="post" >
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary my-box" style="padding-bottom: 20px !important;">
                        <div class="box-header">
                            <h3 class="box-title">Export</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body no-padding">
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-4">
                                    <a href="" class="rsbtn-export">Click here to Export User Information</a>
                                </div>  
                                
                            </div>
             
                            <div class="row" style="margin-top: 10px;">
                                <?php if(file_exists(FCPATH."./user_info/user.csv")){?>
                                <div class="col-md-1"></div>
                                <div class="col-md-4">
                                      <button type="button" class="rsbtn-download btn2" >Download User Information</button> 
                               </div>  
                                <?php }?>
                            </div>
                        </div><!-- /.box-body -->						
                    </div><!-- /.box -->   
                </div><!--/.col (right) -->
        </div>   <!-- /.row -->
    </section><!-- /.content -->
</aside><!-- /.right-side -->

<script>
            $(function(){
                $('.rsbtn-export').on('click',function(e){
                  e.preventDefault();
                   window.location.href= '<?php echo base_url();?>admin/members/export_members';
                });
                 
               
                $('.rsbtn-download').on('click',function(e){
                   e.preventDefault();
                   window.location.href= '<?php echo base_url();?>admin/members/download_export_data';
                });                

            });
            
            
</script>    
    