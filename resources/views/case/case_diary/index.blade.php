@extends('lawfirm.layouts.main')
@section('content')
<section class="content">
<div class="row">
	<div class="col-md-12 m-auto" >
		<div class="box box-primary ">
  			<div class="box-header with-border"> 	 
                    
             <div class="row">
               <div class="col-md-6" style="margin-top: 10px;">
                <a href="{{route('case_mast.create', ['cust_id'=>",case_diary"])}}" class="btn btn-md btn-primary">Add New Case</a>
                </div>
                <div class="col-md-6" style="margin-top: 10px;">
                 <ul class="list-inline" >
                   <li class="list-inline-item btn btn-md btn-default {{$caseBtn == 'cg' ? 'btn-info' : '' }} big" id="cg" style="padding-right: 17px;">
                     <input type="radio" name="cases" class="invisible"  value="cg" {{$caseBtn == 'cg' ? 'checked' : '' }} >
                     On Going Cases
                   </li>
                    <li class="list-inline-item btn btn-md btn-default big {{$caseBtn == 'ca' ? 'btn-info' : '' }}" id="ca" style="padding-right: 17px;">
                     <input type="radio" name="cases" class="invisible" value="ca" {{$caseBtn == 'ca' ? 'checked' : '' }}>
                    All Cases                   </li>
                     <li class="list-inline-item btn btn-md btn-default big {{$caseBtn == 'cw' ? 'btn-info' : '' }}" id="cw" style="padding-right: 17px;">
                     <input type="radio" name="cases" class="invisible" value="cw"  {{$caseBtn == 'cw' ? 'checked' : '' }}>
                    Win Cases              </li>
                     <li class="list-inline-item btn btn-md btn-default big {{$caseBtn == 'cl' ? 'btn-info' : '' }}" id="cl" style="padding-right: 17px;">
                     <input type="radio" name="cases" class="invisible" value="cl" {{$caseBtn == 'cl' ? 'checked' : '' }}>
                    Lost Cases
                   </li>

                 </ul>
               </div>
             </div>
              <div class="row">
                <div class="col-md-12 form-group">
                   <h4 style="font-weight: 700"><b>Filter</b></h4 >
                </div>
              </div>

              <div class="row">
                <div class="col-md-3 form-group">
                   <input type="text" name="case_number" placeholder="Case Number" class="form-control">
                </div>
                <div class="col-md-3 form-group">
                <select class="form-control" id="selectClient" name="client_id">
                  <option value="0">Select client name</option>
                  @foreach($clients as $client)
                    <option value="{{$client->cust_id}}">{{$client->cust_name}}</option>
                  @endforeach
                </select>
              </div>            
              <div class="col-md-3 form-group">
                  <select class="form-control" name="case_court">
                     <option value="0"> Select Case Court</option>
                     @foreach($courts as $court)
                      <option value="{{$court->court_code}}">{{$court->court_name}}</option>
                     @endforeach
                  </select>
              </div>
               <div class="col-md-3 form-group">
                  <select class="form-control" name="case_type">
                     <option value="0"> Select Case Type</option>
                     @foreach($caseTypes as $caseType)
                      <option value="{{$caseType->case_type_id}}">{{$caseType->case_type_desc}}</option>
                     @endforeach
                  </select>
              </div>
              <div class="col-md-3 form-group">                
                  <select class="form-control" name="catg_code" id="case_category">
                    <option value="0">Select case category</option>
                    @foreach($categories as $category)
                      
                      <option value="{{$category->catg_code}}" {{old('catg_code')==$category->catg_code ? 'selected' : ''}}>{{$category->catg_desc}}</option>                     
                    @endforeach
                  </select>
              </div>
              <div class="col-md-3 form-group">   
                  <select class="form-control" name="subcatg_code" id="case_subcategory">
                   
                  </select>
              </div>
              <div class="col-md-3 form-group">
                  <button class="form-control btn-md" id="reportrange"> 
                      <i class="fa fa-calendar"></i>&nbsp;
                      <span ></span> <i class="fa fa-caret-down"></i>
                  </button>             
              </div>
             
              <div class="col-md-1">
                  <button class="btn btn-md btn-primary" id="filterBtn">Filter</button>
              </div>
               <div class="col-md-1">
                  <button class="btn btn-md btn-primary" id="clearBtn">Clear Filter</button>
              </div>
          </div>
  			</div>
        <div class="box-body" id="ongoingCaseBody">
          @if($message = Session::get('success'))
            <div class="alert bg-success">
              {{$message}}
            </div>
          @endif       
          
            <div class="row">
              <div class="col-md-12 table-responsive tableOnCase">
            	         @include('case.case_diary.table.on_going_case')
              </div>
            </div>
          </div>

      <div class="box-body" id="allCaseBody"  style="
          display: none">   
            <div class="row">
              <div class="col-md-12 table-responsive tableAllCase">
                 @include('case.case_diary.table.all_case')
              </div>
            </div>             
      </div>
      <div class="box-body table-responsive" id="winCaseBody" style="
        display: none">
            <div class="row">
              <div class="col-md-12 table-responsive tableWinCase">
                 @include('case.case_diary.table.win_case')
              </div>
            </div>            
        
      </div>
      <div class="box-body table-responsive" id="loseCaseBody" style="
        display: none">
            <div class="row">
              <div class="col-md-12 table-responsive tableLostCase">
                 @include('case.case_diary.table.lost_case')
              </div>
            </div>            
      </div>
		</div>
	</div>
</div>
</section>
<script>
	$(document).ready(function (){

    $('#selectClient').select2();


    $('.big').click(function() {   
      $('.btn-info').removeClass('btn-info');
      $(this).addClass('btn-info').find('input').prop('checked', true) ;   

      var cases = $("input[name='cases']:checked").val();
    
      if(cases == 'cg'){
        $('#ongoingCaseBody').show();
        $('#allCaseBody').hide();
        $('#winCaseBody').hide();
        $('#loseCaseBody').hide();
      }
      else if(cases == 'ca'){
        $('#allCaseBody').show();
        $('#ongoingCaseBody').hide();
        $('#winCaseBody').hide();
        $('#loseCaseBody').hide();
      }
      else if(cases == 'cw'){
        $('#winCaseBody').show();
        $('#allCaseBody').hide();
        $('#ongoingCaseBody').hide();
        $('#loseCaseBody').hide();
      }
      else if(cases == 'cl'){
        $('#loseCaseBody').show();
        $('#allCaseBody').hide();
        $('#ongoingCaseBody').hide();
        $('#winCaseBody').hide();
      }
    });

      var cases = "{{$caseBtn}}";
      if(cases == 'cg'){
        $('#ongoingCaseBody').show();
        $('#allCaseBody').hide();
        $('#winCaseBody').hide();
        $('#loseCaseBody').hide();
      }
      else if(cases == 'ca'){
        $('#allCaseBody').show();
        $('#ongoingCaseBody').hide();
        $('#winCaseBody').hide();
        $('#loseCaseBody').hide();
      }
      else if(cases == 'cw'){
        $('#winCaseBody').show();
        $('#allCaseBody').hide();
        $('#ongoingCaseBody').hide();
        $('#loseCaseBody').hide();
      }
      else if(cases == 'cl'){
        $('#loseCaseBody').show();
        $('#allCaseBody').hide();
        $('#ongoingCaseBody').hide();
        $('#winCaseBody').hide();
      }


  
	$('.myTable').DataTable({
        	searching:false,
        	scrolling:true,
          destroy: true,
		});

      

      $(function() {

        var start = moment().subtract(3,'year');
        var end = moment();

        function cb(start, end) {
            $('#reportrange span').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
        }

        $('#reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
               'Today': [moment(), moment()],
               'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
               'Last 7 Days': [moment().subtract(6, 'days'), moment()],
               'Last 30 Days': [moment().subtract(29, 'days'), moment()],
               'This Month': [moment().startOf('month'), moment().endOf('month')],
               'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);

        cb(start, end);

    });

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $('#filterBtn').on('click',function(e){
        e.preventDefault();
        var date = $('#reportrange span').html();
        var case_number = $("input[name='case_number']").val();
        var case_court = $("select[name='case_court'] option:selected").val();
        var client_id = $("select[name='client_id'] option:selected").val();
        var case_type = $("select[name='case_type'] option:selected").val();

        var catg_code = $("select[name='catg_code'] option:selected").val();
        var subcatg_code = $("select[name='subcatg_code'] option:selected").val();

        var caseBtn = $("input[name='cases']:checked").val();
        date = date.split(" - ");

        var startDate = date[0];
        var endDate = date[1];

        console.log(caseBtn);

        $.ajax({
            type : 'POST',
            url : '{{route('case_diary.filter')}}',
            data : {startDate:startDate, endDate:endDate,case_number:case_number,case_court:case_court,client_id:client_id,caseBtn:caseBtn,case_type:case_type,catg_code:catg_code,subcatg_code:subcatg_code},
            success:function(data){
               console.log(data);
              if(caseBtn == 'ca'){
                $('.tableAllCase').empty().html(data);
              }
              else if(caseBtn == 'cg'){
                $('.tableOnCase').empty().html(data);
              }
              else if(caseBtn == 'cw'){
                $('.tableWinCase').empty().html(data);
              }
              else if(caseBtn == 'cl'){
                $('.tableLostCase').empty().html(data);
              }
              
            }
        });
    });
     $('#clearBtn').on('click',function(e){
        $("input[name='case_number']").val('');
        $("select[name='case_court']").val(0);
        $("#selectClient").select2("val",'0');
        $("select[name='case_type']").val(0);
        $("select[name='catg_code']").val(0);
        $("select[name='subcatg_code']").empty();
    });

});
</script>
@endsection