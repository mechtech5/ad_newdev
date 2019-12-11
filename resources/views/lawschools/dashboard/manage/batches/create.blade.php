@extends('lawschools.main')
@section('content')
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="">Batch<a href="{{route('batches.index')}}" class="btn btn-sm btn-primary pull-right">Back</a></h3>
				</div>
				<div class="box-body">
					@if($message = Session::get('warning'))
						<div style="margin-top: 10px;" class="alert bg-warning">
							{{$message}}
						</div>
					@endif
					<form id="example-form1" action="{{route('batches.store')}}" method="post">
		        	<div class="row form-group">			        		
		        		<div class="col-md-6 col-sm-6 col-xs-6 error-div">
		        			<label class="required">Start Date</label>
		        			<input type="text" id="start_date" name="start_date" class="form-control datepicker" placeholder="YYYY-mm-dd"  readonly value="{{old('start_date')}}">
		        			@error('start_date')
								<span class="text-danger">
									<strong>{{$message}}</strong>
								</span>
							@enderror
		        		</div>
		        		<div class="col-md-6 col-sm-6 col-xs-6 error-div">
		        			<label class="required">End Date</label>
		        			<input type="text" id="end_date" name="end_date" class="form-control datepicker" placeholder="YYYY-mm-dd" readonly value="{{old('end_date')}}">
		        			@error('end_date')
								<span class="text-danger">
									<strong>{{$message}}</strong>
								</span>
							@enderror
		        		</div>			        		
		        	</div>
		        	<div class="row form-group">
		        		<div class="col-md-6 col-sm-6 col-xs-6 error-div">
		        			<label class="required">Batch Name</label>
		        			<input readonly="true" type="text" name="name" class="form-control" placeholder="YYYY-YYYY" value="{{old('name')}}">			        			
		        			
		        		</div>
		        	</div>
		        	<div class="row form-group">
		        		<div class="col-md-12">
		        			 <button type="submit" class="btn btn-primary">Submit</button>
					 		 @csrf
		        		</div>
		           	</div>			        	
		        </form>
				</div>
			</div>
		</div>
	</div>
</section>
<script src="{{asset('js/jquery.validate.min.js')}}"></script>
<script src="{{asset('js/validation/batch_validation.js')}}"></script>
@endsection