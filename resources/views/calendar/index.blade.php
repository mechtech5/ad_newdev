@extends('lawfirm.layouts.main')
@section('content')
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-body">
					<div id="calendar"></div>
					<br>
					<div class="row">
						<div class="col-md-12 text-center">
							<label><i class="fa fa-square" style="color: #ff4566; height: 25px;width: 20px;"></i> Member To-dos</label>
							<label><i class="fa fa-square" style="color: #fda503; height: 25px;width: 20px;"></i> Everyone To-dos</label>
							<label><i class="fa fa-square" style="color: purple; height: 25px;width: 20px;"></i> Hearing Date</label>
							<label><i class="fa fa-square" style="color: #8259ff; height: 25px;width: 20px;"></i> Hearing Morning Session</label>
							<label><i class="fa fa-square" style="color: #0cab0a; height: 25px;width: 20px;"></i> Hearing Evening Session</label>
							
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</div>
	@include('calendar.calendar_modal')
</section>
 <script>
	$(document).ready(function() {
	// page is now ready, initialize the calendar...
	$('#calendar').fullCalendar({

		header: {
		left: 'prev today next ',
		center: 'title',
		right: 'month,agendaWeek,agendaDay,listWeek'
		},
		height: 600,
		navLinks: true,
		editable: false,
		eventLimit: true,
		selectable : true,

		events: [

		@foreach($todos as $todo)
			{	
				id: '{{$todo->id}}',
				title: '{{$todo->title}}',
				description: '{{$todo->description}}',
				color: '{{$todo->user_id == $todo->team_id ? '#fda503': '#ff4566'}}',
				url : '{{route('todos.show',$todo->id)}}',
				start: '{{$todo->start_date}}',
				end: '{{$todo->end_date}}',
				
			},
		@endforeach
		],
		// eventRender: function(event, element) { 
  //           element.find('.fc-title').append("" + event.description); 
  //       }, 
		eventMouseover: function(calEvent, jsEvent) {
		    var tooltip = '<div class="tooltipevent text-center" style="width:200px;min-height:100px;background:orange;position:absolute;z-index:10001; padding:5px;">' + calEvent.description + '</div>';
		    $("body").append(tooltip);
		    $(this).mouseover(function(e) {
		        $(this).css('z-index', 10000);
		        $('.tooltipevent').fadeIn('500');
		        $('.tooltipevent').fadeTo('10', 1.9);
		    }).mousemove(function(e) {
		        $('.tooltipevent').css('top', e.pageY + 10);
		        $('.tooltipevent').css('left', e.pageX + 20);
		    });
		},

		eventMouseout: function(calEvent, jsEvent) {
		     $(this).css('z-index', 8);
		     $('.tooltipevent').remove();
		},
  //       eventMouseover: function(event, jsEvent, view) {
        	
		// 	    $('.fc-event-inner').append('<div id=\"'+event.id+'\" class=\"hover-end\">'+event.description+'</div>');
		// },

		// eventMouseout: function(event, jsEvent, view) {

		//     $('#'+event.id).remove();
		// },
		// dayClick: function(info) {
		// 		var date =  info.date;
		// 		alert(date);
		// 		// $('.start_date').val(date);
		// 		// $('.end_date').val(date);
		// 		// $('#calendar_modal').modal('show');

		// },
		select: function(start, end, jsEvent, view) {
         	
			var start_date = moment(start).format('YYYY-MM-DD');

			var end_date =  moment(end).subtract(1, 'days').format('YYYY-MM-DD');
			// alert(end_date);
	        $('.start_date').val(start_date);
			$('.end_date').val(end_date);
			$('#calendar_modal').modal('show');
	         
	    }

				
		// customButtons: {
		//   addEventButton: {
		//     text: 'Add new event',
		//     click: function () {
		//       var dateStr = prompt('Enter date in YYYY-MM-DD format');
		//       var date = moment(dateStr);

		//       if (date.isValid()) {
		//         $('#calendar').fullCalendar('renderEvent', {
		//           title: 'Dynamic event',
		//           start: date,
		//           allDay: true
		//         });
		//       } else {
		//         alert('Invalid Date');
		//       }

		//     }
		//   }
		// },
		// dayClick: function (date, jsEvent, view) {
		//   var date = moment(date);

		//   if (date.isValid()) {
		//     $('#calendar').fullCalendar('renderEvent', {
		//       title: 'Dynamic event from date click',
		//       start: date,
		//       allDay: true
		//     });
		//   } else {
		//     alert('Invalid');
		//   }
		// },
		});

		 //  document.addEventListener('DOMContentLoaded', function() {
		 //    var calendarEl = document.getElementById('calendar');

		 //    var calendar = new FullCalendar.Calendar(calendarEl, {
		 //       plugins: [ 'dayGrid', 'timeGrid', 'list' ], 
		 //       header: { center: 'dayGridMonth,timeGridWeek,listWeek' },
		 //       height:600,
		 //      events: [
				  //   {
				  //     title: 'My Event',
				  //     start: '2019-10-18',
				  //     url: 'http://google.com/'
				  //   }
				  //   // other events here
				  // ],
		 //    });
		 //    // calendar.setOption('height', 600);
		 //    // calendar.setOption('contentHeight', 600);



		 //    calendar.render();
		  // });
	});
  </script>
@endsection