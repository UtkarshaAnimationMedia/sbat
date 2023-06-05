<?php $this->load->view('includes/head') ?>
<?php $this->load->view('includes/topbar') ?>
<?php $this->load->view('includes/header') ?>
<style type="text/css">
	.fa2{
		margin-top: 7px;

	}
	.fa{
		padding-top: 3px;
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
<main id="main"  style="background-color: var(--page-wrapper-bg-color);" class="pt-4">
	<section class="">
		<div class="container my-0">
			<!--Section heading-->

			<div class="row m-0 px-2 py-4">
				<!--Grid column-->
				<div class="col-md-12 p-0 mx-auto">
					<h2 id="temple-services" class="text-center bottomborder">	Enter Your Event Details</h2>


					<?= form_open('admin/update/profile', ' method="post" id="UpdateProfileForm"') ?>


					<fieldset class="border-2 bg-white">
						<legend  class="legend-outer  float-none w-auto"> Devotee Details </legend>

						<div class="row">
							<div class="col-md-6">
								<fieldset class="border">
									<legend  class="legend-inner float-none w-auto">First Name</legend>
									<!-- <div class="input-group"></div> -->

									<div class="input-group">
										<i class="fa fa-user"></i>
										<input type="text" class="form-control" id="fname" name="fname" placeholder="First Name*" required aria-label="fname" aria-describedby="basic-addon1">
									</div>
								</fieldset>
							</div>
							<div class="col-md-6">
								<fieldset class="border">
									<legend  class="legend-inner float-none w-auto">Last Name</legend>
									<div class="input-group">
										<i class="fa fa-user"></i>
										<input type="text" class="form-control" id="lname" name="lname" value="" placeholder="Last Name" aria-label="lname" required aria-describedby="basic-addon1">
									</div>
								</fieldset>

							</div>

							<div class="col-md-6">
								<fieldset class="border">
									<legend  class="legend-inner float-none w-auto">Phone Number</legend>
									<div class="input-group">
										<i class="fa fa-phone"></i>
										<input type="text" class="form-control phone" id="phoneNumber" name="phoneNumber" placeholder="Phone Number" aria-label="phoneNumber">
									</div>
								</fieldset>

							</div>
							<div class="col-md-6">
								<fieldset class="border">
									<legend  class="legend-inner float-none w-auto">Email Id</legend>
									<div class="input-group">
										<i class="fa fa-envelope"></i>
										<input type="email" class="form-control" id="emailId" name="emailId" value="" placeholder="Email Id" aria-label="emailId" aria-describedby="basic-addon1">
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
										<input type="text" class="form-control" id="eventName" name="eventName" placeholder="Event Name" aria-label="eventName">
									</div>
								</fieldset>
							</div>

							<div class="col-md-6">
								<fieldset class="border">
									<legend  class="legend-inner float-none w-auto">Event Date</legend>
									<div class="input-group">
										<i class="fa fa-clock-o"></i>
										<input type="text" class="form-control event-datepicker" id="eventDate" name="eventDate" placeholder="Event Date" aria-label="eventDate">
									</div>
								</fieldset>
							</div>
						</div>



						<div class="row">
							<div class="col-md-6">
								<fieldset class="border">
									<legend  class="legend-inner float-none w-auto">Event Time</legend>
									<div class="input-group">
										<i class="fa fa-envelope"></i>
										<input type="text" class="form-control event-timepicker" id="eventTime" name="eventTime" placeholder="Event Time" readonly  aria-label="eventTime">
									</div>
								</fieldset>
							</div>
							<div class="col-md-6">
								<fieldset class="border">
									<legend  class="legend-inner float-none w-auto">Preferred Language</legend>
									<div class="input-group">
										<select class="form-select form-control border-dark mb-1" style="color:black!important;" name="preferredLanguage" id="preferredLanguage"   required>
											<option value=" " selected disabled>Choose Preferred Language</option>
											<option value="HINDI">HINDI</option>
											<option value="ENGLISH">ENGLISH</option>
											<option value="TAMIL">TAMIL</option>
											<option value="TELUGU">TELUGU</option>
										</select>
									</div>
								</fieldset>
							</div>

							<div class="col-md-6">
								<fieldset class="border">
									<legend  class="legend-inner float-none w-auto">Adult(s)</legend>
									<div class="input-group">
										<input type="number" class="form-control" id="adults" name="adults" placeholder="No of Adults"  aria-label="adults">
									</div>
								</fieldset>

							</div>
							<div class="col-md-6">
								<fieldset class="border">
									<legend  class="legend-inner float-none w-auto">Children</legend>
									<div class="input-group">
										<input type="number" class="form-control" id="children" name="children" placeholder="No of Children"  aria-label="children">
									</div>
								</fieldset>
							</div>

							<div class="col-md-6">
								<fieldset class="border">
									<legend  class="legend-inner float-none w-auto">Street Address</legend>
									<div class="input-group">
										<input type="text" class="form-control datepicker" id="address" name="address" placeholder="Street Address"  aria-label="address">
									</div>
								</fieldset>
							</div>

							<div class="col-md-6">
								<fieldset class="border">
									<legend  class="legend-inner float-none w-auto">State</legend>
									<div class="input-group">
										<select class="form-control" name="state" id="stateSelect">
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
										<select class="form-control" name="city" id="city" >
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
										<input type="number" class="form-control" onKeyPress="if(this.value.length==6) return false;" name="zipcode" id="zipcode" value="<?= set_value('zipcode', @$userDetails->zip)?>" placeholder="Zip Code"  aria-label="zipcode" aria-describedby="basic-addon1">
									</div>
								</fieldset>
							</div>
						</div>

					</fieldset>

				</form>


			</div>
		</div>
	</div>

</section>
</main>
<?php $this->load->view('includes/footer.php') ?>
<?php $this->load->view('includes/script.php') ?>
<script type="text/javascript">
	$(document).ready(function() {

    // TimePicker
    $('.event-timepicker').mdtimepicker();
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

	$(document).ready(function(){
		$('#stateSelect').change();
		setTimeout(function(){
			$("select[name='city'] option[value='<?= @$userDetails->cityTypes; ?>']").attr('selected', 'selected');
		}, 1500);


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
</script>