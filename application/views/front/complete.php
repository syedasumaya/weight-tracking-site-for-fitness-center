<div class="container">
	<div class="row">
		<div class="col-md-12">
		<div class="fristh">
			<p class="lastp">WORKOUT COMPLETE!</p>
		</div>
		</div>
	</div>
	<div class="row">               
		<div class="col-md-12">
		<div class="fristh">
		   <p class="lastp2">DATA SAVED</p>
		</div>
		</div>
		<div class="clear-both"></div>
		<div class="col-md-12">
		<div class="forth">
			<h1 class="rs_complete">You'll be logged out within <span class="countnumber"> 5 </span> seconds...</h1>                   
		</div>
            </div>
		</div>
	</div>         
</div>
	
         
         <script type="text/javascript">
           var counter = 3;
           var countdown = setInterval(function(){
              // alert(counter);
               //console.log(counter);
               $('.countnumber').html(counter);
              counter--;
          if (counter === 0) {

              window.location.href= '<?php echo base_url().$next;?>';
           //clearInterval(countdown);
          }
          }, 1000);

         </script>