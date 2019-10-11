<div id="calendar_modal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
        		<h3 class="modal-title text-center"><b>NEW CALENDAR ENTRY</b></h3>        		
			</div>
			<div class="modal-body">
				<div class="row">
        			<div class="col-md-12 text-center">
        				<h4> <b>Type:</b> &nbsp; <span> <input type="radio" name="divtype" value="1" > Hearing Date</span>
							<span> <input type="radio" name="divtype" value="0" checked> To-do</span> 

        				</h4>
        			</div> 
        		</div>
				<div class="row" id="hearingDiv" style="display: none">
					<div class=""></div>
				</div>

				<div class="row " id="todoDiv">
					<div class="col-md-12">
					<form action="{{route('todos.store')}}" method="POST">
						<div class="row form-group">
							<div class="col-md-12">
								<label for="title">Title <span class="text-danger font-weight-bold">*</span></label></label>
								<input type="text" name="title" class="form-control" required>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<label for="description">Description <span class="text-danger font-weight-bold">*</span></label></label>
								<textarea type="text" name="description" class="form-control" rows="5" required=""></textarea> 
							</div>
						</div>
					{{-- 	<div class="row form-group">
							<div class="col-md-12">	
								<input type="checkbox" name="privacy" checked="" value="0" class="hidden">				
								<input type="checkbox" name="privacy"> <label for="privacy">Mark as Private</label>
							</div>
						</div> --}}
						<div class="row form-group">
							<div class="col-md-6">
								<label for="start_date">Start Date <span class="text-danger font-weight-bold">*</span></label>
								<input type="text" name="start_date" class="form-control start_date" date-format="yyyy-mm-dd" value="">
							</div>
							<div class="col-md-6">
								<label for="end_date">End Date <span class="text-danger font-weight-bold">*</span></label></label>
								<input type="text" name="end_date" class="form-control end_date"  date-format="yyyy-mm-dd" value="">
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<label for="case_id">Relate To</label>
								<select name="case_id" class="form-control">
									<option value="null">Select Case</option>
									<option value="1">Case 1</option>
									<option value="2">Case 2</option>
								</select>
							</div>
							
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<label for="team_id">Assign To Team Members</label>
								<br>
								<select name="team_id[]" class="form-control" id="select2" multiple="multiple"  style="width: 100%" required>	
									<option value="">Select Team Members</option>	
									<option value="1" {{Auth::user()->id == 1 ? 'selected' : '' }}>Member 1 </option>
									<option value="2" {{Auth::user()->id == 2 ? 'selected' : '' }}>Member 2 {{Auth::user()->name}}</option>
								</select>							
							</div>
						</div>

						<div class="row form-group">
							<div class="col-md-12">
								<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
								<button type="submit" class="btn btn-sm btn-success">Submit</button>
							</div>
						</div>
						@csrf
					</form>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
		
	</div>
</div>
<script >
	$(document).ready(function(){
		$('#select2').select2();
		$(".start_date,.end_date").datepicker({
			startDate : new Date(),
			format : 'yyyy-mm-dd',
			todayHighlight : true,
			setDate : new Date(),
			autoclose :true,
		});

		$('input[name="divtype"]').on('change',function(){
			var type = $(this).val();

		})

	});
</script>