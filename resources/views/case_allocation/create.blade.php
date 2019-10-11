@extends('lawfirm.layouts.main')
@section('content')
<section class="content">
	<div class="row">
		<div class="col-sm-12 col-md-12 m-auto">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 style="margin-top: 10px;">Allocate & Deallocate Lawyer <a href="{{route('case_allocation.index')}}" class="btn btn-sm btn-info pull-right">Back</a></h3>
				</div>
				<div class="box-body">
					@if($message = Session::get('success'))
					<div class="alert bg-success">
					{{$message}}
					</div>
					@endif
					@if($message = Session::get('warning'))
					<div class="alert bg-warning">
					{{$message}}
					</div>
					@endif
					<div class="row">
						<div class="col-md-12">
							@foreach($caseDetails as $caseDetail)
								<h5><b>Case Title:</b> {{ $caseDetail->case_title }}</h5> 
								<h5><b>Case Type:</b> {{ $caseDetail->casetype->case_type_desc }}</h5> 
								<h5><b>Case Court:</b> {{ $caseDetail->court_name }}</h5> 
								<h5><b>Case Registration Date:</b> {{ $caseDetail->case_reg_date }}</h5> 
							@endforeach

						</div>
					</div>
					<br>
					<div class="row">		
						<div class="col-md-6">
						
							<table class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>Allocate lawyer</th>
										<th>Allocate date</th>
									</tr>
								</thead>
								<tbody>
									@foreach($allocate_lawyers as $allocate_lawyer)
										<tr>
											<td>{{$allocate_lawyer->name}}</td>
											<td>{{date('d-m-Y', strtotime($allocate_lawyer->allocate_date))}}</td>
										</tr>
									@endforeach
								</tbody>
							</table>		
						</div>
						<div class="col-md-6">
							
							<table class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>Deallocate lawyer</th>
										<th>Deallocate date</th>
									</tr>
								</thead>
								<tbody>
									@foreach($deallocate_lawyers as $deallocate_lawyer)
										<tr>
											<td>{{$deallocate_lawyer->name}}</td>
											<td>{{date('d-m-Y', strtotime($deallocate_lawyer->deallocate_date))}}</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>	
					</div>
					<hr>
					<div class="row form-group">
						<div class="col-md-12">
							<input type="radio" name="alloc_dealloc" value="alloc" checked> Allocate
							<input type="radio" name="alloc_dealloc" value="dealloc"> Deallocate 
						</div>
					</div>
					<div class="row" id="allocForm">						
						<form action="{{route('case_allocation.store')}}" method="post">
						@csrf
						<div class="col-md-6" style="margin-top: 10px;">
							<label>Lawyers Name <span class="text-danger">*</span></label>
							<select class="form-control" name="user_id1">
								<option value="0">Select Lawyer</option>
								@foreach($comp_lawyers as $comp_lawyer)
									<option value="{{$comp_lawyer->id}}">{{$comp_lawyer->name}}</option>
								@endforeach
							</select>
							@error('user_id1')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
						<div class="col-md-6" style="margin-top: 10px;">
							<label>Allocation date <span class="text-danger">*</span></label>

							<input type="text" value="{{old('allocate_date')}}" class="form-control " name="allocate_date" required autocomplete="allocate_date" autofocus  id="allocate_date" data-date-format="yyyy-mm-dd" placeholder="<?php echo date('Y-m-d'); ?>" />

							@error('allocate_date')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror

						</div>				
						<div class="col-md-12 text-center" style="margin-top: 20px;">
							<input type="hidden" name="case_id" value="{{$case_id}}" />
							<input type="hidden" name="user_id" value="{{Auth::user()->id}}" />
							<button type="submit" class="btn btn-md btn-success">Allocate</button>
						</div>
								
						</form>						
					</div>
					<div class="row" id="deallocForm" style="display: none">
						<form action="{{route('case_allocation.update',['id'=>$case_id])}}" method="post">
						@method('PATCH')
						@csrf			
							<div class="col-md-6"  style="margin-top:20px;">
								<label>Allocate Lawyers Name <span class="text-danger">*</span></label>
								<select class="form-control" name="user_id1" id="alloc_lawyer">
									<option value="0">Select Allocate Lawyer</option>
									@foreach($allocate_lawyers as $allocate_lawyer)
										<option value="{{$allocate_lawyer->id}}">{{$allocate_lawyer->name}}</option>
									@endforeach
								</select>
								@error('user_id1')
									<span class="invalid-feedback text-danger" role="alert">
									<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
							<div class="col-md-6"  style="margin-top:20px;">
								<label>Allocated date</label>
								<input type="text" name="allocate_date" value="" class="form-control" id="alloc_law_date" readonly />
							</div>
							<div class="col-md-6 "  style="margin-top:20px;">
								<label>Deallocation date <span class="text-danger">*</span></label>

								<input type="text" value="{{old('deallocate_date')}}" class="form-control " name="deallocate_date" required autocomplete="deallocate_date" autofocus  id="deallocate_date" data-date-format="yyyy-mm-dd" placeholder="<?php echo date('Y-m-d'); ?>" />

								@error('deallocate_date')
									<span class="invalid-feedback text-danger" role="alert">
									<strong>{{ $message }}</strong>
									</span>
								@enderror

							</div>

							<div class="col-md-12"  style="margin-top:20px;">
								<label>Remark <span class="text-danger">*</span></label>

								<textarea name="remark" class="form-control" cols="10" rows ="5">{{old('remark')}}</textarea >
								@error('remark')
									<span class="invalid-feedback text-danger" role="alert">
									<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
									
							<div class="col-md-12 text-center" style="margin-top:20px;">
								<input type="hidden" name="case_id" value="{{$case_id}}" />
								<input type="hidden" name="user_id" value="{{Auth::user()->id}}" />
								<button type="submit" class="btn btn-md btn-success">Deallocate</button>
							</div>							
						</form>
					</div>							
				</div>
			</div>
		</div>
	</div>
</section>
<script >
	$(document).ready(function(){
		$("#allocate_date, #deallocate_date",).datepicker();

		$("input[name='alloc_dealloc']").on('change',function(){
			var alloc_dealloc =$(this).val();
			if(alloc_dealloc == 'alloc'){
				$('#allocForm').show();
				$('#deallocForm').hide();
			}
			else{
				$('#allocForm').hide();
				$('#deallocForm').show();
			}
		});
		var alloc = $("input[name='alloc_dealloc']:checked").val();
			if(alloc == 'alloc'){
					$('#allocForm').show();
					$('#deallocForm').hide();
				}
				else{
					$('#allocForm').hide();
					$('#deallocForm').show();
			}


	 $.ajaxSetup({
	          headers: {
	              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	          }
	        });

		$('#alloc_lawyer').on('change',function(e){
			e.preventDefault();
			var case_id = "{{$case_id}}";
			var user_id1 = $('#alloc_lawyer').val();
			if(user_id1==0){
				$('#alloc_law_date').val('');
			}
			else{
				$.ajax({
					type:'POST',
					url:"{{route('allocate_lawyer')}}",
					data:{user_id1:user_id1,case_id:case_id},
					success:function(data){
						$('#alloc_law_date').val(data);
					}
				});
			}

		});	



	});
</script>
@endsection