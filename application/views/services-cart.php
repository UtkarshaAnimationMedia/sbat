<?php $this->load->view('includes/head') ?>
<?php $this->load->view('includes/topbar') ?>
<?php $this->load->view('includes/header') ?>

<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/services-cart.css')?>">
<main id="main">
  <?php 
  $cartList = $this->session->userdata('service_cart');
  $cart_count = isset($cartList['ids']) && $cartList['ids'] ? count($cartList['ids']) : 0;
  $cart_count = $cart_count != '' ? $cart_count : 0;
  if(empty($cartList['ids'])) {
    $cartList = array('totalPrice' => 0.00, 'ids' => array());
  }
  $currencySymbol = isset($currency['currencySymbol']) ? (CheckEmptyNullVar($currency['currencySymbol']) != '' ? $currency['currencySymbol'] : '$' ) : '$';
  $GeneralSettings = GeneralSettings();
  ?>

  <!-- ======= Coming Soon ======= -->
  <section id="temple-services" class="temple-services">
   <div style="padding: 40px 0px;background-image: url('<?=base_url('assets/img/botdownloader.com-1686119799.482487.jpg');?>'); background-size: 25%; background-repeat: repeat-x;"></div>
   <div class="container bg-image shadow-1-strong">
    <div class="row">
      <div class="col-md-12 mx-auto">
        <div class="row m-0 p-0">

          <div class="col-md-12">
            <div class="row">
              <div class="col-md-4">
                <div class="row m-0 p-0">
                  <div class="col-md-12 m-0 p-0">

                    <!-- Search Bar -->
                    <div class="px-2 mb-3">
                      <input type="search" name="q" id="search" class="search-text searchKey" placeholder="Search..." autocomplete="off" style="margin-left: 10px;">
                    </div>
                    <!-- Search Bar -->



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



                    <?php if ((isset($GeneralSettings['isMultipleSelect']) && $GeneralSettings['isMultipleSelect'] == 'YES')) { ?>

                     <a href="javascript:void(0)" class="btn btn-success" style="background-color: #ffc107;padding: 5px 14px;color: #15102e;border-radius: 6px!important;font-size: 17px;font-weight: 1000;border: 0px!important;margin: 0px 8px;" onclick="CartCheckLogin('services')">

                      <?php if ((isset($GeneralSettings['payNowText']) && $GeneralSettings['payNowText'] != ''  && $GeneralSettings['payNowText'] != 'null' )) { 
                       echo $GeneralSettings['payNowText'];
                     }else{
                      echo 'PAY NOW';
                    } ?>
                  </a>
                <?php }else if(isset($GeneralSettings['isMultipleSelect']) && $GeneralSettings['isMultipleSelect'] == 'NO'){ ?> 

                 <a href="javascript:void(0)" class="btn btn-success" style="background-color: #ffc107;padding: 5px 14px;color: #15102e;border-radius: 6px!important;font-size: 17px;font-weight: 1000;border: 0px!important;margin: 0px 8px;" onclick="CartCheckLogin('services')">

                  <?php if ((isset($GeneralSettings['payLetterText']) && $GeneralSettings['payLetterText'] != ''  && $GeneralSettings['payLetterText'] != 'null' )) { 
                   echo $GeneralSettings['payLetterText'];
                 }else{
                  echo 'BOOK NOW';
                } ?>
              </a>

            <?php }else{ ?>
             <a href="javascript:void(0)" class="btn btn-success" style="background-color: #ffc107;padding: 5px 14px;color: #15102e;border-radius: 6px!important;font-size: 17px;font-weight: 1000;border: 0px!important;margin: 0px 8px;" onclick="CartCheckLogin('services')">
              <?php if ((isset($GeneralSettings['payNowText']) && $GeneralSettings['payNowText'] != ''  && $GeneralSettings['payNowText'] != 'null' )) { 
               echo $GeneralSettings['payNowText'];
             }else{
              echo 'BOOK NOW';
            } ?>
          </a>
        <?php } ?>


      </div>
    </div>
  </div>
</div>
</div>





<div class="justify-content-center align-items-center filter-tab mt-3" style="overflow:hidden">

  <!-- ============================== -->

  <div class="container tab-content" id="myTabContent">
   <?php  
   $serivce_Types = getServiceTypes();
   ?>
   <!-- @@@@@@@@@@@@@@@@@@@@@@ Service Types @@@@@@@@@@@@@@@@@@@@@@@@@ -->

   <ul class="nav nav-tabs" id="myTab" role="tablist">

    <?php  if(!empty($serivce_Types)){ foreach ($serivce_Types as $key => $val) { ?>

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
        <button class="nav-link <?= ($key==0)?'serviceTypes1 active':''; ?>" id="home-tab<?= $val['_id']; ?>" data-bs-toggle="tab" data-bs-target="#home-tab-pane<?= $val['_id']; ?>" type="button" role="tab" aria-controls="home-tab-pane<?= $val['_id']; ?>" aria-selected="true" style="padding: 9px 6px!important;font-size: 14px!important;"><?= (@$val['displayName'] ? @$val['displayName'] : $val['refDataName']); ?></button>
      </li>

    <?php } } ?>
  </ul>
  <div  class="tab-content" id="myTabContent">

    <?php if(!empty($serivce_Types)){ foreach ($serivce_Types as $key => $val) { ?>


      <div class="tab-pane table-responsive fade shadow panettttttttt<?= $val['_id']; ?> show <?= ($key==0)?'active':''; ?>" id="home-tab-pane<?= $val['_id']; ?>" role="tabpanel" aria-labelledby="home-tab<?= $val['_id']; ?>" tabindex="0">

        <?php
        $services = getServicesByServiceType($val['refDataCode'],$val['refDataName'], $cartList);
        echo $services;
        ?>
      </div>

    <?php }} ?> 


  </div>
  <!-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ -->




  
</div>


<!-- ============================= -->


<!-- ////////// availabel service list  //////////-->
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
<!-- //////////////////////////////// -->
</div> 
</div>
</div>
</div>
</div>
<div style="padding: 40px 0px;background-image: url('<?=base_url('assets/img/botdownloader.com-1686119799.482487.jpg');?>'); background-size: 25%; background-repeat: repeat-x;"></div>
</section>
<!-- End Coming Soon -->


</main><!-- End #main -->



<?php $this->load->view('includes/footer') ?>

<script type="text/javascript" src="<?=base_url('assets/js/paging.js');?>"></script>




<script type="text/javascript">
    // ============================================

  $(document).ready(function() {

  // Custom Search Bar Start
    $("#search").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#table tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
      });
    });
// Custom Search Bar End

    // Custom Pagination
    $('.servicesDataTable').paging({limit:4});
    $("[data-page='0']").click();
    // TimePicker
    $('.timepicker-services').mdtimepicker();
  });

  $(document).on('click', '.datepicker-services', function() {
    var dayVal = $(this).attr('daytype');

  // check if the datepicker widget has already been initialized on the clicked element


    if (dayVal == !'') {
      if (!$(this).hasClass('hasDatepicker')) {
        $(this).datepicker({
          dateFormat: "mm/dd/yy",
          multidate: true,
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
    }else{
      if (!$(this).hasClass('hasDatepicker')) {
        $(this).datepicker({
          dateFormat: "mm/dd/yy",
          multidate: true,
          minDate: 0
        });
      }
    }

    $(this).datepicker('show');
  });

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
    var cart_ctg = [];
    var payment_btn_check = [];

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
    ctg.push($(this).attr('data-category')); 
    serviceTypes.push($(this).attr('data-service-type')); 
    serviceName.push($(this).attr('data-service-name')); 
    image.push($(this).attr('data-image'));


    var payment_type_check =  '';

    if ($(this).attr('payment-btn-check') == 'PAY NOW') {
     payment_type_check = 'PAY-NOW';
   }else if($(this).attr('payment-btn-check') == 'PAY LATER'){
     payment_type_check = 'PAY-LATER';
   }else if($(this).attr('payment-btn-check') == 'SERVICE REQUEST'){
     payment_type_check = 'SERVICE-REQUEST';
   }


   payment_btn_check.push(payment_type_check); 
   description.push($(this).attr('data-description')); 
   cart_ctg.push($(this).attr('cart_category')); 
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
      data: {ids: ids, totalPrice:totalPrice, qty: qty, ctg: ctg, serviceTypes: serviceTypes, serviceName: serviceName, startDate: startDate, startTime: startTime, serviceAmount: serviceAmount, cart_type: cart_type, image: image, description: description, cart_ctg: cart_ctg, payment_btn_check: payment_btn_check}, 
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
    }


    var initialPrice = $("#price_"+id).text();
    var initialResultAmt = initialPrice.replace(/\$/g, "");

    var substractiveAmt = init_qty*initialResultAmt;

    $("#Totalprice_"+id).text(substractiveAmt.toFixed(2));




    addTocart();
  }

  function quantityPlusFunction(id) {

    var totalPrice = 0;
    var init_qty   = parseInt($('#quantity-input'+id).val());

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

    var initialPrice = $("#price_"+id).text();
    var initialResultAmt = initialPrice.replace(/\$/g, "");
    var substractiveAmt = init_qty*initialResultAmt;


    $("#Totalprice_"+id).text(substractiveAmt.toFixed(2));
    addTocart();

  }


  function  ViewCart(){
    if ( $(".cart-count").text() > 0) {
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

    if ($(".cart-count").text() > 0) {
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

</script>

<?php $this->load->view('includes/script') ?>