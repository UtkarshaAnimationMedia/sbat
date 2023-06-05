<?php $this->load->view('managements/includes/head'); ?>
<?php $this->load->view('managements/includes/sidebar'); ?>
<?php $this->load->view('managements/includes/topbar'); ?>


<!-- calendar links -->
<link rel="stylesheet" href="<?=base_url('assets/css/fullcalendar.min.css');?>" />
<script src="<?=base_url('assets/js/moment.js');?>"></script>
<script src="<?=base_url('assets/js/fullcalendar.min.js');?>"></script>
<script src="<?=base_url('assets/js/locale-all.js');?>"></script>
<!-- calendar links -->



<style type="text/css">
  .fc-day-header{
    padding: 8px;
    text-transform: uppercase!important;
     /* color: #44233b;
      background: #f6e0ce !important;*/
      color: #ffffff;
      background: #bb001a !important;
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

.fc-ltr .fc-basic-view .fc-day-top .fc-day-number {
  font-size: 21px; font-weight: 700; text-decoration: none; color: #b02135;
}
.fc-unthemed td.fc-today {
  background: #ffef5b!important;
}



</style>

<!-- Main content-->
<?php
$header_data = $this->mongo_db2->where(['aspectType'=> 'headerSettings'])->get('wesiteSettings');
?>
<div class="container my-3">

  <!-- Modal HTML -->
  <div id="modalevent" class="modal modal-lg fade"  style="margin: 0px 25%;">
    <div class="modal-dialog modal-confirm">



      <div class="modal-content" style="background-image:url('<?=base_url("assets/img/63f8592dd5885.jpg")?>');position: relative;background-size: cover;">
        <div class="modal-header">
          <img src="<?=ApiBaseUrl()['url'].$header_data[0]['leftImage']?>" class="icon-box">   
          <h4 class="modal-title w-100 bottomborder">Meeting Details</h4> 
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


<div class="container mt-2">
  <div class="row">

    <div class="calendar" id="calendar" >


    </div>
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
if(!empty($meeting_data)){
  foreach ($meeting_data as $key => $value) {



      // /*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/**/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/
    $html .= ' {';
    $html .= 'title:"'.trim($value['refDataName']).'",';

    if(!empty($value['refDataName2']))
    {
      if(empty($value['refDataName3']))
      {
       $html .= 'start: "'.(date('Y-m-d', strtotime($value['refDataName2']))).'",';
     }
     else
     {
      $html .= 'start: "'.(date('Y-m-d', strtotime($value['refDataName2'])).'T'.date('H:i:s', strtotime($value['refDataName3'])) ).'",';
    }


    if(empty($value['meetingEndtTime']))
    {
     $html .= 'end: "'.(date('Y-m-d', strtotime($value['MeetingEndDate']))).'",';
   }
   else
   {
    $html .= 'end: "'.(date('Y-m-d', strtotime(@$value['MeetingEndDate'])).'T'.date('H:i:s', strtotime(@$value['meetingEndtTime'])) ).'",';
  }

}
else
{

  $html .= 'start: "'.(date('H:i', strtotime($value['refDataName3']))).'",';
  $html .= 'end: "'.(date('H:i', strtotime($value['meetingEndtTime']))).'",';

}


if(!empty($value['colour']))
{
 $html .= 'backgroundColor:"'.$value['colour'].'",';
}

if(!empty($value['refDataName7']))
{
  $html .= 'dow:"['.@$evereyArray[$value['dayTypes']].']",';
}

$html .= 'c_id:"'.@$value['_id'].'",';
$html .= 'c_refDataName:"'.@$value['refDataName'].'",';
$html .= 'c_dayTypes:"'.@$value['refDataName7'].'",';
$html .= 'c_eventDate:"'.@$value['refDataName2'].'",';
$html .= 'c_startTime:"'.@$value['refDataName3'].'",';
$html .= 'c_endDate:"'.@$value['MeetingEndDate'].'",';
$html .= 'c_endTime:"'.@$value['meetingEndtTime'].'",';
$html .= ' },';
}
}

?>
<!-- End Main content--> 
<?php $this->load->view('managements/includes/footer'); ?>

<script>
 $(document).ready(function() {
  var d = new Date();
  var strDate = d.getFullYear() + "/" + (d.getMonth()+1) + "/" + d.getDate();
    // strDate = moment( new Date ).format('MM/DD/YYYY');
// alert(dd);

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

          
          window.location.href = "<?=base_url('managements/meeting-profile/'.base64_encode(getUserDetails()->data[0]->managementCategory).'/')?>"+btoa(event.c_refDataName)+'/'+btoa(event.c_id);


        })
      }
      
    });

});


 $(document).ready(function() {

  $("#heading").text('Meeting Calendar');

} );


</script>
</body>
</html>
