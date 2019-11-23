@extends('lawschools.layouts.main')
@section('content')
<section class="content">
@include('student.header')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">Student List</h4>
			</div>
			<div class="panel-body">				
				<div class="row">
					<div class="col-md-8">
						<div class="row form-group">
							<div class="col-md-3">
								<select class="form-control">
									<option>Select Batch</option>
								</select>
							</div>
							<div class="col-md-3">
								<select class="form-control"> 
									<option>Select Year</option>
								</select>
							</div>
							<div class="col-md-3">
								<select class="form-control"> 
									<option>Select Semester</option>
								</select>
							</div>
							<div class="col-md-3">
								<button class="btn btn-sm btn-primary">Filter</button>
							</div>
						</div>			
					</div>
					<div class="col-md-4">
						<a href="{{route('student_detail.create')}}" class="btn btn-sm btn-success pull-right">Add Student</a>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-12">
						@include('student.student_detail.table')
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</section>
@endsection