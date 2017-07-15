<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="thirdh">
				<h1>CONFIRM IDENTITY</h1>                       
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="secondinputbox">
				<div class="secondinput">
					<p class="name"><?php echo $name;?></p>                               
				</div>                        
				<button class="btn btn-danger rsbtn-no btn1 no">NO</button>
				<button class="btn btn-success rsbtn-yes btn2 yes">YES</button>
			</div>
		</div>
	</div>
</div>              
<script>
            $(function(){
                $('.rsbtn-no').on('click',function(e){
                  e.preventDefault();
                   window.location.href= '<?php echo base_url();?>logout';
                });
                
                $('.rsbtn-yes').on('click',function(e){
                   e.preventDefault();
                   window.location.href= '<?php echo base_url();?>sameweight';
                });                

            });
            
            
</script>    
    
  