$(document).ready(function(){
		$('.datepicker').datepicker({
			format:'yyyy-mm-dd'
		});
	
	$("#end_date,#start_date").on('focusout keyup',function(){
        var startDate = new Date($('#start_date').val()).getFullYear();
        var endDate = new Date($(this).val()).getFullYear();
        if(endDate != ''){
        	$("input[name='name']").val(startDate+'-'+endDate)
    	}
    });
});

	$('label.required').append('&nbsp;<strong class="text-danger">*</strong>&nbsp;');
	$('th.required').append('&nbsp;<strong class="text-danger">*</strong>&nbsp;');
	var form = $("#example-form1");
	form.validate({   
	    rules: {
	    	start_date:{
	    		required:true,
	    		date:true
	    	},
	    	end_date:{
	    		greaterthan: true,
	    		required:true,
	    		date:true
	    	}
	    },
	errorElement: "em",
	errorPlacement: function errorPlacement(error, element) { 
		element.after(error);
		error.addClass( "help-block" );
	 },
	highlight: function ( element, errorClass, validClass ) {
		$( element ).parents( ".error-div" ).addClass( "has-error" ).removeClass( "has-success" );
	},
	unhighlight: function (element, errorClass, validClass) {
		$( element ).parents( ".error-div" ).addClass( "has-success" ).removeClass( "has-error" );
	},
	submitHandler: function (form) {
	                form.submit();
	                      }
	});
	$.validator.addMethod('greaterthan',function(value,element){
	var start_date =new Date($('#start_date').val());
	var end_date = new Date(value);
	// console.log(start_date.getFullYear()+1);
	if(end_date.getFullYear() > start_date.getFullYear() ){
		return true;
	}else{
		return false;
	}
	},"End date year should be greater than start date year.");
