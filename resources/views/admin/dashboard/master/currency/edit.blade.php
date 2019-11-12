@extends('admin.main')
@section('content')
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="">Edit Currency Name<a href="{{route('currency.index')}}" class="btn btn-sm btn-primary pull-right">Back</a></h3>
					</div>
					<div class="box-body">
						<form action="{{route('currency.update', $currency->currency_code)}}" method="post" >
						@method('PATCH')
						@csrf 
							<div class="row form-group">	
								<div class="col-md-6">
									<label for="">Currency Code <span class="text-danger">*</span>
									</label>
									<input type="text" class="form-control " name="currency_code" required="" placeholder="Enter Currency Code" value="{{old('currency_code') ?? $currency->currency_code}}">
									@error('currency_code')
										<span class="text-danger">
											<strong>{{$message}}</strong>
										</span>
									@enderror
					            </div>						
								<div class="col-md-6">
									<label for="">Currency Name <span class="text-danger">*</span>
									</label>
									<input type="text" class="form-control" name="currency_name" required="" placeholder="Enter Currency Name" value="{{old('currency_name') ??  $currency->currency_name}}">
									@error('currency_name')
										<span class="text-danger">
											<strong>{{$message}}</strong>
										</span>
									@enderror
					            </div>					           
							</div>	
							<div class="row form-group">
								 <div class="col-md-6">
									<label for="">Currency Symbol</label>
									<input type="text" class="form-control" name="symbol" placeholder="Enter Currency Symbol" value="{{old('symbol') ??  $currency->symbol}}">
									@error('symbol')
										<span class="text-danger">
											<strong>{{$message}}</strong>
										</span>
									@enderror
					            </div>
							</div>				
							<div class="row form-group">
								<div class="col-md-12 ">
									<input type="submit" value="Submit" class="btn btn-sm btn-primary">
								</div>								
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>

@endsection
