@extends('lawschools.layouts.main')
@section('content')
<section class="content">
<style type="text/css">
	.wizard>.steps .done a,.wizard>.steps .done a:hover,.wizard>.steps .done a:active{background:#9dc8e2;color:#fff}
	.tabcontrol>.steps>ul>li.current{background:#fff;border:1px solid #bbb;border-bottom:0 none;padding:0 0 1px 0;margin-top:0}
	.tabcontrol>.steps>ul>li.current>a{padding:15px 30px 10px 30px}
	.wizard>.steps .current a,.wizard>.steps .current a:hover,.wizard>.steps .current a:active{background:#2184be;color:#fff;cursor:default}
	.wizard>.steps .error a,.wizard>.steps .error a:hover,.wizard>.steps .error a:active{background:#ff3111;color:#fff}
	.wizard>.steps .current-info,.tabcontrol>.steps .current-info,.wizard>.content>.title,.tabcontrol>.content>.title{position:absolute;left:-999em}
	.wizard>.actions{
		width: 100%;
	}	
	.wizard>.actions a, .wizard>.actions a:hover, .wizard>.actions a:active{
		background:#2184be;
		color:#fff;
		display:block;
		padding:.5em 1em;
		text-decoration:none;
		-webkit-border-radius:5px;
		-moz-border-radius:5px;
		border-radius:5px;
		margin: 0px 10px ;

	}
	.wizard>.actions .disabled a,.wizard>.actions .disabled a:hover,.wizard>.actions .disabled a:active{background:#eee;color:#aaa}

</style>
<div class="row">
	<div class="col-md-12 m-auto " >
		<div class="box box-primary">
			<div class="box-header with-border">
				@include('student.header')
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1 class="panel-title">Add Student</h1>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						<form id="example-form" action="{{route('student_detail.store')}}" method="post">
						    <div>
						        <h3>Basic Details</h3>
						        <section>
							        <div class="row form-group">
										<div class="col-md-12 error-div">
											<label >Student Photo</label>
											<input type="file" name="s_photo" id="s_photo" accept="image/*">
										</div>
									</div>
									<div class="row form-group">
										<div class="col-md-3 col-xs-6 col-sm-6 error-div">
											<label for="qual_catg_code" class="required">Degree</label>
											<select class="form-control " name="qual_catg_code" id="qual_catg">
												<option value="">Select Degree</option>
												@foreach($qual_catgs as $qual_catg)
													<option value="{{$qual_catg->qual_catg_code}}">{{$qual_catg->qual_catg_desc}}</option>
												@endforeach
											</select>
										</div>
										<div class="col-md-3 col-xs-6 col-sm-6 error-div">
											<label class="required">Courses</label>
											<select class="form-control " name="qual_catg" id="qual_course">
												
											</select>
										</div>
										<div class="col-md-3 col-xs-6 col-sm-6 error-div">
											<label class="required">Year</label>
											<select class="form-control " name="qual_year">
												<option value="">Select Admission Year</option>
												<option value="1">1 year</option>
												<option value="2">2 year</option>
												<option value="3">3 year</option>
												<option value="4">4 year</option>
												<option value="5">5 year</option>
											</select>
										</div>
										<div class="col-md-3 col-xs-6 col-sm-6 error-div">
											<label class="required">Batch</label>
											<select class="form-control " name="batch">
												<option>Select Admission Batch</option>
												<option value="1">2018-2019</optio\n>
												<option value="2">2019-2020</option>
											</select>
										</div>
									</div>
									<div class="row form-group">
										<div class="col-md-4 col-xs-6 col-sm-6 error-div">
											<label class="required">Admission Date</label>
											<input type="text" name="addm_date" class="form-control  datepicker" readonly="true" data-date-format="yyyy-mm-dd" placeholder="{{date('Y-m-d')}}">
										</div>
										<div class="col-md-4 col-sm-6 col-xs-6 error-div">
											<label class="">Admission/Enrollment Number</label>
											<input type="text" name="enroll_no" class="form-control ">
										</div>
										<div class="col-md-4 col-sm-6 col-xs-6 error-div">
											<label class="">Class Roll Number</label>
											<input type="text" name="enroll_no" class="form-control ">
										</div>
									</div>
									<div class="row form-group">
										<div class="col-md-3 col-sm-6 col-xs-6 error-div">
											<label class="required">First Name</label>
											<input type="text" name="f_name" id="f_name" class="form-control ">
										</div>								
										<div class="col-md-3 col-sm-6 col-xs-6 error-div">
											<label>Middle Name</label>
											<input type="text" name="m_name" id="m_name" class="form-control">
										</div>									
										<div class="col-md-3 col-sm-6 col-xs-6 error-div">
											<label class="required">Last Name</label>
											<input type="text" name="l_name" id="l_name" class="form-control ">
										</div>
										
									</div>		
									<div class="row form-group">
										<div class="col-md-4 col-sm-6 col-xs-6 error-div">
											<label class="required">Mobile Number</label>
											<input type="text" name="s_mobile" class="form-control " oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"> 
										</div>
										<div class="col-md-4 col-sm-6 col-xs-6 error-div">
											<label class="required">Date of Birth</label>
											<input type="text" name="s_dob" class="form-control datepicker " readonly="true" data-date-format="yyyy-mm-dd" placeholder="{{date('Y-m-d')}}">
										</div>
										<div class="col-md-4 col-sm-6 col-xs-6 error-div">
											<label class="">Email Address</label>
											<input type="text" name="s_email" class="form-control"> 
										</div>
									</div>	
									<div class="row form-group">
										<div class="col-md-4 col-sm-6 col-xs-6 error-div">
											<label class="required">Gender</label>
											<select name="gender" class="form-control ">
												<option value="">Select Gender</option>
												<option value="m">Male</option>
												<option value="f">Female</option>
												<option value="t">Other</option>
											</select>
										</div>
										<div class="col-md-4 col-sm-6 col-xs-6 error-div">
											<label class="required">Cast Category</label>
											<select class="form-control " name="s_catg">
												<option value="">Select Category</option>
												<option value="1">GEN</option>
												<option value="2">OBC</option>
												<option value="3">SC</option>
												<option value="4">ST</option>
												<option value="5">EWS</option>
												<option value="6">SBC</option>
												<option value="7">VJ-A</option>
												<option value="8">NT-B</option>
												<option value="9">NT-C</option>
												<option value="10">NT-D</option>
												<option value="11">Other</option>
											</select>
										</div>
										<div class="col-md-4 col-sm-6 col-xs-6">
											<label>Religion</label>
											<select class="form-control" name="s_relgion">
												<option value="">Select Religion</option>
												<option value="1">Hindu</option>
												<option value="2">Muslim</option>
												<option value="3">Sikh</option>
												<option value="4">Christian</option>
												<option value="5">Buddhist</option>
												<option value="6">Jain</option>
												<option value="7">Zoroastrianism</option>
												<option value="8">Other</option>
											</select>
										</div>
									</div>	
									<div class="row form-group">
										<div class="col-md-3 col-sm-6 col-xs-6">
											<label>Blood Group</label>
											<select class="form-control" name="blood_group">
												<option value="">Select Blood Group</option>
												<option value="1">A+</option>
												<option value="2">A-</option>
												<option value="2">B+</option>
												<option value="2">B-</option>
												<option value="2">O+</option>
												<option value="2">O-</option>
												<option value="2">AB+</option>
												<option value="2">AB-</option>
											</select>
										</div>
										<div class="col-md-3 col-sm-6 col-xs-6">
											<label>Specific Aliment</label>
											<input type="text" name="spe_aliement" class="form-control" placeholder="Mole on nose. etc">
										</div>
										<div class="col-md-3 col-sm-6 col-xs-6">
											<label>Age</label>
											<input type="text" name="age" class="form-control" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
										</div>
										<div class="col-md-3 col-sm-6 col-xs-6">
											<label>Nationality</label>
											<input type="text" name="nationality" class="form-control">
										</div>
									</div>
									<div class="row form-group" >
										<div class="col-md-3 col-sm-6 col-xs-6">
											<label>Taluka(Tehsil)</label>
											<input type="text" name="taluka" class="form-control">
										</div>
										<div class="col-md-3 col-sm-6 col-xs-6">
											<label>Mother tongue</label>
											<input type="text" name="taluka" class="form-control">
										</div>
										<div class="col-md-3 col-sm-6 col-xs-6">
											<label>Student SSMID</label>
											<input type="text" name="s_ssmid" class="form-control" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
										</div>
										<div class="col-md-3 col-sm-6 col-xs-6">
											<label>Family SSMID</label>
											<input type="text" name="f_ssmid" class="form-control" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
										</div>
									</div>
									<div class="form-group row">
										<div class="col-md-3 col-sm-6 col-xs-6 error-div">
											<label>Aadhar Card Number</label>
											<input type="text" name="aadhar_no" class="form-control" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
										</div>
									</div>
						        </section>
						        <h3>Academic Details</h3>
						        <section>
						        	<table class="table table-striped">
						        		<thead>
						        			<tr>
						        				<th class="required">Qualification</th>
						        				<th class="required">School/College</th>
						        				<th class="required">Board/University</th>
						        				<th class="required">Marks%</th>
						        				<th class="required">Year</th>
						        				<th></th>
						        			</tr>
						        		</thead>
						        		<tbody id="qual_field">
						        		
						        		</tbody>
						        	</table>
						          <div class="row form-group">
						          	<div class=""></div>
						          </div>
						        </section>
						        <h3>Parent Info</h3>
						        <section>
						            <div class="form-group row">
						            	<div class="col-sm-6 col-md-6 col-xs-6 error-div">
						            		<label class="">Father Photo</label>
						            		<input type="file" name="f_photo" class="" accept="image/*"> 
						            	</div>
						            	<div class="col-sm-6 col-md-6 col-xs-6 error-div">
						            		<label class="">Mother Photo</label>
						            		<input type="file" name="m_photo" class="" accept="image/*"> 
						            	</div>
						            </div>
						            <div class="row form-group">
						            	<div class="col-md-3 col-sm-6 col-xs-6 error-div">
						            		<label class="required">Father Name</label>
						            		<input type="text" name="father_name" class="form-control required">
						            	</div>
						            	<div class="col-md-3 col-sm-6 col-xs-6 error-div">
						            		<label >Mother Name</label>
						            		<input type="text" name="mother_name" class="form-control">
						            	</div>
						            	<div class="col-md-3 col-sm-6 col-xs-6 error-div">
						            		<label class="required">Father Mobile</label>
						            		<input type="text" name="f_mobile" class="form-control required" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
						            	</div>
						            	<div class="col-md-3 col-sm-6 col-xs-6 error-div">
						            		<label >Mother Mobile</label>
						            		<input type="text" name="m_mobile" class="form-control" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
						            	</div>
						            </div>
						            <div class="row form-group">
						            	<div class="col-md-3 col-sm-6 col-xs-6 error-div">
						            		<label>Father Employer</label>
						            		<input type="text" name="f_employer" class="form-control">
						            	</div>
						            	<div class="col-md-3 col-sm-6 col-xs-6 error-div">
						            		<label>Father Designation</label>
						            		<input type="text" name="f_designation" class="form-control">
						            	</div>
						            	<div class="col-md-3 col-sm-6 col-xs-6 error-div">
						            		<label>Mother Employer</label>
						            		<input type="text" name="m_employer" class="form-control">
						            	</div>
						            	<div class="col-md-3 col-sm-6 col-xs-6 error-div">
						            		<label>Mother Designation</label>
						            		<input type="text" name="m_designation" class="form-control">
						            	</div>
						            </div>
						            <div class="row form-group">
						            	<div class="col-md-3 col-sm-6 col-xs-6 error-div">
						            		<label>Father Qualification</label>
						            		<input type="text" name="f_qual" class="form-control">
						            	</div>
						            	<div class="col-md-3 col-sm-6 col-xs-6 error-div">
						            		<label>Father Occupation/Profession</label>
						            		<input type="text" name="f_occup" class="form-control">
						            	</div>
						            	<div class="col-md-3 col-sm-6 col-xs-6 error-div">
						            		<label>Mother Qualification</label>
						            		<input type="text" name="m_qual" class="form-control">
						            	</div>
						            	<div class="col-md-3 col-sm-6 col-xs-6 error-div">
						            		<label>Mother Occupation/Profession</label>
						            		<input type="text" name="m_occup" class="form-control">
						            	</div>
						            </div>
						            <div class="row form-group">
						            	<div class="col-md-6 col-sm-6 col-xs-6 error-div">
						            		<label>Father Annual Income</label>
						            		<input type="text" name="f_annul" class="form-control">
						            	</div>
						            	<div class="col-md-6 col-sm-6 col-xs-6 error-div">
						            		<label>Mother Annual Income</label>
						            		<input type="text" name="m_annul" class="form-control">
						            	</div>
						            </div>
						        </section>
						        <h3>Bank Details</h3>
						        <section>
						        	<div class="row form-group">
						        		<div class="col-md-6 col-sm-6 col-xs-6 error-div">
						        			<label>Bank Name</label>
						        			<input type="text" name="bank_name" class="form-control">
						        		</div>
						        		<div class="col-md-6 col-sm-6 col-xs-6 error-div">
						        			<label>Branch</label>
						        			<input type="text" name="branch_name" class="form-control">
						        		</div>

						        	</div>
						        	<div class="row form-group">
						        		<div class="col-md-4 col-sm-6 col-xs-6 error-div">
						        			<label>Account Name</label>
						        			<input type="text" name="acc_name" class="form-control">
						        		</div>
						        		<div class="col-md-4 col-sm-6 col-xs-6 error-div">
						        			<label>Account Number</label>
						        			<input type="text" name="acc_no" class="form-control" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
						        		</div>
						        		<div class="col-md-4 col-sm-6 col-xs-6 error-div">
						        			<label>IFSC CODE</label>
						        			<input type="text" name="ifsc_code" class="form-control" id="ifsc_code" >
						        		</div>
						        	</div>
						        </section>
						        <h3>Student Document</h3>
						        <section>
						          	<table class="table">
						          		<thead>
						          			<tr>
						          				<th>Title</th>
						          				<th>Description</th>
						          				<th>Upload</th>
						          			</tr>
						          		</thead>
						          	</table>
						        </section>
						    </div>
						    @csrf
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</section>
<script>
$(function () {
	$(".datepicker").datepicker({ 
		singleDatePicker: true,
		showDropdowns: true,
	});
});


$('label.required').append('&nbsp;<strong class="text-danger">*</strong>&nbsp;');
$('th.required').append('&nbsp;<strong class="text-danger">*</strong>&nbsp;');
var form = $("#example-form");

form.validate({   
    rules: {
		s_mobile:{
			minlength:10,
			maxlength:11,
		},
		age:{
			minlength:1,
			maxlength:2,

		},
		s_email:{
			email:true,
		},
		s_ssmid:{
			minlength:9,
			maxlength:9,
		},
		f_ssmid:{
			minlength:8,
			maxlength:8,
		},
		aadhar_no:{
			minlength:12,
			maxlength:12,
		},
		acc_no:{
			minlength:10,
			maxlength:19,
		},
		ifsc_code:{
			ifsc:true,
		},
		f_mobile:{
			minlength:10,
			maxlength:11,
		},
		'qual_name[]':{
			qual: true,
		},
		'qual_clg[]':{
			qual: true,
		},
		'qual_board[]':{
			qual: true,
		},
		'qual_marks[]':{
			qual:true,	
					
		},
		'qual_years[]':{
			qual:true,

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
	}
});

form.children("div").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    onStepChanging: function (event, currentIndex, newIndex)
    {
        form.validate().settings.ignore = ":disabled,:hidden";
        return form.valid();
    },
    onFinishing: function (event, currentIndex)
    {
        form.validate().settings.ignore = ":disabled";
        return form.valid();
    },
    onFinished: function (event, currentIndex)
    {
        form.submit();
    }
});
$(document).ready(function(){
	$('#qual_catg').on('change',function(e){
		e.preventDefault();
		var qual_catg_code = $(this).val();
		qual_course(qual_catg_code);
	});

	var i = 0;
	$('#qual_field').append('<tr id="row'+i+'"><td class="error-di"><input type="text" name="qual_name[]" class="form-control"></td><td class="error-di"><input type="text" name="qual_clg[]" class="form-control"></td><td class="error-di"><input type="text" name="qual_board[]" class="form-control"></td><td class="error-di"><input type="text" name="qual_marks[]" class="form-control"></td><td class="error-di"><input type="text" name="qual_years[]" class="form-control"></td><td><a class="btn btn-sm btn-success" id="add_row"><i class="fa fa-plus"></i></a></td></tr>');
	i++;
	 $('#add_row').click(function(){
	 	$('#qual_field').append('<tr id="row'+i+'"><td class="error-di"><input type="text" name="qual_name[]" class="form-control"></td><td class="error-di"><input type="text" name="qual_clg[]"  class="form-control"></td><td class="error-di"><input type="text" name="qual_board[]" class="form-control"></td><td class="error-di"><input type="text" name="qual_marks[]" class="form-control"></td><td class="error-di"><input type="text" name="qual_years[]" class="form-control"></td><td><a class="btn btn-sm btn-danger btn_remove" id="'+i+'"><i class="fa fa-minus"></i></a></td></tr>');
	 	i++;
	 });

	$(document).on('click', '.btn_remove', function(){
		var button_id = $(this).attr("id");
		//alert(button_id); 
		$('#row'+button_id+'').remove();
	});

	$.validator.addMethod("qual", function (value, element) {
        var flag = true;
       
      	$("[name^=qual_name], [name^=qual_clg],[name^=qual_board]").each(function (i, j) {

      		$(this).parent('.error-di').find('em.error').remove();
      		$(this).parent('.error-di').removeClass("has-error");
            if ($.trim($(this).val()) == '') {
                flag = false;           
               	$(this).parent('.error-di').addClass('has-error').removeClass('has-success');
               	$(this).parent('.error-di').append('<em class="error help-block">This field is required.</em>');             
            }
            else{
            	$(this).parent('.error-di').addClass( "has-success" ).removeClass( "has-error" );
            }
      		
        });

      	$("[name^=qual_marks]").each(function(i,j){
      		$(this).parent('.error-di').find('em.error').remove();
      		$(this).parent('.error-di').removeClass("has-error");

      		if ($.trim($(this).val()) == '') {
      			flag = false;           
               	$(this).parent('.error-di').addClass('has-error').removeClass('has-success');
               	$(this).parent('.error-di').append('<em class="error help-block">This field is required.</em>');   

      		}else if(!$.isNumeric($.trim($(this).val()))){
      			flag = false;           
               	$(this).parent('.error-di').addClass('has-error').removeClass('has-success');
               	$(this).parent('.error-di').append('<em class="error help-block">The specified marks is invalid.</em>');    
      		}
      		else{
            	$(this).parent('.error-di').addClass( "has-success" ).removeClass( "has-error" );
            }

      	});

      	$("[name^=qual_years]").each(function(i,j){
      		var  year = $.trim($(this).val());
      		var curr_year = (new Date()).getFullYear();
      		 var text = /^[0-9]+$/;
      		
      		$(this).parent('.error-di').find('em.error').remove();
      		$(this).parent('.error-di').removeClass("has-error");

      		if (year == '') {
      			flag = false;           
               	$(this).parent('.error-di').addClass('has-error').removeClass('has-success');
               	$(this).parent('.error-di').append('<em class="error help-block">This field is required.</em>');   

      		}else if(year.length != 4 || !text.test(year)){
      			flag = false;           
               	$(this).parent('.error-di').addClass('has-error').removeClass('has-success');
               	$(this).parent('.error-di').append('<em class="error help-block">The specified year is invalid.</em>');    
      		}
      		else if(year < '1920' || year > curr_year){
      			flag = false;           
               	$(this).parent('.error-di').addClass('has-error').removeClass('has-success');
               	$(this).parent('.error-di').append('<em class="error help-block">Year should be in range 1920 to current year.</em>');  
      		}
      		else{
            	$(this).parent('.error-di').addClass( "has-success" ).removeClass( "has-error" );
            }

      	});


     
        return flag;


    }, "");
	
	
});

</script>

@endsection
