@extends('lawschools.layouts.main')
@section('content')
<section class="content">
<div class="row">
	<div class="col-md-12 m-auto " >
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 style="margin-top: 10px;">Edit Qulification <a href="{{route('course.index')}}" class="btn btn-sm btn-info pull-right">Back</a></h3>
			</div>
			<div class="box-body">
				@if($message = Session::get('warning'))
					<div class="alert bg-warning">
						{{$message}}
					</div>
				@endif
				<form  action="{{route('course.update',$data->id)}}" method="post">
				{{csrf_field()}}
				@method('PATCH')
					<div class="row form-group ">				
						<div class="col-md-6" style="margin-top:10px;">	
							<label for="qual_code">Qulification Name<span class="text-danger">*</span></label>
							<select name="qual_catg_code" class="form-control" id="qual_catg_code">
								<option value="">Select Qualification Name</option>
								@foreach($courses as $course)
									<option value="{{$course->qual_catg_code}}"  {{$data->qual_catg_code == $course->qual_catg_code ? 'selected' : ''}}>{{$course->qual_catg_desc}}</option>
								@endforeach
							</select>
							@error('course_code')
			                    <span class="invalid-feedback text-danger" role="alert">
			                       <strong>{{ $message }}</strong>
			                    </span>
			                 @enderror
						</div>
						<div class="col-md-6" style="margin-top:10px;">	
							<label for="qual_code">Cource Name<span class="text-danger">*</span></label>
							<select name="qual_code" class="form-control" id="qual_course">
								
							</select>
							@error('qual_code')
			                    <span class="invalid-feedback text-danger" role="alert">
			                       <strong>{{ $message }}</strong>
			                    </span>
			                 @enderror
						</div>
					</div>
					<div class="row form-group">
			        		<div class="col-md-6 ">
			        			<label for="course_duration">Course Duration<span class="text-danger">*</span></label><span class="text-muted">(course duration must be enter month wise only 5 year month add)</span>
			        			<input type="text" name="course_duration" class="form-control" placeholder="Enter total number of length	" value="{{$data->course_duration }}">	
			        			@error('course_duration')
			                    <span class="invalid-feedback text-danger" role="alert">
			                       <strong>{{ $message }}</strong>
			                    </span>
			                 @enderror
			        		</div>
			        </div>		
					<div class="row form-group ">
						<div class="col-sm-12 col-md-12" style="margin-top:10px;">	
							<label for="username">Syllabus </label>
							<textarea name="syllabus" rows="10" cols="50" class="form-control tinymce" placeholder="About You.."  id="summernote">{{old('syllabus') ?? $data->syllabus}}</textarea>

							@error('syllabus')
			                    <span class="invalid-feedback text-danger" role="alert">
			                       <strong>{{ $message }}</strong>
			                    </span>
			                 @enderror
						</div>
					</div>
					<div class="row form-group ">
						<div class="col-md-12" style="margin-top:10px;">
							<input type="submit" class="btn btn-md btn-info" value="Submit" id="submitdata">
						</div>
					</div>
				</form>
			</div>			

			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
	$(document).ready(function(){
		var qual_catg_code = "{{$data->qual_catg_code}}";
			var qual_code = "{{$data->qual_code}}";
			qual_course(qual_catg_code,qual_code);

		$('#qual_catg_code').on('change',function(e){
			e.preventDefault();
			var qual_catg_code = $(this).val();
			var qual_code = "";
			qual_course(qual_catg_code,qual_code);

		});
		
		});
</script>


@endsection