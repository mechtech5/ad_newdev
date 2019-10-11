<table class="table table-striped table-bordered">
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
			<td>{{$todo->title}}</td>
			<td>{{$todo->description}}</td>
			<td>{{date('d, M, Y',strtotime($todo->start_date))}}</td>
			<td>{{date('d, M, Y',strtotime($todo->end_date))}}</td>
			<td>{{$todo->user->name}}</td>
			<td>{{$todo->status == 'P' ? 'Pending' : 'completed'}}</td>
		</tr>
		@endforeach
	</tbody>
</table>