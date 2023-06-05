<?php $this->load->view('includes/head') ?>
<?php $this->load->view('includes/topbar') ?>
<?php $this->load->view('includes/header') ?>

<style type="text/css">
	.table>tbody>tr>td,
	.table>tfoot>tr>td {
		vertical-align: middle;
	}

	@media screen and (max-width: 600px) {
		table#cart tbody td .form-control {
			width: 20%;
			display: inline !important;
		}
		.actions .btn {
			width: 36%;
			margin: 1.5em 0;
		}
		.actions .btn-info {
			float: left;
		}
		.actions .btn-danger {
			float: right;
		}
		table#cart thead {
			display: none;
		}
		table#cart tbody td {
			display: block;
			padding: .6rem;
			min-width: 320px;
		}
		table#cart tbody tr td:first-child {
			background: #333;
			color: #fff;
		}
		table#cart tbody td:before {
			content: attr(data-th);
			font-weight: bold;
			display: inline-block;
			width: 8rem;
		}
		table#cart tfoot td {
			display: block;
		}
		table#cart tfoot td .btn {
			display: block;
		}
	}
</style>
<main id="main">
	<section  style="background-image: linear-gradient(var(--page-wrapper-bg-color), white);">
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
		<?php $cart_items = $this->session->userdata($session_data); 

		$currencySymbol = isset($currency['currencySymbol']) ? (CheckEmptyNullVar($currency['currencySymbol']) != '' ? $currency['currencySymbol'] : '$' ) : '$';
		?>

		<span id="cart-amount"  class="allPrice d-none"><?= sprintf("%.2f", $cart_items['totalPrice']); ?></span>
		
		<div class="container">

			<table id="cart" class="table table-responsive shadow">
				<thead style="background-color: #70011D; color: #fff;">
					<tr>
						<th style="width:50%">Facilities</th>
						<th style="width:10%" class="text-end">Amount</th>
						<th style="width:10%" class="text-end">Quantity</th>
						<th style="width:10%" class="text-end">Subtotal</th>
						<th style="width:10%"></th>
					</tr>
				</thead>

				<?php 
                      // print_r($cart_items);
				foreach ($cart_items['ids'] as $key => $value) { ?>

					<tbody>
						<tr style=" background: white">
							<td data-th="Product">
								<div class="row">
									<div class="col-sm-2 hidden-xs"><img src="<?=ApiBaseUrl()['url'].$cart_items['image'][$key]; ?>" alt="<?=$cart_items['serviceName'][$key]; ?>" height="50px" width="80px"/></div>
									<div class="col-sm-10">
										<h4 class="nomargin"><?=$cart_items['serviceName'][$key]; ?></h4>
									</div>
								</div>
							</td>
							<td class="text-end" data-th="Price"><?= @$currencySymbol['currencySymbol'].' '.price_format($cart_items['serviceAmount'][$key], 2); ?></td>
							<td class="text-end" data-th="Quantity">
								<span><?= $cart_items['qty'][$key]; ?></span>
							</td>
							<td  data-th="Subtotal" class="text-end"><?= @$currencySymbol['currencySymbol'].' '.price_format(($cart_items['serviceAmount'][$key]*$cart_items['qty'][$key]), 2); ?></td>
							<td class="actions" data-th="">
								<a href="javascript:void(0)" class="text-danger btn-sm delete-row" data-row-id="<?= $cart_items['ids'][$key]; ?>" style="font-size:17px"><i class="fa fa-trash-o"></i></a>
							</td>
						</tr>
					</tbody>

				<?php } ?>
				<?php  $subTotal =  price_format(((( $cart_items['totalPrice'] * @$GeneralSettings['TaxPercent'] ) / 100) +  $cart_items['totalPrice']), 2);   ?>
				
			</table>


			<div class="row">
				<div class="col-md-6">
					<a href="<?=base_url('services')?>" class="btn btn-warning"><i class="fa fa-angle-left"></i> Go Back to Services</a>
				</div>
				<div class="col-md-6 text-end">
					<span  id="cart-amount" class="hidden-xs text-center"><strong>Total <?=    @$currencySymbol['currencySymbol'].' '.price_format((((  $cart_items['totalPrice'] *  @$GeneralSettings['TaxPercent'] ) / 100) + $cart_items['totalPrice']), 2 );?></strong>
					</span>
					<span><a href="javascript:void(0)" onclick="CartCheckLogin('services')" class="btn btn-success btn-block">Checkout <i class="fa fa-angle-right"></i></a></span>
				</tr>
			</div>
		</div>
	</div>
</section>
</main>

<!-- ==========Language Translator Code============= -->
<div class="ldld full" style="    z-index: 999;"></div>
<?php $this->load->view('includes/footer') ?>
<?php $this->load->view('includes/script') ?>
<script type="text/javascript">

	function CartCheckLogin(page){

		if ( $(".allPrice").text() != 0.00) {
			// loader.on();

			var page_name = page;
			event.preventDefault();
			$.ajax({
				url: "<?=base_url('check-login-status')?>",
				type: "POST",
				dataType: "json",
				success: function(data) 
				{
					// loader.off();

					if (data == 0) {
						openLoginModal(page_name);
					}else{
						if (page_name == 'service-name') {

							$.ajax({
								url: "<?= base_url('Services/AddServiceRequest'); ?>",
								type: "POST",
								dataType: "json",
								success: function(data) 
								{
									loader.off();
									console.log(data);
								}             
							});

						}else{

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


	$(document).on('click', '.delete-row', function(e){
		e.preventDefault();
		var row_id = $(this).data('row-id');
	    var current_row = $(this).closest('tr'); // store the current row for later removal
	    $.ajax({
	    	url: '<?= base_url()?>Services/delete_cart_row',
	    	method: 'POST',
	    	data: {row_id: row_id},
	    	dataType: 'json',
	    	success: function(response){
	    		if(response.status == 'success'){
	                // remove the deleted row from the DOM
	    			current_row.remove();
	                // update the cart amount
	    			var updated_amount = response.updated_amount;
	    			$('#cart-amount').text(updated_amount);
	    			location.reload();
	    		}
	    	},
	    	error: function(){
	    		alert('Error deleting cart row. Please try again.');
	    	}
	    });
	});
</script>