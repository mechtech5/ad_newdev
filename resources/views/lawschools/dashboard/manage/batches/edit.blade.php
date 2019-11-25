@extends('lawschools.layouts.main')
@section('content')
<style type="text/css">
	.wizard>.steps .done a,.wizard>.steps .done a:hover,.wizard>.steps .done a:active{background:#9dc8e2;color:#fff}
	.tabcontrol>.steps>ul>li.current{background:#fff;border:1px solid #bbb;border-bottom:0 none;padding:0 0 1px 0;margin-top:0}
	.tabcontrol>.steps>ul>li.current>a{padding:15px 30px 10px 30px}
	.wizard>.steps .current a,.wizard>.steps .current a:hover,.wizard>.steps .current a:active{background:#2184be;color:#fff;cursor:default}
	.wizard>.steps .error a,.wizard>.steps .error a:hover,.wizard>.steps .error a:active{background:#ff3111;color:#fff}
	.wizard>.steps .current-info,.tabcontrol>.steps .current-info,.wizard>.content>.title,.tabcontrol>.content>.title{position:absolute;left:-999em}
	.wizard>.actions{
		width: 100%;
	}	
	.wizard>.actions a, .wizard>.actions a:hover, .wizard>.actions a:active{
		background:#2184be;
		color:#fff;
		display:block;
		padding:.5em 1em;
		text-decoration:none;
		-webkit-border-radius:5px;
		-moz-border-radius:5px;
		border-radius:5px;
		margin: 0px 10px ;

	}
	.wizard>.actions .disabled a,.wizard>.actions .disabled a:hover,.wizard>.actions .disabled a:active{background:#eee;color:#aaa}

</style>
	<section class="content">
{{-- @include('student.header')	--}}
@foreach($batch_updates as $batch_update)
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="">Batch<a href="{{route('batches.index')}}" class="btn btn-sm btn-primary pull-right">Back</a></h3>
					</div>
					<div class="box-body table-responsive">
						 @if(session()->has('message'))
						    <div class="alert bg-success">
						        {{ session()->get('message') }}
						    </div>
							@endif
							@if(session()->has('messageError'))
						    <div class="alert bg-danger">
						        {{ session()->get('messageError') }}
						    </div>
							@endif
						<form id="example-form1" action="{{route('batches.update', $batch_update->id)}} " method="post">
							@method('PATCH')

			        	<input type="hidden" name="id" class="form-control" placeholder="2018-2019" value="{{$batch_update->id}}"> 

			        	<div class="row form-group">
			        		
			        		<div class="col-md-6 col-sm-6 col-xs-6 error-div">
			        			<label>Start Date</label>
			        			<input type="text" id="start_date" name="start_date" class="form-control" placeholder="YYYY-mm-dd" value="{{$batch_update->start_date}}">
			        			@error('start_date')
									<span class="text-danger">
										<strong>{{$message}}</strong>
									</span>
								@enderror
			        		</div>
			        		<div class="col-md-6 col-sm-6 col-xs-6 error-div">
			        			<label>End Date</label>
			        			<input type="text" id="end_date" name="end_date" class="form-control" placeholder="YYYY-mm-dd" value="{{$batch_update->end_date}}">
			        			@error('end_date')
									<span class="text-danger">
										<strong>{{$message}}</strong>
									</span>
								@enderror
			        		</div>
			        		<div class="col-md-6 col-sm-6 col-xs-6 error-div">
			        			<label>Batch Name</label>
			        			<input type="text" readonly="true" name="name" class="form-control" placeholder="YYYY-YYYY" value="{{$batch_update->name}}"> 
			        			@error('name')
									<span class="text-danger">
										<strong>{{$message}}</strong>
									</span>
								@enderror
			        		</div>
			        	</div>
			        	 <button type="submit" class="btn btn-primary">Update</button>
						 @csrf
			        </form>
					</div>
				</div>
			</div>
		</div>
	</section>
	@endforeach
<script src="{{asset('js/jquery.validate.min.js')}}"></script>
<script type="text/javascript">
	$(document).ready(function(){

		$('#myTable').DataTable();

		  $("#end_date,#start_date").on('focusout keyup',function(){
            var startDate = new Date($('#start_date').val()).getFullYear();
            var endDate = new Date($(this).val()).getFullYear();
            if(endDate != ''){
            	$("input[name='name']").val(startDate+'-'+endDate)
        	}
            // if (startDate+'-'+endDate) {
            // 	$("input[name='name']").prop('disabled', true);
            // }
        });
    });

	$('label.required').append('&nbsp;<strong class="text-danger">*</strong>&nbsp;');
    $('th.required').append('&nbsp;<strong class="text-danger">*</strong>&nbsp;');
	var form = $("#example-form1");

	form.validate({   
	    rules: {
	    	start_date:{
	    		required:true,
	    		date:true
	    	},
	    	end_date:{
	    		greaterthan: true,
	    		required:true,
	    		date:true
	    	},
	    	name:{
	    		required:true,
	    		// date:true

	    	}
	    },

	errorElement: "em",
	errorPlacement: function errorPlacement(error, element) { 
		element.after(error);
		error.addClass( "help-block" );

	 },
	highlight: function ( element, errorClass, validClass ) {
		$( element ).parents( ".error-div" ).addClass( "has-error" ).removeClass( "has-success" );
	},
	unhighlight: function (element, errorClass, validClass) {
		$( element ).parents( ".error-div" ).addClass( "has-success" ).removeClass( "has-error" );
	},
	submitHandler: function (form) {
                    form.submit();
                          }
});
$.validator.addMethod('greaterthan',function(value,element){
		var start_date =new Date($('#start_date').val());
		var end_date = new Date(value);
		if(end_date.getFullYear() > start_date.getFullYear()){
			return true;
		}else{
			return false;
		}

	},"Start date is greater than End date");

$.validator.addMethod("name", function(value, element) {
        return this.optional(element) || moment(value,"YYYY").isValid();
    }, "Please enter a valid name in the year format YYYY-YYYY");


</script>
@endsection