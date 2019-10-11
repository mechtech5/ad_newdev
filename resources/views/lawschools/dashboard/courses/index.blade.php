@extends('lawschools.layouts.main')
@section('content')
<section class="content">
<div class="row">
	<div class="col-md-12 col-xs-12 col-sm-12 m-auto">
		<div class="box box-primary">
			<div class="box-header with-border" >
				<h3 style="margin-top: 10px;">Courses  <a href="{{route('course.create')}}" class="btn btn-sm btn-info pull-right">Add Course</a></h3>
			</div>
			<div class="box-body  table-responsive pt-2 pb-2" >
				@if($message = Session::get('success'))
					<div class="alert bg-success">
						{{$message}}
					</div>
				@endif
				<table class="table table-hover table-striped table-bordered"  id="ClientsTable">
					<thead>
						<tr class="row">
							<th>SNo.</th>
							<th>Course Name</th>
							<th>Course Duration</th>
							<th>Action</th>
							{{-- <th>View</th> --}}
						</tr>
					</thead>
					<tbody>
						@php $count = 0; @endphp

						@foreach($courses as $cours)
						<tr class="row">
							<td>{{++$count}}</td>
							<td>{{$cours->course_desc}}</td>
							<td>{{$cours->course->course_duration}} years</td>
							<td class="">
								<form action="{{route('course.destroy',$cours->id)}}" method="POST" id="delform_{{$cours->id}}">
									@method('DELETE')

									<a href="{{route('course.edit',$cours->id)}}" class="btn btn-sm bg-green"><i class="fa fa-edit"></i></a>

									<a href="javascript:$('#delform_{{$cours->id}}').submit();" onclick="return confirm('Are you sure?')"  class="btn btn-sm bg-red" ><i class="fa fa-trash" ></i></a>


									<a href="{{route('course.show', $cours->id)}}" class="btn btn-sm btn-primary"><i class="fa fa-eye text-white"></i></a>
									
									@csrf
								</form>

								</span>
							</td>
							{{-- <td></td> --}}

						</tr>
						@endforeach
					</tbody>
				</table>
				
			</div>
		</div>
	</div>
</div>
</section>

<script>
	$(document).ready(function(){
		$('#ClientsTable').DataTable();
	});
</script>
@endsection