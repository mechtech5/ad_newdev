<table class="table table-striped table-bordered myTable" >
   <thead>
       <tr>
          <th>SNo.</th>
  				<th>Case Title</th>  			
  				<th>Client Name</th>
          <th>Court Type Name</th>
          <th>Member Name</th>
          <th>Case Registration Date</th>
          @if($case_status != 'cr')<th>Case Over Date</th>@endif
          <th>Action</th>
      
       </tr>
  </thead>
  <tbody>

     @php $count=0; @endphp
     @foreach($cases as $case)
     <tr>   
  			<td>{{++$count}}</td>
        <td>{{$case->case_title}}</td>
        <td>{{$case->client->cust_name}}</td>
  			<td>{{$case->court->court_type_desc}}</td>
        <td>
          @foreach($case->members as $value)

            @php 
              if($value->deallocate_date == null){
                  $names[] = $value->member->name;  
              }
            @endphp
          @endforeach 

          @php 
            echo implode(', ', $names);
            $names = [];  
          @endphp
        </td>

  			<td>{{$case->case_reg_date}}</td>
       @if($case_status != 'cr') <td>{{$case->case_over_date}}</td>@endif
        <td>
            <form action="{{route('case_mast.destroy', ['cust_id' =>  $case->case_id ])}}" method="POST" id="delform_{{ $case->case_id }}">
            @method('DELETE')
            <span>
            @if($cust_id == '')
              <a href="{{route('case_mast.edit', $case->case_id.',case_diary')}}" ><i class="btn fa fa-edit text-green" style="font-size: 16px"></i></a>

              <a href="{{ route('case_mast.show',$case->case_id.',case_diary')}}" class=""><i class="btn text-primary fa fa-eye" style="font-size: 16px"></i></a>              

            @else
               <a href="{{route('case_mast.edit', $case->case_id.',clients')}}" ><i class="btn fa fa-edit text-green" style="font-size: 16px"></i></a>

               <a href="{{ route('case_mast.show',$case->case_id.',clients')}}" class=""><i class="btn text-primary fa fa-eye" style="font-size: 16px"></i></a>              
            @endif
            </span>
            <span>
              <a href="javascript:$('#delform_{{ $case->case_id }}').submit();"  onclick="return confirm('Are you sure?')" ><i class="btn fa fa-trash text-red" style="font-size: 16px"></i></a>              
            </span>
          
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