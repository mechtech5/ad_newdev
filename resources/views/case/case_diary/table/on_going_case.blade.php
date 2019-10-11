<h4 style="margin: 20px 0px;"><b>On Going Cases</b></h4>
<table class="table table-striped table-bordered myTable1" >
   <thead>
       <tr>
          <th>SNo.</th>
  				<th>Client Name</th>
          <th>Case Number</th>
  				<th>Case Title</th>
  				<th>Case Type</th>
          <th>Case Category</th>
          <th>Case Subcategory</th>
          <th>Case Court</th>
          <th>Appellant Name</th>
          <th>Respondant Name</th>
  				<th>Case Registration Date </th>
  				<th>Case Status</th>
          <th>Action</th>
          <th>View</th>
       </tr>
  </thead>
  <tbody>

     @php $count=0; @endphp
     @foreach($onCases as $ongoing)
     <tr>   
  			<td>{{++$count}}</td>
        <td>{{$ongoing->client->cust_name}}</td>
  			<td>{{$ongoing->case_number}}</td>
        <td>{{$ongoing->case_title}}</td>
  			<td>{{$ongoing->casetype->case_type_desc}}</td>
  			<td>{{$ongoing->catg_desc}}</td>
        <td>{{$ongoing->subcatg_desc}}</td>
        <td>{{$ongoing->court_name}}</td>        
        <td>{{$ongoing->appellant_name}}</td>
        <td>{{$ongoing->respondant_name}}</td>
  			<td>{{$ongoing->case_reg_date}}</td>
  			<td>{{ "Case is Running" }}</td>
        <td class="d-flex">
            <span><a href="{{route('case_mast.edit', $ongoing->case_id.',case_diary')}}" class="btn btn-sm btn-success"><i class="fa fa-edit text-white"></i></a></span>
            &nbsp;
            <span class="ml-3">

            <form action="{{route('case_mast.destroy', ['cust_id' =>  $ongoing->case_id ])}}" method="POST" id="delform_{{ $ongoing->case_id }}">
            @method('DELETE')

            <a href="javascript:$('#delform_{{ $ongoing->case_id }}').submit();" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')" ><i class="fa fa-trash text-white" ></i></a>
            @csrf
            </form>

          </span>
        </td>
        <td>
          <a href="{{ route('case_mast.show',$ongoing->case_id.',case_diary')}}" class="btn btn-sm btn-success">View Case</a>
        </td>
     </tr>
    @endforeach
    
  </tbody>
</table>
<script type="text/javascript">
  $('.myTable1').DataTable({
          searching:true,
          scrolling:true,
          
    });
</script>