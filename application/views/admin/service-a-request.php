
<?php $this->load->view('admin/includes/head'); ?>
<?php $this->load->view('admin/includes/sidebar'); ?>
<?php $this->load->view('admin/includes/topbar'); ?>

<?php 
$parts = explode(" ", @$userDetails->refDataName);
$lastname = array_pop($parts);
$firstname = implode(" ", $parts);
?>
<!-- ======= Service Request ======= -->
<div class="container">
	<div class="row p-4 ">


		<div class="col-md-12 mx-auto d-block card shadow-lg p-5 my-2">
			<?php echo $this->session->flashdata('success'); ?>
			<?= form_open(base_url('admin/service-request'),'method="post" id="serviceRequestForm"'); ?>

			<fieldset class="border-2">
				<legend  class="legend-outer  float-none w-auto"> Request A Service </legend>

				<div class="row">
					<div class="col-md-6">
						<fieldset class="border">
							<legend  class="legend-inner float-none w-auto required">First Name*</legend>
							<div class="input-group">
								<i class="fa fa-user fa2"></i>
								<input type="text" class="form-control border-dark mb-1 " style="color:black!important;" name="fname" id="fname" placeholder="First Name*" value="<?=set_value('fname', @$firstname)?>"  required readonly>
							</div>
						</fieldset>
					</div>
					<div class="col-md-6">
						<fieldset class="border">
							<legend  class="legend-inner float-none w-auto required">Last Name*</legend>
							<div class="input-group">
								<i class="fa fa-user fa2"></i>
								<input type="text" class="form-control border-dark mb-1 " name="lname" id="lname" placeholder="Last Name" value="<?=set_value('lname', @$lastname)?>"required readonly>
							</div>
						</fieldset>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<fieldset class="border">
							<legend  class="legend-inner float-none w-auto required">Email*</legend>
							<div class="input-group">
								<i class="fa fa-envelope fa2"></i>
								<input type="email" class="form-control border-dark mb-1 " style="color:black!important;" id="email" name="email" placeholder="Email ID*" value="<?=set_value('email', base64_decode(@$userDetails->email))?>" readonly required>
							</div>
						</fieldset>
					</div>
					<div class="col-md-6">
						<fieldset class="border">
							<legend  class="legend-inner float-none w-auto required">Phone*</legend>
							<div class="input-group">
								<i class="fa fa-phone fa2"></i>
								<input type="text" class="form-control border-dark mb-1 " name="phoneNumber" placeholder="Phone Number*" value="<?=set_value('phoneNumber', formatPhoneNumber(base64_decode(@$userDetails->phone)))?>" style="color:black!important;" readonly required>
							</div>
						</fieldset>
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<fieldset class="border">
							<legend  class="legend-inner float-none w-auto required">Street Address*</legend>
							<div class="input-group">
								<i class="fa fa-map-marker fa2"></i>
								<input type="text" class="form-control border-dark mb-1 " name="streetAddress" id="streetAddress" placeholder="Streat Address*" value="<?=set_value('streetAddress', @$userDetails->address)?>" style="color:black!important;"  required>
							</div>
						</fieldset>
					</div>
				</div>

				<div class="row">

					<div class="col-md-4">
						<fieldset class="border">
							<legend  class="legend-inner float-none w-auto required">State*</legend>
							<div class="input-group">

								<select class="form-select form-control border-dark mb-1 mb-1" name="state" id="stateSelect" style="color:black!important;"   required>
									<option value=" " selected disabled>Select State</option>
									<?php foreach ($GetState as $state) { ?>
										<option value="<?=@$state->refDataName?>" <?= @$state->refDataName == @$userDetails->stateTypes ? 'selected' : ''; ?>><?=@$state->refDataName?></option>
									<?php } ?>
								</select>
							</div>
						</fieldset>
					</div>
					<div class="col-md-4">
						<fieldset class="border">
							<legend  class="legend-inner float-none w-auto required">City*</legend>
							<div class="input-group">
								<select class="form-select form-control border-dark mb-1" style="color:black!important;" name="city" id="city"   required>
									<option value=" " selected disabled>Select City</option>
								</select>
							</div>
						</fieldset>
					</div>

					<div class="col-md-4">
						<fieldset class="border">
							<legend  class="legend-inner float-none w-auto required">Zip Code*</legend>
							<div class="input-group">
								<i class="fa fa-file fa2"></i>
								<input type="text" class="form-control border-dark mb-1 " style="color:black!important;"name="zipcode" id="zipcode" placeholder="Zip Code*" value="<?=set_value('zipcode', @$userDetails->zip)?>"  required>
							</div>
						</fieldset>
					</div>
				</div>

				<div class="row">

					<div class="col-md-6">
						<fieldset class="border">
							<legend  class="legend-inner float-none w-auto required">Preferred Location*</legend>
							<div class="input-group">
								<select name="preferredLocation" id="preferredLocation" style="color:black!important;" class="form-control rounded  form-select" required>
									<option value=" " selected disabled style="color:black!important;">Preferred Location</option>
									<?php 
									foreach ($preferredLocations as $item) { ?>
										<option value="<?=@$item->refDataName?>"><?=@$item->refDataName;?></option>
									<?php } ?>
								</select>
							</div>
						</fieldset>
					</div>
					<div class="col-md-6">
						<fieldset class="border">
							<legend  class="legend-inner float-none w-auto required">Service*</legend>
							<div class="input-group">
								<select name="serviceName" id="serviceName" style="color:black!important;" class="form-control rounded  form-select" required>
									<option value=" " selected disabled>Select Service</option>
								</select>
								<input type="hidden" id="serviceType" name="serviceType">
								<input type="hidden" id="serviceAmount" name="serviceAmount">
								<input type="hidden" name="serviceId" id="serviceId">
							</div>
						</fieldset>
					</div>
				</div>
				<div class="row">


					<div class="col-md-4">	
						<fieldset class="border">
							<legend  class="legend-inner float-none w-auto required">Preferred Language*</legend>
							<div class="input-group">
								<select name="preferredLanguage" id="preferredLanguage" style="color:black!important;" class="form-control rounded  form-select" required>
									<option value=" " selected disabled>Select Preferred Language</option>
									<?php foreach ($preferredLanguage as $item) { ?>
										<option value="<?=@$item->refDataName?>"><?=@$item->refDataName?></option>
									<?php } ?>
								</select>
							</div>
						</fieldset>
					</div>


					<div class="col-md-4">
						<fieldset class="border">
							<legend  class="legend-inner float-none w-auto required">Service Date*</legend>
							<div class="input-group">
								<i class="fa fa-calendar fa2"></i>
								<input placeholder="MM/DD/YYYY"  class="form-control rounded " id="serviceDate"  name="serviceDate" type="text" readonly required>
							</div>
						</fieldset>	
					</div>
					<div class="col-md-4">
						<fieldset class="border">
							<legend  class="legend-inner float-none w-auto required">Service Time*</legend>
							<div class="input-group">
								<i class="fa fa-clock-o fa2"></i>

								<input type='text'  class='form-control' name="serviceTime" id="serviceTime" placeholder='00:00' required>

							</div>
						</fieldset>

					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<fieldset class="border" id="awayTempleAddressBox">
							<legend  class="legend-inner float-none w-auto required">Full Address*</legend>
							<div class="input-group">
								<i class="fa fa-location fa2"></i>
								<input type="text" class="form-control rounded " name="awayTempleAddress" id="awayTempleAddress" placeholder="Please enter your address*" required>
							</div>
						</fieldset>
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">	
						<fieldset class="border">
							<legend  class="legend-inner float-none w-auto required">Priests*</legend>
							<div class="input-group">
								<select name="priestName" id="priestName" style="color:black!important;" class="form-control rounded  form-select" required>
									<?php 

									if ($PriestData != "") {?>

										<option value=" " selected disabled>Select Preferred Priest</option>
										<?php foreach ($PriestData as $item) { ?>
											<option value="<?=@$item->refDataName?>" email="<?=base64_decode(@$item->email)?>" phone="<?=base64_decode(@$item->phone)?>"><?=@$item->refDataName?></option>
										<?php }}else{ ?>
											<option value=" " selected disabled>Priest Not Available.</option>
										<?php	} ?>
									</select>
									<input type="hidden" name="" id="priestPhone">
									<input type="hidden" name="priestEmail" id="priestEmail">
								</div>

							</fieldset>
						</div>
						<div class="col-md-4">	
							<fieldset class="border">
								<legend  class="legend-inner float-none w-auto">No. of Adults</legend>
								<div class="input-group">
									<input name="adults" type="number" class="form-control border-dark mb-1 " placeholder="Adult(s)">
								</div>
							</fieldset>
						</div>
						<div class="col-md-4">	
							<fieldset class="border">
								<legend  class="legend-inner float-none w-auto">No. of Children</legend>
								<div class="input-group">
									<input name="children" type="number"  class="form-control border-dark mb-1 " placeholder="Children">

								</div>
							</fieldset>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<fieldset class="border">
								<legend  class="legend-inner float-none w-auto">Additional Info</legend>
								<div class="input-group">
									<textarea type="textarea" name="addtionalInfo" class="form-control border-dark mb-1 rounded form-text-area" placeholder="Please provide any additional service request information here."></textarea>
								</div>
							</fieldset>
						</div>
					</div>
				</fieldset>
			</form>
		</div>

	</div>
</div>
</div>
<!-- End Service Request -->

<?php $this->load->view('admin/includes/footer'); ?>

<script type="text/javascript" src="<?=base_url('assets/js/time-picker.js')?>"></script>
<script src="<?=base_url('assets/js/jquery-ui.min.js');?>"></script>

<script type="text/javascript">




	$('#serviceRequestForm').keypress(function (e) {
		if (e.which == 13) {
			$('#serviceRequestBtn').click();
			return false;
		}
	});

	$(function(){

		$("#awayTempleAddressBox").hide();
		$otherField = $("#awayTempleAddressBox");
		$otherFieldval = $("#awayTempleAddress");
		$('#preferredLocation').on('change', function() {
					// alert();
			if(this.value === 'AWAY-TEMPLE') {



				$otherFieldval.val("");
				$otherField.show();
			} else {
				$otherField.hide();
				$otherFieldval.val(this.value);
			}

		});


		$('#serviceTime').mdtimepicker();

		$("#heading").text('Request A Service');
	});




	function checkValue(str, max) {
		if (str.charAt(0) !== '0' || str == '00') {
			var num = parseInt(str);
			if (isNaN(num) || num <= 0 || num > max) num = 1;
			str = num > parseInt(max.toString().charAt(0)) && num.toString().length == 1 ? '0' + num : num.toString();
		};
		return str;
	};

	$('#priestName').change(function(){

		var priestEmail = $(this).children(":selected").attr("email");
		var priestPhone = $(this).children(":selected").attr("phone");

			// alert(priestPhone);
			// alert(priestEmail);

		$("#priestEmail").val(priestEmail);
		$("#priestPhone").val(priestPhone);

	});


	$('#stateSelect').change(function(){

		var stateCode = $(this).val();
		$.ajax({
			url:"<?= base_url('admin/getCityByState') ?>",
			type: "POST",
					// dataType: "json",
			data : {'stateCode':stateCode},
			success: function(data) 
			{
				$("#city").html(data);
			}             
		});

	});


	$('#preferredLocation').change(function(){

		var param = $(this).val();

		if (param == 'AWAY TEMPLE') {
			param = 'AWAY-TEMPLE';
		}

		$.ajax({
			url: "<?=base_url('admin/GetServicesByCategory')?>",
			type: "POST",
			data : {'param' : param},
			success: function(data) 
			{

					// console.log(data);
				if (data == '') {
					$('#serviceName').html('<option value=" " disabled selected>No Service Available On This Location.</option>');
				}else{
					$('#serviceName').html(data);
				}


			}             
		});

	});



	$('#serviceName').change(function(){

		var serviceType = $('option:selected', this).attr('serviceType');

			// alert(serviceType);

		$("#serviceType").val(serviceType);





		var startDate = $('option:selected', this).attr('startDate');
		if (startDate != '') {

			$("#serviceDate").val(startDate);
			$("#serviceDate").attr('disabled', 'true');

		}


		var startTime = $('option:selected', this).attr('startTime');
		if (startTime != '') {
			$("#serviceTime").val(startTime);
			$("#serviceTime").attr('disabled', 'true');
		}

		var serviceId = $('option:selected', this).attr('serviceId');
		if (serviceId != '') {
			$("#serviceId").val(serviceId);
		}




	});

	$('#serviceName').change(function(){

		var serviceAmount = $('option:selected', this).attr('serviceAmount');


		var finalPrice = (serviceAmount / 1).toFixed(2);
			// alert(serviceAmount);

		$("#serviceAmount").val(finalPrice);

	});


	$(document).ready(function(){
		$('#stateSelect').change();


		setTimeout(function(){
			$("select[name='city'] option[value='<?= @$userDetails->cityTypes; ?>']").attr('selected', 'selected');
		}, 1500);




		$("#serviceRequestForm").validate({

			submitHandler: function(form) {
				form.submit();
			}

		});
	});

	$( "#serviceDate" ).datepicker({
		dateFormat: "mm/dd/yy",
		minDate: 0
	});




	function submitForm(){

		Swal.fire({
			title: 'Do you want to save the changes?',
			showDenyButton: false,
			showCancelButton: true,
			confirmButtonText: 'Save',
			denyButtonText: `Don't save`,
		}).then((result) => {

			if (result.isConfirmed) {

				$("#serviceRequestForm").submit();
			} else if (result.isDenied) {
				Swal.fire('Changes are not saved', '', 'info')
			}
		});
	}



	function closeForm() {

		Swal.fire({
			title: 'Do you want to cancel the changes?',
			showDenyButton: true,
			showCancelButton: true,
			showConfirmButton:false,
			cancelButtonText: 'No',
			denyButtonText: `Yes`,
		}).then((result) => {
  /* Read more about isConfirmed, isDenied below */
			if (result.isConfirmed) {
				Swal.fire('Saved!', '', 'success')
			} else if (result.isDenied) {

				window.location.href = "<?=base_url('admin/my-service-request')?>";
			}
		})
	}



</script>



</body>
</html>

