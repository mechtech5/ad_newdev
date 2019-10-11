@extends('lawfirm.layouts.main')
@section('content')
<section class="content">
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border" >
				<h3 style="margin-top: 10px;">Edit Case Hearing
					
					@if($page_name == 'clients')
						<a href="{{route('case_mast.show', $edit_detail->case_id.',clients')}}" class="btn btn-sm btn-info pull-right">Back</a>
					@else
						<a href="{{route('case_mast.show', $edit_detail->case_id.',case_diary')}}" class="btn btn-sm btn-info pull-right">Back</a>
					@endif

				</h3>
			</div>
			<div class="box-body">
				<form action="{{route('case_detail.update',$edit_detail->case_tran_id)}}" method="post">
					@csrf
					@method('PATCH')
					<div class="row form-group ">
						<div class="col-md-6">
							<label for="hearing_date">Hearing Date <span class="text-danger" >*</span></label>
							<input type="text" value="{{ $edit_detail->hearing_date }}" class="form-control " name="hearing_date" required autocomplete="case_reg_date" autofocus  id="regdatepicker" data-date-format="yyyy-mm-dd" >
							@error('hearing_date')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>

						<div class="col-md-6">
							<label for="start_time">Start Time <span class="text-danger" >*</span></label>

							<input type='text' class="form-control" name= "start_time" id='datetimepicker3'value="{{$edit_detail->start_time}}" />
							

							@error('start_time')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>
					<div class="row form-group ">
						<div class="col-md-6">
							<label for="case_reg_date">Next Hearing Date <span class="text-danger" >*</span></label>
							<input type="text" value="{{ $edit_detail->next_hearing_date }}" class="form-control " name="next_hearing_date" required autocomplete="next_hearing_date" autofocus  id="regdatepicker" data-date-format="yyyy-mm-dd" >
							@error('next_hearing_date')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>


						<div class="col-md-6">
							<label for="case_charged">Case Charged</label>
							<input type="text" name="case_charged" class="form-control" placeholder="Enter Cash Charges Name" value="{{ $edit_detail->case_charged }}" >
							@error('case_charged')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>
					<div class="row form-group ">
						<div class="col-md-12">
							<label for="case_charges_type">Case Charge Type <span class="text-danger" >*</span></label>
							<select name='case_charges_type' class="form-control">
								<option value="1" {{$edit_detail->case_charges_type==1 ? 'selected' : "" }}>Cash</option>
								<option value="2" {{$edit_detail->case_charges_type == 2 ? 'selected' : "" }}>Cheque</option>
							</select>
							@error('case_charges_type')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>							
					</div>
					<div class="row form-group ">
						<div class="col-md-6" id=''>
							@php $num=0; @endphp
							<label for="lawyer_names">Lawyer Names <span class="text-danger" >*</span></label>
							<table id='dynamic_field' class="table">
								@foreach($sep_name as $same)
							
									<tr id='{{"row".++$num}}'>
										<td class="pl-0 pb-0 border-0">

											<input type="text" name="lawyer_names[]"  class="form-control" placeholder="Enter Lawyer Names" value="{{ $same }}"  required>

										</td>
										<td class="pl-0 pb-0 border-0">
											<button type="button" name="remove" id="{{$num}}_btn" class="btn btn-danger btn_remove" onclick="delete_hearing('{{$num}}')"><i class="fa fa-times"></i></button>
										</td>
									</tr>

		                        @endforeach
		                    </table>
		                    <button type="button" name="add" id="add" class="btn btn-primary btn-sm">Add lawyer</button>
                            @error('lawyer_names')							
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
							
                  		</div>

                        @php $no=0; @endphp
                        <div class="col-md-6" >
							<label for="judges_name">Judge Names <span class="text-danger" >*</span></label>
							<table id='dynamic_field2' class="table">
                     		 	@foreach($jug_name as $all_jug)
									<tr id='{{"roww".++$no}}'>
										<td class="pb-0 pl-0 border-0"> 

											<input type="text" name="judges_name[]"  class="form-control" placeholder="Enter judge Names" value="{{ $all_jug }}" required>

										</td>
										<td class="pl-0 pb-0 border-0">
											<button type="button" name="remove" id="{{$no}}_btn" class="btn btn-danger btn_removes" onclick="delete_jug('{{$no}}')"><i class="fa fa-times"></i></button>
										</td>
									</tr>
		                        @endforeach 
		                    </table>

			                <button type="button" name="add" id="add_again" class="btn btn-success btn-sm">Add judge</button>
                       		@error('judges_name')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
                        
			             </div>
					</div>
					<div class="row form-group ">
						<div class="col-md-12">
							<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
							<input type="hidden" name="case_id"  value="{{$edit_detail->case_id}}">
							<input type="hidden" name="cust_id" value="{{ $edit_detail->cust_id }}">
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
	});
</script>

<script>
$(document).ready(function(){
	var i=1;
	$('#add').click(function(){
		//alert("fdsf");
		

		$('#dynamic_field').append('<tr id="row'+i+'"><td class="pl-0 pb-0 border-0"><input type="text" name="lawyer_names[]" placeholder="Enter Lawyer Name" class="form-control name_list" required /></td><td class="pl-0 pb-0 border-0"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove"><i class="fa fa-times"></i></button></td></tr>');

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
		//alert("fdsf");
		

		$('#dynamic_field2').append('<tr id="row'+i+'"><td class="pl-0 pb-0 border-0"><input type="text" name="judges_name[]" placeholder="Enter judge Name" class="form-control name_list" required /></td><td class="pl-0 pb-0 border-0"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove"><i class="fa fa-times"></i></button></td></tr>');

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
		    format: 'HH:mm:ss'
		});
	});

});

</script>
<script>

	function delete_hearing(value){
		var x = value;
        //alert(x);
        $('#row'+x+'').remove();

	}
	function delete_jug(values){
		var y= values;
		//alert(y);
		 $('#roww'+y+'').remove();


	}
	</script>


@endsection
