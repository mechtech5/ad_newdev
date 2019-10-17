<div class="row">
	<div class="col-md-12">			
		<a href="{{route('case_hearing.create', ['case_id'=>$case_id.','.$page_name])}}" class="btn btn-md btn-primary pull-right" >Add Hearing</a>		
	</div>
</div>
<div class="row">
	<div class="col-md-12 col-sm-12 table-responsive">
		<br>
	<table class="table table-striped table-bordered myTable">
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
						<a href="{{ route('case_detail.edit', $case_hearing->case_tran_id.','.$page_name) }}" class="btn btn-sm btn-success"><i class="fa fa-edit text-white"></i></a>					
						<a href="{{ route('case_detail.edit', $case_hearing->case_tran_id.',case_diary') }}" class="btn btn-sm btn-success"><i class="fa fa-edit text-white"></i></a>
				
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
		</tbody>
	</table>
	</div>
</div>
<script >
	$('.myTable').DataTable({
          searching:true,
          scrolling:true,
    });
</script>