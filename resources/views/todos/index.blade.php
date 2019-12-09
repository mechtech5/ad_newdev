@extends('lawfirm.layouts.main')
@section('content')
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header">
					<h4 class=""><b id="todoHeader">My To-dos List</b>
						@if(Auth::user()->parent_id == null )
							<a href="{{route('todos.create')}}" class="btn btn-sm btn-primary pull-right">Create To-dos</a>
						@endif
					</h4>
					<br>
					{{-- <a href="{{route('todos.update_todo_missed')}}">Missed</a> --}}
					<div class="row">
						<div class="col-md-6">
							<select class="form-control" name="status" >
								<option value="all" selected>--- All ---</option>
								<option value="P">Pending</option>
								<option value="A">Awaiting</option>
								<option value="M">Missed</option>
								<option value="C">Completed</option>
								<option value="O">Closed</option> 
							</select>						
						</div>
							@if(Auth::user()->parent_id == null )
								<div class="col-md-4 form-group pull-right">
									<select class="form-control" name="todoChange">

										<option value="0" {{$todoCategory == '0' ? 'selected' : ''}}>My To-dos</option>
										<option value="1" {{$todoCategory == '1' ? 'selected' : ''}}>Member To-dos</option>	
									</select>							
								</div>
							@endif
					</div>
					<br>
					<div class="row">
						<div class="col-md-12">
							@if($message = Session::get('success'))
								<div class="alert bg-success">{{$message}}</div>
							@endif
						</div>
					</div>
				</div>
				<div class="box-body" id="todoTable">
					@include('todos.todo_table')
				</div>
			</div>
		</div>		
	</div>
	
</section>
<script type="text/javascript">
	$(document).ready(function(){
	$.ajaxSetup({
		headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

		$("select[name='todoChange'], select[name='status'] ").on('change',function(){
			var todoCategory = $("select[name='todoChange'] option:selected").val();
			var status = $("select[name='status'] option:selected").val();
			
			if(todoCategory ==1){
				$('#todoHeader').text('My To-dos List');
			}
			else{
				$('#todoHeader').text('Member To-dos List');
			}
			$.ajax({
				type :'POST',
				url : "{{route('todo.category_table_change')}}",
				data : {todoCategory:todoCategory,status:status},
				success:function(data){
					// console.log(data);
					$('#todoTable').empty().html(data);
				}
			});
		});

		@if(Auth::user()->parent_id !=null)
			$('select[name="status"]').on('change',function(){
				var status = $(this).val();
				console.log(status);
				$.ajax({
					type :'POST',
					url : "{{route('todo.status_table_change')}}",
					data : {status:status},
					success:function(data){
						 // console.log(data);
						$('#todoTable').empty().html(data);
					}
				});
			});
		@endif



		var todo = '1';
		if(todo ==1){
				$('#todoHeader').text('My To-dos List');
			}
			else{
				$('#todoHeader').text('Member To-dos List');
			}

		$('.complete').on('click',function(e){
			e.preventDefault();
			var todo_id = $(this).attr('id');
			swal({
			  title: "Are you sure?",
			  text: "Once Completed, you will not be able continue working to this to-dos",
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
			})
			.then((isConfirm) => {
			  if (isConfirm) {
			   	$.ajax({
			   		type:'post',
			   		url: "{{route('todos.todoUpdate')}}",
			   		data:{id:todo_id},
			   		success:function(res){
			   			
			   			swal({
			   				icon:'success',
			   				title: res,
			   				button: true,
			   			}).then((ok)=> {
			   				if(ok){
			   					location.reload();
			   				}
			   			});
			   		}
			   	});
			  } else {
			    swal("Now you will continue work to this to-dos");
			  }
			});
			// console.log(todo_id);
		})



	});
</script>
@endsection