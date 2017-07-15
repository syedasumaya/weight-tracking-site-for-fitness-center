<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="kubex">
                <h1>KUBE <?php echo $this->session->userdata('kubeid'); ?></h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="forth">
                <?php
                if (isset($exercise_name)) {
                    echo '<h1>' . $exercise_name . '</h1>';
                }
                ?>
                <!-- <h1>CHEST PRESS</h1>    -->                   
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <!--<div class="weighttex2">
                WEIGHT ADJUSTMENT
                FOR NEXT WORKOUT
                
        </div>-->
            <div class="weight" style="text-align: center;">
                <?php if (isset($weight) && !empty($weight)) { //print_r($weight);
                    foreach ($weight as $value) { ?>
                        <p>
                       <?php echo  $value; ?>
                         
                        </p> 
                    
<?php }
                       } else { ?>
                    <p class="rs_na">?</p>
               <?php } ?>
            </div> 
            <div class="weighttex3">
                 <h1><span class="">CURRENT WEIGHT</span></h1>
<?php if (isset($weight->userweight)) {?>
                <input type="hidden"  id="myoldweight" value="<?php echo $weight->userweight;?>"/>
    
<?php } ?>
                <button class="btn btn-success button-keep-current same">ADVANCE</button>  
                <button class="btn btn-danger change">CHANGE</button> 
                <button class="btn btn-info back">BACK</button> 
            </div>
        </div>

    </div>
</div>

<script type="text/javascript">
    $('.back').on('click', function (e) {
            e.preventDefault();
			var currentval = $('#myoldweight').val(); //alert(currentval);
			$.ajax({
                method: "POST",
                url: "<?php echo base_url(); ?>prev_weight",
                dataType: 'json',
				data: {weight: currentval}
                
            })
			.done(function( data ) {
					window.location.href = "<?php echo base_url();?>sameweight";
				});	
	
        });
</script>


<script type="text/javascript">
    var clickcount = 0;
    $(function () {


        $('.change').on('click', function (e) {
            e.preventDefault();
            window.location.href = '<?php echo base_url(); ?>enter_weight';
        });

        /*                 $('.rsbtn').on('click',function(e){
         e.preventDefault();
         if(clickcount >= 3) return;
         var clickval =$(this).attr('data-val');
         var currentval = $('#mypin').val().toString();
         var newval = currentval+clickval.toString();
         $('#mypin').val(newval);
         clickcount++;
         if(clickcount==3){
         $('.button-enter').prop('disabled', false);
         }
         }); */


        $('.button-keep-current').on('click', function (e) {
            e.preventDefault();

            var currentval = $('#myoldweight').val(); //alert(currentval);



            $.ajax({
                method: "POST",
                url: "<?php echo base_url(); ?>save_current_weight",
                dataType: 'json',
                data: {weight: currentval}
            })
                    .done(function (data) {
                        if (data.success == 1) {
                            if (data.kube_complete == 'kube_complete') {
                                window.location.href = '<?php echo base_url(); ?>complete';
                            } else {
                                if (data.newkube == 'newkube') {
                                    iosOverlay({
                                        onhide: function () {
                                            window.location.href = '<?php echo base_url(); ?>sameweight';
                                        }, // Function
                                        text: "Data saved... Preparing next kube... Please wait...",
                                        icon: null,
                                        spinner: null,
                                        duration: 2000, // in ms

                                    });
                                }

                            }

                        }

                    });
        });

    });


</script>    