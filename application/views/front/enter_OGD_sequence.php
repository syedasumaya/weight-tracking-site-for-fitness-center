           <style>
	     .highlight {
    background:#87c846 !important;
	color: #fff !important;
  }
       </style>
	   
	   
	   
	   
	   <div class="container">
           
            <div class="row">
                <div class="col-md-12">
                 
                    <div class="fifth">
                        <button class="btn btn-success rsbtn number2" data-val="1">1</button>
                        <button class="btn btn-success rsbtn number1" data-val="2">2</button>
                        <button class="btn btn-success rsbtn number2" data-val="3">3</button>
                        <button class="btn btn-success rsbtn number1" data-val="4">4</button>                    
                    </div>
                    <div class="fifth1">
                        <button class="btn btn-success button-enter enter">ENTER</button>  
                    </div>
                </div>
            </div>                  
        </div>  
         
   <script type="text/javascript">
            $(function () {
        
        $('.rsbtn').on('click', function (e) {
            e.preventDefault();
            var seq = $(this).attr('data-val');
          $('.button-enter').on('click', function (e) {
            e.preventDefault();
			$.ajax({
				method: "POST",
				url: "<?php echo base_url();?>set_initial_data",
				dataType: 'json',
				data: { sequence:  seq}
				})
			
            .done(function( data ) {
					window.location.href = "<?php echo base_url();?>enterpin";
				});

                    });
        });
        });
            

         </script> 
 <script>
$( ".rsbtn" ).on('click', function(e) {
	  e.preventDefault();
     $( ".rsbtn" ).removeClass( "highlight");
    $( this ).addClass( "highlight");
});
</script>		 