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
					if(isset($exercise_name)){
							echo '<h1>'.$exercise_name.'</h1>';
					}
						?>                      
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="thirdinputbox">
                        <div class="weight">
                            <?php if(isset($weight) && !empty($weight)){foreach ($weight as $value) {?>
                <p>
                            <?php   echo (int)$value;?>
                </p> <?php }}else{?>
                  <p class="rs_na">N/A</p>
                <?php }?>
                            </div> 

						<div class="weighttext">
                            <h1>CURRENT WEIGHT</h1>

                             <button class="btn rsbtn-yes btn2 btn-success advance">ADVANCE</button>							 
                        </div>
							
                    </div>
                </div>
            </div>
        </div>
		
		
		

     <script>
            $(function(){
                $('.rsbtn-yes').on('click',function(e){
                   e.preventDefault();
                   window.location.href= '<?php echo base_url();?>sameweight';
                });                

            });
            
            
         </script>     