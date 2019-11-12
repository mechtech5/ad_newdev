@extends('admin.main')
@section('content')
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="">Create Nationality Name<a href="{{route('nationality.index')}}" class="btn btn-sm btn-primary pull-right">Back</a></h3>
					</div>
					<div class="box-body">
						<form action="{{route('nationality.store')}}" method="post" >
						@csrf 
							<div class="row form-group">							
								<div class="col-md-6">
									<label for="">Nationality Name <span class="text-danger">*</span>
									</label>
									<input type="text" class="form-control" name="name" required="" placeholder="Enter Nationality Name" value="{{old('name')}}">
									@error('name')
										<span class="text-danger">
											<strong>{{$message}}</strong>
										</span>
									@enderror
					            </div>
							</div>					
							<div class="row ">
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
