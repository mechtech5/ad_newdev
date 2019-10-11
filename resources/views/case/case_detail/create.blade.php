@extends('lawfirm.layouts.main')
@section('content')
<section class="content">
<div class="row">
	<div class="col-md-12 ">
		<div class="box box-primary">
			<div class="box-header with-border" >
				<h3 style="margin-top: 10px;">Add Case Hearing 
					@if($page_name == 'clients')
						<a href="{{route('case_mast.show', $select->case_id.',clients')}}" class="btn btn-sm btn-info pull-right">Back</a>
					@else
						<a href="{{route('case_mast.show', $select->case_id.',case_diary')}}" class="btn btn-sm btn-info pull-right">Back</a>
					@endif

				</h3> 
			</div>
			<div class="box-body">
				<form action="{{route('case_detail.store')}}" method="post">
				@csrf
					<div class="row form-group ">
						<div class="col-md-6">
							<label for="hearing_date">Hearing Date <span class="text-danger" >*</span></label>
							<input type="text" value="{{old('hearing_date')}}" class="form-control " name="hearing_date" required autocomplete="case_reg_date" autofocus  id="regdatepicker" data-date-format="yyyy-mm-dd" >
							@error('hearing_date')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>

						<div class="col-md-6">
							<label for="start_time">Start Time <span class="text-danger" >*</span></label>

							<input type='text' class="form-control" name= "start_time" id='datetimepicker3' value="<?php echo date('h:i:sa') ?>" />
							

							@error('start_time')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-6" style="margin-top:10px;">
							<label for="case_reg_date">Next Hearing Date <span class="text-danger" >*</span></label>

							<input type="text" value="{{old('next_hearing_date')}}" class="form-control " name="next_hearing_date" required autocomplete="next_hearing_date" autofocus  id="regdatepicker" data-date-format="yyyy-mm-dd" placeholder="Enter next hearing date">

							@error('next_hearing_date')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
						<div class="col-md-6" style="margin-top:10px;">
							<label for="case_charged">Case Charged</label>
							<input type="text" name="case_charged" class="form-control" placeholder="Enter Cash Charges Name" value="{{ old('case_charged')}}" >
							@error('case_charged')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>						
					</div>
					<div class="row form-group">
						<div class="col-md-12 col-xs-12 col-sm-12 mb-2">
							<label for="case_charges_type">Case Charge Type <span class="text-danger" >*</span></label>
							<select name='case_charges_type' class="form-control">
								<option value="0">select</option>
								<option value="1" {{ (Input::old('case_charges_type') == '1') ? 'selected' : ''}} >Cash</option>
								<option value="2" {{ (Input::old('case_charges_type') == '2') ? 'selected' : ''}}>Chaque</option>
							</select>
							@error('case_charges_type')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-6" style="margin-top:10px;" >
							<label for="lawyer_names">Lawyer Names <span class="text-danger" >*</span></label>
							<table id='dynamic_field' class='table'>

							<tr><td class="pb-0 pl-0 border-0"><input type="text" name="lawyer_names[]" class="form-control" placeholder="Enter Lawyer Names" required></td></tr></table>

							<button type="button" name="add" id="add" class="btn btn-success btn-sm">Add More</button>
							
							@error('lawyer_names')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>

						<div class="col-md-6" style="margin-top:10px;" >
							<label for="judges_name">Judge Names <span class="text-danger" >*</span></label>
							<table id='dynamic_field2' class='table'>

							<tr><td class="pb-0 pl-0 border-0"><input type="text" name="judges_name[]" class="form-control" placeholder="Enter Judge Names" required></td></tr></table>

							<button type="button" name="add" id="add_again" class="btn btn-success btn-sm">Add More</button>
							
							@error('judges_name')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-12" style="margin-top: 10px;">
							<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
							<input type="hidden" name="cust_id" value="{{ $select->cust_id }}">
							<input type="hidden" name="case_id" value="{{ $select->case_id }}">
							<input type="hidden" name="page_name" value="{{$page_name}}">
							
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
			$("#datepicker, #regdatepicker").datepicker({ 
				singleDatePicker: true,
				showDropdowns: true,
			});
		});

	var i=1;
	$('#add').click(function(){
		
		

		$('#dynamic_field').append('<tr id="row'+i+'"><td class="pb-0 pl-0 border-0"><input type="text" name="lawyer_names[]" placeholder="Enter Lawyer Name" class="form-control name_list" required /></td><td class="pb-0 pl-0 border-0"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');

		i++;
	});

	$(document).on('click', '.btn_remove', function(){
		var button_id = $(this).attr("id");
		//alert(button_id); 
		$('#row'+button_id+'').remove();
	});
	
	$('#submit').click(function(){		
		$.ajax({
			url:"name.php",
			method:"POST",
			data:$('#add_name').serialize(),
			success:function(data)
			{
				alert(data);
				$('#add_name')[0].reset();
			} 
		});
	});  
	

	var i=1;
	$('#add_again').click(function(){
		
		$('#dynamic_field2').append('<tr id="row'+i+'"><td class="pb-0 pl-0 border-0"><input type="text" name="judges_name[]" placeholder="Enter Judge Name" class="form-control name_list" required /></td><td class="pb-0 pl-0 border-0"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');

		i++;
	});

	$(document).on('click', '.btn_remove', function(){
		var button_id = $(this).attr("id");
		//alert(button_id); 
		$('#row'+button_id+'').remove();
	});
	
	$('#submit').click(function(){		
		$.ajax({
			url:"name.php",
			method:"POST",
			data:$('#add_name').serialize(),
			success:function(data)
			{
				alert(data);
				$('#add_name')[0].reset();
			} 
		});
	});  

	$(function(){
	    $('#datetimepicker3').datetimepicker({
	        format: 'HH:mm:ss',
	        

	    });
	});

	
});
</script>


@endsection