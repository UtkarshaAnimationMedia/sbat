<?php $this->load->view('includes/head') ?>
<?php $this->load->view('includes/topbar') ?>
<?php $this->load->view('includes/header') ?>

<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/services-cart.css')?>">
<main id="main">
  <?php 
  $cartList = $this->session->userdata('facilities_cart');
  $cart_count = isset($cartList['ids']) && $cartList['ids'] ? count($cartList['ids']) : 0;
  $cart_count = $cart_count != '' ? $cart_count : 0;
  if(empty($cartList['ids'])) {
    $cartList = array('totalPrice' => 0.00, 'ids' => array());
  }
  $currencySymbol = isset($currency['currencySymbol']) ? (CheckEmptyNullVar($currency['currencySymbol']) != '' ? $currency['currencySymbol'] : '$' ) : '$';
  $GeneralSettings = GeneralSettings();
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
                  <div class="row m-0 p-0">
                    <div class="col-md-12 m-0 p-0">

                      <!-- Search Bar -->
                      <div class="px-2 mb-3">
                        <input type="search" name="q" id="search" class="search-text searchKey" placeholder="Search..." autocomplete="off" style="margin-left: 10px;">
                      </div>
                    </div>
                  </div> 
                </div>

                <div class="col-md-4">
                  <h2 class="bottomborder text-center" style="font-weight:bold!important;font-size: 25px!important;">BOOK FACILITIES</h2>
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
                        <span class="cart-count text-dark" style="font-size: 14px!important;"><?=$cart_count?></span></a>
                      </span>

                      <label class="label label-primary" style="background: #000030;padding: 5px 14px;color: white;margin: 0px 8px;border-radius: 6px;font-size: 14px;font-weight: 1000;"><?=$currencySymbol != '' ? $currencySymbol : '$ ';?> <span class="allPrice"><?= sprintf("%.2f", $cartList['totalPrice']); ?></span></label>

                      <a href="javascript:void(0)" class="btn btn-success" style="background-color: #ffc107;padding: 5px 14px;color: #15102e;border-radius: 6px!important;font-size: 14px;font-weight: 1000;border: 0px!important;margin: 0px 8px;" onclick="CartCheckLogin('facilities')">SEND REQUEST</a>
                   </div>
                 </div>
               </div>
             </div>
           </div>

           <div class="justify-content-center align-items-center filter-tab" style="overflow:hidden">

            <!-- ============================== -->

            <div class="container tab-content" id="myTabContent">
             <?php  
             $rental_types = GetRentalTypes()['data'];
             ?>
             <!-- @@@@@@@@@@@@@@@@@@@@@@ Service Types @@@@@@@@@@@@@@@@@@@@@@@@@ -->

             <ul class="nav nav-tabs" id="myTab" role="tablist">

              <?php  if(!empty($rental_types)){ foreach ($rental_types as $key => $val) { ?>

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

              <?php if(!empty($rental_types)){ foreach ($rental_types as $key => $val) { ?>

               <div class="tab-pane table-responsive fade shadow panettttttttt<?= $val['_id']; ?> show <?= ($key==0)?'active':''; ?>" id="home-tab-pane<?= $val['_id']; ?>" role="tabpanel" aria-labelledby="home-tab<?= $val['_id']; ?>" tabindex="0">

                <?= getRentalServicesByRentalTypes($val['refDataCode'],$val['refDataName'], $cartList); ?>
              </div>
            <?php }} ?> 
          </div>
          <!-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ -->

        </div>
      </div> 

    </div>
  </div>
</div>
</div>



</section>
<!-- End Coming Soon -->


</main><!-- End #main -->



<?php $this->load->view('includes/footer') ?>

<script type="text/javascript" src="<?=base_url('assets/js/paging.js');?>"></script>




<script type="text/javascript">

  $(document).ready(function() {

    // Custom Pagination
    $('.servicesDataTable').paging({limit:4});
    $("[data-page='0']").click();
  });


  // Custom Search Bar Start
  $("#search").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#table tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
// Custom Search Bar End

  function addTocart()
  {

    var totalPrice = 0;
    var cart_type = 'FACILITIES';
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
      var init_qty = parseInt($("#quantity-input"+id).val());
      init_qty = init_qty?parseInt(init_qty):1;
      totalPrice = parseFloat(totalPrice)+(parseFloat($(this).attr('data-price'))*init_qty);
      ctg.push($(this).attr('data-category')); 
      serviceTypes.push($(this).attr('data-service-type')); 
      serviceName.push($(this).attr('data-service-name')); 
      image.push($(this).attr('data-image'));

      description.push($(this).attr('data-description')); 
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
      url: "<?= base_url('facilitiesContollers/Facilities/addCart'); ?>", 
      data: {ids: ids, totalPrice:totalPrice, qty: qty, ctg: ctg, serviceTypes: serviceTypes, serviceName: serviceName, startDate: startDate, startTime: startTime, serviceAmount: serviceAmount, cart_type: cart_type, image: image, description: description}, 
      success: function(result){
        console.log(result);
        loader.off();
      }});
  }

  function clearCart() {
    $('input[name="services_id[]"]:checked').each(function() {
      $("input[name='services_id[]']").prop('checked', false);
    });

    if ($("input[name='allCheck']").is(":checked")) {
      $("input[name='allCheck']").prop('checked', false);
    }
    addTocart();
  }

  function quantityMinusFunction(id) {

    var totalPrice = 0;
    var init_qty = parseInt($('#quantity-input'+id).val());
    if (init_qty > 1) {
      init_qty = init_qty?parseInt(init_qty)-1:0;
      $('#quantity-input'+id).val(init_qty);



    var initialPrice = $("#price_"+id).text();
    var initialResultAmt = initialPrice.replace(/\$/g, "");

    var subTotal = init_qty*initialResultAmt;

    $("#Totalprice_"+id).text("$ "+subTotal.toFixed(2));


    }

    addTocart();
  }

  function quantityPlusFunction(id) {
    var totalPrice = 0;
    var init_qty   = parseInt($('#quantity-input'+id).val());
    init_qty = init_qty?parseInt(init_qty)+1:0;
    $('#quantity-input'+id).val(init_qty);


    var initialPrice = $("#price_"+id).text();
    var initialResultAmt = initialPrice.replace(/\$/g, "");
     var subTotal = init_qty*initialResultAmt;


    $("#Totalprice_"+id).text("$ "+subTotal.toFixed(2));
    addTocart();
  }


  function  ViewCart(){
    if ( $(".cart-count").text() > 0) {
      window.location.href = "<?=base_url('facilitiesContollers/Facilities/ViewCart')?>";

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
        if (page_name == 'facilities') {
          window.location.href = "<?=base_url('facilities/checkout')?>";
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

</script>

<?php $this->load->view('includes/script') ?>