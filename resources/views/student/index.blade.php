@extends('lawschools.layouts.main')
@section('content')
<section class="content">
<div class="row">
	<div class="col-md-12 m-auto " >
		<div class="box box-primary">
			<div class="box-header with-border">
				@include('student.header')	
			</div>
			<div class="box-body">
				<div class="row">
					<div class="col-md-3 col-sm-6 col-xs-12">
						<div class="info-box">
							<span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>

							<div class="info-box-content">
								<span class="info-box-text"><b>Total Student</b></span>
								<span class="info-box-number">0</span>
							</div>					
						</div>			
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</section>
@endsection