@extends('lawfirm.main')
@section('content')
<section class="content">
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header">
				<h5>All Notifications 
					<a href="{{route('lawfirm.index')}}" class="btn btn-sm btn-info pull-right">Back</a>
				</h5>
			</div>
			<div class="box-body">
				<div class="row">
					<div class="col-md-12">
						<ul>
		                  @forelse(Auth::user()->unreadNotifications as $notification)	              
		                  	@include('notifications.'.snake_case(class_basename($notification->type)))
		                  @empty
		                  	<li class="text-center">Records not found</li>
		                  @endforelse			      
              			</ul>
					</div>
				</div>
				
			</div>
		</div>
	</div>
</div>
</section>
@endsection