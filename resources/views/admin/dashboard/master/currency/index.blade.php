@extends('admin.main')
@section('content')
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header">
					<h3>Currency <a href="{{route('currency.create')}}" class="btn btn-sm btn-primary pull-right">Add Currency </a></h3>
				</div>
				<div class="box-body">
					@if($message = Session::get('success'))
							<div class="alert bg-success">
								{{$message}}
							</div>
						@endif
						<table class="table table-striped table-bordered" id="myTable">
							<thead>
								<tr>
									<th>#</th>
									<th>Currency Code</th>
									<th>Currency Name</th>
									<th>Symbol</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>	
								@php $count = '0' @endphp								
								@foreach($currencies as $currency)
									<tr>
										<td>{{++$count}}</td>
										<td>{{$currency->currency_code}}</td>
										<td>{{$currency->currency_name}}</td>
										<td>{{$currency->symbol}}</td>
										<td>
											<form action="{{route('currency.destroy', ['id' =>  $currency->currency_code ])}}" method="POST" id="delform_{{ $currency->currency_code }}">
											@method('DELETE')

										 	<a href="{{route('currency.edit',$currency->currency_code)}}"><i class="fa fa-edit text-green btn btn-sm"></i></a>

										 	<a href="javascript:$('#delform_{{ $currency->currency_code }}').submit();"  onclick="return confirm('Are you sure?')" ><i class="fa fa-trash text-danger btn btn-sm" ></i></a>
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
</section>
<script >
	$(document).ready(function(){		
		$('#myTable').DataTable();
    });
</script>
@endsection