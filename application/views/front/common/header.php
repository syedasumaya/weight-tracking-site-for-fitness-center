<!DOCTYPE html>
<html>
    <head>
        <title>KUBE <?php echo $this->session->userdata('kubeid');?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, user-scalable=no">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/rsfrontend/css/iosOverlay.css" />
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		
        <link rel="stylesheet" href="<?php echo base_url();?>assets/rsfrontend/css/mystyle.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>assets/rsfrontend/js/spin.min.js"></script>
		<script src="<?php echo base_url();?>assets/rsfrontend/js/iosOverlay.js"></script>
    </head>
    <body class="backbody">
	  <div class="container">
           <div class="row">
				<?php //echo $this->uri->segment(1);
				$loc = $this->session->userdata('kubelocation');
				$seq = $this->session->userdata('kubeseq');
				$id = $this->session->userdata('kubeid');
				$par = $seq.'_'.$id;
				$var = $loc.$par;
				//echo   $id; exit;
				   if($this->uri->segment(1) == $var || $var != ' '){
				?>
				<div  class="col-md-12">
					<div class="fristh"> <h1> LOCATION: <?php echo $this->session->userdata('kubelocation');?> SEQUENCE <?php echo $this->session->userdata('kubeseq'); ?></h1></div> 
				</div>
               <?php }?>
			</div>
    </div>