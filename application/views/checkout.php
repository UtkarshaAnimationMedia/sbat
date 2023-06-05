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
  .booknow-btn{
    background-color: #ffc107;
    padding: 5px 14px;color: #15102e;
    border-radius: 6px!important;
    font-size: 17px;
    font-weight: 1000;
    border: 0px!important;
    margin: 0px 8px;
  }
</style>
<main id="main">
  <section  style="background:#FFF8E1;">
    <center> <h2 class="bottomborder" style="font-weight:bold!important;font-size: 35px!important;">Checkout</h2> </center><br>
    <div class="container h-100">




      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12">
          <div class="card card-registration card-registration-2 mb-4" style="border-radius: 15px;">
            <div class="card-body p-3">
              <div class="card-header text-end px-3" style="font-size: 18px!important;background-color:#315c61;"><a href="<?= $session_data == 'sponsor_cart' ? base_url('puja-sponsorship') : ($session_data == 'service_cart' ? base_url('services') : base_url()) ?>" class="btn" style=";background-color:#009688;color: white!important;border-radius: 1px!important;">Close X</a></div>

              <?php 
              $currencySymbol = isset($GeneralSettings['currencySymbol']) ? (CheckEmptyNullVar($GeneralSettings['currencySymbol']) != '' ? $GeneralSettings['currencySymbol'] : '$' ) : '$';

              if (isset($this->session->userdata($session_data)['ids'])) { ?>


                <div class="row g-0">
                  <div class="col-lg-7" style="background-color:#f5f5f5">


                   <div style="margin-bottom: 10px; padding: 0px!important;  padding-left: 15px!important;">
                    <div class="form-check form-check-inline mx-4 mt-3" style="padding: 0px!important;">
                      <input class="form-check-input" type="checkbox" id="InTempleCheckbox" name="InTempleCheckbox">
                      <label class="form-check-label m-auto pt-2" for="InTempleCheckbox">Pay Now</label>
                    </div>

                    <div class="form-check form-check-inline mx-4">
                      <input class="form-check-input" type="checkbox" id="AtHomeCheckbox" name="AtHomeCheckbox">
                      <label class="form-check-label m-auto pt-2" for="AtHomeCheckbox">Pay Later</label>
                    </div>

                    <div class="form-check form-check-inline mx-4">
                      <input class="form-check-input" type="checkbox" id="RequestService" name="RequestService">
                      <label class="form-check-label m-auto pt-2" for="RequestService">Service Request</label>
                    </div>
                  </div>


                  <div class="p-5">
                    <?php $cart_items = $this->session->userdata($session_data); ?>
                    <div class="d-flex justify-content-between align-items-center mb-5">
                      <h3 class="fw-bold mb-0 text-black">Sale Summary</h3>
                      <?php  foreach ($cart_items['ids'] as $key => $value) {  } ?>
                      <h6 class="mb-0 text-muted"><?=$key+1;?> items</h6>
                    </div>
                    <hr class="my-4">


                    <!-- ============================================= -->
                    <?php 
                    $payNowTotalAmount = 0;
                    foreach ($cart_items['ids'] as $key => $value) { 


                      if ($cart_items['payment_btn_check'][$key] == 'PAY-NOW' || (CheckEmptyNullVar($cart_items['payment_btn_check'][$key]) == '' && $cart_items['serviceAmount'][$key] > 0)  ) {
                        $payNowTotalAmount = ($cart_items['serviceAmount'][$key] * $cart_items['qty'][$key]) + $payNowTotalAmount;
                      }
                      ?>


                      <div class="row mb-4 d-flex justify-content-between align-items-center servicesTr <?=$cart_items['payment_btn_check'][$key]; ?> <?= $cart_items['payment_btn_check'][$key] != 'PAY-NOW'? 'd-none' : ''; ?>">
                        <div class="col-md-6 col-lg-6 col-xl-6">
                          <h6 class="text-black fw-bold mb-0"><?=$cart_items['serviceName'][$key].' ('.$cart_items['payment_btn_check'][$key].')'; ?></h6>
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
                    <?php } ?>






                    <!-- ============================================= -->

                    <hr class="my-4">

                    


                    <?php if (@CheckEmptyNullVar($GeneralSettings['TaxPercent']) != '' && @$GeneralSettings['TaxPercent'] > 0) { ?>

                      <div class="row mt-3">
                        <div class="col-md-10"><h5 class="mb-0"  style="font-weight:bold!important;">Tax (<?=@$GeneralSettings['TaxPercent'] != '' || @$GeneralSettings['TaxPercent'] != 0 ?  @$GeneralSettings['TaxPercent'] : 0 ?>%)</h5></div>
                        <div class="col-md-2 text-end"><span style="font-weight:bold!important;"><?=$currencySymbol?> <?= ( price_format( $cart_items['totalPrice'], 2) * price_format( @$GeneralSettings['TaxPercent'], 2 ) ) / 100;?></span></div>

                        <?php $taxAmt = ( price_format( $cart_items['totalPrice'], 2) * price_format( @$GeneralSettings['TaxPercent'], 2 ) ) / 100; ?>
                      </div>

                      <hr class="my-4">
                    <?php }else{ 
                        $taxAmt = 0;
                    } ?>

                    <div class="row mt-3">
                      <div class="col-md-10"><h5 class="mb-0"  style="font-weight:bold!important;">Subtotal</h5></div>
                      <div class="col-md-2 text-end"><span style="font-weight:bold!important;"><?=$currencySymbol?> <?=price_format( $cart_items['totalPrice'], 2);?></span></div>

                    </div>


                    <hr class="my-4">

                    <div class="row p-3" style="background-color:#dbdbdb">
                      <div class="col-md-8"><h4 class="text-dark" style="margin-top:auto;margin-bottom:auto;font-weight: bold!important;">Sale Total</h4></div>
                      <div class="col-md-4">

                        <h4 class="text-dark text-end" style="margin-top:auto;margin-bottom:auto;font-weight: bold!important;"><?=$currencySymbol?>&nbsp;<?=  price_format(($payNowTotalAmount+@$taxAmt), 2);?>
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

                  <?php if(@$GeneralSettings['AcharyaSambhavana'] == 1 ){ ?>
                    <div class="row p-3" style="background-color:#dbdbdb">
                      <div class="col-md-9"><h6 class="fw-bold" style="margin-top:auto;margin-bottom:auto;">Acharya Sambhavana (<?=$currencySymbol?>)</h6></div>
                      <div class="col-md-3 text-end">
                        <input type="number" name="acharya_sambhavana" placeholder="<?=$currencySymbol?> 0.00" class="form-control form-control-sm" id="acharya-sambhavana-input">
                      </div>

                    </div>
                  <?php } ?>

                  <?php if(@$GeneralSettings['GeneralDonationAmount'] == 1 ){ ?>
                    <div class="row p-3" style="background-color:#dbdbdb">
                      <div class="col-md-9"><h6 class="fw-bold" style="margin-top:auto;margin-bottom:auto;">General Donation Amount (<?=$currencySymbol?>)</h6></div>
                      <div class="col-md-3 text-end">
                        <input type="number" name="general_donation" placeholder="<?=$currencySymbol?> 0.00" class="form-control form-control-sm" id="general-donation-input">
                      </div>

                    </div>
                    <hr class="my-4">
                  <?php } ?>
                  <?php
                  $subTotal =  price_format(((( $cart_items['totalPrice'] * @($GeneralSettings['TaxPercent'] ? $GeneralSettings['TaxPercent'] : 0) ) / 100) +  $cart_items['totalPrice']), 2); 
                  $this->session->set_userdata('totalPrice', $subTotal);
                  $newSubTotal = $this->session->userdata('totalPrice');
                  ?>
                  <?php if (@CheckEmptyNullVar($GeneralSettings['TaxPercent']) != '' && @$GeneralSettings['TaxPercent'] > 0) { 
                    $payNowTotalAmount = (price_format( $payNowTotalAmount, 2) * price_format( @$GeneralSettings['TaxPercent'], 2 ) ) / 100;
                  } ?>
                  <div class="text-center my-3">
                    <?php if ((isset($GeneralSettings['isMultipleSelect']) && $GeneralSettings['isMultipleSelect'] == 'YES')) { ?>

                      <?php if ($payNowTotalAmount > 0) { ?> 
                        <div class="d-flex justify-content-between my-4">
                          <h3 class="fw-bold">Amount to Pay:</h3>
                          <h3 class="fw-bold text-end" style="border: 2px solid #dbdbdb;border-radius: 9px;padding: 3px;" id="total-price"><?=$currencySymbol?>&nbsp;<?=  price_format($payNowTotalAmount, 2);?></h3>
                        </div>
                        <div id="paypal-button-container"></div>

                      <?php }else{ ?>
                        <a href="javascript:void(0)" class="btn btn-success booknow-btn" onclick="BookNow()">BOOK NOW</a>
                      <?php  } ?>

                    <?php }else if(isset($GeneralSettings['isMultipleSelect']) && $GeneralSettings['isMultipleSelect'] == 'NO'){ ?> 
                     <a href="javascript:void(0)" class="btn btn-success booknow-btn" onclick="BookNow()">

                      <?php if ((isset($GeneralSettings['payLetterText']) && $GeneralSettings['payLetterText'] != ''  && $GeneralSettings['payLetterText'] != 'null' )) { 
                       echo $GeneralSettings['payLetterText'];
                     }else{
                      echo 'BOOK NOW';
                    } ?>
                  </a>
                <?php }else{ ?>
                 <a href="javascript:void(0)" class="btn btn-success booknow-btn" onclick="BookNow()">
                   <?php if ((isset($GeneralSettings['payLetterText']) && $GeneralSettings['payLetterText'] != ''  && $GeneralSettings['payLetterText'] != 'null' )) { 
                     echo $GeneralSettings['payLetterText'];
                   }else{
                    echo 'BOOK NOW';
                  } ?>
                </a>
              <?php } ?>





            </div>
          </div>
        </div>
      </div>
    <?php }else{ ?> 

     <div class="text-center  my-5">
       <h3 class="text-danger text-center fw-bold mb-5">Your Cart is empty!</h3>
       <a href="<?=base_url('services')?>" class='btn text-center btn-primary btn-sm checkoutbtn' style='background: #910301; border: 1px solid yellow;'>Go to services</a>
     </div>
   <?php } ?>
 </div>
</div>
</div>
</div>
</div>
</section>
</main>




<!-- Live Client Id -->

<!-- <script src="https://www.paypal.com/sdk/js?client-id=AU1EnTmRbtsqFsmFz0FgxzXpAGUkhVs-qVaa8biBb3ijIXriWw4Jgq65m4DQzSjpJhXce8l8tVcYZpAO&intent=capture" data-sdk-integration-source="integrationbuilder"></script> -->

<!-- Demo Client Id -->

<script src="https://www.paypal.com/sdk/js?client-id=AZWa1v-41vEK0OBD5Gh4e7dzK1jDBktayNboPvTKQpmyaf4iOJdSQ9wg3uy_-d9fQZdWYRYnyDZKQxs0&intent=capture" data-sdk-integration-source="integrationbuilder"></script>





<?php $this->load->view('includes/footer') ?>

<script type="text/javascript">

  $(document).ready(function() {
    $('.form-check-input').change(function() {
      $('.form-check-input').not(this).prop('checked', false);
    });

// Start by checking the "In Temple" checkbox by default
    $('#InTempleCheckbox').prop('checked', true);

// Hide rows that don't have the class "IN-TEMPLE"
    $('.servicesTr:not(.PAY-NOW)').addClass('d-none');

// Listen for changes to the checkboxes
    $('#InTempleCheckbox, #AtHomeCheckbox, #RequestService').on('change', function() {
  // Get the ID of the checkbox that was clicked
      var clickedCheckbox = $(this).attr('id');

  // Hide all rows by default
      $('.servicesTr').addClass('d-none');

  // Show rows based on which checkbox was clicked
      if (clickedCheckbox == 'InTempleCheckbox') {
        $('.servicesTr.PAY-NOW').removeClass('d-none');
      } else if (clickedCheckbox == 'AtHomeCheckbox') {
        $('.servicesTr.PAY-LATER').removeClass('d-none');
      } else if (clickedCheckbox == 'RequestService') {
        $('.servicesTr.SERVICE-REQUEST').removeClass('d-none');
      }
    });


  });
   // Create a new ldLoader object
  var loader = new ldLoader({root: ".ldld.full"});


  if (window.performance && window.performance.navigation.type === window.performance.navigation.TYPE_BACK_FORWARD) {
  // Show the loader if the page is being loaded from the cache
    loader.on();
  }



// Add a click event listener to the document object
  document.addEventListener("click", function(event) {


  // Check if the clicked element matches a specific selector
    if (event.target.matches(".navlink, .loader")) {
    // Show the loader
      loader.on();
    }
  });

// Wait for the page to finish loading
  window.onload = function() {
  // Hide the loader
    loader.off();
  };





  $(document).ready(function() {
  // Get the total price element
    var $totalPrice = $('#total-price');

  // Get the input fields
    var $acharyaInput = $('#acharya-sambhavana-input');
    var $generalInput = $('#general-donation-input');

  // Add event listeners to the input fields
    $acharyaInput.on('input', updateTotalPrice);
    $generalInput.on('input', updateTotalPrice);

  // Function to update the total price based on the input values
    function updateTotalPrice() {
    // Get the input values
      var acharyaValue = parseFloat($acharyaInput.val().replace(/[^\d.-]/g, '')) || 0;
      var generalValue = parseFloat($generalInput.val().replace(/[^\d.-]/g, '')) || 0;

    // Get the initial total price
      var initialTotalPrice = parseFloat(<?=$payNowTotalAmount;?>) || 0;

    // Calculate the new total price
      var newTotalPrice = initialTotalPrice + acharyaValue + generalValue;

    // Update the total price element
      $totalPrice.text('<?=$currencySymbol?> ' + newTotalPrice.toFixed(2));
    }

  // Call updateTotalPrice once to include the initial total price
    updateTotalPrice();



  // Disable arrow key inputs
    $acharyaInput.on('keydown', function(e) {
      if (e.which === 38 || e.which === 40) {
        e.preventDefault();
      }
    });


    $generalInput.on('keydown', function(e) {
      if (e.which === 38 || e.which === 40) {
        e.preventDefault();
      }
    });

  // Add validation to prevent input of negative values
    $acharyaInput.on('keydown', function(e) {
      if (e.key === '-' || e.key === '+') {
        e.preventDefault();
      }
    });

    $generalInput.on('keydown', function(e) {
      if (e.key === '-' || e.key === '+') {
        e.preventDefault();
      }
    });

  // Add validation to prevent input of "+" and "e" characters
    $acharyaInput.on('input', function() {
      $acharyaInput.val($acharyaInput.val().replace(/[+e]/gi, ''));
    });

    $generalInput.on('input', function() {
      $generalInput.val($generalInput.val().replace(/[+e]/gi, ''));
    });
  });






  const paypalButtonsComponent = paypal.Buttons({
    style: {
      shape: 'rect',
      color: 'gold',
      layout: 'vertical',
      label: 'paypal',

    },
// set up the transaction
    createOrder: (data, actions) => {
      var currency = "USD";

      amt = parseFloat($('#total-price').text().replace('<?=$currencySymbol?> ', '')) || 0;

      const createOrderPayload = {
        purchase_units: [
        {
          amount: {
            currency_code: currency,
            value:amt
          }
        }
        ]
      };

      return actions.order.create(createOrderPayload);
    },
   // finalize the transaction


    onApprove: (data, actions) => {
      const captureOrderHandler = (details) => {

        loader.on();
        const payerName = details.payer.name.given_name;
        var payer_firstname = details.payer.name.given_name;
        var payer_lastname = details.payer.name.surname;
        var orderid = details.id;
        var status = details.status;
        var email = details.payer.email_address;
        var transaction_id = details.purchase_units[0].payments.captures[0].id;
        var totalPrice = details.purchase_units[0].amount.value;

        var acharya_sambhavana = parseFloat($('#acharya-sambhavana-input').val()) || 0;
        var general_donation = parseFloat($('#general-donation-input').val()) || 0;



        var cart_data = '<?php echo json_encode($cart_items) ?>';





        $.ajax({
          url: "<?=base_url('Services/AddToCart')?>",
          type: "POST",
          dataType: "json",
          data : {

            'fname' : payer_firstname, 
            'lname': payer_lastname, 
            'orderid': orderid, 
            'status': status, 
            'email': email, 
            'transaction_id': transaction_id,
            'totalPrice':totalPrice, 
            'acharya_sambhavana':acharya_sambhavana, 
            'general_donation':general_donation, 
            'cart_data':cart_data, 
          },
          success: function(response) 
          {
          // console.log(response);

            loader.off();

            if (response.statusCode == 1) {

              swal({
                html: true,
                title: "Service Booking Confirmed!",
                text: "<span style='font-weight: 600;margin:5px;padding:5px'>Token No:</span> "+response.data[0].invoiceNo,
                type: "success",
                confirmButtonText: 'OK',
                confirmButtonColor: '#008080',
              },

              function(){


               window.location.reload(); 

             });

            }else{
              swal({
                html: true,
                title: "Failed!",
                text: "<span>Transaction Failed!<span><br><span style='font-weight: 600;margin:5px;padding:5px'>Token No:</span> "+response.data[0].invoiceNo,
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

      // Ajax Request End

      };

      return actions.order.capture().then(captureOrderHandler);
    },

    onError: (err) => {

      console.log(err);
      alert('Transaction Failed');

    }
  });

  paypalButtonsComponent
  .render("#paypal-button-container")
  .catch((err) => {
    console.log('PayPal Buttons failed to render');
  });

  function BookNow(){
    loader.on();
    swal({
      title: "Confirmation?",
      text: "Are you want to Request this Service!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#008080",
      confirmButtonText: "Yes",
      closeOnConfirm: false
    },
    function(){

      loader.on();
      $.ajax({
        url: "<?=base_url('Services/AddServiceRequest')?>",
        type: "POST",
        dataType: "json",
        success: function(response) 
        {
          loader.off();
          if (response.statusCode == 1) {
            swal({
              html: true,
              title: "Service Requested Successful!",
              type: "success",
              confirmButtonText: 'OK',
              confirmButtonColor: '#008080',
            },
            function(){
             window.location.reload(); 
           });

          }else{
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

    });

    loader.off();

  }
</script>
<!-- ==========Language Translator Code============= -->
<div class="ldld full" style="    z-index: 999;"></div>