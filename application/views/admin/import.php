<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Import User Information
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
                    <b>Some users not imported. </b>
                <?php  $data_arr = $this->session->flashdata('err'); 
                          foreach ($data_arr as $key => $value){
                          print_r($value);?><br>
                         <?php     }
                     
                 ?>
                </div>
<?php } ?>		

            <form role="form" action="<?php echo base_url('admin/members/import_members') ?>" method="post" enctype="multipart/form-data">
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary my-box" style="padding-bottom: 20px !important;">
                        <div class="box-header">
                            <h3 class="box-title">Import</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body no-padding">
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-4">
                                  <input name="user" type="file" id="csv" /> 
                                 <input type="submit" name="Submit" value="Import User Info" style="margin-top: 10px;"/> 
                                </div>  
                           
                            </div>
                        </div><!-- /.box-body -->						
                    </div><!-- /.box -->   
                </div><!--/.col (right) -->
        </div>   <!-- /.row -->
    </section><!-- /.content -->
</aside><!-- /.right-side -->


