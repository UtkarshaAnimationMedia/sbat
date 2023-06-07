<?php $this->load->view('includes/head') ?>
<?php $this->load->view('includes/topbar') ?>
<?php $this->load->view('includes/header') ?>
<style type="text/css">
  @media (min-width: 1025px) {
    .h-custom {
      height: 100vh !important;
    }
  }

  .card-registration .select-input.form-control[readonly]:not([disabled]) {
    font-size: 1rem;
    line-height: 2.15;
    padding-left: .75em;
    padding-right: .75em;
  }

  .card-registration .select-arrow {
    top: 13px;
  }

  .bg-grey {
    background-color: #eae8e8;
  }

  @media (min-width: 992px) {
    .card-registration-2 .bg-grey {
      border-top-right-radius: 16px;
      border-bottom-right-radius: 16px;
    }
  }

  @media (max-width: 991px) {
    .card-registration-2 .bg-grey {
      border-bottom-left-radius: 16px;
      border-bottom-right-radius: 16px;
    }
  }

  .fa2{
    padding: 4px 10px;

  }
  input{
    padding-top: 0px!important;
    padding-left: 15px!important;
  }
  .form-control{
    border: 0!important;
  }
  .form-control:focus {
    box-shadow: 0 0 0 0.25rem rgb(255 255 255 / 0%)!important;
  }

</style>
<main id="main">
  <section>
<div class="mt-3" style="padding: 40px 0px;background-image: url('<?=base_url('assets/img/botdownloader.com-1686119799.482487.jpg');?>'); background-size: 25%; background-repeat: repeat-x;"></div>
    <div class="container h-100">

     <?php 

     $currencySymbol = isset($GeneralSettings['currencySymbol']) ? (CheckEmptyNullVar($GeneralSettings['currencySymbol']) != '' ? $GeneralSettings['currencySymbol'] : '$' ) : '$';

     if (isset($this->session->userdata($session_data)['ids'])) { ?>


       <div class="row m-0 px-2 py-4">
        <h2 id="temple-services" class="text-center bottomborder">  Enter Your Event Details</h2>
        <div class="col-md-12 p-0 mx-auto  bg-white rounded px-3">
          <form id="eventdetailsForm">
            <fieldset class="border-2">
              <legend  class="legend-outer  float-none w-auto"> Devotee Details </legend>

              <div class="row">
                <div class="col-md-6">
                  <fieldset class="border">
                    <legend  class="legend-inner float-none w-auto">First Name</legend>
                    <!-- <div class="input-group"></div> -->

                    <div class="input-group">
                      <i class="fa fa-user"></i>
                      <?php
                      $parts = explode(" ", @$userDetails->refDataName);
                      $lastname = array_pop($parts);
                      $firstname = implode(" ", $parts);
                      ?> 
                      <input type="text" class="form-control" id="fname" name="fname" value="<?=set_value('fname', @$firstname)?>" placeholder="First Name*" required aria-label="fname" aria-describedby="basic-addon1" readonly>
                    </div>
                  </fieldset>
                </div>
                <div class="col-md-6">
                  <fieldset class="border">
                    <legend  class="legend-inner float-none w-auto">Last Name</legend>
                    <div class="input-group">
                      <i class="fa fa-user"></i>
                      <input type="text" class="form-control" id="lname" name="lname" value="<?=set_value('lname', @$lastname)?>" placeholder="Last Name" aria-label="lname" required aria-describedby="basic-addon1" readonly>
                    </div>
                  </fieldset>

                </div>

                <div class="col-md-6">
                  <fieldset class="border">
                    <legend  class="legend-inner float-none w-auto">Phone Number</legend>
                    <div class="input-group">
                      <i class="fa fa-phone"></i>
                      <input type="text" class="form-control phone" id="phoneNumber" name="phoneNumber" placeholder="Phone Number" value="<?= set_value('phoneNumber', formatPhoneNumber(base64_decode(@$userDetails->phone)))?>" aria-label="phoneNumber" readonly>
                    </div>
                  </fieldset>

                </div>
                <div class="col-md-6">
                  <fieldset class="border">
                    <legend  class="legend-inner float-none w-auto">Email Id</legend>
                    <div class="input-group">
                      <i class="fa fa-envelope"></i>
                      <input type="email" class="form-control" id="emailId" name="emailId" value="<?= set_value('emailId', base64_decode(@$userDetails->email))?>" placeholder="Email Id" aria-label="emailId" aria-describedby="basic-addon1" readonly>
                    </div>
                  </fieldset>

                </div>

              </div>
            </fieldset>

            <fieldset class="border-2 bg-white">
              <legend  class="legend-outer  float-none w-auto"> Event Details Details </legend>
              <div class="row">
                <div class="col-md-6">
                  <fieldset class="border">
                    <legend  class="legend-inner float-none w-auto">Event Name</legend>
                    <div class="input-group">
                      <input type="text" class="form-control" id="eventName" name="eventName" placeholder="Enter Event Name" aria-label="eventName" required>
                    </div>
                  </fieldset>
                </div>

                <div class="col-md-6">
                  <fieldset class="border">
                    <legend  class="legend-inner float-none w-auto">Event Date</legend>
                    <div class="input-group">
                      <i class="fa fa-calendar"></i>
                      <input type="text" class="form-control event-datepicker" id="eventDate" name="eventDate" placeholder="MM/DD/YYYY" aria-label="eventDate" readonly required>
                    </div>
                  </fieldset>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <fieldset class="border">
                    <legend  class="legend-inner float-none w-auto">Event Time</legend>
                    <div class="input-group">
                      <i class="fa fa-clock-o"></i>
                      <input type="text" class="form-control event-timepicker" id="eventTime" name="eventTime" placeholder="00:00"  aria-label="eventTime" readonly required>
                    </div>
                  </fieldset>
                </div>
                <div class="col-md-6">
                  <fieldset class="border">
                    <legend  class="legend-inner float-none w-auto">Preferred Language</legend>
                    <div class="input-group">

                      <select name="preferredLanguage" id="preferredLanguage" style="color:black!important;" class="form-select form-control border-dark mb-1" required>
                        <option value=" " selected disabled>Select Preferred Language</option>
                        <?php foreach ($preferredLanguage as $item) { ?>
                          <option value="<?=@$item->refDataName?>"><?=@$item->refDataName?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </fieldset>
                </div>


                <div class="col-md-6">
                  <fieldset class="border">
                    <legend  class="legend-inner float-none w-auto">Street Address</legend>
                    <div class="input-group">
                     <i class="fa fa-map-marker"></i>
                     <input type="text" class="form-control border-dark mb-1 " name="eventLocation" id="eventLocation" placeholder="Event Location*" style="color:black!important;"  required>
                   </div>
                 </fieldset>
               </div>

               <div class="col-md-6">
                <fieldset class="border">
                  <legend  class="legend-inner float-none w-auto">State</legend>
                  <div class="input-group">
                    <select class="form-control" name="state" id="stateSelect" required>
                      <option selected disabled>Select State</option>
                      <?php
                      $keys = array_column($GetState, 'refDataName');
                      array_multisort($keys, SORT_ASC, $GetState);
                      foreach ($GetState as $state) { ?>
                        <option value="<?=@$state->refDataName?>" <?= @$state->refDataName == @$userDetails->stateTypes ? 'selected' : ''; ?>><?=@$state->refDataName?></option>
                      <?php } ?>
                    </select>
                  </div>
                </fieldset>
              </div>
              <div class="col-md-6">
                <fieldset class="border">
                  <legend  class="legend-inner float-none w-auto">City</legend>
                  <div class="input-group">
                    <select class="form-control" name="city" id="city" required>
                      <option value="" selected disabled>Select City</option>
                    </select>
                  </div>
                </fieldset>
              </div>
              <div class="col-md-6">
                <fieldset class="border">
                  <legend  class="legend-inner float-none w-auto">Zip Code</legend>
                  <div class="input-group">
                    <i class="fa fa-file"></i>
                    <input type="number" class="form-control" onKeyPress="if(this.value.length==6) return false;" name="zipcode" id="zipcode" onkeydown="disableE(event)"  value="<?= set_value('zipcode', @$userDetails->zip)?>" placeholder="Zip Code"  aria-label="zipcode" aria-describedby="basic-addon1" required>
                  </div>
                </fieldset>
              </div>

              <div class="col-md-12">
                <fieldset class="border">
                  <legend  class="legend-inner float-none w-auto required">Event Description</legend>
                  <div class="input-group">
                    <i class="fa fa-file"></i>
                    <textarea type="text" class="form-control" name="eventDescription" id="eventDescription" placeholder="Enter Event Description"  aria-label="eventDescription" aria-describedby="eventDescription"></textarea>
                  </div>
                </fieldset>
              </div>

            </div>
            <div class="text-center my-3">
             <button type="submit" id="eventdetailsButtonn" class="btn btn-success d-none" style="background-color: #008080;padding: 5px 14px;color: #fff;border-radius: 6px!important;font-size: 17px;font-weight: 700;border: 0px!important;margin: 0px 8px;">SUBMIT</button>
           </div>
         </fieldset>
       </form>
     </div>
   </div>


   <div class="row d-flex justify-content-center align-items-center h-100" id="checkoutForm" >
    <div class="mt-3" style="padding: 40px 0px;background-image: url('<?=base_url('assets/img/botdownloader.com-1686119799.482487.jpg');?>'); background-size: 25%; background-repeat: repeat-x;"></div>
    <div class="col-12">
      <div class="card card-registration card-registration-2 mb-4" style="border-radius: 15px;">
        <div class="card-body p-3">
          <div class="card-header d-none text-end px-3" style="font-size: 18px!important;background-color:#315c61;"><a href="<?= $session_data == 'sponsor_cart' ? base_url('puja-sponsorship') : ($session_data == 'facilities_cart' ? base_url('services') : base_url()) ?>" class="btn" style=";background-color:#009688;color: white!important;border-radius: 1px!important;">Close X</a></div>




          <div class="row g-0">
            <div class="col-lg-7" style="background-color:#f5f5f5">

              <div class="p-5">
                <?php $cart_items = $this->session->userdata($session_data); ?>
                <div class="d-flex justify-content-between align-items-center mb-5">
                  <h3 class="fw-bold mb-0 text-black">Request Summary</h3>
                  <?php  foreach ($cart_items['ids'] as $key => $value) {  } ?>
                  <h6 class="mb-0 text-muted"><?=$key+1;?> items</h6>
                </div>

                <div class="row mb-4 d-flex justify-content-between align-items-center ">
                  <div class="col-md-6 col-lg-6 col-xl-6">
                    <h6 class="text-black fw-bold mb-0">Facilities</h6>
                  </div>
                  <div class="col-md-3 col-lg-3 col-xl-2 text-center d-flex">
                    <h5 class="text-black fw-bold mb-0">Quantity</h5>
                  </div>
                  <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                    <h6 class="text-black fw-bold mb-0">Price</h6>
                  </div>
                </div>
                <hr class="my-4">

                <!-- ============================================= -->
                <?php 
                $payNowTotalAmount = 0;
                foreach ($cart_items['ids'] as $key => $value) { 


                  if ($cart_items['serviceAmount'][$key] > 0) {
                    $payNowTotalAmount = $cart_items['serviceAmount'][$key] + $payNowTotalAmount;
                  }
                  ?>


                  <div class="row mb-4 d-flex justify-content-between align-items-center ">
                    <div class="col-md-6 col-lg-6 col-xl-6">
                      <h6 class="text-black fw-bold mb-0"><?=$cart_items['serviceName'][$key]; ?></h6>
                    </div>
                    <div class="col-md-3 col-lg-3 col-xl-2 text-center d-flex">
                      <h5 class="mb-0"  style="font-weight:bold!important;">
                        x <?= $cart_items['qty'][$key]; ?>
                      </h5>
                    </div>
                    <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                      <h6 class="mb-0 text-end"><span style="font-weight:bold!important;"><?= $currencySymbol.' '.price_format($cart_items['serviceAmount'][$key], 2); ?></span></h6>
                    </div>
                  </div>
                <?php }?>


                <?php if (@CheckEmptyNullVar($GeneralSettings['TaxPercent']) != '' && @$GeneralSettings['TaxPercent'] > 0) { 


                  $payNowTotalAmount = (price_format( $payNowTotalAmount, 2) * price_format( @$GeneralSettings['TaxPercent'], 2 ) ) / 100;
                } ?>




                <!-- ============================================= -->

                <hr class="my-4">

                <div class="row mt-3">
                  <div class="col-md-10"><h5 class="mb-0"  style="font-weight:bold!important;">Subtotal</h5></div>
                  <div class="col-md-2 text-end"><span style="font-weight:bold!important;"><?=$currencySymbol?> <?=price_format( $cart_items['totalPrice'], 2);?></span></div>

                </div>


                <?php if (@CheckEmptyNullVar($GeneralSettings['TaxPercent']) != '' && @$GeneralSettings['TaxPercent'] > 0) { ?>

                  <div class="row mt-3">
                    <div class="col-md-10"><h5 class="mb-0"  style="font-weight:bold!important;">Tax (<?=@$GeneralSettings['TaxPercent'] != '' || @$GeneralSettings['TaxPercent'] != 0 ?  @$GeneralSettings['TaxPercent'] : 0 ?>%)</h5></div>
                    <div class="col-md-2 text-end"><span style="font-weight:bold!important;"><?=$currencySymbol?> <?= price_format(($cart_items['totalPrice'] *  @$GeneralSettings['TaxPercent'] ) / 100, 2);?></span></div>

                  </div>
                <?php } ?>
                <hr class="my-4">

                <div class="row p-3" style="background-color:#dbdbdb">
                  <div class="col-md-8"><h4 class="text-dark" style="margin-top:auto;margin-bottom:auto;font-weight: bold!important;">Sale Total</h4></div>
                  <div class="col-md-4">
                    <h4 class="text-dark text-end" style="margin-top:auto;margin-bottom:auto;font-weight: bold!important;"><?=$currencySymbol?>&nbsp;<?=  price_format((((  $cart_items['totalPrice'] *  @($GeneralSettings['TaxPercent'] ? $GeneralSettings['TaxPercent'] : 0) ) / 100) +  $cart_items['totalPrice']), 2);?>
                  </h4>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-5">
            <div class="p-5">
              <div class="row">
                <div class="col-md-7 fw-bold text-start"><h5 class="mb-2" style="color:#009688!important"><?= @$this->session->userdata('refDataName');?></h5><span><?=@ base64_decode($this->session->userdata('email')) ;?></span></div>
                <div class="col-md-5 fw-bold text-end" style="word-wrap:none ;color:#009688!important">

                  <?=formatPhoneNumber(@base64_decode($this->session->userdata('phone')));?>

                </div>
              </div>
              <hr class="my-4">

              <?php
              $subTotal =  price_format(((( $cart_items['totalPrice'] * @($GeneralSettings['TaxPercent'] ? $GeneralSettings['TaxPercent'] : 0) ) / 100) +  $cart_items['totalPrice']), 2); 
              $this->session->set_userdata('totalPrice', $subTotal);
              $newSubTotal = $this->session->userdata('totalPrice');
              ?>
              <div class="text-center my-3">
               <a href="javascript:void(0)" class="btn btn-success" style="background-color: #ffc107;padding: 5px 14px;color: #15102e;border-radius: 6px!important;font-size: 17px;font-weight: 1000;border: 0px!important;margin: 0px 8px;" id="checkoutButton">SEND REQUEST</a>
             </div>
           </div>
         </div>
       </div>
       <br><br>
     <?php }else{ ?> 
      <div class="row d-flex justify-content-center align-items-center h-100" id="checkoutForm" >
        <center> <h2 class="bottomborder" style="font-weight:bold!important;font-size: 35px!important;">Checkout</h2> </center><br>
        <div class="col-12">
          <div class="card card-registration card-registration-2 mb-4" style="border-radius: 15px;">
            <div class="card-body p-3">
              <div class="card-header text-end px-3" style="font-size: 18px!important;background-color:#315c61;"><a href="<?= $session_data == 'sponsor_cart' ? base_url('puja-sponsorship') : ($session_data == 'facilities_cart' ? base_url('facilities') : base_url()) ?>" class="btn" style=";background-color:#009688;color: white!important;border-radius: 1px!important;">Close X</a></div>


              <div class="text-center  my-5">
               <h3 class="text-danger text-center fw-bold mb-5">Your Cart is empty!</h3>
               <a href="<?=base_url('facilities')?>" class='btn text-center btn-primary btn-sm checkoutbtn' style='background: #910301; border: 1px solid yellow;'>Go to Facilities</a>
             </div>
           <?php } ?>
         </div>
       </div>
     </div>
   </div>
 </div>
 <div class="mt-3" style="padding: 40px 0px;background-image: url('<?=base_url('assets/img/botdownloader.com-1686119799.482487.jpg');?>'); background-size: 25%; background-repeat: repeat-x;"></div>
</section>
</main>

<script src="https://www.paypal.com/sdk/js?client-id=AZWa1v-41vEK0OBD5Gh4e7dzK1jDBktayNboPvTKQpmyaf4iOJdSQ9wg3uy_-d9fQZdWYRYnyDZKQxs0&intent=capture" data-sdk-integration-source="integrationbuilder"></script>




<?php $this->load->view('includes/footer') ?>
<!-- date picker -->
<script src="<?=base_url('assets/js/jquery-ui.min.js');?>"></script>
<!-- date picker -->
<script type="text/javascript">

  function disableE(event) {
    var keyCode = event.keyCode || event.which;
    var char = String.fromCharCode(keyCode);
    if (char.toLowerCase() === 'e') {
      event.preventDefault();
    }
  }
  $(document).ready(function() {

    // TimePicker
    $('.event-timepicker').mdtimepicker();

    $('#stateSelect').change();
    setTimeout(function(){
      $("select[name='city'] option[value='<?= $userDetails->cityTypes; ?>']").attr('selected', 'selected');
    }, 3000);


  });

  $('#stateSelect').change(function(){

    var stateCode = $(this).val();
    $.ajax({
      url:"<?= base_url('facilitiesContollers/Facilities/getcityByState') ?>",
      type: "POST",
      data : {'stateCode':stateCode},
      success: function(data) 
      {
        $("#city").html(data);
      }             
    });

  });


  $(document).on('click', '.event-datepicker', function() {
    if (!$(this).hasClass('hasDatepicker')) {
      $(this).datepicker({
        dateFormat: "mm/dd/yy",
        multidate: true,
        minDate: 0
      });
    }
    $(this).datepicker('show');
  });



  $(".phone").on('input', function(){

    var  phoneField = this;
    var phoneValue = phoneField.value;
    var output;
    phoneValue = phoneValue.replace(/[^0-9]/g, '');
    var area = phoneValue.substr(0, 3);
    var pre = phoneValue.substr(3, 3);
    var tel = phoneValue.substr(6, 4);
    if (area.length < 3) {
      output = "(" + area;
    } else if (area.length == 3 && pre.length < 3) {
      output = "(" + area + ")" + " " + pre;
    } else if (area.length == 3 && pre.length == 3) {
      output = "(" + area + ")" + " " + pre + " - "+tel;
    }
    phoneField.value = output;

  });



  var loader = new ldLoader({root: ".ldld.full"});
  if (window.performance && window.performance.navigation.type === window.performance.navigation.TYPE_BACK_FORWARD) {
    loader.on();
  }

  document.addEventListener("click", function(event) {
    if (event.target.matches(".navlink, .loader")) {
      loader.on();
    }
  });

  window.onload = function() {
    loader.off();
  };

  $(document).ready(function() {
    var $totalPrice = $('#total-price');

    function updateTotalPrice() {
      var initialTotalPrice = parseFloat(<?=$newSubTotal;?>) || 0;
      var newTotalPrice = initialTotalPrice;
      $totalPrice.text('<?=$currencySymbol?> ' + newTotalPrice.toFixed(2));
    }

    updateTotalPrice();

  });


  $(document).ready(function() {
    $("#checkoutButton").click(function() {

      $("#eventdetailsButtonn").click();


    });

    $("#eventdetailsForm").submit(function(e) {
    e.preventDefault(); // Prevent form submission

    // Check if all fields are filled
    if (this.checkValidity()) {
      BookNow();
    }
  });


  });


 function BookNow() {
  var eventDetails = []; 

  eventDetails.push({
    eventName: $("#eventName").val(),
    eventDate: $("#eventDate").val(),
    eventTime: $("#eventTime").val(),
    eventAddress: $("#eventLocation").val(),
    eventState: $("#selectState").val(),
    eventCity: $("#city").val(),
    eventLanguage: $("#preferredLanguage").val(),

    zip: $("#zipcode").val(),
    eventDescription: $("#eventDescription").val(),
  });

  loader.on();
  swal({
    title: "Confirmation?",
    text: "Are you sure you want to request this facility?",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#008080",
    confirmButtonText: "Yes",
    closeOnConfirm: false
  },
  function(isConfirmed) {
    if (isConfirmed) {
      // Disable the button
      $('.confirm').prop('disabled', true);
      
      loader.on();
      $.ajax({
        url: "<?=base_url('facilitiesContollers/Facilities/BookFacilities')?>",
        type: "POST",
        dataType: "json",
        data: { eventDetails },
        success: function(response) {
          loader.off();
          if (response.statusCode == 1) {
            swal({
              html: true,
              title: "Facility Request Successful!",
              text: "<span style='font-weight: 600;margin:5px;padding:5px'>Order No:</span> " + response.data[0].invoiceNo,
              type: "success",
              confirmButtonText: 'OK',
              confirmButtonColor: '#008080',
            },
            function(){
              window.location.reload(); 
            });
          } else {
            swal({
              html: true,
              title: "Failed!",
              text: "<span>Transaction Failed!<span>",
              type: "error",
              confirmButtonText: 'OK',
              confirmButtonColor: '#008080',
            },
            function(){
              window.location.reload(); 
            });
          }
        }             
      });
    }
  });
  
  loader.off();
}

</script>
<script type="text/javascript" src="<?=base_url('assets/js/time-picker.js')?>"></script>
<!-- ==========Language Translator Code============= -->
<div class="ldld full" style="    z-index: 999;"></div>