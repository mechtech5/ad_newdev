@extends('lawfirm.layouts.main')
@section('content')
<section class="content">
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border" >
				<h3 style="margin-top: 10px;">Add New Case 
					@if($page_name == 'clients')
						<a href="{{route('clients.show',$cust_id)}}" class="btn btn-sm btn-info pull-right">Back</a>
					@else
						<a href="{{route('case_diary.index',['caseBtn' =>'cg'])}}" class="btn btn-sm btn-info pull-right">Back</a>
					@endif

				</h3>
			</div>
			<div class="box-body">
				<form action="{{route('case_mast.store')}}" method="post">
				@csrf
					<div class="row form-group">
						<div class="col-md-6" style="margin-top:10px; ">
							<label for="court_type">Court Type Name <span class="text-danger">*</span></label>
							<select class="form-control" name="court_type" id="court_type">
								<option value="0"> Select Court Type Name</option>
								@foreach($courts as $court)
									<option value="{{$court->court_type}}" {{old('court_type') == $court->court_type ? 'selected' : ''}} >{{$court->court_type_desc}}</option>
								@endforeach
							</select>
							@error('court_type')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ "The selected court name is invalid." }}</strong>
								</span>
							@enderror
						</div>
					</div>

					<div class="row from-group" style="margin-top:10px; display: none;" id="cnr_div">
						<div class="col-md-6">
							<label for="cnr">Do you have CNR #?</label>
							<input type="radio" name="cnr" value="1">Yes
							<input type="radio" name="cnr" value="0" checked>No
						</div>
					</div>
					<div class="row form-group" style="margin-top:10px; display: none;" id="cnr_number_div">
						<div class="col-md-6">							
							<label for="cnr_number">CNR Number <span class="text-danger">*</span></label>
							<input type="text" name="cnr_number" value="{{old('cnr_number')}}" class="form-control">
						</div>
					</div>

					<div class="row form-group">
						<div class="col-md-6" style="margin-top: 10px; display: none" id="no_catg_div">
							<label>Supreme Court Of India <span class="text-danger">*</span></label>
							<select class="form-control" name="no_catg" id="no_catg">
								<option value="0">Select type</option>
								<option value="c_no">Case Number</option>
								<option value="d_no">Diary Number</option>
							</select>

						</div>
				
						<div class="col-md-6" style="margin-top:10px; display: none;" id="court_code_div">
							<label for="court_code" id="court_code_label"></label>
								<select class="form-control" name="court_code" id="court_code">
								
								</select>
							@error('court_code')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ "The selected court name is invalid." }}</strong>
								</span>
							@enderror
						</div>

						<div class="col-md-6" style="margin-top:10px; display: none;" id="bench_code_div">
							<label for="bench_code">Bench Code <span class="text-danger">*</span></label>
								<select class="form-control" name="bench_code" id="bench_code">
								
								</select>
							@error('bench_code')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ "The selected court name is invalid." }}</strong>
								</span>
							@enderror
						</div>
					</div>	

					
					<div class="row form-group" style="margin-top:10px; display: none;" id="no_div">
						<div class="col-md-6">
							<label for="case_number" id="no_label"> </label>
							<input type="text" name="case_number" class="form-control" placeholder="Number">
						</div>
						<div class="col-md-6" >
							<label for="year">Year <span class="text-danger">*</span></label>
							<input type="text" name="year" class="form-control" placeholder="Year">
						</div>
						
					</div>
					<div class="row form-group">
						<div class="col-md-6" style="margin-top:10px;">
							<label for="client_name">Client Name <span class="text-danger">*</span></label>
							@if($cust_id == '')
								<select class="form-control" name="cust_id">
									<option value="0"> Select Client Name</option>
									@foreach($clients as $client)
										<option value="{{$client->cust_id}}" {{old('cust_id') == $client->cust_id ? 'selected' : ''}}>{{$client->cust_name}}</option>
									@endforeach
								</select>
							@else
								<select class="form-control" name="cust_id">
									@foreach($clients as $client)
										<option value="{{$client->cust_id}}" {{$cust_id == $client->cust_id ? 'selected' : ''}}>{{$client->cust_name}}</option>
										@php  break; @endphp
									@endforeach
								</select>
							@endif

							@error('cust_id')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ "The selected customer name is invalid." }}</strong>
								</span>
							@enderror
						</div>
											
						<div class="col-md-6" style="margin-top:10px; ">
							<label for="case_title">Case Title <span class="text-danger">*</span></label>
							<input type="text" name="case_title" class="form-control" placeholder="Enter Case Title" value="{{ old('case_title')}}" aria-required="true" aria-invalid="true">
							@error('case_title')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>					
					<div class="row form-group">
						{{-- <div class="col-md-6" style="margin-top:10px;">
							<label for="case_number">Case Number <span class="text-danger">*</span></label>
							<input type="text" name="case_number" class="form-control" placeholder="Enter Case Number" value="{{ old('case_number')}}" >
							@error('case_number')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div> --}}
					
						<div class="col-md-6" style="margin-top:10px;">
							<label for="case_type_id">Case Type <span class="text-danger">*</span></label>
							<select class="form-control" name="case_type_id">
								<option value="0">Select Case Type</option>
								@foreach($case_types as $case_type)
							    
							    <option value="{{$case_type->case_type_id}}" {{old('case_type_id')==$case_type->case_type_id ? 'selected' : ''}}>{{$case_type->case_type_desc}}</option>									    
								@endforeach
							</select>
							@error('case_type_id')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ "The selected case type is invalid" }}</strong>
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
							    
							    <option value="{{$category->catg_code}}" {{old('catg_code')==$category->catg_code ? 'selected' : ''}}>{{$category->catg_desc}}</option>									    
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
					<div class="row form-group">
						{{-- <div class="col-md-6" style="margin-top:10px;">
							<label for="court_code">Case Court Name <span class="text-danger" >*</span></label>
							<select class="form-control" name="court_code">
								<option value="0">Select Case Court</option>
								@foreach($courts as $court)
								
								<option value="{{$court->court_code}}" {{old('court_code')==$court->court_code ? 'selected' : ''}}>{{$court->court_name}}</option>
								
								@endforeach
							</select>
							@error('court_code')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ "The selected case court is invalid." }}</strong>
								</span>
							@enderror
						</div> --}}
					
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
						</div> --}}

						<div class="col-md-6" style="margin-top:10px;">
							<label for="case_reg_date">Case Registration Date <span class="text-danger">*</span></label>
							<input type="text" value="{{old('case_reg_date')}}" class="form-control " name="case_reg_date" required autocomplete="case_reg_date" autofocus  id="regdatepicker" data-date-format="yyyy-mm-dd" placeholder="Enter case registration date ">
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
							<input type="text" name="appellant_name" class="form-control" placeholder="Enter Appellant Name" value="{{ old('appellant_name')}}" >
							@error('appellant_name')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>

						<div class="col-md-6" style="margin-top:10px;">
							<label for="respondant_name">Respondant Name</label>
							<input type="text" name="respondant_name" class="form-control" placeholder="Enter Respondant Name" value="{{ old('respondant_name')}}">
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
							<input type="text" name="case_fees" class="form-control" placeholder="Enter Case Fees" value="{{ old('case_fees')}}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" >
							@error('case_fees')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-6" style="margin-top:10px;">
							<label for="case_status">Case Status <span class="text-danger">*</span></label>
							<select class="form-control" name="case_status">
								<option value="0">Select Case Status</option>
								<option value="cg" {{old('case_status') == 'cg' ? 'selected' : 'selected'}} >On going case</option>
								<option value="cw" {{old('case_status') == 'cw' ? 'selected' : ''}}>Case over in favour of client</option>
								<option value="cl" {{old('case_status') == 'cl' ? 'selected' : ''}}>Case over against the favour of client</option>
								<option value="ct" {{old('case_status') == 'ct' ? 'selected' : ''}}>Case withdrawn by client</option>
							</select>
							@error('case_status')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>

						<div class="col-md-6" style="margin-top:10px; display: none;"  id="caseOverDate">							
								<label for="case_over_date">Case Over Date <span class="text-danger">*</span></label>
								<input type="text" value="{{old('case_over_date')}}" class="form-control" name="case_over_date" id="datepicker" data-date-format="yyyy-mm-dd" placeholder="Case over date">
								
							
								@error('case_over_date')
									<span class="invalid-feedback text-danger" role="alert">
									<strong>{{ $message }}</strong>
									</span>
								@enderror
								
							 
						</div>
					</div>
					
					<div class="row form-group">
						<div class="col-md-12" style="margin-top:10px;">
							<label for="case_summary">Case Summary <span class="text-danger">*</span></label>
							<textarea name="case_summary" rows="5" cols="50" class="form-control tinymce" placeholder="Brief details about the case as explained by the customer..."  id="summernote" >{{old('case_summary')}}</textarea>
							@error('case_summary')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
							
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-12" style="margin-top:10px;">
							<label for="case_remark">Case Remark <span class="text-danger">*</span></label>
							<textarea name="case_remark" rows="4" cols="50" class="form-control tinymce" placeholder="Your personal information about the case ..."  id="summernote" >{{old('case_remark')}}</textarea>
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
							<input type="hidden" name="page_name" value="{{$page_name}}" >
							<button type="submit" class="btn btn-primary btn-md">Submit</button>
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
		//	endDate: new Date(),
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

	 	

	$('#case_category').on('change',function(){
		var catg_code = $(this).val();  
		// console.log(catg_code);  
		var subcatg_code = "";
		case_subcategory(catg_code,subcatg_code);
	});
		
	var catg_code = "{{old('catg_code')}}";
    var subcatg_code = "{{old('subcatg_code')}}";
    if(catg_code !=0){
    	case_subcategory(catg_code,subcatg_code);
    }
	        
	$("#court_type").on('change',function(e){
		e.preventDefault();
		var court_type = $(this).val();
		var court_code = "";
		//alert(court_type);
		if(court_type =='1'){
			$('#no_catg_div').show();
			$('#no_catg').val('0');
			$('#no_div').hide();
			$('#court_code_div').hide();
			$('#cnr_div').hide();			
			$('#no_catg').on('change',function(e){
				e.preventDefault();
				var no_catg = $(this).val();
				// alert(no_catg);
				if(no_catg == 'd_no'){
					$('#no_label').empty().html('Diary Number <span class="text-danger">*</span>');
					$('#no_div').show();

				}	
				else if(no_catg == 'c_no'){
					$('#no_label').empty().html('Case Number <span class="text-danger">*</span>');
					$('#no_div').show();
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
		}
		else{	
			case_court(court_type,court_code);
			$('#no_catg_div').hide();	
			$('#no_div').hide();
			// $('#court_code_div').show();
			$('#cnr_div').show();
			var cnr = $('input[name="cnr"]:checked').val();
			if(cnr == '0'){
				$('#court_code_div').show();
				$('#bench_code_div').show();
				$('#no_label').empty().html('Case Number <span class="text-danger">*</span>');
				$('#no_div').show();
				
			}
			$('input[name="cnr"]').on('change', function(e){
				e.preventDefault();
				var cnr = $(this).val();
				if(cnr == '0'){
					$('#court_code_div').show();
					$('#bench_code_div').show();

					$('#no_label').empty().html('Case Number <span class="text-danger">*</span>');
					$('#no_div').show();
					$('#cnr_number_div').hide();
				}
				else{
					$('#no_div').hide();
					$('#cnr_number_div').show();
					$('#court_code_div').hide();
					$('#bench_code_div').hide();
				}
			})
		}
	});

	var court_type = "{{old('court_type')}}";
	var court_code = "{{old('court_code')}}";
	if(court_type !=0){
		court(court_type,court_code);
	}
});
</script>
@endsection