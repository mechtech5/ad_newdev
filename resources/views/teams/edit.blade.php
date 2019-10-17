@extends(Auth::user()->user_catg_id=='4' ? 'lawschools.layouts.main' : 'lawfirm.layouts.main')
@section('content')
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="">Edit Team Member <a href="{{route('teams.index')}}" class="btn btn-sm btn-primary pull-right">Back</a></h3>
					</div>
					<div class="box-body">
						<form action="{{route('teams.update',$member->id)}}" method="post">
							@csrf
							@method('PATCH')
							<div class="row form-group">
								<div class="col-md-6">
									<label for="name">User Name <span class="text-danger">*</span></label>
									<input type="text" class="form-control timepicker" name="name" value="{{old('name') ?? $member->name}}">  
									@error('name')
	                                    <span class="text-danger">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror      
								</div>	
								<div class="col-md-6">
									<label for="email">Email Address <span class="text-danger">*</span></label>
									<input type="text" name="email" class="form-control" value="{{old('email') ?? $member->email}}">
									@error('email')
	                                    <span class="text-danger">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror
								</div>
							</div>	
							<div class="row form-group">
								<div class="col-md-6">
									<label for="mobile">Mobile Number <span class="text-danger">*</span></label>
									<input type="text" class="form-control timepicker" name="mobile" value="{{old('mobile') ?? $member->mobile}}"> 
									@error('mobile')
	                                    <span class="text-danger">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror     
								</div>	
							</div>						
							<div class="row ">
								<div class="col-md-12 ">
									<input type="submit" value="Update" class="btn btn-sm btn-primary">
								</div>								
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	
@endsection