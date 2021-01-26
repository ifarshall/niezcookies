<section class="content-header">
      <h1>
        Calendar
        <small>Kalender Pemesanan</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
        <li class="active">Calendar</li>
      </ol>
</section>

<section class="content">
  <div class="row">
    
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-body no-padding">
          <!-- THE CALENDAR -->
          <div id="calendar"></div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /. box -->
    </div>
    <!-- /.col -->
  </div>
      <!-- /.row -->
</section>

<script>

  $(document).ready(function(){
    var calendar = $('#calendar').fullCalendar({
      contentHeight: 700,
      locale: 'id',
      editable: true,
      header: {
        left  : 'prev,next today',
        center: 'title',
        right : 'month,agendaWeek,agendaDay'
      },
      buttonText: {
        today: 'Hari ini',
        month: 'Bulan',
        week : 'Minggu',
        day  : 'Harian'
      },
      events:"<?php echo site_url('calender/load'); ?>",
      eventColor: 'red',
      selectable:true,
      selectHelper:true,
      timeFormat: 'h:mm',
      select:function(start, end, allDay)
      {
        var title = prompt("Masukan Catatan Pesanan");
        // var title = Swal.fire({
        //             input: 'textarea',
        //             inputLabel: 'Message',
        //             inputPlaceholder: 'Type your message here...',
        //             inputAttributes: {
        //               'aria-label': 'Type your message here'
        //             },
        //             showCancelButton: true
        //           }).then((result) => {
        //               if (result.isConfirmed) {
        //                   window.location = link;
        //               }
        //           })
      
        if(title)
        {
          var start = $.fullCalendar.formatDate(
              start, "Y-MM-DD HH:mm:ss");
          var end = $.fullCalendar.formatDate(
              end, "Y-MM-DD HH:mm:ss");
          $.ajax({
              url: "<?php echo site_url('calender/insert');?>",
              type: "POST",
              data: {title:title, start:start, end:end},
              success:function()
              {
                calendar.fullCalendar('refetchEvents');
                Swal.fire('Event telah ditambahkan');
              }
          })
        }
      },
      editable:true,
      eventResize:function(event)
      {
        var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
        var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
        var title = event.title;
        var id = event.id;

        $.ajax({
          url:"<?php echo site_url('calender/update');?>",
          type: "POST",
          data: {title:title, start:start, end:end, id:id},
          success:function()
          {
            calendar.fullCalendar('refetchEvents');
            Swal.fire('Event telah diperbaharui');
          }
        })
      },
      eventDrop:function(event)
      {
        var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
        var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
        var title = event.title;
        var id = event.id;
        $.ajax({
          url:"<?php echo site_url('calender/update');?>",
          type: "POST",
          data: {title:title, start:start, end:end, id:id},
          success:function()
          {
            calendar.fullCalendar('refetchEvents');
            Swal.fire('Event telah diperbaharui');
          }
        })
      },
      eventClick:function(event)
      {
        if(confirm("Apakah pesanan telah selesai?"))
        {
          var id = event.id;
          $.ajax({
            url:"<?php echo site_url('calender/del')?>",
            type: "POST",
            data: {id:id},
            success:function()
            {
              calendar.fullCalendar('refetchEvents');
              Swal.fire('Pesanan telah selesai!');
            }
          })
        }
      }
    });
  });
</script>
