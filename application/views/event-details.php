<?php $this->load->view('includes/head') ?>
<?php $this->load->view('includes/topbar') ?>
<?php $this->load->view('includes/header') ?>

<style type="text/css">
	.bookeventbtn:hover{
		box-shadow: 1px 1px 10px red;
		transition: .4s;
	}

	
	.form-check-input[type=checkbox] {
		border-radius: 0.25em;
		padding: 10px;
		font-size: 18px;
		border: 3px solid #005D4B;
	}
	.form-check-input:checked[type="checkbox"] {
		background-color: #005D4B;
		border-radius: 0.25em;
		padding: 10px;
		font-size: 18px;
		border: 3px solid #005D4B;
	}
	.form-check-input:checked[type="checkbox"] + .form-check-label::before {
		background-color: #005D4B;
		font-weight: bold;
		font-size: 18px;
	}
	.form-check-input:checked[type="checkbox"] + .form-check-label::after {
		background-color: #005D4B;
		border-radius: 0.25em;
		padding: 10px;
		color: yellow!important;
		background-image: url('data:image/svg+xml,%3csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"%3e%3cpath fill="yellow" stroke="%23FFFF00" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5.5 8l4 4 4-4"/%3e%3c/svg%3e')!important;
	}
	.form-check-input:focus {
		border-color: #005D4B!important;
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


	input::-webkit-input-placeholder {
		color: #fff!important;
	}

	input::-moz-placeholder {
		color: #fff!important;
	}

	input:-ms-input-placeholder {
		color: #fff!important;
	}

	input:-moz-placeholder {
		color: #fff!important;
	}

	.services{
		background-color:#db9619;
		border:0;
		word-wrap: inherit;
		color: #642318;
		font-weight: bold!important;
		padding: 11px 17px;
	}
	.active-services{
		background-color:#570000;
		border:0;color: white;    
		padding: 12px 0px;
		word-wrap: inherit;
		font-weight: 600;
		box-shadow: 2px 2px 10px red!important;
		padding: 11px 17px;
	}

	.center-cropped {
		width: 100%;
		height: 120px;
		background-position: center center;
		background-repeat: no-repeat;
		overflow: hidden;
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
</style>
<main id="main">


	<?php 
	$cartList = $this->session->userdata('child_events');
	if(empty($cartList['ids']))
	{

		$cartList = array('totalPrice' => 0.00, 'ids' => array());
		
	}


	$services_html =	GetChildEventByParentEvent($serviceDetails['refDataName'],$serviceDetails['serviceCategoryTypes'],$cartList);

	$currencySymbol = GeneralSettings()['currencySymbol'];
	?>



	<!-- ======= Temple Services Section ======= -->
	<section id="temple-services" class="temple-services" style="background-color:var(--page-wrapper-bg-color)!important">
		<div class="container">
			
			<?php   $ServicePrice = str_replace("$","",$serviceDetails['serviceAmount']);?>
			<div class="container-fluid">

				<!-- <?php print_r($serviceDetails); ?> -->

				<div class="row mb-5">
					<?php if($serviceDetails['Image'] != ""){ ?>
						<div class="col-md-6" data-aos="fade-right">
							<h2  class="bottomborder text-center" style="font-weight:bold!important;font-size: 35px!important;text-shadow: 1px 1px 5px #FA9D1E"><?=camelCase($serviceDetails['refDataName']);?></h2>
							<img src="<?=ApiBaseUrl()['url'].$serviceDetails['Image'];?>" class="img-fluid rounded shadow w-100 h-100" style="width: 100%; height:auto;">

						</div>
					<?php } ?>
					<div class="<?=$serviceDetails['Image'] ? 'col-md-6 mt-5' : 'col-md-12' ;?>" data-aos="fade-left">
						<h5 class="title2 fw-bold mb-4"><u>EVENT DETAILS</u></h5>



						<?= isset($serviceDetails['refDataName']) ? ($serviceDetails['refDataName'] && $serviceDetails['refDataName'] != 'null'?  '<h6 class="fw-bold m-0">Event Name: </h5><p>'.camelCase($serviceDetails['refDataName']).'</p>' : '') : '';?>
						<!-- Date Start -->
						<?php

						if(isset($serviceDetails['startDate']) && !empty(CheckEmptyNullVar($serviceDetails['startDate'])) && isset($serviceDetails['endDate']) && !empty(CheckEmptyNullVar($serviceDetails['endDate']))  )
						{
							if ($serviceDetails['startDate'] == $serviceDetails['endDate']) {

								echo '<h6 class="fw-bold m-0">Date: </h6><p> '.$serviceDetails['startDate'].'</p>';
							}
							else{
								echo '<h6 class="fw-bold m-0">Date: </h6><p> '.$serviceDetails['startDate'].' to '.$serviceDetails['endDate'].'</p>';
							}
						}

						elseif (isset($serviceDetails['startDate']) && !empty(CheckEmptyNullVar($serviceDetails['startDate'])) && isset($serviceDetails['endDate']) && empty(CheckEmptyNullVar($serviceDetails['endDate'])) ) {

							echo '<h6 class="fw-bold m-0">Date: </h6><p> '.$serviceDetails['startDate'].'</p>';
						}
						elseif (isset($serviceDetails['startDate']) && empty(CheckEmptyNullVar($serviceDetails['startDate'])) && isset($serviceDetails['endDate']) && !empty(CheckEmptyNullVar($serviceDetails['endDate'])) ) {

							echo '<h6 class="fw-bold m-0">Date: </h6><p> '.$serviceDetails['endDate'].'</p>';
						}
						elseif (isset($serviceDetails['startDate']) && empty(CheckEmptyNullVar($serviceDetails['startDate'])) && isset($serviceDetails['endDate']) && empty(CheckEmptyNullVar($serviceDetails['endDate'])) ) {

							echo '';
						}

						?>
						<!-- Date End -->

						<!-- Time Start -->


						<?php

						if(isset($serviceDetails['startTime']) && !empty(CheckEmptyNullVar($serviceDetails['startTime'])) && isset($serviceDetails['endTime']) && !empty(CheckEmptyNullVar($serviceDetails['endTime']))  )
						{
							if ($serviceDetails['startTime'] == $serviceDetails['endTime']) {

								echo '<h6 class="fw-bold m-0">Time: </h6><p>'.$serviceDetails['startTime'].'</p>';
							}
							else{
								echo '<h6 class="fw-bold m-0">Time: </h6><p>'.$serviceDetails['startTime'].' to '.$serviceDetails['endTime'].'</p>';
							}
						}

						elseif (isset($serviceDetails['startTime']) && !empty(CheckEmptyNullVar($serviceDetails['startTime'])) && isset($serviceDetails['endTime']) && empty(CheckEmptyNullVar($serviceDetails['endTime'])) ) {

							echo '<h6 class="fw-bold m-0">Time: </h6><p> '.$serviceDetails['startTime'].'</p>';
						}
						elseif (isset($serviceDetails['startTime']) && empty(CheckEmptyNullVar($serviceDetails['startTime'])) && isset($serviceDetails['endTime']) && !empty(CheckEmptyNullVar($serviceDetails['endTime'])) ) {

							echo '<h6 class="fw-bold m-0">Time: </h6><p> '.$serviceDetails['endTime'].'</p>';
						}
						elseif (isset($serviceDetails['startTime']) && empty(CheckEmptyNullVar($serviceDetails['startTime'])) && isset($serviceDetails['endTime']) && empty(CheckEmptyNullVar($serviceDetails['endTime'])) ) {

							echo '';
						}

						?>


						<!-- Time End -->



						<?= ($ServicePrice != 0.00  && $ServicePrice != 'null') ?  '<h6 class="fw-bold m-0">Price: </h5><p>'.@$currencySymbol.' '.sprintf("%.2f", $ServicePrice).'</p>' : '';?>


						<?= isset($serviceDetails['poojaList']) ?  ($serviceDetails['poojaList'] && $serviceDetails['poojaList'] != 'null' ?  '<h6 class="fw-bold m-0">Pooja List: </h5><pre>'.$serviceDetails['poojaList'].'</pre>' : '') : '';?>


						<?= isset($serviceDetails['description']) ? ($serviceDetails['description'] && $serviceDetails['description'] != 'null' ?  '<h6 class="fw-bold m-0">Event Details: </h5><p>'.$serviceDetails['description'].'</p>' : '') : '';?>


						<?= isset($serviceDetails['venue']) ? ($serviceDetails['venue'] && $serviceDetails['venue'] != 'null' ?  '<h6 class="fw-bold m-0">Venue: </h5><p>'.$serviceDetails['venue'].'</p>' : '') : '';?>

						<?php if ($ServicePrice != 0.00) { 

							if ($services_html == '') { ?>
								
								<a href="javascript:void(0)" class="btn btn-primary bookeventbtn btn-sm" style="padding: 6px 20px;background: #910301;border: 1px solid white;" onclick="checkLoginStatus('<?= $ServicePrice ?>', '<?=str_replace("'", "`", $serviceDetails['refDataName'])?>', '<?=$serviceDetails['_id'] ?>', '<?=$serviceDetails['serviceCategoryTypes']?>','<?=$serviceDetails['serviceTypes']?>','<?=$serviceDetails['dayTypes']?>', '<?=$serviceDetails['startDate']?>','<?=$serviceDetails['startTime']?>')">BOOK NOW</a>

							<?php }


							?>

							

						<?php }else{ ?>
							<a href="<?=base_url('contact-us')?>">
								<div class="d-flex shadow flex-column mt-4 text-center col-md-8" style="background-color: #B02135!important;color: #f6e54c;padding: 9px 18px;font-size:14px">Please&nbsp;Contact&nbsp;The&nbsp;Priest&nbsp;For&nbsp;More&nbsp;Details.</div>
							</a>

						<?php } ?>




					</div>

				</div>


				<?php if ($services_html != '') { ?>
					

					<div class="row mt-4" id="service-data">

						<div class="container">
							<div class="d-flex justify-content-end align-items-end h-100" style="border-bottom: 20px;">
								<div class="text-white px-4">
									<p style="font-size: 25px;    font-weight: 600;">
										<a href="javascript:void(0)" onclick="clearCart()">
											<img src="<?=base_url('assets/img/empty-cart.png')?>" style="height: 45px;margin: 0px 8px;">
										</a>
										<label class="label label-primary" style="background: #000030;padding: 1px 11px;color: white;margin: 0px 8px;border-radius: 6px;
										font-size: 17px;">$ <span class="allPrice"><?= sprintf("%.2f", $cartList['totalPrice']); ?></span></label>
										<a href="javascript:void(0)" class="btn btn-success" style="background-color: #ffc107;padding: 6px 14px;color: #15102e;border-radius: 6px!important;font-weight: 1000;border: 0px!important;margin: 0px 8px;" onclick="CartCheckLogin('events')">PAY NOW</a>

										<?php if ($services_html != '') { ?>


											<input class="form-check-input" style="margin-top:13px" name="allCheck" type="checkbox" value="" id="allcheck"  onclick="allcheck()">
											<label class="form-check-label"  style="margin-top:10px" for="allcheck">
												Check All
											</label>

										<?php }?>
									</p>

								</div>
							</div>
						</div>

						<?php 



					// print_r($cartList);
						echo $services_html;

						?>

					</div>
				<?php }?>

			</div>


		</div>
	</section><!-- End Temple Services Section -->


</main><!-- End #main -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript">


	$( ".datepicker-child-events" ).datepicker({
		dateFormat: "mm/dd/yy",
		minDate: 0
	});



	$(function(){
		$('.timepicker-child-events').mdtimepicker();
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
	function allcheck(){
		// $("input[name='services_id[]']").prop("checked", true);


		if ($("input[name='allCheck']").is(":checked")) {
			$("input[name='services_id[]']").prop('checked', true);
		}
		else
		{
			$("input[name='services_id[]']").prop('checked', false);
		}

		addTocart();
	}

	function addTocart()
	{
		var totalPrice = 0;
		var ids = [];
		var qty = [];
		var ctg = [];
		var serviceTypes = [];
		var serviceName = [];
		var startDate = [];
		var startTime = [];
		var serviceAmount = [];

		$('input[name="services_id[]"]:checked').each(function() {
			id = $(this).attr('data-id');
			var init_qty = parseInt($("#quantity-input"+id).val());
			init_qty = init_qty?parseInt(init_qty):1;


			totalPrice = parseFloat(totalPrice)+(parseFloat($(this).attr('data-price'))*init_qty);
			$("#Totalprice_"+id).text((parseFloat($(this).attr('data-price'))*init_qty / 1).toFixed(2));

			ctg.push($(this).attr('data-category')); 
			serviceTypes.push($(this).attr('data-service-type')); 
			serviceName.push($(this).attr('data-service-name')); 



          // if ($("#timepicker_"+id).val()) {}

			startDate.push($("#datepicker_"+id).val()); 
			startTime.push($("#timepicker_"+id).val()); 


			serviceAmount.push($(this).attr('data-price')); 



			ids.push($(this).attr('data-id')); 
			qty.push(init_qty); 


		});

		$(".allPrice").text((totalPrice / 1).toFixed(2));

		$.ajax({
			type: "POST", 
			url: "<?= base_url('BookChildEvents/addCart'); ?>", 
			data: {ids: ids, totalPrice:totalPrice, qty: qty, ctg: ctg, serviceTypes: serviceTypes, serviceName: serviceName, startDate: startDate, startTime: startTime, serviceAmount: serviceAmount}, 
			success: function(result){
				console.log(result);
			}});

	}
	function quantityMinusFunction(id) {

		var totalPrice = 0;
		var init_qty = parseInt($('#quantity-input'+id).val());
		if (init_qty > 1) {
			init_qty = init_qty?parseInt(init_qty)-1:0;

			$('#quantity-input'+id).val(init_qty);
			$("#Totalprice_"+id).text((parseFloat($("input[value='"+id+"']").attr('data-price'))*init_qty / 1).toFixed(2));
		}

		addTocart();
	}

	function quantityPlusFunction(id) {
		var totalPrice = 0;
		var init_qty = parseInt($('#quantity-input'+id).val());
		init_qty = init_qty?parseInt(init_qty)+1:0;

		$('#quantity-input'+id).val(init_qty);

		$("#Totalprice_"+id).text((parseFloat($("input[value='"+id+"']").attr('data-price'))*init_qty / 1).toFixed(2));

		addTocart();
	}


	function CartCheckLogin(page){

		if ( $(".allPrice").text() != 0.00) {


			var page_name = page;
			event.preventDefault();
			$.ajax({
				url: "<?=base_url('check-login-status')?>",
				type: "POST",
				dataType: "json",
				success: function(data) 
				{


					if (data == 0) {
						openLoginModal(page_name);
					}else{
						window.location.href = "<?=base_url('checkout/events')?>";
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




	$(document).ready(function() {

		window.scrollTo({ top: 215, behavior: 'smooth'});
	});
</script>
<?php $this->load->view('includes/footer') ?>
<?php $this->load->view('includes/script') ?>
