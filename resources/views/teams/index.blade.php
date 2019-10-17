@extends(Auth::user()->user_catg_id=='4' ? 'lawschools.layouts.main' : 'lawfirm.layouts.main')

@section('content')
<section class="content">
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<div class="box-title" >Team Member ({{count($members)}})</div>
				<div class="box-tools pull-right">
					<a href="{{route('teams.create')}}" class="btn btn-md btn-primary pull-left">Create Team Member</a>
				</div>
					
				<div class="row">
					<div class="col-md-12">
						@if($message = Session::get('success'))
							<div class="alert bg-success">
								{{$message}}
							</div>
						@endif
					</div>
				</div>
			</div>	

			<div class="box-body table-responsive " id="mytable1">
				<table class="table table-striped table-bordered" id="all_table" style="width: 100%">
					<thead>
						<tr>
							<td>#</td>
							<td>Name</td>
							<td>Email</td>
							<td>Mobile Number</td>
							<td>Status</td>						
							<td>Action</td>						
						</tr>
					</thead>
					<tbody>
						@php $count = 1; @endphp
						@foreach($members as $member)
							<tr>
								<td>{{$count++}}</td>
								<td>{{$member->name}}</td>
								<td>{{$member->email}}</td>
								<td>{{$member->mobile}}</td>						
								<td>{{$member->status == 'A' ? 'Verified by Email' : 'Pending'}}</td>
								<td>
									<form action="{{route('teams.destroy', ['id' =>  $member->id ])}}" method="POST" id="delform_{{ $member->id}}">
											@method('DELETE')
									@role(['lawcompany','lawyer'])
									<a href="javascript:void(0)" onclick="cases('{{ $member->id }}')" title="cases"><i class="fa fa-briefcase btn btn-sm" title="cases"></i></a>
									@endrole
									<a href="javascript:void(0)" onclick="loginhistory('{{ $member->id }}')" title="Member login history" data-id="modal" id="loginbtn"><i class="fa fa-clock-o btn btn-sm" style="font-size: 16px"></i></a>

									<a href="{{route('teams.edit',$member->id)}}" title="edit"><i class="fa fa-edit btn btn-sm" style="font-size: 16px"></i></a>

									<a href="javascript:$('#delform_{{ $member->id}}').submit();"  onclick="return confirm('Are you sure want to delete team member permanetly?')" title="delete"><i class="fa fa-trash btn btn-sm" style="font-size: 16px"></i></a>
									@csrf
									</form>
								</td>
							</tr>
						@endforeach						
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="login">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Member Login History</h4>
			</div>
			<div class="modal-body">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>Last Login Date & Time</th>
							<th>Last Logout Date & Time</th>
						</tr>
					</thead>
					<tbody>
						<tr id="login_time">
							
						</tr>
					</tbody>
					
				</table>
			</div>
			 <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      </div>
		</div>
	</div>
</div>

<div class="modal fade" id="cases_modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Member Cases</h4>
			</div>
			<div class="modal-body">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							
						</tr>
					</thead>
					<tbody>
						<tr >
							
						</tr>
					</tbody>
					
				</table>
			</div>
			 <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      </div>
		</div>
	</div>
</div>
</section>
<script >
	function loginhistory($id){
		var id = $id;
		$.ajax({
			type:'POST',
			url: "{{ route('login_history')}}",
			data: {id:id},
			success:function(res){
				$('#login_time').empty();
				$('#login_time').append("<td>"+(res.last_login_in_at !=null ? res.last_login_in_at : '')+"</td>");
				$('#login_time').append("<td>"+(res.last_logout_in_at != null ? res.last_logout_in_at : '-' )+"</td>");
				$('#login').modal('show');
				// console.log(res.last_login_in_at);
			}
		});
	}
	function cases($id){
		var id = $id;
		$.ajax({
			type:'POST',
			url: "{{ route('member_cases')}}",
			data: {id:id},
			success:function(res){
				
				$('#cases_modal').modal('show');
				// console.log(res.last_login_in_at);
			}
		});
	}
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#all_table,#approve_table,#pending_table').DataTable();

		$('.big').click(function() {
			$('.bg-green').removeClass('bg-green');
			$(this).addClass('bg-green').find('input').prop('checked', true) ;   
		});
		// $('#all_lawyer,#approve_lawyer,#pending_lawyer').on('click',function(){
		// 	var mylawyers = $("input[name='mylawyers']:checked").val();
		// 	if(mylawyers=='all'){
		// 		$('#mytable1').show();
		// 		$('#mytable2').hide();
		// 		$('#mytable3').hide();
		// 	}
		// 	else if(mylawyers=='approve'){
		// 		$('#mytable1').hide();
		// 		$('#mytable2').show();
		// 		$('#mytable3').hide();
		// 	}
		// 	else{
		// 		$('#mytable1').hide();
		// 		$('#mytable2').hide();
		// 		$('#mytable3').show();
		// 	}
		// });
	$.ajaxSetup({
		headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	
		// $('.approveBtn, .declineBtn').on('click',function(){
		// 	var btnType = $(this).attr('id');
		// 	var member_id = $(this).data('id');
			
		// 	var tr = $(this).closest('tr');
		// 	console.log(tr);

		// 	$.ajax({
		// 		type:'POST',
		// 		url:"{{route('approve_decline_member')}}",
		// 		data:{btnType:btnType, member_id:member_id },
		// 		success:function(data){
		// 			swal({
		//                     text: data,
		//                     icon : 'success',
		//                   });
		                 
		// 		  	 tr.find('td').fadeOut(1000,function(){ 
  //                           tr.remove();                    
  //                    }); 
  //                    setTimeout(function(){
		//                      location.reload(); 
		//                   }, 3000); 
		// 		}
		// 	});
		// });

	});
</script>
@endsection