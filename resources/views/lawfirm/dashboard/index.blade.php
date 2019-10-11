@extends('lawfirm.layouts.main')
@section('content')
<section class="content">
	<div class="row">
	    <div class="col-md-4 ">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>0</h3>
              <h4>Cases</h4>
              <span>Running: 0 | Closed : 0 | Transfed/NOC : 0 | Direction Matter : 0  | Order Reserved : 0</span>
            </div>
            <div class="icon">
              <i class="fa fa-briefcase"></i>
            </div>
            <a href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-md-4 ">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>0</h3>

              <h4>Total Clients</h4>
              </br></br>
              <span></span>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-md-4 ">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>0</h3>

              <h4>Message</h4></br></br>
            </div>
            <div class="icon">
              <i class="fa fa-envelope"></i>
            </div>
            <a href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
    </div>
    <div class="row">

      <div class="col-md-4 ">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3>0</h3>
              <h4>Appointment</h4>
              <span>Unconfirmed : 0 | Confirmed : 0 | Cancelled Request : 0 </span>
            </br><br>
            </div>
            <div class="icon">
              <i class="fa fa-calendar"></i>
            </div>
            <a href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-md-4 ">
          <!-- small box -->
          <div class="small-box " style="color:white; background-color: #5c6a77">
            <div class="inner">
              <h3>0</h3>
              <h4>Document</h4>
            </br></br>
            </div>
            <div class="icon">
              <i class="fa fa-file"></i>
            </div>
            <a href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
         <div class="col-md-4 ">
  
          <div class="small-box" style="background-color: #df6c6f; color:white;">
            <div class="inner">
              <h3>0</h3>
              <h4>Team Member</h4>
              <span>Approved Request : 0 | Pending Request : 0 | Cancelled Request : 0</span>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
    <div class="row">
      <div class="col-md-4 ">
      <!-- small box -->
        <div class="small-box" style="background-color: #23bab5; color: white">
          <div class="inner">
            <h3>0</h3>

            <h4>To-dos</h4>
            <span>Pending : 0 | Upcoming: 0 | Complete: 0</span>
          </br></br>
          </div>
          <div class="icon">
            <i class="fa fa-list-alt"></i>
          </div>
          <a href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
     {{--  <div class="col-md-4 ">
      <!-- small box -->
        <div class="small-box" style="background-color: #5da3d4; color: white">
          <div class="inner">
            <h3></h3>

            <h4>Invoices</h4>
            <span>Dialy : 0 | Saint: 0 | Paid: 0 | Partially Paid: 0 | Draft & Partially Paid : 0 |</span>
          </div>
          <div class="icon">
            <i class="fa fa-inr"></i>
          </div>
          <a href="{{route('case_diary.index',['caseBtn' =>'ca'])}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div> --}}
    </div>
      <div class="row">
        <div class="col-md-6" >
            <div class="box box-primary " style="height: 300px;">
            <div class="box-header">
              <i class="fa fa-list"></i>
              <h3 class="box-title">Upcoming To-Dos</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="height: 200px;">
              <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
              <ul class="todo-list">
                <li>
                  <label>September 17, 2019</label>
                  <br>
                  <span class="label label-success">2:00 PM</span>
                  <span>Design a nice theme</span>
                 
                {{--   <!-- todo text -->
                  <span class="text">Design a nice theme</span>
                  <!-- Emphasis label -->
                  <small class="label label-danger"><i class="fa fa-clock-o"></i> 2 mins</small>
                  <!-- General tools such as edit or delete--> --}}
                  <div class="tools">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash-o"></i>
                  </div>
                </li>
               
              </ul>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix no-border">
              <button type="button" class="btn btn-default pull-right">More info <i class="fa fa-arrow-circle-right"></i></button>
              <button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add Todo</button>
            </div>
          </div>
        </div>

        <div class="col-md-6" >
            <div class="box box-primary " style="height: 300px;">
            <div class="box-header">
              <i class="fa fa-list"></i>
              <h3 class="box-title">Upcoming Hearing Dates</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="height: 200px;">
              <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
              <ul class="todo-list">
                <li>
                  <label>September 17, 2019</label>
                  <br>
                  <span>Original Suit 1231 / 2019 - case</span>
                 
                  <!-- todo text -->
                {{--   <span class="text">Design a nice theme</span>
                  <!-- Emphasis label -->
                  <small class="label label-danger"><i class="fa fa-clock-o"></i> 2 mins</small> --}}
                  <!-- General tools such as edit or delete-->
                  <div class="tools">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash-o"></i>
                  </div>
                </li>
               
              </ul>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix no-border">
              <button type="button" class="btn btn-default pull-right">More info <i class="fa fa-arrow-circle-right"></i></button>
              <button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add Hearing</button>

            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary" style="height: 300px;">
            <div class="box-header">
              <h3 class="box-title">Recent Activity</h3>
            </div>
            <div class="box-body" style="height: 200px;">
                
            </div>
            <div class="box-footer clearfix no-border">
              <button type="button" class="btn btn-default pull-right">More info <i class="fa fa-arrow-circle-right"></i></button>
               
            </div>
          </div>
        </div>
      </div>
        <!-- ./col -->
        {{-- <div class="col-md-4 ">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3></h3>

              <p>Unconfirmed Appointment</p>
            </div>
            <div class="icon">
              <i class="fa fa-calendar"></i>
            </div>
            <a href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-md-4 ">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3></h3>

              <p>Confirmed Appointment</p>
            </div>
            <div class="icon">
              <i class="fa fa-calendar"></i>
            </div>
            <a href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div> --}}

{{-- <div class="row">
	
        <div class="col-md-4 ">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3></h3>
              <p> Cancelled Appointment</p>
            </div>
            <div class="icon">
              <i class="fa fa-calendar"></i>
            </div>
            <a href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-md-4 ">
          <!-- small box -->
          <div class="small-box bg-orange">
            <div class="inner">
              <h3></h3>

              <p>Total Practicing in Courts</p>
            </div>
            <div class="icon">
              <i class="fa fa-university"></i>
            </div>
            <a href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-md-4 ">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3></h3>

              <p>Total Landmark Case</p>
            </div>
            <div class="icon">
              <i class="fa fa-gavel"></i>
            </div>
            <a href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
         <div class="col-md-4 ">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3></h3>

              <p>Total area of Specializations</p>
            </div>
            <div class="icon">
              <i class="fa fa-balance-scale"></i>
            </div>
            <a href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      
</div>
<div class="row">
    <div class="col-md-4 ">
      <!-- small box -->
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3></h3>

          <p>All Cases</p>
        </div>
        <div class="icon">
          <i class="fa fa-book"></i>
        </div>
        <a href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <div class="col-md-4 ">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3></h3>

          <p>On Going Cases</p>
        </div>
        <div class="icon">
          <i class="fa fa-book"></i>
        </div>
        <a href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>

     <div class="col-md-4 ">
      <!-- small box -->
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3>0</h3>

          <p>Today's Cases</p>
        </div>
        <div class="icon">
          <i class="fa fa-book"></i>
        </div>
        <a href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>

     <div class="col-md-4 ">
      <!-- small box -->
      <div class="small-box bg-red">
        <div class="inner">
          <h3>0</h3>

          <p>Cases of This Week</p>
        </div>
        <div class="icon">
          <i class="fa fa-book"></i>
        </div>
        <a href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>

</div>


	 --}}
		

	</section>
@endsection


