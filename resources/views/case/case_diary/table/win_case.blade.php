<h4 style="margin: 20px 0px;"><b>Win Cases</b></h4>
<table class="table table-striped table-bordered myTable3" >
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
          <th>Case Registration Date </th>
          <th>Case Over Date </th>         
          <th>View</th>         
       </tr>
  </thead>
  <tbody>

     @php $count=0; @endphp
     @foreach($winCases as $winCase)
     <tr>   
        <td>{{++$count}}</td>
        <td>{{$winCase->client->cust_name}}</td>
        <td>{{$winCase->case_number}}</td>
        <td>{{$winCase->case_title}}</td>
        <td>{{$winCase->casetype->case_type_desc}}</td>
        <td>{{$winCase->catg_desc}}</td>
        <td>{{$winCase->subcatg_desc}}</td>
        <td>{{$winCase->court_name}}</td>
        <td>{{$winCase->appellant_name}}</td>
        <td>{{$winCase->respondant_name}}</td>
        <td>{{$winCase->case_fees}}</td>
        <td>{{$winCase->case_reg_date}}</td>
        <td>{{$winCase->case_over_date}}</td>
        <td>
            <a href="{{route('case_diary.show', $winCase->case_id.',cw')}}" class="btn btn-sm btn-success">View</a>
        </td>
       
     </tr>
    @endforeach
    
  </tbody>
</table>
<script type="text/javascript">
  $('.myTable3').DataTable({
          searching:true,
          scrolling:true,
          
    });
</script>