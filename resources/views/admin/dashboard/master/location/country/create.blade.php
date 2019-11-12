@extends('admin.main')
@section('content')
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="">Add Country <a href="{{route('country.index')}}" class="btn btn-sm btn-primary pull-right">Back</a></h3>
					</div>
					<div class="box-body">
						<form action="{{route('country.store')}}" method="post">
							@csrf
							<div class="row form-group">
								<div class="col-md-6 col-sm-6">
									<label for="country_name">Country Name <span class="text-danger">*</span></label>
									<input type="text" name="country_name" class="form-control" placeholder="Enter Country Name" value="{{old('country_name')}}">
									@error('country_name')
										<span class="text-danger">
											<strong>{{$message}}</strong>
										</span>
									@enderror
								</div>
								<div class="col-md-6 col-sm-6">
									<label for="phone_code">Phone Code</label>
									<input type="text" name="phone_code" class="form-control" placeholder="Enter Phone Code" value="{{old('phone_code')}}">
									@error('phone_code')
										<span class="text-danger">
											<strong>{{$message}}</strong>
										</span>
									@enderror
								</div>
								
							</div>
							<div class="row form-group">
								<div class="col-md-6 col-sm-6">
									<label for="iso2">Country Short Name (2 Letter)</label>
									<input type="text" name="iso2" class="form-control" value="{{old('iso2')}}"> 
									@error('iso2')
										<span class="text-danger">
											<strong>{{$message}}</strong>
										</span>
									@enderror
								</div>
								<div class="col-md-6 col-sm-6">
									<label for="iso3">Country Short Name (3 Letter)</label>
									<input type="text" name="iso3" class="form-control" value="{{old('iso3')}}">
									@error('iso3')
										<span class="text-danger">
											<strong>{{$message}}</strong>
										</span>
									@enderror
								</div>
							</div>
							<div class="row form-group">
								<div class="col-md-6">
									<label>Nationality</label>
									<select name="nationality_id" class="form-control">
										<option value="0">Select Nationality</option>
										@foreach($nationalities as $nationality)
											<option value="{{$nationality->id}}">{{$nationality->name}}</option>
										@endforeach
									</select>
								</div>
								<div class="col-md-6">
									<label>Currency</label>
									<select name="currency_code" class="form-control">
										<option value="0">Select Nationality</option>
										@foreach($currencies as $currency)
											<option value="{{$currency->currency_code}}">{{$currency->currency_name}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="row form-group">
								<div class="col-md-12">
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