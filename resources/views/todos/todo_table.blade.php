<table class="table table-striped table-bordered mytable">
	<thead>
		<tr>
			<th>#</th>
			<th>Title</th>
			<th>Description</th>
			<th>Start Date</th>								
			<th>End Date</th>								
			<th>Team Member</th>								
			<th>Status</th>								
		</tr>
	</thead>
	<tbody>
		@php $count = 0 ;@endphp
		@foreach($todos as $todo)
		<tr>
			<td>{{++$count}}</td>
			<td>{{$parent_id == null ? $todo->title : $todo->todos->title}}</td>
			<td>{{$parent_id == null ? $todo->description : $todo->todos->description}}</td>
			<td>{{$parent_id == null ? date('d-m-Y', strtotime($todo->start_date)) : date('d-m-Y', strtotime($todo->todos->start_date))}}</td>
			<td>{{$parent_id == null ? date('d-m-Y', strtotime($todo->end_date)) : date('d-m-Y', strtotime($todo->todos->end_date))}}</td>
			<td>
				@if($parent_id == null)
					@foreach($todo->users as $users)
						<span>{{$users->user->name . ', '}}</span>
					@endforeach
				@else
					@foreach($todo->todos->users as $users)
						<span>{{$users->user->name . ', '}}</span>
					@endforeach
				@endif
			</td>
			<td></td>
		</tr>
		@endforeach
	</tbody>
</table>
<script type="text/javascript">
	$(document).ready(function(){
		$('.mytable').DataTable();
	});
</script>