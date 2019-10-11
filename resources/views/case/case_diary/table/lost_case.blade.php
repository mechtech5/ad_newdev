<h4 style="margin: 20px 0px;"><b>Lost Cases</b></h4>
<table class="table table-striped table-bordered myTable4" >
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
          <th>Case Over Date </th>
          <th>Case Fees</th>
          <th>View</th>
          
       </tr>
  </thead>
  <tbody>

     @php $count=0; @endphp
     @foreach($lostCases as $lostCase)
     <tr>   
        <td>{{++$count}}</td>
        <td>{{$lostCase->client->cust_name}}</td>
        <td>{{$lostCase->case_number}}</td>
        <td>{{$lostCase->case_title}}</td>
        <td>{{$lostCase->casetype->case_type_desc}}</td>
        <td>{{$lostCase->catg_desc}}</td>
        <td>{{$lostCase->subcatg_desc}}</td>
        <td>{{$lostCase->court_name}}</td>
        <td>{{$lostCase->appellant_name}}</td>
        <td>{{$lostCase->respondant_name}}</td>
        <td>{{$lostCase->case_reg_date}}</td>
        <td>{{$lostCase->case_over_date}}</td>
        <td>{{$lostCase->case_fees}}</td>
        <td>
            <a href="{{route('case_diary.show', $lostCase->case_id.',cl')}}" class="btn btn-sm btn-success">View</a>
        </td>
     </tr>
    @endforeach
    
  </tbody>
</table>
<script type="text/javascript">
  $('.myTable4').DataTable({
          searching:true,
          scrolling:true,
          
    });
</script>