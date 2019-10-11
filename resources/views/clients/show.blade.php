@extends('lawfirm.layouts.main')
@section('content')
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<div class="row">
						<div class="col-md-6 col-xs-5 col-sm-6">
							<h3 style="margin-top: 8px;">Client Details</h3>
						</div>				
						<div class="col-md-6 col-xs-7 col-sm-6 text-right">
							<a href="{{route('case_mast.create', ['cust_id'=>$clientDetail->cust_id.',clients'])}}" class="btn btn-sm btn-primary ">Add New Case</a> 
										
							<a href="{{route('clients.index')}}" class="btn btn-sm btn-info ">Back</a> 

						</div>	
					</div>			
				</div>
				<div class="box-body">
					@if($message = Session::get('success'))
						<div class="alert bg-success">
							{{$message}}
						</div>
					@endif
					<div class="row">
						<div class=" col-md-6 col-sm-6">
							<h5><b>Name :</b> {{ $clientDetail->cust_name }}</h5>
							<h5><b>Gender :</b>
									@if($clientDetail->gender=='m')
										{{'Male'}}
									@elseif($clientDetail->gender=='f')
										{{'Female'}}
									@elseif($clientDetail->gender=='t')
										{{'Other'}}
									@else
										
									@endif
							</h5>
							<h5><b>Date of birth :</b> <?php echo date('d-m-Y', strtotime($clientDetail->dob)); ?></h5>
							<h5><b>Mobile Number :</b>								
									<span>{{$clientDetail->mobile1}}</span>
									<span>{{$clientDetail->mobile2}}</span>
							</h5>
							<h5><b>Email :</b> {{$clientDetail->email}}</h5>
							<h5><b>Registration Date :</b> {{ date('d-m-Y', strtotime($clientDetail->regsdate))}}</h5>
							
						</div>
						<div class="col-md-6 col-sm-6">
							<h5><b>Fax Number :</b> {{ $clientDetail->fax }}</h5>
							<h5><b>Tele Number :</b> {{ $clientDetail->tele }}</h5>
							<h5><b>PAN Number :</b> {{ $clientDetail->panno }}</h5>
							<h5><b>GST Number :</b> {{ $clientDetail->gstno }}</h5>
							<h5><b>Aadhar Number :</b> {{ $clientDetail->adharno }}</h5>
							<h5><b>Adddress :</b> {{ $clientDetail->custaddr }}</h5>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12 col-md-12 col-xs-12 mt-2">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 style="margin-top: 10px;">Client Cases</h3>
				</div>

				<div class="box-body table-responsive">
						<table class="table table-striped table-bordered" id="caseTable">
							<thead>
								<tr class="row">
									<th>SNo.</th>
									<th>Case Title</th>
									<th>Case Type</th>
									<th>Court Name</th>
									<th>Case Number</th>
									<th>Case Registration Date</th>
									<th>Case Over Date</th>
									<th>Case Fees</th>
									<th>Case Status</th>
									<th>Edit</th>
									<th>View Case</th>

								</tr>
							</thead>
							<tbody>
								@php $count = 0; @endphp
								@foreach($caseDetails as $caseDetail)
								<tr class="row">
									<td>{{++$count}}</td>
									<td>{{$caseDetail->case_title}}</td>
									<td>{{$caseDetail->court_name}}</td>
									<td>{{$caseDetail->casetype->case_type_desc}}</td>
									<td>{{$caseDetail->case_number}}</td>
									<td>{{$caseDetail->case_reg_date}}</td>
									<td>{{$caseDetail->case_over_date ? $caseDetail->case_over_date : '-'}}</td>
									<td></td>
									<td>{{$caseDetail->case_status_desc}}</td>
									<td class="d-flex">
										<span><a href="{{route('case_mast.edit', $caseDetail->case_id.',clients')}}" class="btn btn-sm btn-success"><i class="fa fa-edit text-white"></i></a></span>
										&nbsp;
										<span class="ml-3">

										<form action="{{route('case_mast.destroy', ['cust_id' =>  $caseDetail->case_id ])}}" method="POST" id="delform_{{ $caseDetail->case_id }}">
										@method('DELETE')

										<a href="javascript:$('#delform_{{ $caseDetail->case_id }}').submit();" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')" ><i class="fa fa-trash text-white" ></i></a>
										@csrf
										</form>

										</span>
									</td>
									<td>
									  <a href="{{ route('case_mast.show',$caseDetail->case_id.',clients')}}" class="btn btn-sm btn-success">View Case</a>

									</td>

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
		$('#caseTable').DataTable();
	});
</script>

@endsection
