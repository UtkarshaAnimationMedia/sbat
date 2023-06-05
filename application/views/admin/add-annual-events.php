
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
			
			<?= form_open(base_url('Admin/Dashboard/AddAnnualEvent'),'method="post" id="addAnnualEvent"'); ?>

			<style type="text/css">
				.outer{
					padding-bottom: 19px!important;
				}
				fieldset {
					margin-bottom: 0px!important; 
				}
			</style>
			<fieldset class="border-2 outer">
				<legend  class="legend-outer  float-none w-auto"> Devotee Details </legend>

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
								<input type="text" class="form-control phone border-dark mb-1 " name="phoneNumber" id="phoneNumber" placeholder="Phone Number*" value="<?=set_value('phoneNumber', formatPhoneNumber(base64_decode(@$userDetails->phone)))?>" style="color:black!important;" readonly required>
							</div>
						</fieldset>
					</div>
				</div>

				
				
			</fieldset>


			<fieldset class="border-2 outer">
				<legend  class="legend-outer  float-none w-auto"> Register Event </legend>
				<div class="row">
					<div class="col-md-4">
						<fieldset class="border">
							<legend  class="legend-inner float-none w-auto required">Name*</legend>
							<div class="input-group">
								<i class="fa fa-user fa2"></i>
								<input type="text" class="form-control border-dark mb-1 " name="nameOfPerson" id="nameOfPerson" placeholder="Name of the Person*"  style="color:black!important;" required>
							</div>
						</fieldset>
						<label id="nameOfPerson-error" class="error" for="nameOfPerson" style=""></label>
					</div>

					<div class="col-md-4">
						<fieldset class="border">
							<legend  class="legend-inner float-none w-auto required">Date of Birth*</legend>
							<div class="input-group">
								<i class="fa fa-calendar fa2"></i>
								<input type="text" class="form-control border-dark mb-1 " name="dob" id="dob" placeholder="Person's Date of Birth*"  style="color:black!important;" required>
							</div>
						</fieldset>
						<label id="dob-error" class="error" for="dob" style=""></label>
					</div>



					<div class="col-md-4">
						<legend  class="legend-inner float-none w-auto">Send Email On</legend>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="checkbox" id="emailOnMember" name="emailOnMember">
							<label class="form-check-label m-auto pt-1" for="emailOnMember"> &nbsp;&nbsp;&nbsp;On Person's Email</label>
						</div>
					</div>
					<div class="col-md-4 memEmail" style="display: none;">
						<fieldset class="border">
							<legend  class="legend-inner float-none w-auto required">Person's Email*</legend>
							<div class="input-group">
								<i class="fa fa-envelope fa2"></i>
								<input type="email" class="form-control border-dark mb-1 " name="emailOnMember" id="emailOnMember" placeholder="Person's Email*"  style="color:black!important;" required>
							</div>
						</fieldset>
						<label id="emailOnMember-error" class="error" for="emailOnMember" style=""></label>
					</div>

					<script type="text/javascript">
						$(document).ready(function() {
							$('#emailOnMember').on('change', function() {
								if ($(this).is(':checked')) {
									$('.memEmail').show(); 
								} else {
									$('.memEmail').hide(); 
								}
							});
						});

					</script>
					<div class="col-md-4">
						<fieldset class="border">
							<legend  class="legend-inner float-none w-auto required">Relationship*</legend>
							<div class="input-group">
								<select class="form-select form-control border-dark mb-1" style="color:black!important;" name="Relationship" id="Relationship"   required>
									<option value=" " selected disabled>Choose Relationship</option>
									<option value="SON">SON</option>
									<option value="DAUGHTER">DAUGHTER</option>
									<option value="BROTHER">BROTHER</option>
									<option value="SPOUSE">SPOUSE</option>
									<option value="FATHER">FATHER</option>
									<option value="MOTHER">MOTHER</option>
									<option value="GRAND FATHER">GRAND FATHER</option>
									<option value="GRAND MOTHER">GRAND MOTHER</option>
									<option value="FATHER-IN-LAW">FATHER IN LAW</option>
									<option value="MOTHER-IN-LAW">MOTHER IN LAW</option>
								</select>
							</div>
						</fieldset>
						<label id="Relationship-error" class="error" for="Relationship" style=""></label>
					</div>

					<div class="col-md-4">
						<fieldset class="border">
							<legend  class="legend-inner float-none w-auto required">Event Type*</legend>
							<div class="input-group">
								<select class="form-select form-control border-dark mb-1 mb-1" name="eventType" id="eventType" style="color:black!important;"   required>
									<option value=" " selected disabled>Select Event Type</option>
									<?php foreach ($Events as $item) { ?>
										<option value="<?=@$item->refDataName?>"><?=@$item->refDataName?></option>
									<?php } ?>
								</select>
							</div>
						</fieldset>
						<label id="eventType-error" class="error" for="eventType" style=""></label>
					</div>

					<div class="col-md-4">
						<fieldset class="border">
							<legend  class="legend-inner float-none w-auto required">Event Date Occured*</legend>
							<div class="input-group">
								<i class="fa fa-calendar fa2"></i>
								<input type="text" class="form-control border-dark mb-1 " name="eventDate" id="eventDate" placeholder="Event Date*"  style="color:black!important;" required>
							</div>
						</fieldset>
						<label id="eventDate-error" class="error" for="eventDate" style=""></label>
					</div>
					

					<div class="col-md-4">
						<fieldset class="border">
							<legend  class="legend-inner float-none w-auto required">Event Time Occured*</legend>
							<div class="input-group">
								<i class="fa fa-clock-o fa2"></i>
								<input type="text" class="form-control border-dark mb-1 " name="eventTime" id="eventTime" placeholder="Event Time*"  style="color:black!important;" required>
							</div>
						</fieldset>
						<label id="eventTime-error" class="error" for="eventTime" style=""></label>
					</div>

					<div class="col-md-4">
						<fieldset class="border">
							<legend  class="legend-inner float-none w-auto required">Event Location*</legend>
							<div class="input-group">
								<i class="fa fa-map-marker fa2"></i>
								<input type="text" class="form-control border-dark mb-1 " name="eventLocation" id="eventLocation" placeholder="Event Location*" style="color:black!important;"  required>
							</div>
						</fieldset>
						<label id="eventLocation-error" class="error" for="eventLocation" style=""></label>
					</div>


					<input type="hidden" class="form-control border-dark mb-1 " name="latitude" id="latitude" placeholder="Latitude*" style="color:black!important;"  required>

					<input type="hidden" class="form-control border-dark mb-1 " name="longitude" id="longitude" placeholder="Longitude*" style="color:black!important;"  required>
					

					

					<div class="col-md-4">
						<fieldset class="border">
							<legend  class="legend-inner float-none w-auto required">Gotra</legend>
							<div class="input-group">
								<input type="text" class="form-control border-dark mb-1 " style="color:black!important;" name="eventGotra" id="eventGotra" value="<?=set_value('eventGotra'); ?>" placeholder="Gotra*"   required>
							</div>
						</fieldset>
						<label id="eventGotra-error" class="error" for="eventGotra" style=""></label>
					</div>

					<div class="col-md-4">
						<fieldset class="border">
							<legend  class="legend-inner float-none w-auto required">Nakshtra</legend>
							<div class="input-group">
								<input type="text" class="form-control border-dark mb-1 " name="eventNakshtra" id="eventNakshtra" placeholder="Nakshtra*" value="<?=set_value('eventNakshtra'); ?>" required >
							</div>
						</fieldset>
						<label id="eventNakshtra-error" class="error" for="eventNakshtra" style=""></label>
					</div>

					<div class="col-md-4">
						<fieldset class="border">
							<legend  class="legend-inner float-none w-auto required">Rashi</legend>
							<div class="input-group">
								<input type="text" class="form-control border-dark mb-1 " name="eventRashi" id="eventRashi" placeholder="Rashi*" value="<?=set_value('eventRashi'); ?>" required >
							</div>
						</fieldset>
						<label id="eventRashi-error" class="error" for="eventRashi" style=""></label>
					</div>


					<div class="col-md-4">
						<fieldset class="border">
							<legend  class="legend-inner float-none w-auto required">Tithi*</legend>
							<div class="input-group">
								<input type="text" class="form-control border-dark mb-1 " style="color:black!important;" name="eventTithi" id="eventTithi" value="<?=set_value('eventTithi'); ?>" placeholder="Tithi"   required>
							</div>
						</fieldset>
						<label id="eventTithi-error" class="error" for="eventTithi" style=""></label>
					</div>

					<div class="col-md-4">
						<fieldset class="border">
							<legend  class="legend-inner float-none w-auto required">Reminder Type*</legend>
							<div class="input-group">
								<select class="form-select form-control border-dark mb-1" style="color:black!important;" name="reminderType" id="reminderType"   required>
									<option value=" " selected disabled>Choose Reminder Type</option>
									<option value="DAILY" >DAILY</option>
									<option value="WEEKLY" >WEEKLY</option>
									<option value="MONTHLY" >MONTHLY</option>
									<option value="YEARLY" >YEARLY</option>
								</select>
							</div>
						</fieldset>
						<label id="reminderType-error" class="error" for="reminderType" style=""></label>
					</div>


					<div class="col-md-4">
						<fieldset class="border">
							<legend  class="legend-inner float-none w-auto required">Start Date*</legend>
							<div class="input-group">
								<i class="fa fa-calendar fa2"></i>
								<input type="text" class="form-control border-dark mb-1 " name="startDate" id="startDate" placeholder="Start Date*"  required >
							</div>
						</fieldset>
						<label id="startDate-error" class="error" for="startDate" style=""></label>
					</div>
					<div class="col-md-4">
						<fieldset class="border">
							<legend  class="legend-inner float-none w-auto">End Date</legend>
							<div class="input-group">
								<i class="fa fa-calendar fa2"></i>
								<input type="text" class="form-control border-dark mb-1 " style="color:black!important;" name="endDate" id="endDate"  placeholder="End Date*">
							</div>
						</fieldset>
						<label id="endDate-error" class="error" for="endDate" style=""></label>
					</div>

					<div class="col-md-4">
						<legend  class="legend-inner float-none w-auto">Reminder Preference</legend>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="checkbox" id="isTithiReminder" name="isTithiReminder">
							<label class="form-check-label m-auto pt-1" for="isTithiReminder"> &nbsp;&nbsp;&nbsp;Tithi</label>
						</div>
						<div class="form-check form-check-inline mx-4">
							<input class="form-check-input" type="checkbox" id="isEmailReminder" name="isEmailReminder">
							<label class="form-check-label m-auto pt-1" for="isEmailReminder"> &nbsp;&nbsp;&nbsp;Email</label>
						</div>
						<div class="form-check form-check-inline mx-4">
							<input class="form-check-input" type="checkbox" id="isSmsReminder" name="isSmsReminder">
							<label class="form-check-label m-auto pt-1" for="isSmsReminder"> &nbsp;&nbsp;&nbsp;SMS</label>
						</div>
					</div>

					<div class="col-md-4">
						<fieldset class="border">
							<legend  class="legend-inner float-none w-auto required">Before Day Reminder*</legend>
							<div class="input-group">
								<input type="number" class="form-control border-dark mb-1" max="31" min="1" name="beforeDayReminder" id="beforeDayReminder" placeholder="Enter Number of Days*"  required >
							</div>
						</fieldset>
						<label id="beforeDayReminder-error" class="error" for="beforeDayReminder" style=""></label>
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDL6vmveLaK3zRSY3cFAk2qFyLoOs_o9D4&amp;libraries=places&amp;callback=initPlaces" async="" defer=""></script>
<script type="text/javascript">

	$(document).ready(function() {
		$('#beforeDayReminder').on('input', function() {
			var value = parseInt($(this).val());
			if (isNaN(value) || value <= 0 || value > 31) {
				$(this).val('');
			}
		});
	});


	$('#eventState').change(function(){

		var stateCode = $(this).val();

		$.ajax({
			url:"<?= base_url('admin/getCityByState') ?>",
			type: "POST",
					// dataType: "json",
			data : {'stateCode':stateCode},
			success: function(data) 
			{

				$("#eventCity").html(data);
			}             
		});

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


	$(document).ready(function(){

		$("#heading").text('Register Events');
		$('#eventState').change();
		setTimeout(function(){
			$("select[name='eventCity'] option[value='<?= @$userDetails->cityTypes; ?>']").attr('selected', 'selected');
		}, 1500);

		$('#timeofbirth').mdtimepicker();



		$("#addAnnualEvent").validate({

			submitHandler: function(form) {
				form.submit();
			}

		});

	});

	$( "#startDate, #endDate" ).datepicker({
		dateFormat: "mm/dd/yy",
		minDate: 0
	});

	$( "#dob" ).datepicker({
		dateFormat: "mm/dd/yy"
	});
	



	$(function() {
		$("#eventLocation").on("input", function(event) {
			const eventDate = $("#eventDate").val();
			const eventTime = $("#eventTime").val();
			if (eventDate === "" || eventTime === "") {
				event.preventDefault();
				$(this).val(""); 
				alert("Please fill out the event date and time fields first.");
			}
		});
	});

	function submitForm(){

		Swal.fire({
			title: 'Do you want to add this annual event?',
			showDenyButton: false,
			showCancelButton: true,
			confirmButtonText: 'Send',
			denyButtonText: `Cancel`,
		}).then((result) => {

			if (result.isConfirmed) {

				$("#addAnnualEvent").submit();
			} else if (result.isDenied) {
				Swal.fire('Changes are not saved', '', 'info')
			}
		});
	}



	let autocomplete;
	let placeSearch;
	let componentForm = {
		street_number: 'short_name',
		route: 'long_name',
		city: 'long_name',
		eventState: 'long_name',
		eventCountry: 'long_name',
		postal_code: 'short_name'
	};

	window.initPlaces = function() {
		if ( jQuery( '#eventLocation' ).length ) {
			autocomplete = new google.maps.places.Autocomplete(
				document.getElementById( 'eventLocation' ),
				{ types: [ 'geocode' ] }
				);
			autocomplete.addListener( 'place_changed', fillInAddress );
		}
	};




	$("#eventDate").datepicker({
		onSelect: function(dateText, instance) {

			if ($("#eventTime").val() !== "" &&  $("#eventLocation").val() !== "") {

				fillInAddress();

			}
		}
	});



	$('#eventTime').mdtimepicker().on('timechanged', function() {
		const eventDate = $("#eventDate").val();
		const eventLocation = $("#eventLocation").val();

		if (eventDate != "" && eventLocation != "") {
			fillInAddress();
		}

	});




	function fillInAddress() {

	  // Get the place details from the autocomplete object.
		let place = autocomplete.getPlace();
		var latitude=place.geometry.location.lat();
		var longitude=place.geometry.location.lng();



		$.ajax({
			url: "https://api.wheretheiss.at/v1/coordinates/"+latitude+","+longitude,
			//type: "POST",
			//dataType: "json",
			success: function(data) 
			{ 

				var tzone = data.offset;
				var eventDate = $("#eventDate").val();
				var dateObj = new Date(eventDate);
				var year = dateObj.getFullYear();
				var month = dateObj.getMonth() + 1;
				var day = dateObj.getDate();
				var timeString = $("#eventTime").val();
				var eventTime = timeString.slice(0, -3);
				var timeArray = eventTime.split(":");
				var hour = timeArray[0];
				var minute = timeArray[1];

				$.ajax({
					url: "<?=base_url('Admin/Dashboard/getTithi')?>",
					type: "POST",
					dataType: "json",
					data : {'latitude':latitude,'longitude':longitude,'tzone':tzone, 'year' : year, 'month': month, 'day' : day, 'hour' : hour, 'minute' : minute},
					success: function(data) 
					{
						$("#eventTithi").val(data.tithi);
						$("#eventNakshtra").val(data.nakshatra);
					}             
				});
			}             
		});
		





		$("#latitude").val(latitude);
		$("#longitude").val(longitude);

	  // Get each component of the address from the place details
	  // and fill the corresponding field on the form.
		// for ( let i = 0; i < place.address_components.length; i++ ) {
		// 	let addressType = place.address_components[i].types[0];
		// 	if ( componentForm[addressType]) {
		// 		let val = place.address_components[i][componentForm[addressType]];
		// 		document.getElementById( addressType ).value = val;
		// 	}
		// }

	}


	function geolocate() {
		if ( navigator.geolocation ) {
			navigator.geolocation.getCurrentPosition( function( position ) {
				var geolocation = {
					lat: position.coords.latitude,
					lng: position.coords.longitude
				};
				var circle = new google.maps.Circle({
					center: geolocation,
					radius: position.coords.accuracy
				});
				autocomplete.setBounds( circle.getBounds() );
			});
		}
	}

	jQuery( '#eventLocation' ).on( 'focus', function() {
		geolocate();
	});

</script>
</body>
</html>

