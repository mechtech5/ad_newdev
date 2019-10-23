
function court(court_type,court_code){
	if(court_type != 0){
		$.ajax({ 
			type:"GET",
			url:"/court_category/"+court_type,
			success:function(res){   	
				if(res.length !=0){
					$("#court_code").empty();

					$("#court_code").append('<option value="0">Select Court Type</option>');
					$.each(res,function(key,value){
						$("#court_code").append('<option value="'+value.court_code+'" ' + (value.court_code == court_code ? 'selected="selected"' : '' )+ '>'+value.court_name+'</option>');
					});
				}
				else{
					$("#court_code").empty();		              
				}
			}
		});
	}
	else{
		$("#court_code").empty();
	}
}

function case_subcategory(catg_code,subcatg_code){

	if(catg_code != 0){
		$.ajax({
		   type:"GET",
		   url:"/case_subcategory?catg_code="+catg_code,
		   success:function(res){               
		    if(res){
		        $("#case_subcategory").empty();
		      
		        $.each(res,function(key,value){
		            $("#case_subcategory").append('<option value="'+value.subcatg_code+'" ' + (value.subcatg_code == subcatg_code ? 'selected="selected"' : '' )+ ' >'+value.subcatg_desc+'</option>');
		        });
		   
		    }else{
		       $("#case_subcategory").empty();
		    }
		   }
		});
	}else{
		$("#case_subcategory").empty();
	}
}

function case_court(court_type,court_code){
	if(court_type != 0){
		$.ajax({ 
			type:"GET",
			url:"/court_category/"+court_type,
			success:function(res){   	
				
				if(res.length !=0){
					if(court_type =='2'){
						$('#court_code_label').empty().html('High Court <span class="text-danger">*</span>');
					}
					else{
						$('#court_code_label').empty().html('Court Name <span class="text-danger">*</span>')
					}
					$("#court_code").empty();

					//$("#court_code").append('<option value="0">Select Court Type</option>');
					$.each(res,function(key,value){
						$("#court_code").append('<option value="'+value.court_code+'" ' + (value.court_code == court_code ? 'selected="selected"' : '' )+ '>'+value.court_name+'</option>');
					});
				}
				else{
					$("#court_code").empty();		              
				}
			}
		});
	}
	else{
		$("#court_code").empty();
	}
}
function state(state_code,city_code){
	 if(state_code !='0'){
        $.ajax({
           type:"GET",
           url:"/city_fetch?state_code="+state_code,
           success:function(res){                     
            if(res){
                $("#city").empty();
                $.each(res,function(key,value){
                    $("#city").append('<option value="'+value.city_code+'" '+(value.city_code == city_code ? 'selected="selected"' : '' )+'>'+value.city_name+'</option>');
                });
           
            }else{
               $("#city").empty();
            }
           }
        });
    }else{
        $("#city").empty();
    }
}

function case_court_select(court_code, court_type, no_catg, cnr){
	if(court_type =='1'){
		$('#no_catg_div').show();
		
		$('#no_div').hide();
		$('#case_type_div').hide();
		$('#court_code_div').hide();
		$('#cnr_div').hide();
		$('#cnr_number_div').hide();

		var sno_catg = $('#no_catg').val();
		var no_catg =( no_catg !='0' ? no_catg : sno_catg ) ;
		
		if(no_catg == 'd_no'){
			$('#no_label').empty().html('Diary Number <span class="text-danger">*</span>');
			$('#no_div').show();

			$('#case_type_div').hide();

		}	
		else if(no_catg == 'c_no'){
			$('#no_label').empty().html('Case Number <span class="text-danger">*</span>');
			$('#no_div').show();
			$('#case_type_div').show();
		}
		else{
			$('#no_div').hide();
		}
		$('#no_catg').on('change',function(e){
			e.preventDefault();
			var no_catg = $(this).val();
			// alert(no_catg);
			if(no_catg == 'd_no'){
				$('#no_label').empty().html('Diary Number <span class="text-danger">*</span>');
				$('input[name="c_d_number"]').val('');
				$('#err_c_d_number').html('');
				$('#no_div').show();
				$('#case_type_div').hide();

			}	
			else if(no_catg == 'c_no'){
				$('#no_label').empty().html('Case Number <span class="text-danger">*</span>');
				$('input[name="c_d_number"]').val('');
				$('#err_c_d_number').html('');
				$('#no_div').show();
				$('#case_type_div').show();
			}
			else{
				$('#no_div').hide();
			}
		});
	}else if(court_type =='0'){
		$('#court_code_div').hide();
		$('#no_catg_div').hide();
		$('#no_div').hide();
		$('#cnr_div').hide();
		$('#case_type_div').hide();
		$('#cnr_number_div').hide();
		$('#state_city_div').hide();
	}
	else if(court_type =='2' || court_type == '3'){	
		case_court(court_type,court_code);
		$('#no_catg_div').hide();	
		$('#no_div').hide();
		// $('#court_code_div').show();
		$('#cnr_div').show();
		var scnr = $('input[name="cnr"]:checked').val();

		var cnr = (cnr != '' ? cnr : scnr );

			
		if(cnr == '0'){
			if(court_type == '3'){
				$('#state_city_div').show();
				$('#court_code_div').hide();
			}
			else if(court_type == '2'){
				$('#court_code_div').show();
				$('#state_city_div').hide();
			}
				// $('#bench_code_div').show();
				$('#no_label').empty().html('Case Number <span class="text-danger">*</span>');
				$('#no_div').show();
				$('#cnr_number_div').hide();
				$('#case_type_div').show();
			}
			else{
				
				$('#state_city_div').hide();					
				$('#court_code_div').hide();
				
				$('#no_div').hide();
				$('#cnr_number_div').show();
				$('#court_code_div').hide();
				$('#case_type_div').hide();
				// $('#bench_code_div').hide();
			}
		$('input[name="cnr"]').on('change', function(e){
			e.preventDefault();
			var cnr = $(this).val();
				if(cnr == '0'){
					if(court_type == '3'){
						$('#state_city_div').show();
						$('#court_code_div').hide();
					}
					else if(court_type == '2'){
						$('#court_code_div').show();
						$('#state_city_div').hide();

					}
				
					// $('#bench_code_div').show();
					$('#no_label').empty().html('Case Number <span class="text-danger">*</span>');
					$('#no_div').show();
					$('#cnr_number_div').hide();
					$('#case_type_div').show();
			}
			else{
				
				$('#cnr_number_div').show();
				$('#state_city_div').hide();
				$('#no_div').hide();
				$('#court_code_div').hide();				
				$('#case_type_div').hide();
				// $('#bench_code_div').hide();
			}
		})
	}
	else{
		$('#cnr_number_div').show();	
		$('#cnr_div').hide();
		$('#court_code_div').hide();
		$('#no_div').hide();
		$('#case_type_div').hide();
		$('#state_city_div').hide();
	}
	
}

function case_table(case_status,case_status_text,cust_id){
	$.ajax({
		type:"GET",
		url: '/cases_table?case_status='+case_status+"&cust_id="+cust_id,
		success:function(res){
			var case_text = case_status_text + ' Cases';
 			$('#case_status_label').empty().html(case_text);
			$('#table_div').empty().html(res);
		}
	})
}