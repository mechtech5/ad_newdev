@extends('lawschools.layouts.main')
@section('content')
<section class="content">
@include('student.header')

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">Upload Student</h4>
			</div>
			<div class="panel-body">	
				<div class="row">
					<div class="col-md-8" style="margin-top: 10px;" >
						<div class="row form-group">
							<div class="col-md-4">
								<label>Admission Batch</label>
								<select class="form-control" name="batch_id">
									<option value="">Select Admission Batch</option>
									@foreach($batches as $batch)
										<option value="{{$batch->id}}">{{$batch->name}}</option>
									@endforeach
								</select>
							</div>
							<div class="col-md-4">
								<label>Admission Year</label>
								<select class="form-control" name="qual_year">
									<option value="">Select Admission Year</option>
									<option value="1">1 year</option>
									<option value="2">2 year</option>
									<option value="3">3 year</option>
									<option value="4">4 year</option>
									<option value="5">5 year</option>								
								</select>
							</div>
							<div class="col-md-4">
								<label>Semester</label>
								<select class="form-control" name="semester">
									<option value="">Select Semester</option>
									<option value="1">1st</option>
									<option value="2">2nd</option>
									<option value="3">3rd</option>
									<option value="4">4th</option>
									<option value="5">5th</option>
									<option value="6">6th</option>
									<option value="7">7th</option>
									<option value="8">8th</option>
									<option value="9">9th</option>
									<option value="10">10th</option>								
								</select>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<button class="btn btn-md btn-info" id="exportBtn">Export</button> 
							</div>
						</div>
					</div>
					<div class="col-md-4 " style="margin-top: 10px;">
							<div class="row">
								<a href="{{route('student_sample')}}">
									<div class="col-md-12">
										<div class="info-box " >
											<span class="info-box-icon bg-green"><i class="fa fa-download"></i></span>
											<div class="info-box-content">
												<span class="info-box-text">DOWNLOAD SAMPLE</span>	
											</div>							
										</div>
									</div>
								</a>
								<br>
								<a href="{{route('all_students_export')}}">
									<div class="col-md-12">
										<div class="info-box " >
											<span class="info-box-icon bg-purple"><i class="fa fa-download"></i></span>
											<div class="info-box-content">
											<span class="info-box-text">Export All Student</span>										
										</div>							
										</div>
									</div>
								</a>

								<a href="#">
									<div class="col-md-12">
										<div class="info-box " >
											<span class="info-box-icon bg-purple"><i class="fa fa-download"></i></span>
											<div class="info-box-content">
											<span class="info-box-text">Export Student Batch, <br> Year & semester wise
											</span>										
										</div>							
										</div>
									</div>
								</a>
							</div>
						</div>
				</div>
			</div>
		</div>
	</div>
</div>
</section>

<script>
	$(document).ready(function(){
		$('#exportBtn').on('click',function(){
			var batch_id = $('select[name="batch_id"] option:selected').val();
			var qual_year = $('select[name="qual_year"] option:selected').val();
			var semester = $('select[name="semester"] option:selected').val();
			console.log(batch_id);
			console.log(qual_year);
			console.log(semester);
			if(batch_id !='' || qual_year !='' || semester !=''){
				console.log("success");
			}else{
				alert("select field");
			}
		});
	});

</script>
@endsection
