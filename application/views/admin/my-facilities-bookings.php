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
		
		<?php 
		$rental_types = GetRentalTypes()['data'];
		$list = '';
		foreach ($rental_types as $key => $value) {
			$list .= '<li><a class="dropdown-item" href="#" data-value="'.$value['refDataName'].'">'.$value['refDataName'].'</a></li>';

			if ($key == 0) {
				$selectedValue = $value['refDataName'];
			}
		}

		$html = '<div class="dropdown"><button class="btn dropdown-toggle text-white border-white" type="button" id="filter-bookings" data-bs-toggle="dropdown" aria-expanded="false">IN TEMPLE BOOKINGS</button><ul class="dropdown-menu filter-bookings" aria-labelledby="filter-bookings">'.$list.'</ul></div>';

		?>
		$("#dropdown-list").html('<?=$html?>');

		var selectedValue = '<?=$selectedValue?>';

	$("#filter-bookings").text("<?=$selectedValue?>"); // set initial text

	$('.dropdown-menu a').click(function(e) {
		e.preventDefault(); // prevent link from navigating

		var selectedValue = $(this).data('value');
		$("#filter-bookings").text($(this).text()); // update button text

		$.ajax({
			url: '<?=base_url('admin/filterFacilitiesBookingData/')?>'+selectedValue,
			type: 'POST',
			data: {aspectType : selectedValue},
			success: function(data) {
				$("#TableData").html(data);
				$('#myBookings').DataTable( {
					order: [[ 0, 'desc' ]],
					"searching": false,
					"lengthChange": false,
					language: {
						emptyTable: "No Facilities Bookings Available to show.."
					}
				} );

				$("#heading").text(selectedValue);
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
