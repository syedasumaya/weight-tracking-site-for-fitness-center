<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>Log in</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="<?php echo base_url();?>assets/admin/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?php echo base_url();?>assets/admin/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo base_url();?>assets/admin/css/adminlte.css" rel="stylesheet" type="text/css" />
    </head>
    <body class="bg-black">

        <div class="form-box" id="login-box">
            <div class="header">Sign In</div>
            <form action="<?php echo base_url('admin/login');?>" method="post">
                <div class="body bg-gray">
				<?php 
				if(validation_errors() ||$this->session->flashdata('loginerr')){
				?>
				 <div class="alert alert-danger alert-dismissable">
                  <i class="fa fa-ban"></i>
                   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <b>Error!</b> <?php echo validation_errors();?>
					<?php echo $this->session->flashdata('loginerr');?>
                  </div>
				  <?php } ?>
                    <div class="form-group">
                        <input type="text" name="username" class="form-control" placeholder="User Name"/>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password"/>
                    </div> 
                </div>
                <div class="footer">                                                               
                    <button type="submit" class="btn bg-olive btn-block">Sign me in</button>  
                  
                </div>
            </form>
        </div>


        <!-- jQuery 2.0.2 -->
        <script src="<?php echo base_url();?>assets/admin/js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="<?php echo base_url();?>assets/admin/js/bootstrap.min.js" type="text/javascript"></script>        

    </body>
</html>