@extends('lawschools.layouts.main')
@section('content')
<section class="content">
@include('student.header')
<style>
	/*.tabs {
  max-width: 640px;
  margin: 0 auto;
  padding: 0 20px;
}*/
#tab-button {
  display: table;
  table-layout: fixed;
  width: 100%;
  margin: 0;
  padding: 0;
  list-style: none;
}
#tab-button li {
  display: table-cell;
  /*width: 20%;*/
}
#tab-button li a {
  display: block;
  padding: .5em;
  background: #eee;
  border: 1px solid #ddd;
  text-align: center;
  color: #000;
  text-decoration: none;
}
#tab-button li:not(:first-child) a {
  border-left: none;
}
#tab-button li a:hover,
#tab-button .is-active a {
  border-bottom-color: transparent;
  background: #fff;
}

.tab-contents {
  padding: .5em 2em 1em;
  border: 1px solid #ddd;
}

.tab-button-outer {
  display: none;
}

.tab-contents {
  margin-top: 20px;
}

@media screen and (min-width: 768px) {
  .tab-button-outer {
    position: relative;
    z-index: 2;
    display: block;
  }
  .tab-select-outer {
    display: none;
  }
  .tab-contents {
    position: relative;
    top: -1px;
    margin-top: 0;
  }
}
</style>		
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1 class="panel-title">Student Details</h1>

			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">					
						<div class="tab-button-outer">
						    <ul id="tab-button">
						      <li><a href="#tab01">Basic Details</a></li>
						      <li><a href="#tab02">Academic Details</a></li>
						      <li><a href="#tab03">Guardian Info</a></li>
						      <li><a href="#tab04">Student Address</a></li>
						      <li><a href="#tab05">Student Documents</a></li>
						    </ul>
						</div>
						<div class="tab-select-outer">
						    <select id="tab-select" class="form-control">
						      <option value="#tab01">Basic Details</option>
						      <option value="#tab02">Academic Details</option>
						      <option value="#tab03">Guardian Info</option>
						      <option value="#tab04">Student Address</option>
						      <option value="#tab05">Student Documents</option>
						    </select>
						</div>

						  <div id="tab01" class="tab-contents">
						  	<div class="row " style="margin-top: 10px;">
						  		<div class="col-md-2">
						  			<label class="">Student Photo</label>
						  			<img src="{{asset($student->photo !=null ? 'storage/'.$student->photo : 'images/student_demo.png')}}" style="width: 100px; height: 100px;">
						  		</div>
						  		<div class="col-md-10">
						  			<div class="row form-group">
						  				<div class="col-md-4">
						  					<label>Student Full Name</label>
						  					<input type="text" readonly value="{{ucwords($student->f_name .' '. $student->m_name .' '. $student->l_name)}}" class="form-control">
						  				</div>
						  				<div class="col-md-4">
						  					<label>Mobile Number</label>
						  					<input type="text" readonly value="{{$student->mobile}}" class="form-control">
						  				</div>
						  				<div class="col-md-4">
						  					<label>Date of Birth</label>
						  					<input type="text" readonly value="{{$student->dob}}" class="form-control">
						  				</div>
						  			</div>
						  			<div class="row form-group">
						  				<div class="col-md-4">
						  					<label>Student Gender</label>
						  					<input type="text" readonly value="{{$student->gender == 'm' ? 'Male' : ($student->gender == 'f' ? 'Female' : 'Other')}}" class="form-control">
						  				</div>
						  				<div class="col-md-4">
						  					<label>Enrollment Number</label>
						  					<input type="text" readonly value="{{$student->enroll_no}}" class="form-control">
						  				</div>
						  				<div class="col-md-4">
						  					<label>Roll Number</label>
						  					<input type="text" readonly value="{{$student->roll_no}}" class="form-control">
						  				</div>
						  			</div>
						  		</div>
						  	</div>
						  	<div class="row form-group" style="margin-top: 10px;">
						  		<div class="col-md-3">
						  			<label>Qualification Name</label>
						  			<input type="text" readonly value="{{$student->qual_course->qual_catg_desc}}" class="form-control">
						  		</div>
						  		<div class="col-md-3">
						  			<label>Course Name</label>
						  			<input type="text" readonly value="{{$student->qual_course->qual_desc}}" class="form-control">
						  		</div>
						  		<div class="col-md-3">
						  			<label>Admission Date</label>
						  			<input type="text" readonly value="{{date('d-m-Y', strtotime($student->addm_date))}}" class="form-control">
						  		</div>
						  		<div class="col-md-3">
						  			<label>Student Status</label>
						  			<input type="text" readonly value="{{$student->status == 'R' ? 'Running' : ($student->status == 'P' ? 'Pass' : 'Fail')}}" class="form-control">
						  		</div>
						  	</div>
						  	<div class="row form-group" style="margin-top: 10px;">
						  		@if($student->status == 'P')
						  		<div class="col-md-3">
						  			<label>Passout Date</label>
						  			<input type="text" readonly value="{{$student->passout_date}}" class="form-control">
						  		</div>
						  		@endif
						  		<div class="col-md-3">
						  			<label>Year of Admission</label>
						  			<input type="text" readonly value="{{$student->qual_year}} Year" class="form-control">
						  		</div>
						  		<div class="col-md-3">
						  			<label>Admission Batch</label>
						  			<input type="text" readonly value="{{$student->batch !=null ? $student->batch->name : '' }}" class="form-control">
						  		</div>
						  		<div class="col-md-3">
						  			<label>Semester</label>
						  			<input type="text" readonly value="{{$student->semester !=null ? $student->semester : '' }} sem" class="form-control">
						  		</div>
						  	</div>

						  	<div class="row form-group" style="margin-top: 10px;">	
						  		<div class="col-md-3">
						  			<label>Age</label>
						  			<input type="text" readonly value="{{$student->age }}" class="form-control">
						  		</div>			  	
						  		<div class="col-md-3">
						  			<label>Email Address</label>
						  			<input type="text" readonly value="{{$student->email}}" class="form-control">
						  		</div>
						  		<div class="col-md-3">
						  			<label>Cast Category</label>
						  			<input type="text" readonly value="{{$student->reservation->name
						  			 }}" class="form-control">
						  		</div>
						  		<div class="col-md-3">
						  			<label>Religion</label>
						  			<input type="text" readonly value="{{$student->religion !=null ? $student->religion->name : '' }}" class="form-control">
						  		</div>
						  	</div>
						  	<div class="row form-group" style="margin-top: 10px;">
						  		<div class="col-md-3">
						  			<label>Blood Group</label>
						  			<input type="text" readonly value="{{($student->blood_group == '1' ? 'A+' : ($student->blood_group == '2' ? 'A-' : ($student->blood_group == '3' ? 'B' : ($student->blood_group == '4' ? 'B-' : ($student->blood_group == '5' ? 'O+' : ($student->blood_group == '6' ? 'O-' : ($student->blood_group == '7' ? 'AB+' : ($student->blood_group == '8' ? 'AB-' : ''))))))))}}" class="form-control">
						  		</div>	
						  		<div class="col-md-3">
						  			<label>Nationality</label>
						  			<input type="text" readonly value="{{$student->country !=null ? $student->country->nationality : '' }}" class="form-control">
						  		</div>
						  		<div class="col-md-3">
						  			<label>Mother Tongue</label>
						  			<input type="text" readonly value="{{$student->language !=null ? $student->language->name : '' }}" class="form-control">
						  		</div>
						  		<div class="col-md-3">
						  			<label>Taluka</label>
						  			<input type="text" readonly value="{{$student->taluka}} Year" class="form-control">
						  		</div>
						  	</div>
						  	<div class="row form-group" style="margin-top: 10px;">
						  		
						  		<div class="col-md-3">
						  			<label>Student SSMID</label>
						  			<input type="text" readonly value="{{$student->s_ssmid}}" class="form-control">
						  		</div>
						  		<div class="col-md-3">
						  			<label>Family SSMID</label>
						  			<input type="text" readonly value="{{$student->f_ssmid }}" class="form-control">
						  		</div>
						  		<div class="col-md-3">
						  			<label>Addhar Card</label>
						  			<input type="text" readonly value="{{$student->aadhar_card }}" class="form-control">
						  		</div>
						  		<div class="col-md-3">
						  			<label>Spec Ailment</label>
						  			<input type="text" readonly value="{{$student->spec_ailment}}{" class="form-control">
						  		</div>
						  	</div>
						  	<hr>
						  	<h4>Student Banking Details</h4>
						  	<div class="row form-group" style="margin-top: 10px;">
						  		<div class="col-md-4">
						  			<label>Bank Name</label>
						  			<input readonly class="form-control" value="{{$student->bank_name}}">
						  		</div>
						  		<div class="col-md-4">
						  			<label>Bank Branch</label>
						  			<input readonly class="form-control" value="{{$student->bank_branch}}">
						  		</div>
						  		<div class="col-md-4">
						  			<label>Account Holder Name</label>
						  			<input readonly class="form-control" value="{{$student->account_name}}">
						  		</div>
						  		
						  		
						  	</div>
						  	<div class="row form-group" style="margin-top: 10px;">
						  		<div class="col-md-6">
						  			<label>Account Number</label>
						  			<input readonly class="form-control" value="{{$student->account_no}}">
						  		</div>
						  		<div class="col-md-6">
						  			<label>ISFC CODE</label>
						  			<input readonly class="form-control" value="{{$student->ifsc_code}}">
						  		</div>
						  	</div>


						  </div>

						  <div id="tab02" class="tab-contents">
						    	<h3>Student Previous Year Academic Details</h3>
						    	<hr>
						    	@if(count($student->stu_qual_details) !=0)
							    	@foreach($student->stu_qual_details as $qual_detl)
								    	<div class="row form-group" style="margin-top: 10px">
								    		<div class="col-md-4">
								    			<label>Qualification Name</label>
								    			<input readonly class="form-control" value="{{$qual_detl->name}}">
								    		</div>	 
								    		<div class="col-md-4">
								    			<label>School/College</label>
								    			<input readonly class="form-control" value="{{ucwords($qual_detl->school)}}">
								    		</div>	
								    		<div class="col-md-4">
								    			<label>Board/University</label>
								    			<input readonly class="form-control" value="{{strtoupper($qual_detl->board)}}">
								    		</div>	
								    	</div>
								    	<div class="row form-group" style="margin-top: 10px">
								    		<div class="col-md-4">
								    			<label>Passing Year</label>
								    			<input readonly class="form-control" value="{{$qual_detl->pass_year}}">
								    		</div>	
								    		<div class="col-md-4">
								    			<label>Marks</label>
								    			<input readonly class="form-control" value="{{$qual_detl->pass_marks}}">
								    		</div>	
								    		<div class="col-md-4">
								    			<label>Passing Division</label>
								    			<input readonly class="form-control" value="{{$qual_detl->pass_division}}">
								    		</div>		
								    	</div>
								    	<hr>
								    @endforeach
								@else
									<div class="row form-group" style="margin-top: 10px">
							    		<div class="col-md-4">
							    			<label>Qualification Name</label>
							    			<input readonly class="form-control" value="">
							    		</div>	 
							    		<div class="col-md-4">
							    			<label>School/College</label>
							    			<input readonly class="form-control" value="">
							    		</div>	
							    		<div class="col-md-4">
							    			<label>Board/University</label>
							    			<input readonly class="form-control" value="">
							    		</div>	
							    	</div>
							    	<div class="row form-group" style="margin-top: 10px">
							    		<div class="col-md-4">
							    			<label>Passing Year</label>
							    			<input readonly class="form-control" value="">
							    		</div>	
							    		<div class="col-md-4">
							    			<label>Marks</label>
							    			<input readonly class="form-control" value="">
							    		</div>	
							    		<div class="col-md-4">
							    			<label>Passing Division</label>
							    			<input readonly class="form-control" value="">
							    		</div>		
							    	</div>
							    @endif
						  </div>
						  <div id="tab03" class="tab-contents">

						  	@if(count($student->stud_guardians) !=0)
						  	@foreach($student->stud_guardians as $guardian)
						   	<div class="row" style="margin-top: 10px;">
						   		<div class="col-md-2">
						  			<label>{{$guardian->relation !=null ? $guardian->relation->name : 'Guardian' }} Photo</label>
						  			<img src="{{asset($guardian->photo !=null ? 'storage/'.$guardian->photo : 'images/student_demo.png')}}" style="width: 100px; height: 100px;">


						  		</div>
						  		<div class="col-md-10">
						  			<div class="row form-group">
						  				<div class="col-md-3">
						  					<label>Relation Name</label>
						  					<input readonly value="{{$guardian->relation !=null ? $guardian->relation->name : '' }}" class="form-control">
						  				</div>
						  				<div class="col-md-3">
						  					<label>Name</label>
						  					<input readonly value="{{$guardian->name}}" class="form-control">
						  				</div>
						  				<div class="col-md-3">
						  					<label>Mobile</label>
						  					<input readonly value="{{$guardian->mobile}}" class="form-control">
						  				</div>
						  				<div class="col-md-3">
						  					<label>Work Status</label>
						  					<input readonly value="{{$guardian->work_type_id == '1' ? 'Self Employed'  : ($guardian->work_type_id == '2' ? 'Job' : ($guardian->work_type_id == '3' ? 'Retired'  : ''))}}" class="form-control">
						  				</div>
						  			</div>

						  			<div class="row form-group">
						  				<div class="col-md-3">
						  					<label>Employment Type</label>
						  					<input readonly value="{{$guardian->employment_type == '0' ? 'Goverment' : ($guardian->employment_type == '1' ? 'Private' : '')}}" class="form-control">
						  				</div>
						  				<div class="col-md-3">
						  					<label>Professtion Type</label>
						  					<input readonly value="{{$guardian->profession !=null ? $guardian->profession->name : ''}}" class="form-control">
						  				</div>
						  				<div class="col-md-3">
						  					<label>Employer</label>
						  					<input readonly value="{{$guardian->employer}}" class="form-control">
						  				</div>
						  				<div class="col-md-3">
						  					<label>Designation</label>
						  					<input readonly value="{{$guardian->designation !=null ? $guardian->designation->name : ''}}" class="form-control">
						  				</div>
						  			</div>
						  		</div>
						   	</div>
						   	<hr>
						   @endforeach
						   @else
						   	<div class="row" style="margin-top: 10px;">
						   		<div class="col-md-12 text-center">
						   			<h4>Records Not Found</h4>
						   		</div>
						   	</div>
						   @endif
						  </div>
						  <div id="tab04" class="tab-contents">

						   	<div class="row" style="margin-top: 10px">
						   		<div class="col-md-12">
						   			@if(count($student->stud_addresses) !=0) 
						   			@foreach($student->stud_addresses as $addr)
						   			<div class="panel panel-default">
						   				<div class="panel-heading">
						   					<h1 class="panel-title">{{$addr->addr_type == 'S' ? 'Permanent & Local ' : ($addr->addr_type == 'P' ? 'Permanent ' : 'Local ')}} Address</h1>
						   				</div>
						   				<div class="panel-body">
						   					<div class="row form-group">
						   						<div class="col-md-4">
						   							<label>Address Line</label>
						   							<input readonly value="{{$addr->address}}" class="form-control">
						   						</div>
						   						<div class="col-md-4">
						   							<label>Country Name</label>
						   							<input readonly value="{{$addr->country_name}}" class="form-control">
						   						</div>
						   						<div class="col-md-4">
						   							<label>State Name</label>
						   							<input readonly value="{{$addr->state_name}}" class="form-control">
						   						</div>
						   					</div>
						   					<div class="row form-group">
						   						<div class="col-md-4">
						   							<label>City Name</label>
						   							<input readonly value="{{$addr->city_name}}" class="form-control">
						   						</div>
						   						<div class="col-md-4">
						   							<label>Zip Code</label>
						   							<input readonly value="{{$addr->zip_code}}" class="form-control">
						   						</div>						   						
						   					</div>
						   				</div>
						   			</div>
						   			@endforeach
						   			@else
						   				<h4 class="text-center">Records Not found</h4>
						   			@endif
						   		</div>
						   	</div>
						  </div>
						  <div id="tab05" class="tab-contents">
						    <h2>Tab 5</h2>
						    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius quos aliquam consequuntur, esse provident impedit minima porro! Laudantium laboriosam culpa quis fugiat ea, architecto velit ab, deserunt rem quibusdam voluptatum.</p>
						  </div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(function() {
  var $tabButtonItem = $('#tab-button li'),
      $tabSelect = $('#tab-select'),
      $tabContents = $('.tab-contents'),
      activeClass = 'is-active';


  $tabButtonItem.first().addClass(activeClass);
  $tabContents.not(':first').hide();

  $tabButtonItem.find('a').on('click', function(e) {
    var target = $(this).attr('href');
    // console.log(target);
    $tabButtonItem.removeClass(activeClass);
    $(this).parent().addClass(activeClass);
    $tabSelect.val(target);
    $tabContents.hide();
    $(target).show();
    e.preventDefault();
  });

  $tabSelect.on('change', function() {
    var target = $(this).val(),
        targetSelectNum = $(this).prop('selectedIndex');

    $tabButtonItem.removeClass(activeClass);
    $tabButtonItem.eq(targetSelectNum).addClass(activeClass);
    $tabContents.hide();
    $(target).show();
  });
});
</script>
@endsection
			