@extends('lawfirm.layouts.main')
@section('content')
<section class="content"> 
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border" >
				<h3 style="margin-top: 10px">Edit Client Case 
					@if($page_name == 'clients')
						<a href="{{route('clients.show',$caseDetail->cust_id)}}" class="btn btn-sm btn-info pull-right">Back</a>
					@else
						<a href="{{route('case_diary.index',['caseBtn' =>'cg'])}}" class="btn btn-sm btn-info pull-right">Back</a>
					@endif
					
				</h3> 
			</div>
			<div class="box-body">
				<form action="{{ route('case_mast.update', ['id' => $caseDetail->case_id] ) }}" method="post">
				@method('PATCH')					
				@csrf
					<div class="row form-group">
						<div class="col-md-6">
							<label for="client_name">Client Name <span class="text-danger">*</span></label>	
								<select class="form-control" name="cust_id">
									@foreach($clients as $client)
										<option value="{{$client->cust_id}}" {{$caseDetail->cust_id == $client->cust_id ? 'selected' : ''}}>{{$client->cust_name}}</option>
										@php  break; @endphp
									@endforeach
								</select>
							@error('cust_id')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ "The selected customer name is invalid." }}</strong>
								</span>
							@enderror
						</div>

						<div class="col-md-6" style="margin-top:10px;">
								<label for="case_title">Case Title <span class="text-danger" >*</span></label>
								<input type="text" name="case_title" class="form-control" placeholder="Enter Case Title" value="{{ old('case_title') ?? $caseDetail->case_title}}" >
								@error('case_title')
									<span class="invalid-feedback text-danger" role="alert">
									<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>	
						<div class="row form-group ">
							<div class="col-md-6" style="margin-top:10px;">
								<label for="case_number">Case Number <span class="text-danger" >*</span></label>
								<input type="text" name="case_number" class="form-control" placeholder="Enter Case Number" value="{{ old('case_number') ?? $caseDetail->case_number}}" >
								@error('case_number')
									<span class="invalid-feedback text-danger" role="alert">
									<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						
							<div class="col-md-6" style="margin-top:10px;">
								<label for="case_type">Case Type <span class="text-danger" >*</span></label>
								<select class="form-control" name="case_type_id">
									<option value="">Select Case Type</option>
									@foreach($case_types as $case_type)
										<option value="{{$case_type->case_type_id}}" {{$case_type->case_type_id == $caseDetail->case_type_id ? 'selected' : ''}}>{{$case_type->case_type_desc}}</option>
									@endforeach
								</select>
								@error('case_type_id')
									<span class="invalid-feedback text-danger" role="alert">
									<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>	
						<div class="row form-group">
							<div class="col-md-6" style="margin-top:10px;">
								<label for="catg_code">Case Category <span class="text-danger">*</span></label>
								<select class="form-control" name="catg_code" id="case_category">
									<option value="0">Select case category</option>
									@foreach($categories as $category)
								    
								    <option value="{{$category->catg_code}}" {{old('catg_code')==$category->catg_code ? 'selected' : ''}} {{$caseDetail->catg_code == $category->catg_code ? 'selected' : ''}}>{{$category->catg_desc}}</option>									    
									@endforeach
								</select>
								@error('catg_code')
									<span class="invalid-feedback text-danger" role="alert">
									<strong>{{ "The selected case category is invalid." }}</strong>
									</span>
								@enderror
							</div>
					
							<div class="col-md-6" style="margin-top:10px;">
								<label for="subcatg_code">Case Subcategory <span class="text-danger">*</span></label>
								<select class="form-control" name="subcatg_code" id="case_subcategory">
								
								</select>
								@error('subcatg_code')
									<span class="invalid-feedback text-danger" role="alert">
									<strong>{{ "The selected case subcategory is invalid." }}</strong>
									</span>
								@enderror
							</div>
						</div>
						<div class="row form-group ">
							<div class="col-md-6" style="margin-top:10px;">
								<label for="court_code">Case Court Name <span class="text-danger" >*</span></label>
								<select class="form-control" name="court_code">
									<option value="0">Select Case Court</option>
									@foreach($courts as $court)
										<option value="{{$court->court_code}}" {{$court->court_code == $caseDetail->court_code ? 'selected' : ''}}>{{$court->court_name}}</option>
									@endforeach
								</select>
								@error('court_code')
									<span class="invalid-feedback text-danger" role="alert">
									<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						{{-- </div>
						<div class="row form-group"> --}}
							{{-- <div class="col-md-6" style="margin-top:10px;">
								<label for="city_code">City Name</label>
								<select class="form-control" name="city_code">
									<option value="0">Select City</option>

								</select>
								@error('city_code')
									<span class="invalid-feedback text-danger" role="alert">
									<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
 --}}
							<div class="col-md-6" style="margin-top:10px;">
								<label for="case_reg_date">Case Registration Date <span class="text-danger" >*</span></label>
								<input type="text" value="{{old('case_reg_date') ?? $caseDetail->case_reg_date}}" class="form-control " name="case_reg_date" required autocomplete="case_reg_date" autofocus  id="regdatepicker" data-date-format="yyyy-mm-dd" >
								@error('case_reg_date')
									<span class="invalid-feedback text-danger" role="alert">
									<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>

						</div>
						<div class="row form-group">							

							<div class="col-md-6" style="margin-top:10px;">
								<label for="appellant_name">Appellant Name</label>
								<input type="text" name="appellant_name" class="form-control" placeholder="Enter Appellant Name" value="{{ old('appellant_name') ?? $caseDetail->appellant_name}}" >
								@error('appellant_name')
									<span class="invalid-feedback text-danger" role="alert">
									<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
					
							<div class="col-md-6" style="margin-top:10px;">
								<label for="respondant_name">Respondant Name</label>
								<input type="text" name="respondant_name" class="form-control" placeholder="Enter Respondant Name" value="{{ old('respondant_name') ?? $caseDetail->respondant_name}}">
								@error('respondant_name')
									<span class="invalid-feedback text-danger" role="alert">
									<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-6" style="margin-top:10px;">
								<label for="case_fees">Case Fees</label>
								<input type="text" name="case_fees" class="form-control" placeholder="Enter Case Fees" value="{{ old('case_fees') ?? $caseDetail->case_fees}}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
								@error('case_fees')
									<span class="invalid-feedback text-danger" role="alert">
									<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-6" style="margin-top:10px;">
								<label for="case_status">Case Status <span class="text-danger" >*</span></label>
								<select class="form-control" name="case_status">
									<option value="0">Select Case Status</option>
									<option value="cg" 
										@if(old('case_status') == '')
											{{$caseDetail->case_status == 'cg' ? 'selected' : ''}}
										@else
											{{'cg' == old('case_status') ? 'selected' : ''}}	
										@endif
									 >On going case</option>
									<option value="cw" 
										@if(old('case_status') == '')
											{{$caseDetail->case_status == 'cw' ? 'selected' : ''}}
										@else
											{{'cw' == old('case_status') ? 'selected' : ''}}	
										@endif
									>Case over in favour of client</option>
									<option value="cl" 
										@if(old('case_status') == '')
											{{$caseDetail->case_status == 'cl' ? 'selected' : ''}}
										@else
											{{'cl' == old('case_status') ? 'selected' : ''}}	
										@endif
									>Case over against the favour of client</option>
									<option value="ct" 
										@if(old('case_status') == '')
											{{$caseDetail->case_status == 'ct' ? 'selected' : ''}}
										@else
											{{'ct' == old('case_status') ? 'selected' : ''}}	
										@endif
									>Case withdrawn by client</option>
								</select>
								@error('case_status')
									<span class="invalid-feedback text-danger" role="alert">
									<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>

							<div class="col-md-6" style="margin-top:10px; display: none;" id="caseOverDate">
								<label for="case_over_date">Case Over Date <span class="text-danger">*</span></label>
								<input type="text" value="{{old('case_over_date') ?? $caseDetail->case_over_date}}" class="form-control" name="case_over_date" id="datepicker" data-date-format="yyyy-mm-dd" placeholder="Case over date">
								
								@if(old('case_over_date') == '' )
									@error('case_over_date')
									<span class="invalid-feedback text-danger" role="alert">
									<strong>{{$message }}</strong>
									</span>
									@enderror
								@else
									@error('case_over_date')
										<span class="invalid-feedback text-danger" role="alert">
										<strong>{{ $message }}</strong>
										</span>
									@enderror
								@endif  
							</div>
						</div>
						
						<div class="row form-group">
							<div class="col-md-12" style="margin-top:10px;">
								<label for="case_summary">Case Summary <span class="text-danger" >*</span></label>
								<textarea name="case_summary" rows="5" cols="50" class="form-control tinymce" placeholder="Brief details about the case as explained by the customer..."  id="summernote">{{old('case_summary') ?? $caseDetail->case_summary }}</textarea>
								@error('case_summary')
									<span class="invalid-feedback text-danger" role="alert">
									<strong>{{ $message }}</strong>
									</span>
								@enderror
								
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-12" style="margin-top:10px;">
								<label for="case_remark">Case Remark <span class="text-danger" >*</span></label>
								<textarea name="case_remark" rows="4" cols="50" class="form-control tinymce" placeholder="Your personal information about the case ..."  id="summernote"  >{{ old('case_remark') ?? $caseDetail->case_remark}}</textarea>
								@error('case_remark')
									<span class="invalid-feedback text-danger" role="alert">
									<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-12" style="margin-top:10px;">
								<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
								
								<input type="hidden" name="page_name" value="{{$page_name}}">
								
								<button type="submit" class="btn btn-primary btn-md">Update</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
<script>
	$(document).ready(function(){
		$(function () {
			$("#regdatepicker").datepicker({ 				
				endDate: new Date(),
			});
		});
		$(function () {
			$("#datepicker").datepicker();
		});

		$("select[name='case_status']").on('change',function(e){
			e.preventDefault();
		 	var case_status = $(this).val();
		 	// console.log(case_status);
		 	if(case_status == 'cw' || case_status == 'cl' || case_status == 'ct'){
		 		$('#caseOverDate').show();
		 	}
		 	else if(case_status == 'cg' || case_status == 0){
		 		$('#caseOverDate').hide();
		 	}
		});

		var case_status = "{{old('case_status')}}";
		 	
		 	if(case_status == 'cw' || case_status == 'cl' || case_status == 'ct'){
		 		$('#caseOverDate').show();
		 	}
		 	else if(case_status == 'cg' || case_status == 0){
		 		$('#caseOverDate').hide();
		 	}

	 	
		tinymce.init({
			/* replace textarea having class .tinymce with tinymce editor */
			selector: "textarea.tinymce",
			// theme: "modern",
			// skin: "lightgray",
			plugins: [
			"advlist autolink link image lists charmap print preview hr anchor pagebreak",

			"   directionality emoticons template paste textcolor"
			],
			toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent |  forecolor backcolor ",

			height: 300,
		});


		$('#case_category').on('change',function(){
		    var catg_code = $(this).val();  
		    // console.log(catg_code);  
		    if(catg_code){
		        $.ajax({
		           type:"GET",
		           url:"{{route('case_subcategory')}}?catg_code="+catg_code,
		           success:function(res){               
		            if(res){
		                $("#case_subcategory").empty();
		              
		                $.each(res,function(key,value){
		                    $("#case_subcategory").append('<option value="'+value.subcatg_code+'">'+value.subcatg_desc+'</option>');
		                });
		           
		            }else{
		               $("#case_subcategory").empty();
		            }
		           }
		        });
		    }else{
		        $("#case_subcategory").empty();
		    }
		        
		   });
			
			
			var oldcatg_code = "{{old('catg_code')}}";
				if(oldcatg_code != ''){
					var catg_code = oldcatg_code;
				}
				else{
					var catg_code = "{{$caseDetail->catg_code}}";

				}

		    var oldsubcatg_code = "{{old('subcatg_code')}}";
			    if(oldsubcatg_code != ''){
					var subcatg_code = oldsubcatg_code;
				}
				else{
					var subcatg_code = "{{$caseDetail->subcatg_code}}";
					
				}
		    if(catg_code){
		        $.ajax({
		           type:"GET",
		           url:"{{route('case_subcategory')}}?catg_code="+catg_code,
		           success:function(res){               
		            if(res){
		                $("#case_subcategory").empty();
		              
		                $.each(res,function(key,value){
		                    $("#case_subcategory").append('<option value="'+value.subcatg_code+'" ' + (value.subcatg_code == subcatg_code ? 'selected="selected"' : '' )+ '  >'+value.subcatg_desc+'</option>');
		                });
		           
		            }else{
		               $("#case_subcategory").empty();
		            }
		           }
		        });
		    }else{
		        $("#case_subcategory").empty();
		    }



	});
</script>
@endsection