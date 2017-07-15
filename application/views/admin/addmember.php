<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>Register</title>
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
            <div class="header">Register</div>
            <form action="<?php echo base_url('admin/register');?>" method="post">
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
                        <input type="text" name="username" value="<?php echo set_value('username');?>" class="form-control" placeholder="User Name"/>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password"/>
                    </div> 
					  <div class="form-group">
                        <input type="password" name="re_pass" class="form-control" placeholder="Retype Password"/>
                    </div>
                    <div class="form-group">
                        <input type="text" name="firstname" value="<?php echo set_value('firstname');?>" class="form-control" placeholder="Firstname"/>
                    </div> 
					 <div class="form-group">
                        <input type="text" name="lastname" value="<?php echo set_value('lastname');?>" class="form-control" placeholder="Lastname"/>
                    </div>
                    <div class="form-group">
                        <input type="text" name="email" value="<?php echo set_value('email');?>" class="form-control" placeholder="User Email"/>
                    </div> 
					 <div class="form-group">
                        <input type="text" name="user_type" value="<?php echo set_value('user_type');?>" class="form-control" placeholder="User Type"/>
                    </div> 
                </div>
                <div class="footer">                                                               
                    <button type="submit" class="btn bg-olive btn-block">Register</button>  
                   <a href="<?php echo base_url('login/login');?>" class="text-center">Back to login</a>
                </div>
            </form>
        </div>


        <!-- jQuery 2.0.2 -->
        <script src="<?php echo base_url();?>assets/admin/js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="<?php echo base_url();?>assets/admin/js/bootstrap.min.js" type="text/javascript"></script>        

    </body>
</html>