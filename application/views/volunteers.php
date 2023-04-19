<?php $this->load->view('includes/head') ?>
<?php $this->load->view('includes/topbar') ?>
<?php $this->load->view('includes/header') ?>
<style type="text/css">

</style>
<main id="main">

	<!-- ======= Coming Soon ======= -->
	<section style="background-color:var(--page-wrapper-bg-color)!important">
		<div class="container" >
			<center> <h2 class="bottomborder" style="font-weight:bold!important;font-size: 35px!important;">Volunteers Registration Form</h2> </center><br>
			<div class="row mb-3">
				<div class="col-md-10 mx-auto d-block">
					<?php if ($this->session->flashdata('failure')) {
						echo $this->session->flashdata('failure');
					}
					if ($this->session->flashdata('success')) {
						echo $this->session->flashdata('success');
					}
					?>
					<form action="<?=base_url('Forms/AddVolunteers')?>" class="contact-form shadow-lg" method="post">
						<div class="row">
							<div class="col-md-6">
								<fieldset class="border">
									<legend  class="legend-inner float-none w-auto">Name</legend>
									<div class="input-group">
										<i class="fa fa2 fa-user"></i>
										<input type="text" class="form-control border-0" name="vol_name" id="name" placeholder="Name*" required>
									</div>
								</fieldset>
							</div>
							<div class="col-md-6">
								<fieldset class="border">
									<legend  class="legend-inner float-none w-auto">Contact Number</legend>
									<div class="input-group">
										<i class="fa fa2 fa-phone"></i>
										<input type="text" class="form-control border-0" name="vol_phone" id="ConatctNumber" placeholder="Contact Number*" required>
									</div>
								</fieldset>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<fieldset class="border">
									<legend  class="legend-inner float-none w-auto">Email</legend>
									<div class="input-group">
										<i class="fa fa2 fa-envelope"></i>
										<input type="email" class="form-control border-0" name="vol_email" placeholder="Email*" required>
									</div>
								</fieldset>
							</div>
							<div class="col-md-6">
								<fieldset class="border">
									<legend  class="legend-inner float-none w-auto">City</legend>
									<div class="input-group">
										<input type="text" class="form-control border-0" name="vol_city" placeholder="City*" required>
									</div>
								</fieldset>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<fieldset class="border">
									<legend  class="legend-inner float-none w-auto">State</legend>
									<div class="input-group">
										<input type="text" class="form-control border-0" name="vol_state" placeholder="State*" required>
									</div>
								</fieldset>
							</div>
							<div class="col-md-6">
								<fieldset class="border">
									<legend  class="legend-inner float-none w-auto">Country</legend>
									<div class="input-group">
										<input type="text" class="form-control border-0" name="vol_country" placeholder="Country*" required>
									</div>
								</fieldset>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<fieldset class="border">
									<legend  class="legend-inner float-none w-auto">Zipcode</legend>
									<div class="input-group">
										<i class="fa fa2 fa-file"></i>
										<input type="text" class="form-control border-0" name="vol_zipcode" placeholder="Zipcode">
									</div>
								</fieldset>
							</div>
							<div class="col-md-6">
								<fieldset class="border">
									<legend  class="legend-inner float-none w-auto">Volunteer Area</legend>
									<div class="input-group">
										<select name="VolunteerArea" id="VolunteerArea" class="form-control border-0 form-select" required>
											<option value="" selected disabled>Volunteer Area</option>
											<option value="Publicity/Advertising">Publicity/Advertising</option>
											<option value="Fund Raising">Fund Raising</option>
											<option value="Food">Food</option>
											<option value="Handling">Handling</option>
											<option value="Any">Any</option>
										</select>
									</div>
								</fieldset>
							</div>
						</div>


						<div class="row">
							<div class="col-md-12">
								<fieldset class="border">
									<legend  class="legend-inner float-none w-auto">Address</legend>
									<div class="input-group">
										<textarea id="address" name="vol_address" class="form-control border-0" rows="5" cols="30" placeholder="Address*" required></textarea>
									</div>
								</fieldset>
							</div>
						</div>
						<div class="submit-button-wrapper">
							<input type="submit" value="SUBMIT">
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
	<!-- End Coming Soon -->
</main><!-- End #main -->
<script type="text/javascript">


	function phone_formatting(ele,restore) {
		var new_number,
		selection_start = ele.selectionStart,
		selection_end = ele.selectionEnd,
		number = ele.value.replace(/\D/g,'');

  // automatically add dashes
		if (number.length > 2) {
    // matches: 123 || 123-4 || 123-45
			new_number = number.substring(0,3) + '-';
			if (number.length === 4 || number.length === 5) {
      // matches: 123-4 || 123-45
				new_number += number.substr(3);
			}
			else if (number.length > 5) {
      // matches: 123-456 || 123-456-7 || 123-456-789
				new_number += number.substring(3,6) + '-';
			}
			if (number.length > 6) {
      // matches: 123-456-7 || 123-456-789 || 123-456-7890
				new_number += number.substring(6);
			}
		}
		else {
			new_number = number;
		}


		ele.value =  (new_number.length > 12) ? new_number.substring(12,0) : new_number;

		document.getElementById('msg').innerHTML='<p>Selection is: ' + selection_end + ' and length is: ' + new_number.length + '</p>';

		if (new_number.slice(-1) === '-' && restore === false
			&& (new_number.length === 8 && selection_end === 7)
			|| (new_number.length === 4 && selection_end === 3)) {
			selection_start = new_number.length;
		selection_end = new_number.length;
	}
	else if (restore === 'revert') {
		selection_start--;
		selection_end--;
	}
	ele.setSelectionRange(selection_start, selection_end);

}

function phone_number_check(field,e) {
	var key_code = e.keyCode,
	key_string = String.fromCharCode(key_code),
	press_delete = false,
	dash_key = 189,
	delete_key = [8,46],
	direction_key = [33,34,35,36,37,38,39,40],
	selection_end = field.selectionEnd;

  // delete key was pressed
	if (delete_key.indexOf(key_code) > -1) {
		press_delete = true;
	}

  // only force formatting is a number or delete key was pressed
	if (key_string.match(/^\d+$/) || press_delete) {
		phone_formatting(field,press_delete);
	}
  // do nothing for direction keys, keep their default actions
	else if(direction_key.indexOf(key_code) > -1) {
    // do nothing
	}
	else if(dash_key === key_code) {
		if (selection_end === field.value.length) {
			field.value = field.value.slice(0,-1)
		}
		else {
			field.value = field.value.substring(0,(selection_end - 1)) + field.value.substr(selection_end)
			field.selectionEnd = selection_end - 1;
		}
	}
  // all other non numerical key presses, remove their value
	else {
		e.preventDefault();
//    field.value = field.value.replace(/[^0-9\-]/g,'')
		phone_formatting(field,'revert');
	}

}

document.getElementById('ConatctNumber').onkeyup = function(e) {
	phone_number_check(this,e);
}


$(document).ready(function() {
	window.scrollTo({ top: 250, behavior: 'smooth'});
});
</script>

<?php $this->load->view('includes/footer') ?>
<?php $this->load->view('includes/script') ?>
