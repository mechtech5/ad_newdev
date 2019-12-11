@extends('lawfirm.main')
@section('content')
<section class="content">
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header">
				<h5>All Upcoming Pending Hearings 
					<a href="{{route('lawfirm.index')}}" class="btn btn-sm btn-info pull-right">Back</a>
				</h5>
			</div>
			<div class="box-body">
				<ul class="todo-list"  style="height: 500px;">
	               @foreach($hearings as $hearing)
	                <li>
	                  <label>{{date('M d, Y', strtotime($hearing->hearing_date))}}</label>
	                  <br>
	                  <span>{{$hearing->case->case_title}}</span>
	              
	                  <div class="tools">
	                    <a href="{{ route('case_mast.show', $hearing->case_id.',case_diary') }}"><i class="fa fa-eye text-primary fa-icon"></i></a>
	                   @if($hearing->user_id == Auth::user()->id)  <a href="{{route('case_hearing.edit', $hearing->case_tran_id.',case_diary')}}"><i class="fa fa-edit text-success fa-icon" ></i></a>@endif
	                  </div>
	                </li>
	                <br>
                @endforeach
               
              </ul>
			</div>
		</div>
	</div>
</div>
</section>
@endsection