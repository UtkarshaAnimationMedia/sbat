<?php $this->load->view('includes/head') ?>
<?php $this->load->view('includes/topbar') ?>
<?php $this->load->view('includes/header') ?>
<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/jquery.dataTables.css');?>">
<script type="text/javascript" charset="utf8" src="<?=base_url('assets/js/jquery.dataTables.js'); ?>"></script>



<style type="text/css">

  .form-check-input[type=checkbox] {
    border-radius: 11px;
    padding: 16px;
    font-size: 18px;
    border: 2px solid #ffc107;
  }
  .form-check-input:checked[type="checkbox"] {
   background-color: #005d4b;
   border-radius: 11px;
   padding: 16px;
   font-size: 18px;
   border: 2px solid #ffc107;
 }
 .form-check-input:checked[type="checkbox"] + .form-check-label::before {
  background-color: #005D4B;
  font-weight: bold;
  font-size: 18px;
}
.form-check-input:focus {
  border-color: 2px solid #ffc107;
  outline: 0!important;
  box-shadow: none!important;
}


.crop-center {
  background-position: center center;
  background-repeat: no-repeat;
  background-size: cover;
  height: 100px;
  width:100%;
}


.date-time-placeholder::-webkit-input-placeholder {
  color: #fff!important;
}

.date-time-placeholder::-moz-placeholder {
  color: #fff!important;
}

input:-ms-input-placeholder {
  color: #fff!important;
}

.date-time-placeholder:-moz-placeholder {
  color: #fff!important;
}



.quantity-container {
  display: flex;
  align-items: center;
}

.quantity-input {
  width: 40px;
  text-align: center;
  border: 1px solid gray;
  border-radius: 5px;
  margin: 0 10px;
  padding: 5px;
}

.minus-btn, .plus-btn {
  width: 40px;
  height: 40px;
  border: 1px solid gray;
  border-radius: 5px;
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 20px;
  font-weight: bold;
  cursor: pointer;
}

.services{
  background-color:#db9619!important;
  border:0!important;
  word-wrap: inherit!important;
  color: #642318!important;
  font-weight: bold!important;
  padding: 11px 17px!important;
}
.active-services{
  background-color:#570000!important;
  border:0!important;
  color: white!important;    
  padding: 12px 0px!important;
  word-wrap: inherit!important;
  font-weight: 600!important;
  padding: 11px 17px!important;
}


.availability-btn{
  border-radius: 4px!important;
  text-align: center;
  font-size: unset;
  background: #045b62;
  font-weight: 700;
  font-size: 17px;
  padding: 10px;
  float: right;
  margin-right: 26px;
}

.service-list-header{
  vertical-align: middle;
  font-size: 20px;
  font-weight: 700;
  text-shadow: 0px 1px 0px red;
  background-color: #045b62;
  color: #ffe000;
}

.dataTables_length{
  display: none;
}

    /*.dataTables_filter{
      display: none;
    }*/

    .dataTables_info{
      margin-top: 30px;
    }

    .dataTables_paginate {
      margin-top: 30px;
    }
  



    .ui-icon,
.ui-widget-content .ui-icon {
  background-image: url("<?=base_url('assets/js/ui-icons_444444_256x240.png'); ?>")!important;
}
.ui-widget-header .ui-icon {
  background-image: url("<?=base_url('assets/js/ui-icons_444444_256x240.png'); ?>")!important;
}



    .ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default, .ui-button, html .ui-button.ui-state-disabled{
      background: #005d4b!important!important;
    }

    .form-select:focus {
      border-color: #000000;
      outline: 0;
      box-shadow: 0 0 0 0.25rem rgb(255 255 255 / 25%);
    }
    .form-select {
      min-height: 37px;
      color: #b02135;
      font-weight: 800;
      width: 100%!important;
      font-size: 16px;
    }


    input.search-text {
      color: #222;
      position:relative;
      z-index:5;
      transition: z-index 0.8s, width 0.5s, background 0.3s ease, border 0.3s;
      height: 39px;
      width: 0;
      margin: 0;
      padding: 5px 0 5px 38px;
      box-sizing: border-box;
      font-size: 16px;
      font-size: 1rem;
      cursor: pointer;
      border-radius: 30px;
      border: 1px solid transparent;
      /*background: url(search.png) no-repeat left 9px center transparent;*/
      background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/PjwhRE9DVFlQRSBzdmcgIFBVQkxJQyAnLS8vVzNDLy9EVEQgU1ZHIDEuMS8vRU4nICAnaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkJz48c3ZnIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDUxMiA1MTIiIGhlaWdodD0iNTEycHgiIGlkPSJMYXllcl8xIiB2ZXJzaW9uPSIxLjEiIHZpZXdCb3g9IjAgMCA1MTIgNTEyIiB3aWR0aD0iNTEycHgiIHhtbDpzcGFjZT0icHJlc2VydmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiPjxwYXRoIGQ9Ik01MDMuODY2LDQ3Ny45NzRMMzYwLjk1OCwzMzUuMDUyYzI4LjcyNS0zNC41NDQsNDYuMDE3LTc4LjkxMiw0Ni4wMTctMTI3LjMzNiAgYzAtMTEwLjA4NC04OS4yMjctMTk5LjMxMi0xOTkuMzEyLTE5OS4zMTJDOTcuNTk5LDguNDAzLDguMzUxLDk3LjYzMSw4LjM1MSwyMDcuNzE1YzAsMTEwLjA2NCw4OS4yNDgsMTk5LjMxMiwxOTkuMzEyLDE5OS4zMTIgIGM0OC40MzUsMCw5Mi43OTItMTcuMjkyLDEyNy4zMzYtNDYuMDE3bDE0Mi45MDgsMTQyLjkyMkw1MDMuODY2LDQ3Ny45NzR6IE0yOS4zMzEsMjA3LjcxNWMwLTk4LjMzNCw3OS45ODctMTc4LjMzMiwxNzguMzMyLTE3OC4zMzIgIGM5OC4zMjUsMCwxNzguMzMyLDc5Ljk5OCwxNzguMzMyLDE3OC4zMzJzLTgwLjAwNywxNzguMzMyLTE3OC4zMzIsMTc4LjMzMkMxMDkuMzE4LDM4Ni4wNDcsMjkuMzMxLDMwNi4wNSwyOS4zMzEsMjA3LjcxNXoiIGZpbGw9IiMzNzQwNEQiLz48L3N2Zz4=) no-repeat left 9px center transparent;
      background-size:24px;
    }
    input.search-text:focus {
      z-index:3; 
      width: 270px;
      border: 2px solid #005d4b;  
      background-color: white;
      outline: none;
      cursor:auto;
      padding-right: 10px;
    }

    input.search-submit {
      position: relative;
      z-index: 4;
      top:17px;
      left: 49px;
      width: 45px;
      height: 45px;
      margin: 0;
      padding: 0;
      border: 0;
      outline: 0;
      border-radius: 30px;
      cursor: pointer; 
      background: none;
    }

    input.search-text::-webkit-search-cancel-button {
      cursor:pointer;
    }

  </style>
  <main id="main">

    <?php $cartList = $this->session->userdata('service_cart');

    $cart_count = (isset($cartList['ids']) && $cartList['ids']) != '' ? count($cartList['ids']) : 0 ;

    $cart_count = $cart_count != '' ? $cart_count : 0 ;
  // echo '<pre>';
    if(empty($cartList['ids']))
    {
      $cartList = array('totalPrice' => 0.00, 'ids' => array());
    }
    $currencySymbol = isset($currency['currencySymbol']) ? (CheckEmptyNullVar($currency['currencySymbol']) != '' ? $currency['currencySymbol'] : '$' ) : '$';


    $generalSettings = GeneralSettings();
    ?>

    <!-- ======= Coming Soon ======= -->
    <section id="temple-services" class="temple-services" style="background-color:var(--page-wrapper-bg-color)!important">
      <div class="container bg-image shadow-1-strong" >
        <div class="row">
          <div class="col-md-12 mx-auto">
            <div class="row m-0 p-0">

              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-4">
                    <span class="text-start fw-bold" style="--bs-body-font-size: 1rem;padding-left: 0.7rem!important;" >Select</span>
                    <div class="row m-0 p-0">
                     <div class="col-md-6 m-0 p-0">
                       <select class="form-control form-select" id="getDataByCategory">
                        <!-- <option value=" " selected disabled><a href="">SELECT</a></option> -->
                        <?php    
                        $serviceCatTypes = array_reverse(GetServiceCatTypes());
                        if (isset($serviceCatTypes) && $serviceCatTypes!= '') {  

                         foreach ($serviceCatTypes as $key => $item) { 
                           if ($item['refDataName'] == 'IN-TEMPLE' || $item['refDataName'] == 'AWAY-TEMPLE' || $item['refDataName'] == 'SHRADAM') { 
                            ?>

                            <?php    $serviceCatTypes = array_reverse(GetServiceCatTypes()); ?>
                            <option value="<?=$item['refDataName']?>"><a href=""><?=$item['displayName']?></a></option>
                          <?php } } } ?>
                        </select>
                      </div>
                    </div> 
                  </div>

                  <div class="col-md-4">
                    <h2 class="bottomborder text-center" style="font-weight:bold!important;font-size: 25px!important;">BOOK A SERVICE</h2>
                  </div>

                  <div class="col-md-4">
                    <div class="d-flex justify-content-end align-items-end" style="border-bottom: 20px;">
                      <div class="text-white px-4">



                        <div class="row">
                          <div class="col-md-9 text-center text-dark">
                            Total Amount
                          </div>
                        </div>

                        <span style="padding-right:6px!important">
                         <a href="javascript:void(0)" onclick="ViewCart()"> <i class="fa fa-shopping-cart fa-2x" style="color:#000030;"></i>
                          <span class="cart-count text-dark" style="font-size: 20px!important;"><?=$cart_count?></span></a>
                        </span>




                        <label class="label label-primary" style="background: #000030;padding: 5px 14px;color: white;margin: 0px 8px;border-radius: 6px;font-size: 17px;font-weight: 1000;"><?=$currencySymbol != '' ? $currencySymbol : '$ ';?> <span class="allPrice"><?= sprintf("%.2f", $cartList['totalPrice']); ?></span></label>
                        <?php if ((isset($generalSettings['isMultipleSelect']) && $generalSettings['isMultipleSelect'] == 'YES')) { ?>

                         <a href="javascript:void(0)" class="btn btn-success" style="background-color: #ffc107;padding: 5px 14px;color: #15102e;border-radius: 6px!important;font-size: 17px;font-weight: 1000;border: 0px!important;margin: 0px 8px;" onclick="CartCheckLogin('services')">

                          <?php if ((isset($generalSettings['payNowText']) && $generalSettings['payNowText'] != ''  && $generalSettings['payNowText'] != 'null' )) { 
                           echo $generalSettings['payNowText'];
                         }else{
                          echo 'PAY NOW';
                        } ?>
                      </a>

                    <?php }else if(isset($generalSettings['isMultipleSelect']) && $generalSettings['isMultipleSelect'] == 'NO'){ ?> 

                     <a href="javascript:void(0)" class="btn btn-success" style="background-color: #ffc107;padding: 5px 14px;color: #15102e;border-radius: 6px!important;font-size: 17px;font-weight: 1000;border: 0px!important;margin: 0px 8px;" onclick="CartCheckLogin('services')">

                      <?php if ((isset($generalSettings['payLetterText']) && $generalSettings['payLetterText'] != ''  && $generalSettings['payLetterText'] != 'null' )) { 
                       echo $generalSettings['payLetterText'];
                     }else{
                      echo 'BOOK NOW';
                    } ?>
                  </a>

                <?php }else{ ?>
                 <a href="javascript:void(0)" class="btn btn-success" style="background-color: #ffc107;padding: 5px 14px;color: #15102e;border-radius: 6px!important;font-size: 17px;font-weight: 1000;border: 0px!important;margin: 0px 8px;" onclick="CartCheckLogin('services')">
                  <?php if ((isset($generalSettings['payNowText']) && $generalSettings['payNowText'] != ''  && $generalSettings['payNowText'] != 'null' )) { 
                   echo $generalSettings['payNowText'];
                 }else{
                  echo 'PAY NOW';
                } ?>
              </a>
            <?php } ?>


          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="px-2 my-3">

    <!-- Search Bar -->
    <input type="search" name="q" id="search" class="search-text searchKey" placeholder="Search..." autocomplete="off" style="margin-left: 10px;">
  </div>
  <!-- Search Bar -->



  <div class="justify-content-center align-items-center filter-tab" style="overflow:hidden">

    <!-- ============================== -->

    <div class="container tab-content" id="myTabContent">
     <?php   
     if (isset($serviceCatTypes) && $serviceCatTypes!= '') {  

      foreach ($serviceCatTypes as $key => $item) {
       if ($item['refDataName'] == 'IN-TEMPLE' || $item['refDataName'] == 'AWAY-TEMPLE' || $item['refDataName'] == 'SHRADAM') { 



        $serivce_Types = getServiceTypes($item['refDataName']);

        ?>

        <div class="tab-pane fade <?= ($key == 0) ? 'show active' : ''; ?>" id="home<?=$key?>" role="tabpanel" aria-labelledby="home-tab">



          <!-- @@@@@@@@@@@@@@@@@@@@@@ Service Types @@@@@@@@@@@@@@@@@@@@@@@@@ -->

          <ul class="nav nav-tabs" id="myTab" role="tablist">

            <?php if(!empty($serivce_Types)){ foreach ($serivce_Types as $key => $val) { ?>

              <style type="text/css">
                .nav-link.active {
                  color: #fff!important;
                  background-color: #005d4b!important;
                }
                .nav-link {
                  color: #000!important;
                  background-color: #E9ECEF!important;
                  margin-right: 5px;
                  border: 0;
                }

              </style>
              <li class="nav-item" role="presentation">
                <button class="nav-link <?= ($key==0)?'serviceTypes1 active':''; ?>" id="home-tab<?= $val['_id']; ?>" data-bs-toggle="tab" data-bs-target="#home-tab-pane<?= $val['_id']; ?>" type="button" role="tab" aria-controls="home-tab-pane<?= $val['_id']; ?>" aria-selected="true" style="padding: 9px 6px!important;font-size: 14px!important;"><?= $val['refDataName']; ?></button>
              </li>
            <?php } } ?>
          </ul>
          <div  class="tab-content" >
            <?php if(!empty($serivce_Types)){ foreach ($serivce_Types as $key => $val) { ?>
              <div class="tab-pane table-responsive fade shadow panettttttttt<?= $val['_id']; ?> show <?= ($key==0)?'active':''; ?>" id="home-tab-pane<?= $val['_id']; ?>" role="tabpanel" aria-labelledby="home-tab<?= $val['_id']; ?>" tabindex="0">
                <?php
                $services = getServicesByServiceType($val['refDataCode'],$val['refDataName'], $cartList);
                echo $services;
                ?>
              </div>
            <?php }} ?> 
          </div>
        </div>
      <?php } }
    }  ?>
  </div>

  <!-- ============================= -->


  <!-- ///////////////////////////////////////////  availabel service list  ////////////////////////////////////////////////// -->
  <div class="modal fade" id="showServiceListModal"  tabindex="-1" role="dialog" aria-labelledby="showServiceListModalTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg " role="document">
      <div class="modal-content modal-dialog-scrollable">


        <form action="#" method="post">
          <div class="modal-header text-center" style="background: #910000;">
            <h5 class="modal-title bottomborder modatTitle" style="color: #ffffff!important;font-size: 23px!important;">Service Availability List</h5>

            <button type="button" class="btn-close m-0" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="container">



              <table class="table table-responsive table-bordered table-hover table-stripe border-dark" style="background: #fff6be;">
                <thead class="service-list-header">
                  <tr>
                    <th style="padding: 10px 33px;">Date <span id="headerMonths"></span></th>
                    <th style="margin-right: 28px;text-align: end;padding: 7px 60px;">Availability</th>
                  </tr>
                </thead>

                <tbody>
                </tbody> 
              </table>


            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- ///////////////////////////////////////////////////////////////////////////////////////////// -->


</div> 

</div>
</div>
</div>
</div>



</section>
<!-- End Coming Soon -->


</main><!-- End #main -->



<?php $this->load->view('includes/footer') ?>

<script type="text/javascript">
    // ============================================

  $(function(){
    $('.timepicker-services').mdtimepicker();
  });


$(document).on('click', '.datepicker-services', function() {
  var dayVal = $(this).attr('daytype');
  
  // check if the datepicker widget has already been initialized on the clicked element
  if (!$(this).hasClass('hasDatepicker')) {
    $(this).datepicker({
      dateFormat: "mm/dd/yy",
      minDate: 0,
      beforeShowDay: function(date){
        var dayOfWeek = $.datepicker.formatDate('DD', date);

        // console.log(dayOfWeek.toUpperCase() +"--"+ dayVal.toUpperCase());

        if (dayOfWeek.toUpperCase() === dayVal.toUpperCase()){
          return [true];
        } else {
          return [false];
        }
      }
    });
  }
  
  $(this).datepicker('show');
});


// Custom Search Bar Start
  $("#search").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#table tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
// Custom Search Bar End


  $(document).ready(function() {
    // $("#getDataByCategory").val("IN-TEMPLE").change();

    var selectedValue = 'IN-TEMPLE';
    $.ajax({
      url: '<?=base_url('Services/getServicesDataByAjax')?>',
      type: 'POST',
      data: {category : selectedValue},
      success: function(data) {
        $("#myTabContent").html('');
        $("#myTabContent").html(data);
        var datatable = $('.servicesDataTable').DataTable({
          "ordering": false,
          "paging": true, 
            "searching": false, // disable searching by default
            "pageLength": 10
          });
        loader.off();
        $('.timepicker-services').mdtimepicker();
        $( ".datepicker-services" ).datepicker({
          dateFormat: "mm/dd/yy",
          minDate: 0
        });
      }
    });




    $("#getDataByCategory").change(function() {
      loader.on();
      var selectedValue = this.value;
      $.ajax({
        url: '<?=base_url('Services/getServicesDataByAjax')?>',
        type: 'POST',
        data: {category : selectedValue},
        success: function(data) {
          $("#myTabContent").html('');
          $("#myTabContent").html(data);
          var datatable = $('.servicesDataTable').DataTable({
            "ordering": false,
            "paging": true, 
            "searching": false, // disable searching by default
            "pageLength": 10
          });
          loader.off();
          $('.timepicker-services').mdtimepicker();
          $( ".datepicker-services" ).datepicker({
            dateFormat: "mm/dd/yy",
            minDate: 0
          });
        }
      });
    });
  } );



  function clearCart() {

    $('input[name="services_id[]"]:checked').each(function() {
      $("input[name='services_id[]']").prop('checked', false);
    });

    if ($("input[name='allCheck']").is(":checked")) {
      $("input[name='allCheck']").prop('checked', false);
    }
    addTocart();

  }

  function addTocart()
  {

    var totalPrice = 0;
    var cart_type = 'SERVICES';
    var ids = [];
    var qty = [];
    var ctg = [];
    var serviceTypes = [];
    var serviceName = [];
    var startDate = [];
    var startTime = [];
    var serviceAmount = [];
    var description = [];
    var image = [];

    $('input[name="services_id[]"]:checked').each(function() {
      id = $(this).attr('data-id');

      loader.on();

          //HERE CHECK SELECTED DATE OR NOT
          //

      if($(this).attr('data-service-type')=='VADAMALA')
      {
       if($("#datepicker_"+id).val().length == 0)
       {
        $(this).prop('checked', false);
        $("#datepicker_"+id).focus();
        $("#datepicker_"+id).parent().append('<span id="myElemdate" style="color:red; font-size:12px;">Please select date</span>');
        $("#myElemdate").fadeIn('slow').animate({opacity: 1.0}, 1500).effect("pulsate", { times: 2 }, 800).fadeOut('slow'); 

        setTimeout(function() {
          $('#myElemdate').remove();
        }, 2000);

        return false;
      }
      else if($("#timepicker_"+id).val().length == 0)
      {
        $("#timepicker_"+id).focus();
        $(this).prop('checked', false);

        $("#timepicker_"+id).parent().append('<span id="myElemtime" style="color:red; font-size:12px;">Please select time</span>');
        $("#myElemtime").fadeIn('slow').animate({opacity: 1.0}, 1500).effect("pulsate", { times: 2 }, 800).fadeOut('slow');

        setTimeout(function() {
          $('#myElemtime').remove();
        }, 2000);

        return false;
      }
    }



    var init_qty = parseInt($("#quantity-input"+id).val());
    init_qty = init_qty?parseInt(init_qty):1;




    totalPrice = parseFloat(totalPrice)+(parseFloat($(this).attr('data-price'))*init_qty);
    // $("#Totalprice_"+id).text((parseFloat($(this).attr('data-price'))*init_qty / 1).toFixed(2));

    ctg.push($(this).attr('data-category')); 
    serviceTypes.push($(this).attr('data-service-type')); 
    serviceName.push($(this).attr('data-service-name')); 



    image.push($(this).attr('data-image')); 
    description.push($(this).attr('data-description')); 



          // if ($("#timepicker_"+id).val()) {}

    startDate.push($("#datepicker_"+id).val()); 
    startTime.push($("#timepicker_"+id).val()); 


    serviceAmount.push($(this).attr('data-price')); 



    ids.push($(this).attr('data-id')); 
    qty.push(init_qty); 


  });


    $(".cart-count").text(ids.length);

    $(".allPrice").text((totalPrice / 1).toFixed(2));

    $.ajax({
      type: "POST", 
      url: "<?= base_url('Services/addCart'); ?>", 
      data: {ids: ids, totalPrice:totalPrice, qty: qty, ctg: ctg, serviceTypes: serviceTypes, serviceName: serviceName, startDate: startDate, startTime: startTime, serviceAmount: serviceAmount, cart_type: cart_type, image: image, description: description}, 
      success: function(result){
        console.log(result);
        loader.off();
      }});

  }



  function quantityMinusFunction(id) {

    var totalPrice = 0;
    var init_qty = parseInt($('#quantity-input'+id).val());
    if (init_qty > 1) {
      init_qty = init_qty?parseInt(init_qty)-1:0;

      $('#quantity-input'+id).val(init_qty);
      // $("#Totalprice_"+id).text((parseFloat($("input[value='"+id+"']").attr('data-price'))*init_qty / 1).toFixed(2));
    }

    addTocart();
  }

  function quantityPlusFunction(id) {
    var totalPrice = 0;
    var init_qty   = parseInt($('#quantity-input'+id).val());
        // var init_max   = parseInt($('#quantity-input'+id).attr('max'));


        // check max quantity
    if($("input[data-id='"+id+"']").attr('data-service-type')=='VADAMALA')
    {
      if($('#quantity-input'+id).attr('max'))
      {
        var maxQty = $('#quantity-input'+id).attr('max');
        if(init_qty == maxQty)
        {
          return false;
        }
      }
    }


    init_qty = init_qty?parseInt(init_qty)+1:0;
    $('#quantity-input'+id).val(init_qty);
    // $("#Totalprice_"+id).text((parseFloat($("input[value='"+id+"']").attr('data-price'))*init_qty / 1).toFixed(2));
    addTocart();

  }


  function  ViewCart(){
    if ( $(".allPrice").text() != 0.00) {
      window.location.href = "<?=base_url('Services/ViewCart')?>";

    }else{
      swal({
        title: "Your cart is empty!",
        text: "Please add some items to your cart.",
        icon: "warning",
        confirmButtonText: 'OK',
        confirmButtonColor: '#005D4B',
      });


    }

  }

  function CartCheckLogin(page){

    if ( $(".allPrice").text() != 0.00) {
     loader.on();

     var page_name = page;
     event.preventDefault();
     $.ajax({
      url: "<?=base_url('check-login-status')?>",
      type: "POST",
      dataType: "json",
      success: function(data) 
      {
       loader.off();

       if (data == 0) {
        openLoginModal(page_name);
      }else{
        if (page_name == 'services') {
          window.location.href = "<?=base_url('checkout/service')?>";
        }

      }

    }
  });



   }else{
    swal({
      title: "Your cart is empty!",
      text: "Please add some items to your cart.",
      icon: "warning",
      confirmButtonText: 'OK',
      confirmButtonColor: '#005D4B',
    });


  }
}




function changebtnStyles(id){
  $(".styles").removeClass('active-services');
  $(".styles").addClass('services');
  $("#"+id).addClass('active-services');
  $("#"+id).removeClass('services');
}

// /*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*//*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/


function availabelServiceList(serviceID)
{

 loader.on();
 var serviceObject     = $("input[value='"+serviceID+"']");
 var startDate         = $(serviceObject).attr('data-start-date');
 var startTime         = $(serviceObject).attr('data-start-time');
 var serviceName       = $(serviceObject).attr('data-service-name');
 var endDate           = $(serviceObject).attr('data-end-date');
 var endTime           = $(serviceObject).attr('data-end-time');

 var BookingLimitPerDay           = $(serviceObject).attr('data-BookingLimitPerDay');


 $.ajax({
  url: "<?= base_url('Services/checkServiceAvailibilty'); ?>",
  type: "POST",
  data:{
    startDate:startDate,
    startTime:startTime,
    serviceName:serviceName,
    endDate:endDate,
    endTime:endTime,
    BookingLimitPerDay:BookingLimitPerDay,
    serviceID:serviceID
  },
  dataType: "json",
  success: function(data) 
  {
   loader.off();

   if(data.statusCode)
   {
    $("#showServiceListModal").modal('show');
    $("#headerMonths").text(data.headerMonths);
    $("#showServiceListModal table tbody").html(data.servicesList);

  }
  else
  {

  }

}             
});
}


function serviceAvailabilitybook(obj)
{
  $("#showServiceListModal").modal('hide');
  var date = $(obj).attr('data-date');
  var serviceID = $(obj).attr('data-service-id');
  var noAvailability = $(obj).attr('data-availability');

  $("#datepicker_"+serviceID).val(date);
  $("#timepicker_"+serviceID).prop('required', true);
  $("#quantity-input"+serviceID).attr('max', noAvailability);

}

$(function() {

  var datatable = $('.servicesDataTable').DataTable({
    "ordering": false,
    "paging": true, 
    "pageLength": 10,
    "searching": false // disable searching by default
  });

});


</script>

<?php $this->load->view('includes/script') ?>