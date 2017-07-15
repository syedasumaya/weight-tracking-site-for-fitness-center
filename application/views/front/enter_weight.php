<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="thirdh rsnexth1">
                <h1>KUBE <?php echo $this->session->userdata('kubeid'); ?></h1>
                <h1><span class="exercise-name"><?php echo $this->session->userdata('exercise_name'); ?></span></h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-6">
            <div class="currentinputbox">
                <span class="current">CURRENT</span> 
                <?php if (isset($current_weight->userweight) && !empty($current_weight->userweight)) { ?>
                    <input class="currentinput" type="text"  value="<?php echo $current_weight->userweight; ?>" placeholder="Current Weight" maxlength="3" readonly/>
                <?php } else { ?>
                    <input class="currentinput" type="text"  value="0" placeholder="Current Weight" maxlength="3" readonly/>
                <?php } ?>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-6">
            <div class="inc-dec-btn">
                <span class="current">NEW</span>
                <?php if (isset($current_weight->userweight) && !empty($current_weight->userweight)) { ?>
                    <input class="inc-dec-input input" type="text" id="mypin" value="<?php echo $current_weight->userweight; ?>" placeholder="" maxlength="3" readonly/>

                <?php } else { ?>
                    <input class="inc-dec-input input" type="text" id="mypin" value="0" placeholder="" maxlength="3" readonly/>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-6">
            <button type="button" id="subtract" class="btn btn-danger btn-cl dec-btn" style="background-color: #ed1c24 !important;"><img style ="height:100px" src="<?php echo base_url() ?>assets/frontend/img/minusico.png"></button>

        </div>
        <div class="col-md-6 col-sm-6 col-xs-6">
            <button type="button" id="add" class="btn btn-danger btn-cl inc-btn" style="background-color: #ed1c24 !important;"><img style ="height:100px" src="<?php echo base_url() ?>assets/frontend/img/plusico.png"></button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <!--<button type="button" class="btn btn-danger clear button-cancel btn-cl" >CLEAR</button>-->
            <button type="button" class="btn btn-success  button-enter btn-er save-btn"><span>SAVE & ADVANCE</span></button>
        </div>
        <div class="col-md-2"></div>
    </div>
    <input class="wgt_inc" type="hidden" name="wgt_inc" value="<?php echo $weight_range_inc->wgt_inc; ?>">
    <input class="location" type="hidden" name="location" value="<?php echo $location; ?>">
    <input class="locationid" type="hidden" name="location_id" value="<?php echo $this->session->userdata('locationid'); ?>">
    <input class="kubeid" type="hidden" name="kubeid" value="<?php echo $this->session->userdata('kubeid'); ?>">
    <input class="kubeseq" type="hidden" name="kubeseq" value="<?php echo $this->session->userdata('kubeseq'); ?>">

</div>

<script type="text/javascript">
    function getIndex(arr, arrlength, val) {
        for (var j = 0; j < arrlength; j++) {
            if (arr[j] == val) { //alert(j);

                return j;
            }
        }
    }
</script>

<script type="text/javascript">
    $(document).ready(function () {
        var wgt_inc = $('.wgt_inc').val().split(',');  //alert(wgt_inc);

        var low_wgt_range = wgt_inc[0]; //alert(low_wgt_range);
        var high_wgt_range = wgt_inc[wgt_inc.length-1]; //alert(high_wgt_range);

        var kubeid = $('.kubeid').val();  //alert(kubeid);
        var kubeseq = $('.kubeseq').val();  //alert(kubeseq);
        var locationid = $('.locationid').val();  //alert(locationid);


        //var loop = 0;
        var count = low_wgt_range;
        var singlecount = 0;

        var arrlength = wgt_inc.length;
        var mypinval = +$('#mypin').val(); //alert(mypinval);
        var index = getIndex(wgt_inc, arrlength, mypinval);  //alert(index); 

        if (typeof index !== 'undefined') {
            if (mypinval !== low_wgt_range) {
                var i = index;
            } else {
                var i = 0;
            }
        } else {
            i = 'invalid';
        }



        $("#add").click(function () {

                if (arrlength > 1) {
                    var mypinval = +$('#mypin').val();

                    if (mypinval >= high_wgt_range) {
                        return;
                    } else {
                        if (i == 'invalid') {
                            $('#mypin').val(low_wgt_range);
                            i = 0;
                            i++;
                        } else {
                            // alert(wgt_inc[i]);
                            $('#mypin').val(wgt_inc[i]);
                            i++;

                        }
                    }

                } else { //alert('sss');
                    var mypinval = +$('#mypin').val();
                    //alert(high_wgt_range);
                    if (mypinval >= high_wgt_range) { //alert('dsfcs');
                        return;
                    } else {
                        var value = +wgt_inc[0];
                        var newval = (mypinval + value);

                        if (newval >= high_wgt_range) {
                            $('#mypin').val(high_wgt_range);
                        } else {
                            $('#mypin').val(newval);
                        }

                    }
                    return singlecount++;
                }

        });



        $("#subtract").click(function () {

            if (i !== 'invalid') {
                i--;
            }
                if (arrlength > 1) { //alert(mypinval);
                    var mypinval = +$('#mypin').val();
                    if (mypinval <= low_wgt_range) {

                        return i = 1;
                    } else {
                        if (i == 'invalid') {
                            $('#mypin').val(low_wgt_range);
                            i = 1;
                            i--;
                        } else {

                            $('#mypin').val(wgt_inc[i]);

                        }
                    }


                } else {
                    var mypinval = +$('#mypin').val();

                    if (mypinval <= low_wgt_range) {
                        return;
                    } else {
                        if (singlecount == low_wgt_range) {
                            $('#mypin').val(low_wgt_range);
                        } else {
                            var value = +wgt_inc[0]; //alert(value);
                            var currval = +$('#mypin').val();
                            var newval = (currval - value); //alert(newval);
                            $('#mypin').val(newval);
                        }
                    }
                    return singlecount++;
                }

            
        });

        $(".button-cancel").click(function () {
            var counter = 0;
            $("#mypin").val(counter);
        });





        $('.button-enter').on('click', function (e) {
            e.preventDefault();
            var currentval = $('#mypin').val().toString();

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