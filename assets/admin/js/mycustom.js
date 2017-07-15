            $(function() {
                $("#example1").dataTable();
                $('#example2').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": false
                });
           
			

$(".update").click(function(){

	//event.preventDefault();
	var ID = $(this).attr('id'); //alert(ID);
	var price = $('#price_input_'+ID).val(); //alert(price);
	var sold = $('#sold_input_'+ID).val(); //alert(sold);
	var display = $('#display_input_'+ID).val();  //alert(display);
	var spec = $('#spec_input_'+ID).val(); //alert(spec);
	
	var url = baseurl+"login/updatevehicle";//alert(url);
	
	var mydata = "vid="+ID+"&price="+price+"&sold="+sold+"&display="+display+"&spec="+spec; //alert(mydata);
	
	 $.ajax({
	 type: "POST",
	 url: url,
	 data:mydata,
	 //cache: false,
	dataType:'json',

	 success: function(msg){
	
		if(msg.res == 1)
			{
				
				
				myData ="";
				
				url = baseurl+"admin/vehicleview";
					$.ajax({
					 type: "POST",
					 url: url,
					 data:myData,
					// cache: false,
					//dataType:'json',
				
					 success: function(html){
					 alert('Sucessfully Updated Data');
						  location.reload();
						  
					}
					});
			}
		
		  
		 }
	 });
});



 });