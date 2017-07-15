<div class="container">           
	<div class="row">
		<center>
			<div id="invalidpin" class="alert alert-warning fade in" style="display:none; width:60%">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Invalid!</strong> PIN Provided.
			</div>
		</center>  
	</div>
</div>
<div class="container">      
	<div class="row">
		<div class="col-md-12">
			<div class="thirdh">
				<h1>ENTER YOUR</h1>
				<h1>MEMBERSHIP NUMBER</h1>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			<div class="firstinputbox">
				<input class="firstinput input" id="mypin" type="number" placeholder="Membership #" maxlength="6" style="margin-left: 6px !important;">
				
					<button class="btn btn-danger button-cancel btn-cl clear">CLEAR</button>
					<button class="btn btn-success button-enter btn-er enter1">ENTER</button>
			 
			</div>
		</div>
	</div>
</div>
<script>
    var clickcount = 0;
	
    $(function () {
        $('.rsbtn').on('click', function (e) {
            e.preventDefault();
            if (clickcount >= 6)
                return;
            var clickval = $(this).attr('data-val');
            var currentval = $('#mypin').val().toString();
            var newval = currentval + clickval.toString();
            $('#mypin').val(newval);
            clickcount++;
            if (clickcount == 6) {
                $('.button-enter').prop('disabled', false);
            }
        });

        $('.button-cancel').on('click', function (e) {
            e.preventDefault();
            clickcount = 0;
            $('#mypin').val('');
            $('.button-enter').prop('disabled', false);
        });


        $('.button-enter').on('click', function (e) {
            e.preventDefault();
            var currentval = $('#mypin').val().toString();
            $.ajax({
                method: "POST",
                url: "<?php echo base_url(); ?>checkpin",
                dataType: 'json',
                data: {pin: currentval}
            })
                    .done(function (data) {
                        if (data.success == 0) {
                            $('#invalidpin').show();
			    $('.button-enter').prop('disabled', true);
                        } else {
                            window.location.href = '<?php echo base_url(); ?>areyou';
                        }

                    });
        });

    });

/*
    $(document).ready(function () {
        var kubeid = '<?php echo $this->session->userdata('kubeid'); ?>';
        var segmentvalue = '<?php echo $this->uri->segment(1) ?>';
        if (typeof kubeid == 'undefined' || kubeid == '') {
                $('#myModal').modal({
                    show: true
					
                });
				$('.equipment').hide();
        }

        $('#get_data').on('click', function (e) {
            e.preventDefault();
	var location = $("#location").val();
     var seq= $(".sequence").val();
     var kube= '1';

	 if(location == 'SGU'){
	 var complate= location+seq+'_'+kube;
	 }else{
		 var complate= location+seq+'_'+kube+'A';
	 }
			 window.location.href = complate;
        });
		$('#location').on('change', function (e){
			e.preventDefault();
			 $('.sequence').find('option').remove();
			 
			 var html1='<option>Select sequence</option>';
			if($(this).val() == 'SGU'){
				
				var seq = SGU_seq;
			
				 for(i=1; i<=SGU_seq; i++) {
				 html1 += "<option value="+i+">"+i+"</option>";	
				 }
			}else{

				var seq = OGD_seq;
			       
				for(i=1; i<=OGD_seq; i++) {
                    html1 += "<option value="+i+">"+i+"</option>";	                
                }
			 
			}
			
			$('.sequence').append(html1);  

			
		});
    });
*/

</script>    