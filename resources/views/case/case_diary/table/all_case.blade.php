<h4 style="margin: 20px 0px;"><b>All Cases</b></h4>
 <table class="table table-striped table-bordered myTable2"  >
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
          <th>Case Fees</th>
          <th>Case Status</th>         
          <th>Case Registration Date </th>
          <th>Case Over Date</th>                      
          <th>View</th>                      
       </tr>
    </thead>
    <tbody>
   
        @php $counts=0; @endphp
        @foreach($allcase as $all)
      <tr>
          <td>{{++$counts}}</td>
          <td>{{$all->client->cust_name}}</td>
          <td>{{$all->case_number}}</td>
          <td>{{$all->case_title}}</td>
          <td>{{$all->casetype->case_type_desc}}</td>
          <td>{{$all->catg_desc}}</td>
          <td>{{$all->subcatg_desc}}</td>
          <td>{{$all->court_name}}</td>
          <td>{{$all->appellant_name}}</td>
          <td>{{$all->respondant_name}}</td>
          <td>{{$all->case_fees}}</td>
          <td>
            @if($all->case_status == 'cw')
              {{__('Case Win')}}
            @elseif($all->case_status == 'cg')
              {{__('Case On going')}}
            @elseif($all->case_status == 'ct')
              {{__('Case Lost')}}
            @endif

          </td>
          <td>{{$all->case_reg_date}}</td>
          <td>{{$all->case_over_date}}</td>
          <td>
            <a href="{{route('case_diary.show', $all->case_id.',ca')}}" class="btn btn-sm btn-success">View</a>
          </td>
      </tr>
        @endforeach
      
    </tbody>
</table>
<script type="text/javascript">
  $('.myTable2').DataTable({
          searching:true,
          scrolling:true,
         
          
    });
</script>