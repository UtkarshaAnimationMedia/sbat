<?php $this->load->view('managements/includes/head'); ?>
<?php $this->load->view('managements/includes/sidebar'); ?>
<?php $this->load->view('managements/includes/topbar'); ?>
<!-- Main content-->

<div class="container my-3">
	<div id="attendanceData">

	</div>
</div>
<!-- End Main content--> 
<?php $this->load->view('managements/includes/footer'); ?>


<script type="text/javascript" src="<?=base_url('assets/js/time-picker.js')?>"></script>
<script src="<?=base_url('assets/js/jquery-ui.min.js');?>"></script>

<script>

	$(document).ready(function() {





		<?php
		if (!empty($meetingData->data[0])) {

			$first_value = base64_encode($meetingData->data[0]->insertedId);
			$first_refDataName = $meetingData->data[0]->refDataName;

		} ?>




		<?php if (isset($first_value) && $first_value != '') {?>

			var id = '<?= $first_value; ?>';

			loader.on();

			$.ajax({
				url: '<?=base_url('Managements/Managements/FilterMeeting')?>',
				type: 'POST',
				data: {id : id},
				success: function(data) {


					$("#attendanceData").html(data);


					$('#TimeIn').mdtimepicker();
					var alertShown = false;
					$('#TimeOut').on('click', function() {
						var timeIn = $('#TimeIn').val();

						if (timeIn === '') {
							alert('Please add Time In first!');
						} else {
							$('#TimeOut').mdtimepicker();

							$('#TimeOut').on('timechanged', function(e) {


								var formattedTimeIn = $("#TimeIn").attr('data-time');
								



								var timeOut = e.time;

								var now = new Date();

								var dateIn = new Date(now.getFullYear(), now.getMonth(), now.getDate(), formattedTimeIn.split(':')[0], formattedTimeIn.split(':')[1], 0);

								var dateOut = new Date(now.getFullYear(), now.getMonth(), now.getDate(), timeOut.split(':')[0], timeOut.split(':')[1], 0);

								if (dateOut < dateIn) {
									if (!alertShown) {
										alert('TimeOut time is less than TimeIn time');
										alertShown = true;
										$('#TimeOut').val('');
									}
								} else {
									alertShown = false;
								}
							});
						}
					});



					loader.off();
				}
			});

			<?PHP }else { ?>
				$("#attendenceData").html('<h3 class="text-center">No Meetings Schedule Today!</h3>');
			<?php } ?>


			$("#heading").text('Add Attendance');

		} );


	</script>
</body>
</html>
