@extends('lawfirm.layouts.main')
@section('content')
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h4 class="">To-Dos Details						
						<a href="{{route('todos.index')}}" class="btn btn-sm btn-info pull-right">Back</a>
						@if($todo->user_id == Auth::user()->id)
						<a href="{{route('todos.edit',$todo->id)}}" class="pull-right btn btn-sm btn-success" style="margin-right: 10px;">Edit</a>
						@endif
					</h4>

				</div>
				<div class="box-body">
					<div class="row" style="margin-top:10px; ">
						<div class="col-md-12">
							@if($message = Session::get('success'))
								<div class="alert bg-success">{{$message}}</div>
							@endif
						</div>
					</div>	
					<div class="row">
						<div class="col-md-2 col-xl-2 col-sm-2"> <h4><b >Title : </b></h4> </div>
						<div class="col-md-6 col-xl-6 col-sm-6"> <h4 class="text-capitalize">{{$todo->title}}</h4> </div>
					</div>
					@if($todo->relate_to_case !=null)
						<div class="row">
							<div class="col-md-2 col-xl-2 col-sm-2"> <h4><b>Related Case Title : </b></h4> </div>
							<div class="col-md-6 col-xl-6 col-sm-6"> <h4 class="text-capitalize">{{$todo->relate_to_case->case_title}}</h4> </div>
						</div>
					@endif
					<div class="row">
						<div class="col-md-2 col-xl-2 col-sm-2"> <h4><b>Creator : </b></h4> </div>
						<div class="col-md-6 col-xl-6 col-sm-6"> <h4 class="text-capitalize">{{$todo->created_user->name}}</h4> </div>
					</div>
					<div class="row">
						<div class="col-md-2 col-xl-2 col-sm-2"> <h4><b>Assignee : </b></h4> </div>
						<div class="col-md-6 col-xl-6 col-sm-6"> <h4>{{$todo->assigned_user->name}}</h4> </div>
					</div>
					<div class="row">
						<div class="col-md-2 col-xl-2 col-sm-2"> <h4><b>Start Date : </b></h4> </div>
						<div class="col-md-6 col-xl-6 col-sm-6"> <h4>{{date('d-m-Y', strtotime($todo->start_date))}}</h4> </div>
					</div>
					<div class="row">
						<div class="col-md-2 col-xl-2 col-sm-2"> <h4><b>End Date : </b></h4> </div>
						<div class="col-md-6 col-xl-6 col-sm-6"> <h4>{{date('d-m-Y', strtotime($todo->end_date))}}</h4> </div>
					</div>
					<div class="row">
						<div class="col-md-2 col-xl-2 col-sm-2"> <h4><b>Status : </b></h4> </div>
						<div class="col-md-6 col-xl-6 col-sm-6"> <h4>{{ $todo->status == 'P' ? 'Pending' : ($todo->status == 'A' ? 'Awaiting' : ($todo->status == 'C' ? 'completed' : ($todo->status == 'M' ? 'Missed' : 'Closed')))}}</div>
					</div>
					<div class="row">
						<div class="col-md-12 col-xl-12 col-sm-12"> <h4><b>Description : </b></h4> </div>
						<div class="col-md-12 col-xl-12 col-sm-12">
							@php 
								echo $todo->description;
							@endphp 
						</div>
					</div>					
				</div>
			</div>
		</div>
	</div>
</section>
@endsection