@extends('lawfirm.layouts.main')
@section('content')
<section class="content">
<div class="row">
	<div class="col-md-12" >
		<div class="box box-primary">
			<div class="box-header with-header">
				<h3 style="margin-top: 10px;">On Going Case</h3>
			</div>	
          <div class="box-body table-responsive">
  	         <table class="table table-striped table-bordered" id="myTable">
  	           <thead>
            	     <tr>
                      <th>SNo.</th>
                      <th>Client Name</th>
                      <th>Case Title</th>
                      <th>Case Type</th>
                      <th>Case Court</th>
                      <th>Case Registration Date </th>
                    
                      <th>Case Allocation</th>
    	    		   </tr>
  	          </thead>
  	          <tbody>
                    <?php $count=0; ?>
                    @foreach($onCases as $ongoing)
                    <tr>   
                    <td>{{++$count}}</td>
                    <td>{{$ongoing->client->cust_name}}</td>
                    <td>{{$ongoing->case_title}}</td>
                    <td>{{$ongoing->casetype->case_type_desc}}</td>
                    <td>{{$ongoing->court_name}}</td>
                    <td>{{$ongoing->case_reg_date}}</td>
                    
          					<td>
	          					<span>
	          						<a href="{{route('case_allocation.create',['case_id'=>$ongoing->case_id])}}" class="btn btn-sm btn-success"><i class="fas fa-exchange-alt"></i> Allocate & Deallocate</a>
	          						
	          					
	          					</span>
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
 <script>
 	$(document).ready(function(){
 			$('#myTable').DataTable({
        	searching:true,
        	scrolling:true,
		});
 	});
 	
 </script>
@endsection