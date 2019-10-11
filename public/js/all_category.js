
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
