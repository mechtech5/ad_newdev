<table class="table table-striped table-bordered myTable" >
   <thead>
       <tr>
          <th>SNo.</th>
  				<th>Client Name</th>
          <th>Case Number</th>
  				<th>Case Title</th>  			
          <th>Case Registration Date</th>
          <th>Action</th>
      
       </tr>
  </thead>
  <tbody>

     @php $count=0; @endphp
     @foreach($cases as $case)
     <tr>   
  			<td>{{++$count}}</td>
        <td>{{$case->client->cust_name}}</td>
  			<td>{{$case->c_d_number}}</td>
        <td>{{$case->case_title}}</td>
  			<td>{{$case->case_reg_date}}</td>
        <td>
            <form action="{{route('case_mast.destroy', ['cust_id' =>  $case->case_id ])}}" method="POST" id="delform_{{ $case->case_id }}">
            @method('DELETE')

            <a href="{{route('case_mast.edit', $case->case_id.',case_diary')}}" class="btn btn-sm btn-success"><i class="fa fa-edit text-white"></i></a>

            <a href="javascript:$('#delform_{{ $case->case_id }}').submit();" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')" ><i class="fa fa-trash text-white" ></i></a>

            <a href="{{ route('case_mast.show',$case->case_id.',case_diary')}}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>

            @csrf
            </form>
        </td>
     </tr>
    @endforeach
    
  </tbody>
</table>
<script type="text/javascript">
  $('.myTable').DataTable({
          searching:true,
          scrolling:true,
          
    });
</script>