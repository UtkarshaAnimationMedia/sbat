<?php $this->load->view('includes/head') ?>
<?php $this->load->view('includes/topbar') ?>
<?php $this->load->view('includes/header') ?>

  <style type="text/css">
    .fc-day-header{
      padding: 8px;
      text-transform: uppercase!important;
      color: #44233b;
      background: #f6e0ce !important;
      padding: 1.1em 0 !important;
      font-weight: 500;
      letter-spacing: 0;
      text-transform: capitalize;
      position: relative;
    }
 
   
    .fc-unthemed .fc-row, .fc-unthemed tbody, .fc-unthemed td, .fc-unthemed th, .fc-unthemed thead {
      border-color: #ffefe2;
    }
    .fc td, .fc th {
      border-style: solid;
      border-width: 10px;
      padding: 0;
      vertical-align: top;
      background-color: white;
    }
    .fc .fc-row .fc-content-skeleton table, .fc .fc-row .fc-content-skeleton td, .fc .fc-row .fc-helper-skeleton td {
      background: 0 0;
      border-color: transparent;
      padding: 3px;
      margin: 1px;
      padding-top: 0px;
    }
    .fc .fc-button-group>:first-child {
      margin-left: 0;
      padding: -13px;
      color: black;
      text-transform: uppercase;
      background-color: #ffefe2;
    }
    .fc-toolbar .fc-state-active, .fc-toolbar .ui-state-active {
      z-index: 4;
      background: #aa1f32!important;
      color: white!important;
    }
    .fc .fc-button-group>* {
      float: left;
      margin: 0 0 0 -1px;
      background: #ffefe2;
      color: black;
      text-transform: uppercase;
    }
    .closeButton {
     border-radius: 5px!important;
     background: #008080 !important;
     box-shadow: 1px 1px 10px #7e455561!important;
     text-transform: uppercase!important;
   }

   #calendarEventDetails td {
   border: 1px solid #A71333;
    padding: 17px;
    text-align: center;
    font-weight: 800;
    text-shadow: 0px 1px 13px #fff700;
    color: #9d0000;

}


#calendarEventDetails th {
   border: 1px solid #A71333;
    padding: 17px;
    text-align: center;
    font-weight: 800;
    text-shadow: 0px 1px 13px #fff700;
    color: #9d0000;
  }

/*Modal Css*/


.modal-header {
  border-top: none!important;
}

.modal-confirm.modal-dialog {
    margin-top: 10%;
}

.modal-confirm {
    color: #877676;
    width: 550px;
}



.modal-confirm .modal-content {
  padding: 20px;
  border-radius: 5px;
  border: none;
}
.modal-confirm .modal-header {
  border-bottom: none;   
  position: relative;
}
.modal-confirm h4 {
     text-align: center;
    font-size: 24px;
    margin: 22px 0 -15px;
    color: #980c3c;
    font-weight: 800;
}
.modal-confirm .form-control, .modal-confirm .btn {
  min-height: 40px;
  border-radius: 3px; 
}
.modal-confirm .close {
  position: absolute;
  top: -5px;
  right: -5px;
} 
.modal-confirm .modal-footer {
  border: none;
  text-align: center;
  border-radius: 5px;
  font-size: 13px;
} 
.modal-confirm .icon-box {
  color: #fff!important;
  position: absolute;
  margin: 0 auto;
  left: 0;
  right: 0;
  top: -70px;
  width: 95px;
  height: 95px;
  border-radius: 50%;
  z-index: 9;
  background: #fff;
  padding: 2px;
  text-align: center;
  box-shadow: 0px 2px 2px rgb(0 0 0 / 10%);
}
.modal-confirm .icon-box i {
  font-size: 56px;
  position: relative;
  top: 4px;
}
.modal-confirm .btn {
  color: #fff;
    border-radius: 4px!important;
    background: #980c3c;
    text-decoration: none;
    transition: all 0.4s;
    line-height: normal;
    border: none;
    padding: 0px 36px;
}
.modal-confirm .btn:hover, .modal-confirm .btn:focus {
  background: #da2c12;
  outline: none;
}
.trigger-btn {
  display: inline-block;
  margin: 100px auto;
}

</style>
<main id="main"  style="background-color:var(--page-wrapper-bg-color)!important">

  <div class="container py-5">



    <!-- Modal HTML -->
    <div id="modalevent" class="modal modal-lg fade">
      <div class="modal-dialog modal-confirm">



        <div class="modal-content" style="background-image:url('<?=base_url("assets/img/63f8592dd5885.jpg")?>');position: relative;background-size: cover;">
          <div class="modal-header">
            <img src="<?=base_url('assets/img/image-1672655162220-934535808.png')?>" class="icon-box">      
            <h4 class="modal-title w-100 bottomborder">Event Details</h4> 
          </div>
          <div class="modal-body p-0">
            <table class="table table-responsive table-bordered mt-4" style="background: #ffffff3b;;" >
             <tbody id="calendarEventDetails">

             </tbody>
           </table>
         </div>
         <div class="modal-footer p-0">
          <button type="button" class="mx-auto d-block btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>  





  <div class="calendar" id="calendar" >

  </div>

</div>

<?php 

$evereyArray = array(
  'EVERY SUNDAY' => 0,
  'EVERY MONDAY' => 1,
  'EVERY TUESDAY' => 2,
  'EVERY WEDNESDAY' => 3,
  'EVERY THURSDAY' => 4,
  'EVERY FRIDAY' => 5,
  'EVERY SATURDAY' => 6,
  'EVERY DAY' => '0, 1, 2, 3, 4, 5, 6',
  '' => '',

);



///echo  '<pre>'; print_r($calendar_events);


$html = '';
if(!empty($calendar_events)){
  foreach ($calendar_events as $key => $value) {



      // /*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/**/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/
    $html .= ' {';
    $html .= 'title:"'.trim($value['refDataName']).'",';
          // $html .= 'url:"newpage.php/'.trim($value['_id']).'",';

    if(!empty($value['eventDate']))
    {
      if(empty($value['startTime']))
      {
       $html .= 'start: "'.(date('Y-m-d', strtotime($value['eventDate']))).'",';
     }
     else
     {
      $html .= 'start: "'.(date('Y-m-d', strtotime($value['eventDate'])).'T'.date('H:i:s', strtotime($value['startTime'])) ).'",';
    }


    if(empty($value['endTime']))
    {
     $html .= 'end: "'.(date('Y-m-d', strtotime($value['eventDate']))).'",';
   }
   else
   {
    $html .= 'end: "'.(date('Y-m-d', strtotime($value['eventDate'])).'T'.date('H:i:s', strtotime($value['endTime'])) ).'",';
  }

}
else
{

  $html .= 'start: "'.(date('H:i', strtotime($value['startTime']))).'",';
  $html .= 'end: "'.(date('H:i', strtotime($value['endTime']))).'",';

}


if(!empty($value['colour']))
{
 $html .= 'backgroundColor:"'.$value['colour'].'",';
}

if(!empty($value['dayTypes']))
{
  $html .= 'dow:"['.@$evereyArray[$value['dayTypes']].']",';
}

$html .= 'c_id:"'.@$value['_id'].'",';
$html .= 'c_refDataName:"'.camelCase(@$value['refDataName']).'",';
$html .= 'c_dayTypes:"'.camelCase(@$value['dayTypes']).'",';
$html .= 'c_eventDate:"'.@$value['eventDate'].'",';
$html .= 'c_startTime:"'.@$value['startTime'].'",';
$html .= 'c_endTime:"'.@$value['endTime'].'",';
$html .= 'c_colour:"'.@$value['colour'].'",';
$html .= 'c_moduleName:"'.@$value['moduleName'].'",';
$html .= 'c_clientID:"'.@$value['clientID'].'",';
$html .= 'c_productID:"'.@$value['productID'].'",';
$html .= 'c_aspectType:"'.@$value['aspectType'].'",';
$html .= 'c_recCreBy:"'.@$value['recCreBy'].'",';
$html .= 'c_recCreDate:"'.@$value['recCreDate'].'",';
$html .= 'c_recModBy:"'.@$value['recModBy'].'",';
$html .= 'c_recModDate:"'.@$value['recModDate'].'",';


$html .= ' },';

}
}



?>


</main><!-- End #main -->

<script type="text/javascript">
  $(document).ready(function() {
    var d = new Date();
    var strDate = d.getFullYear() + "/" + (d.getMonth()+1) + "/" + d.getDate();


    $('#calendar').fullCalendar({
      //locale: 'zh-cn',
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,basicWeek,basicDay,list'
      },
      defaultDate: strDate,
      //defaultDate: '2022-11-12',
      navLinks: true, // can click day/week names to navigate views
      editable: true,
      eventLimit: true, // allow "more" link when too many events


      events: 
      [
        <?= $html; ?>
        ],
      displayEventTime: false,

      eventRender: function(event, element, view){
        element.click(function(){


          var html = '';
          html += '<tr><th>Event</th><td> <span id="event_name">'+event.c_refDataName+'</span></td></tr>';

          if(event.c_dayTypes){
            html += '<tr><th>Day</th><td> <span id="event_day">'+event.c_dayTypes+'</span></td></tr>';
          }

          if(event.c_eventDate){
            html += '<tr><th>Date</th><td> <span id="event_date">'+event.c_eventDate+'</span></td></tr>';
          }

          if(event.c_startTime){
            html += '<tr><th>Start&nbspTime</th><td> <span id="start_time">'+event.c_startTime+'</span></td></tr>';
          }

          if(event.c_endTime){
            html += '<tr><th>End&nbspTime</th><td> <span id="end_time">'+event.c_endTime+'</span></td></tr>';
          }

              // alert(html);

          $("#calendarEventDetails").html(html);

          $('#modalevent').modal('show');


        })
      }
      
    });

  });

</script>
<script type="text/javascript">
  $(document).ready(function() {
    window.scrollTo({ top: 225, behavior: 'smooth'});
  });
</script>

<?php $this->load->view('includes/footer.php') ?>
<?php $this->load->view('includes/script.php') ?>


