<div class="row form-group "><a href="" class="pull-right btn btn-sm btn-success " style="margin:10px 10px 0px 0px" id="add_guar"><i class="fa fa-plus"></i> Add More</a></div><div class="form-group row"><div class="col-sm-6 col-md-4 col-xs-6 error-div"><label class="required">Relation</label><select name="relation" class="form-control required"><option value="">Select Relation</option><?php foreach($relations as $relation){?><option value="{{$relation->id}}">{{$relation->name}}</option> <?php } ?></select></div><div class="col-md-4 col-sm-6 col-xs-6 error-div"><label class="required">Name</label><input type="text" name="g_name" class="form-control required"></div><div class="col-md-4 col-sm-6 col-xs-6 error-div"><label class="required">Mobile</label><input type="text" name="g_mobile" class="form-control required"></div></div><div class="row form-group"><div class="col-md-4 col-xs-6 col-sm-6 error-div"><label class="">Work Status</label><select name="work_status" class="form-control"><option value="">Select Work Status</option><option value="0">Self Employed</option><option value="1">Job</option><option value="3">Retired</option></select></div><div class="col-md-4 col-xs-6 col-sm-6 error-div"><label class="">Employment Type</label><select name="employment_type" class="form-control"><option value="">Select Employment Type</option><option value="0">Government</option><option value="1">Private</option></select></div><div class="col-md-4 col-xs-6 col-sm-6 error-div"><label class="">Professtion Type</label><select name="profession_status" class="form-control"><option value="">Select Profession type</option><?php foreach($professions as $profession) { ?><option value="{{$profession->id}}">{{$profession->name}}</option><?php  } ?></select></div></div><div class="form-group row"><div class="col-md-4 col-xs-6 col-sm-6 error-div"><label>Employer</label><input type="text" name="employer" class="form-control"></div><div class="col-md-4 col-xs-6 col-sm-6 error-div"><label>Designation</label><input type="text" name="designation" class="form-control"></div><div class="col-md-4 col-xs-6 col-sm-6 error-div"><label >Student Photo</label><input type="file" name="g_photo" id="g_photo" accept="image/*"></div></div>



						         {{--    <div class="row form-group">
						            	
						            	<div class="col-md-3 col-sm-6 col-xs-6 error-div">
						            		<label class="required">Father Mobile</label>
						            		<input type="text" name="f_mobile" class="form-control required" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
						            	</div>
						            	<div class="col-md-3 col-sm-6 col-xs-6 error-div">
						            		<label >Mother Mobile</label>
						            		<input type="text" name="m_mobile" class="form-control" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
						            	</div>
						            </div>
						            <div class="row form-group">
						            	<div class="col-md-3 col-sm-6 col-xs-6 error-div">
						            		<label>Father Employer</label>
						            		<input type="text" name="f_employer" class="form-control">
						            	</div>
						            	<div class="col-md-3 col-sm-6 col-xs-6 error-div">
						            		<label>Father Designation</label>
						            		<input type="text" name="f_designation" class="form-control">
						            	</div>
						            	<div class="col-md-3 col-sm-6 col-xs-6 error-div">
						            		<label>Mother Employer</label>
						            		<input type="text" name="m_employer" class="form-control">
						            	</div>
						            	<div class="col-md-3 col-sm-6 col-xs-6 error-div">
						            		<label>Mother Designation</label>
						            		<input type="text" name="m_designation" class="form-control">
						            	</div>
						            </div>
						            <div class="row form-group">
						            	<div class="col-md-3 col-sm-6 col-xs-6 error-div">
						            		<label>Father Qualification</label>
						            		<input type="text" name="f_qual" class="form-control">
						            	</div>
						            	<div class="col-md-3 col-sm-6 col-xs-6 error-div">
						            		<label>Father Occupation/Profession</label>
						            		<input type="text" name="f_occup" class="form-control">
						            	</div>
						            	<div class="col-md-3 col-sm-6 col-xs-6 error-div">
						            		<label>Mother Qualification</label>
						            		<input type="text" name="m_qual" class="form-control">
						            	</div>
						            	<div class="col-md-3 col-sm-6 col-xs-6 error-div">
						            		<label>Mother Occupation/Profession</label>
						            		<input type="text" name="m_occup" class="form-control">
						            	</div>
						            </div>
						            <div class="row form-group">
						            	<div class="col-md-6 col-sm-6 col-xs-6 error-div">
						            		<label>Father Annual Income</label>
						            		<input type="text" name="f_annul" class="form-control">
						            	</div>
						            	<div class="col-md-6 col-sm-6 col-xs-6 error-div">
						            		<label>Mother Annual Income</label>
						            		<input type="text" name="m_annul" class="form-control">
						            	</div>
						            </div> --}}