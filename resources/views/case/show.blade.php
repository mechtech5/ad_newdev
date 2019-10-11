@extends('lawfirm.layouts.main')
@section('content')
<section class="content">
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary ">
			<div class="box-header with-border" >			
				<div class="row">
					<div class="col-md-6"><h3 style="margin-top: 8px;">Case Details</h3> </div>
					<div class="col-md-6 text-right">
						
						@if($page_name == 'clients')						
							<a href="{{route('case_detail.create', ['case_id'=>$case_detail->case_id.',clients'])}}" class="btn btn-sm btn-primary mt-1" >Add Hearing</a>
							<a href="{{route('case_doc.create',['case_id'=>$case_detail->case_id.',clients'])}}" class="btn btn-sm btn-primary mt-1 ">Add Document</a>
							<a href="{{route('case_notes.create', ['case_id'=>$case_detail->case_id.',clients'])}}" class="btn btn-sm btn-primary mt-1">Add Notes</a>
							<a href="{{route('clients.show', $case_detail->cust_id)}}" class="btn btn-sm btn-info mt-1">Back</a>
						@else
							<a href="{{route('case_detail.create', ['case_id'=>$case_detail->case_id.',case_diary'])}}" class="btn btn-sm btn-primary mt-1" >Add Hearing</a>
							<a href="{{route('case_doc.create',['case_id'=>$case_detail->case_id.',case_diary'])}}" class="btn btn-sm btn-primary mt-1 ">Add Document</a>
							<a href="{{route('case_notes.create', ['case_id'=>$case_detail->case_id.',case_diary'])}}" class="btn btn-sm btn-primary mt-1">Add Notes</a>
							<a href="{{route('case_diary.index',['caseBtn'=>'cg'])}}" class="btn btn-sm btn-info mt-1">Back</a>
						@endif
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
					<div class="col-md-6">
						<h4><b>Customer Name: </b> {{$case_detail->client->cust_name}} </h4>
						<h4><b>Case Title : </b> {{ $case_detail->case_title }} </h4>
						<h4><b>Case Number. : </b> {{ $case_detail->case_number}}</h4>
						<h4><b>Case Type. : </b> {{$case_detail->casetype->case_type_desc}}</h4>
						<h4><b>From Court :</b> {{ $case_detail->court_name}}</h4>				
					</div>
					<div class="col-md-6">
						<h4><b>Appellant :</b> {{ $case_detail->appellant_name}} </h4>
						<h4><b>Respondant :</b> {{ $case_detail->respondant_name}} </h4>
						<h4><b>Registration Date :</b> {{ $case_detail->case_reg_date}} </b></h4>
						<h4><b>Last Over Date :</b> {{ $case_detail->case_over_date}} </h4>
						<h4><b>Case Fees :</b> {{ $case_detail->case_fees}} </h4>
						<h4><b>Case Status :</b>
								@if($case_detail->case_status == 'cw')
					              {{__('Case Win')}}
					            @elseif($case_detail->case_status == 'cg')
					              {{__('Case On going')}}
					            @elseif($case_detail->case_status == 'ct')
					              {{__('Case Lost')}}
					            @endif 
					        
			        	</h4>
					</div>

					<div class="col-md-12" >
						<hr>
						<h4><b>Case Summary</b></h4>
						<p style="font-size: 15px;">@php echo $case_detail->case_summary @endphp</p>
					</div>
					<div class="col-md-12 ">
						<hr>
						<h4><b>Case Remark</b></h4>
						<p style="font-size: 15px;">@php echo $case_detail->case_remark @endphp</p>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-12" style="margin-bottom: 10px;">
						<a href="" class="btn btn-sm btn-info" id="hearing_detail">Hearing Detail</a>
						<a href="" class="btn btn-sm btn-default" id="notes_detail">Notes Detail</a>
						<a href="" class="btn btn-sm btn-default" id="doc_detail">Document Detail</a>
					</div>
					<div class="col-md-12 col-sm-12 table-responsive">
						<table class="table table-striped table-bordered" id="hearingTable">
							<thead>
								<tr>
									<th>SNo</th>								
									<th>Lawyer Name</th>
									<th>Judge Name</th>
									<th>Hearing Date</th>
									<th>Next Hearing Date</th>								
									<th>Start Time</th>
									<th>Case Charged</th>		
									<th>Case Charges Type</th>	
									<th>Action</th>	
								</tr>														
							</thead>
							<tbody>

								@php $count = 0; @endphp
								@if(count($case_hearings) !=0)
								@foreach($case_hearings as $case_hearing)
								<tr>
									<td>{{++$count}}</td>									
									<td>{{ $case_hearing->lawyer_names}}</td>
									<td>{{ $case_hearing->judges_name}}</td>
									<td>{{ $case_hearing->hearing_date}}</td>
									<td>{{ $case_hearing->next_hearing_date}}</td>
									<td>{{ $case_hearing->start_time}}</td>
									<td>{{ $case_hearing->case_charged}}</td>		
									<td>@if($case_hearing->case_charges_type==1)
											{{'Cash'}}
										@else
											{{'Cheque'}}
										@endif
									</td>	
									<td class="d-flex">
										<span>
											@if($page_name == 'clients')
												<a href="{{ route('case_detail.edit', $case_hearing->case_tran_id.',clients') }}" class="btn btn-sm btn-success"><i class="fa fa-edit text-white"></i></a>
											@else
												<a href="{{ route('case_detail.edit', $case_hearing->case_tran_id.',case_diary') }}" class="btn btn-sm btn-success"><i class="fa fa-edit text-white"></i></a>
											@endif
										</span>
										<span class="ml-2">

										<form action="{{ route('case_detail.destroy',['id'=>$case_hearing->case_tran_id])}}" method="POST" id="delform_{{ $case_hearing->case_tran_id}}">
												@csrf
											@method('DELETE')
											<a href="javascript:$('#delform_{{ $case_hearing->case_tran_id}}').submit();" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger"><i class="fa fa-trash text-white"></i></a >
									
										</form>
										</span>
									</td>	
								</tr>
								@endforeach		
								@else
								<tr class="text-center">
									<td colspan="9">No matching records found</td>
								</tr>
								@endif			
							</tbody>
						</table>
                        
						<table class="table table-striped table-bordered" id="notesTable" style="display: none">
							<thead>
								<tr>
									<th>SNo</th>								
									<th>Case Notes Heading</th>					
									<th>Case Notes</th>							
									<th>Case Notes Date</th>
									<th>Case Notes Type</th>
									<th>Action</th>
								</tr>								
							</thead>
							<tbody>
								@php $count = 0; @endphp
								@if(count($case_notes) !=0)
								@foreach($case_notes as $case_note) 
								<tr>
									<td>{{++$count}}</td>
									<td>{{$case_note->case_note_heading}}</td>
									<td>{{$case_note->case_notes}}</td>
									<td>{{$case_note->case_note_date}}</td>
									<td>
										@if($case_note->case_notes_type=='p')
											{{'Personal'}}
										@else
											{{'Customer'}}
										@endif
									</td>
									<td class="d-flex">
									<span>
										@if($page_name == 'clients')
										<a href="{{route('case_notes.edit', ['notes_id'=> $case_note->case_notes_id.',clients'])}}" class="btn btn-sm btn-success"><i class="fa fa-edit text-white"></i>
										</a>
										@else
											<a href="{{route('case_notes.edit', ['notes_id'=> $case_note->case_notes_id.',case_diary'])}}" class="btn btn-sm btn-success"><i class="fa fa-edit text-white"></i>
										</a>
										@endif
									</span>
										&nbsp;
									<span class="ml-2">

									<form action="{{route('case_notes.destroy', ['notes_id' =>$case_note->case_notes_id])}}" method="POST" id="delform_{{$case_note->case_notes_id}}">
									@method('DELETE')

									<a href="javascript:$('#delform_{{$case_note->case_notes_id}}').submit();"  class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')" ><i class="fa fa-trash text-white" ></i></a>

									@csrf
								</form>

										</span>
									</td>
								</tr>	
								@endforeach	
								@else
								<tr class="text-center">
									<td colspan="6">No matching records found</td>
								</tr>
								@endif							
							</tbody>
						</table>
                       
						<table class="table table-striped table-bordered" id="docTable" style="display: none">
							<thead>
								<tr>
									<th>SNo</th>								
									<th>Document Name</th>						
									<th>Document Remark</th>
									<th>Document Type</th>
									<th>Action</th>		
								</tr>														
							</thead>
							<tbody>
								@php $count = 0; @endphp
								@if(count($case_docs) !=0)
								@foreach($case_docs as $case_doc)
								<tr>
									<td>{{++$count}}</td>
									<td><?php echo explode('_',$case_doc->doc_name,2)[1]; ?></td>
									<td>{{$case_doc->doc_remark}}</td>
									<td>
										@if($case_doc->doc_type=='P')
											{{'Personal Ref'}}
										@elseif($case_doc->doc_type == 'C')
											{{'Court Related'}}
										@elseif($case_doc->doc_type=='D')
											{{'Case Ref'}}
										@endif
										</td>
									<td class="d-flex">
									<span>
										<a href="{{asset($case_doc->doc_url)}}" class="btn btn-sm btn-success"><i class="fa fa-eye"></i>
										</a>
									</span>
									<span class="ml-2"> 
										<a href="{{route('fileDownload',['doc_id' =>$case_doc->doc_id])}}" class="btn btn-sm btn-info"><i class="fa fa-download"></i></a>
									</span>
							<span class="ml-2">
								<form action="{{route('case_doc.destroy',['doc_id'=>$case_doc->doc_id])}}" method="POST" id="delform_{{$case_doc->doc_id}}">
									@csrf
									@method('DELETE')

								<a href="javascript:$('#delform_{{$case_doc->doc_id}}').submit();" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')" ><i class="fa fa-trash" ></i></a>
							</form>
								</span>
									</td>

								</tr>							
								@endforeach	
								@else
								<tr class="text-center">
									<td colspan="5">No matching records found</td>
								</tr>
								@endif	
							</tbody>
						</table>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</section>
<script>
	$(document).ready(function(){
		
		$('#doc_detail').on('click', function(e){
			e.preventDefault();
			$('#hearingTable').hide();
			$('#notesTable').hide();
			$('#hearing_detail').removeClass('btn-info');
			$('#hearing_detail').addClass('btn-default');
			$('#notes_detail').removeClass('btn-info ');
			$('#doc_detail').addClass('btn-info');
			$('#docTable').show();
		});

		$('#hearing_detail').on('click', function(e){
			e.preventDefault();
			$('#hearingTable').show();
			$('#notesTable').hide();
			$('#hearing_detail').addClass('btn-info');
			$('#notes_detail').removeClass('btn-info ');
			$('#doc_detail').removeClass('btn-info');
			$('#docTable').hide();
		});

		$('#notes_detail').on('click', function(e){
			e.preventDefault();
			$('#hearingTable').hide();
			$('#notesTable').show();
			$('#hearing_detail').removeClass('btn-info');
			$('#hearing_detail').addClass('btn-default');
			$('#notes_detail').addClass('btn-info');
			$('#doc_detail').removeClass('btn-info');
			$('#docTable').hide();
		});
		  
		

           
	});
  
</script>
@endsection