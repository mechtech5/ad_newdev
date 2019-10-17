<div class="row">
	<div class="col-md-12">
		<a href="{{route('case_doc.create',['case_id'=>$case_id.','.$page_name])}}" class="btn btn-md btn-primary pull-right">Add Document</a>
		
	</div>
</div>
<div class="row">
	<div class="col-md-12 col-sm-12 table-responsive">
		<br>
		<table class="table table-striped table-bordered myTable">
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