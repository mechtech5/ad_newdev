@extends('admin.main')
@section('content')
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="">Add User <a href="{{route('user.index')}}" class="btn btn-sm btn-primary pull-right">Back</a></h3>
					</div>
					<div class="box-body">
						<form action="{{route('user.store')}}" method="post">
							@csrf
							<div class="row form-group">
								<div class="col-md-6">
									<label for="user_catg_id">Select User Type <span class="text-danger">*</span></label>
									 <select name="user_catg_id" class="form-control" id="user_catg_id"  >
		                                <option value="0">Select User Type</option>
			                                @foreach($roles as $role)
			                                    <option value="{{ $role->id}}" {{old('user_catg_id')== $role->id ? 'selected' : ''}}>{{ $role->display_name}}</option>
			                                @endforeach
		                               </select>

		                                @error('user_catg_id')
		                                    <span class="text-danger">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
								</div>	
							</div>
							<div class="row form-group">
								<div class="col-md-6">
									<label for="name">User Name <span class="text-danger">*</span></label>
									<input type="text" class="form-control timepicker" name="name" value="{{old('name')}}">  
									@error('name')
	                                    <span class="text-danger">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror      
								</div>	
								<div class="col-md-6">
									<label for="email">Email Address <span class="text-danger">*</span></label>
									<input type="text" name="email" class="form-control" value="{{old('email')}}">
									@error('email')
	                                    <span class="text-danger">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror
								</div>
							</div>	
							<div class="row form-group">
								
								<div class="col-md-4">
									<label for="country_code">Country Name</label>
									<select name="country_code" class="form-control" id="country">
										<option value="0">Select Country</option>
										@foreach($countries as $country)
											<option value="{{$country->country_code}}" {{old('country_code') == $country->country_code ? 'selected' : ''}} {{'102' == $country->country_code ? 'selected' : ''}}>{{$country->country_name}}</option>
										@endforeach
									</select>
									@error('country_code')
	                                    <span class="text-danger">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror
								</div>
								<div class="col-md-4">
									<label for="state_code">State Name</label>
									<select name="state_code" class="form-control" id="state">
										
									</select>
									@error('state_code')
	                                    <span class="text-danger">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror
								</div>
								<div class="col-md-4">
									<label for="city_code">City Name</label>
									<select name="city_code" class="form-control" id="city">
									
									</select>
									@error('city_code')
	                                    <span class="text-danger">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror
								</div>
							</div>	
							<div class="row form-group">
								<div class="col-md-6">
									<label for="zip_code">Zip Code</label>
									<input type="text" class="form-control timepicker" name="zip_code" value="{{old('zip_code')}}">
									@error('zip_code')
	                                    <span class="text-danger">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror       
								</div>	
								<div class="col-md-6">
									<label for="mobile">Mobile Number</label>
									<input type="text" class="form-control timepicker" name="mobile" value="{{old('mobile')}}"> 
									@error('mobile')
	                                    <span class="text-danger">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror     
								</div>	
							</div>						
							<div class="row ">
								<div class="col-md-12 ">
									<input type="submit" value="Submit" class="btn btn-sm btn-primary">
								</div>								
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<script>
		$(document).ready(function(){

			$("#country").on('change',function(e){
			  	e.preventDefault();
			  	var country_id = $('#country').val();
			    $.ajax({ 
			      type:"GET",
			      url:"{{route('state')}}?country_id="+country_id,
			      success:function(res)
			      {   		     
			          if(res.length !=0){
			              $("#state").empty();

			              $("#state").append('<option value="0">Select State</option>');
			              $.each(res,function(key,value){
			                  $("#state").append('<option value="'+value.state_code+'">'+value.state_name+'</option>');
			              });
			          }else{
			              $("#state").empty();		              
			          }
			      }
			    });
			});

			var oldcountry_id = "{{old('country_code')}}";
			var country_id = (oldcountry_id !='' ? oldcountry_id : '102');
			if(country_id !=0){
				 $.ajax({ 
			      type:"GET",
			      url:"{{route('state')}}?country_id="+country_id,
			      success:function(res)
			      {   		     
			          if(res.length !=0){
			              $("#state").empty();

			              $("#state").append('<option value="0">Select State</option>');
			              $.each(res,function(key,value){
			                  $("#state").append('<option value="'+value.state_code+'">'+value.state_name+'</option>');
			              });
			          }else{
			              $("#state").empty();		              
			          }
			      }
			    });
			}


			$('#state').on('change',function(){
			    var state_code = $(this).val();    
			    if(state_code){
			        $.ajax({
			           type:"GET",
			           url:"{{route('city')}}?state_code="+state_code,
			           success:function(res){               
			            if(res){
			                $("#city").empty();
			                $.each(res,function(key,value){
			                    $("#city").append('<option value="'+value.city_code+'">'+value.city_name+'</option>');
			                });
			           
			            }else{
			               $("#city").empty();
			            }
			           }
			        });
			    }else{
			        $("#city").empty();
			    }
			        
			   });
		});
	</script>
@endsection