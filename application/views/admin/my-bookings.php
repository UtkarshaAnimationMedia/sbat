<?php $this->load->view('admin/includes/head'); ?>
<?php $this->load->view('admin/includes/sidebar'); ?>
<?php $this->load->view('admin/includes/topbar'); ?>
<div class="container">
	<div id="TableData" class="table-responsive">


	</div>
	<?php $cat = GetServiceCatTypes(); ?>
</div>
<!-- End Main content-->

<?php $this->load->view('admin/includes/footer'); ?>
<script type="text/javascript">



	$(document).ready(function(){
		

		$("#dropdown-list").html('<div class="dropdown"><button class="btn dropdown-toggle text-white border-white" type="button" id="filter-bookings" data-bs-toggle="dropdown" aria-expanded="false">IN TEMPLE BOOKINGS</button><ul class="dropdown-menu filter-bookings" aria-labelledby="filter-bookings"><li><a class="dropdown-item" href="#" data-value="IN-TEMPLE">IN TEMPLE BOOKINGS</a></li><li><a class="dropdown-item" href="#" data-value="AWAY-TEMPLE">AWAY TEMPLE BOOKINGS</a></li><li><a class="dropdown-item" href="#" data-value="EVENTS">EVENTS BOOKINGS</a></li>				</ul></div>');

		var selectedValue = 'IN-TEMPLE';

	$("#filter-bookings").text("IN TEMPLE BOOKINGS"); // set initial text

	$('.dropdown-menu a').click(function(e) {
		e.preventDefault(); // prevent link from navigating

		var selectedValue = $(this).data('value');
		$("#filter-bookings").text($(this).text()); // update button text

		$.ajax({
			url: '<?=base_url('admin/filterBookingData/')?>'+selectedValue,
			type: 'POST',
			data: {aspectType : selectedValue},
			success: function(data) {
				$("#TableData").html(data);
				$('#myBookings').DataTable( {
					order: [[ 0, 'desc' ]],
					"searching": false,
					"lengthChange": false,
					language: {
						emptyTable: "No Bookings Available to show.."
					}
				} );

				if (selectedValue == 'IN-TEMPLE') {
					$("#heading").text('In Temple Bookings');
				}
				if (selectedValue == 'AWAY-TEMPLE') {
					$("#heading").text('Away Temple Bookings');
				}
				if (selectedValue == 'EVENTS') {
					$("#heading").text('Events Bookings');
				}
			}
		});
	});

	$('.dropdown-menu a[data-value="' + selectedValue + '"]').trigger('click'); // trigger click on initial value



});
	function CancelBooking(id){

		var id = id;
		Swal.fire({
			title: 'Do you want to cancel this Booking?',
			showDenyButton: false,
			showCancelButton: true,
			confirmButtonText: 'Yes',
			denyButtonText: 'No',
		}).then((result) => {
			if (result.isConfirmed) {
				loader.on();
				$.ajax({
					url: '<?=base_url('admin/Dashboard/CancelBooking/')?>'+id,
					type: 'POST',
					dataType: "json",
					success: function(data) {
						loader.off();
						if (data['statusCode'] == 1) {
							Swal.fire({
								title: 'Booking has been cancelled',
								type: "success",
								confirmButtonText: 'OK',
								confirmButtonColor: '#008080',
							}).then((result) => {
								window.location.reload(); 
							});
						} else {
							Swal.fire({
								title: 'Something went wrong!',
								type: "alert",
								confirmButtonText: 'OK',
								confirmButtonColor: '#008080',
							}).then((result) => {
								window.location.reload(); 
							});
						}
					}
				});
			} else if (result.isDenied) {
				Swal.fire('Changes are not saved', '', 'info')
			}
		});
	}



</script>


</body>
</html>
