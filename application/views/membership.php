<?php $this->load->view('includes/head') ?>
<?php $this->load->view('includes/topbar') ?>
<?php $this->load->view('includes/header') ?>
<main id="main">
	<!-- ======= Coming Soon ======= -->
	<section>
		<div style="padding: 40px 0px;background-image: url('<?=base_url('assets/img/botdownloader.com-1686119799.482487.jpg');?>'); background-size: 25%; background-repeat: repeat-x;"></div>
		<div class="container" >
			<center> <h2 class="bottomborder" style="font-weight:bold!important;font-size: 35px!important;">Membership</h2> </center>
			<div class="row">
				<div class="col-md-10 mx-auto d-block">
					<form action="#" class="contact-form">
						<fieldset class="border-2">
							<legend  class="legend-outer  float-none w-auto"> Login Details </legend>
							<div class="row">
								<div class="col-md-4">
									<fieldset class="border">
										<legend  class="legend-inner float-none w-auto">Email</legend>
										<div class="input-group">
											<i class="fa fa2 fa-envelope"></i>
											<input type="email" class="form-control border-0" aria-label="email" aria-describedby="basic-addon1" required>
										</div>
									</fieldset>
								</div>
								<div class="col-md-4">
									<fieldset class="border">
										<legend  class="legend-inner float-none w-auto">Password</legend>
										<div class="input-group">
											<i class="fa fa2 fa-lock"></i>
											<input type="password" class="form-control border-0" id="password" placeholder="Password*" aria-label="password" aria-describedby="basic-addon1" required>
										</div>
									</fieldset>
								</div>
								<div class="col-md-4">
									<fieldset class="border">
										<legend  class="legend-inner float-none w-auto">Confirm Password</legend>
										<div class="input-group">
											<i class="fa fa2 fa-lock"></i>
											<input type="text" class="form-control border-0" id="conf_password" placeholder="Confirm Password*" aria-label="conf_password" aria-describedby="basic-addon1" required>
										</div>
									</fieldset>
								</div>
							</div>
						</fieldset>
						<fieldset class="border-2">
							<legend  class="legend-outer  float-none w-auto"> Personal Details </legend>
							<div class="row">
								<div class="col-md-4">
									<fieldset class="border">
										<legend  class="legend-inner float-none w-auto">First Name</legend>
										<div class="input-group">
											<i class="fa fa2 fa-user"></i>
											<input type="text" class="form-control border-0" id="fname" name="fname" placeholder="First Name*" required>
										</div>
									</fieldset>
								</div>
								<div class="col-md-4">
									<fieldset class="border">
										<legend  class="legend-inner float-none w-auto">Last Name</legend>
										<div class="input-group">
											<i class="fa fa2 fa-user"></i>
											<input type="text" class="form-control border-0" id="lname" name="lname" placeholder="Last Name*" required>
										</div>
									</fieldset>
								</div>

								<div class="col-md-4">
									<fieldset class="border">
										<legend  class="legend-inner float-none w-auto">Contact</legend>
										<div class="input-group">
											<i class="fa fa2 fa-phone"></i>
											<input type="number" class="form-control border-0" placeholder="Contact Number*" required>
										</div>
									</fieldset>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<fieldset class="border">
										<legend  class="legend-inner float-none w-auto">City</legend>
										<div class="input-group">
											<input type="text" class="form-control border-0" placeholder="City*" required>
										</div>
									</fieldset>
								</div>
								<div class="col-md-6">
									<fieldset class="border">
										<legend  class="legend-inner float-none w-auto">State</legend>
										<div class="input-group">
											<input type="text" class="form-control border-0" placeholder="State*" required>
										</div>
									</fieldset>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<fieldset class="border">
										<legend  class="legend-inner float-none w-auto">Country</legend>
										<div class="input-group">
											<input type="text" class="form-control border-0" placeholder="Country*" required>
										</div>
									</fieldset>
								</div>
								<div class="col-md-6">
									<fieldset class="border">
										<legend  class="legend-inner float-none w-auto">Nakshatram</legend>
										<div class="input-group">
											<input type="text" class="form-control border-0" placeholder="Nakshatram*" required>
										</div>
									</fieldset>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<fieldset class="border">
										<legend  class="legend-inner float-none w-auto">Gothram</legend>
										<div class="input-group">
											<input type="text" class="form-control border-0" placeholder="Gothram*" required>
										</div>
									</fieldset>
								</div>
								<div class="col-md-4">
									<fieldset class="border">
										<legend  class="legend-inner float-none w-auto">Zip Code</legend>
										<div class="input-group">
											<i class="fa fa2 fa-file"></i>
											<input type="text" class="form-control border-0" placeholder="Zip Code*" required>
										</div>
									</fieldset>
								</div>
								<div class="col-md-4">
									<fieldset class="border">
										<legend  class="legend-inner float-none w-auto">Spouse Name</legend>
										<div class="input-group">
											<input type="text" class="form-control border-0" placeholder="Spouse Name*" required>
										</div>
									</fieldset>
								</div>
							</div>
						</fieldset>
						<fieldset class="border-2">
							<legend  class="legend-outer  float-none w-auto"> Children Details </legend>

							<div class="row">	
								<div class="customer_records m-0 p-0">
									<div class="row m-0 p-0">
										<div class="col-md-4">	
											<fieldset class="border">
												<legend  class="legend-inner float-none w-auto">Name</legend>
												<div class="input-group">
													<i class="fa fa2 fa-user"></i>
													<input type="text" class="form-control border-0" placeholder="Name*" required>
												</div>
											</fieldset>
										</div>
										<div class="col-md-3">	
											<fieldset class="border">
												<legend  class="legend-inner float-none w-auto">Nakshatram</legend>
												<div class="input-group">
													<input type="text" class="form-control border-0" placeholder="Nakshatram*" required>
												</div>
											</fieldset>
										</div>
										<div class="col-md-4">	
											<fieldset class="border">
												<legend  class="legend-inner float-none w-auto">Date of Birth</legend>
												<div class="input-group">
													<input type="date" class="form-control border-0" placeholder="Date of Birth*" required>
												</div>
											</fieldset>
										</div>
										<div class="col-md-1 addremovebtn mt-3">	
											<a class="extra-fields-customer btn btn-warning" style="background-color:#096a78;color:white;padding: 7px 27px;" href="javascript:void(0)"><i class="fa fa2 fa-plus"></i></a>
										</div>
									</div>
								</div>

								<div class="customer_records_dynamic m-0 p-0"></div>
							</div>
						</fieldset>

						<div class="submit-button-wrapper my-4">
							<input type="submit" value="SUBMIT">
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="mt-3" style="padding: 40px 0px;background-image: url('<?=base_url('assets/img/botdownloader.com-1686119799.482487.jpg');?>'); background-size: 25%; background-repeat: repeat-x;"></div>
	</section>
	<!-- End Coming Soon -->


</main><!-- End #main -->
<script type="text/javascript">
	$('.extra-fields-customer').click(function() {


		$('.customer_records').clone().appendTo('.customer_records_dynamic');
		$('.customer_records_dynamic .customer_records').addClass('single remove');
		$('.single .extra-fields-customer').remove();

		$('.single  .addremovebtn').append('<a href="#" class="remove-field btn-remove-customer btn btn-danger" style="background-color:#780914;color:white;padding: 7px 27px;"><i class="fa fa2 fa-trash"></i></a>');
		$('.customer_records_dynamic > .single').attr("class", "remove");

		$('.customer_records_dynamic input').each(function() {
			var count = 0;
			var fieldname = $(this).attr("name");
			$(this).attr('name', fieldname + count);
			count++;
		});

	});

	$(document).on('click', '.remove-field', function(e) {
		$(this).parent().parent().remove();
		e.preventDefault();
	});
</script>
<script type="text/javascript">
	$(document).ready(function() {
		window.scrollTo({ top: 250, behavior: 'smooth'});
	});
</script>

<?php $this->load->view('includes/footer') ?>
<?php $this->load->view('includes/script') ?>
