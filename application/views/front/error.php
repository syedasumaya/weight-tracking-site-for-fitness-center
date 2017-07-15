<div class="container">
<div class="row">
	<div class="col-md-12">
		<div class="kubex">
			<!--<h1>ERROR!</h1>-->
		</div>
	</div>
</div>


<div class="row">
<div class="col-md-12 text-center">
<p class="errorp1">Please Select Your Location By Typing URL</p>
<p class="errorp2">Select location from here:
    <?php foreach ($locations as $value) {
        //print_r($value->location_name);exit;?>
    <a href="<?php echo base_url();?><?php echo strtolower($value->location_name); ?>"><?php echo $value->location_name; ?></a> &nbsp;
  <?php  }?>
    
</p>
</div>
</div>
</div>