<?php $this->load->view('admin/includes/head'); ?>
<?php $this->load->view('admin/includes/sidebar'); ?>
<?php $this->load->view('admin/includes/topbar'); ?>
<div class="container">
	<div id="TableData" class="table-responsive">
		

	</div>

</div>
<!-- End Main content-->

<?php $this->load->view('admin/includes/footer'); ?>
<script>

	$(document).ready(function(){

		$("#dropdown-list").html('<div class="dropdown"><button class="btn btn-secondary dropdown-toggle" type="button" id="filter-bookings" data-bs-toggle="dropdown" aria-expanded="false">DAILY ORDERS</button><ul class="dropdown-menu" aria-labelledby="filter-bookings"><li><a class="dropdown-item" href="#" data-value="DAILY ORDERS">DAILY ORDERS</a></li></ul></div>');

		var selectedValue = 'DAILY ORDERS';

	$("#filter-bookings").text("DAILY ORDERS"); // set initial text

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
					order: [[ 0, 'desc' ]]
				} );

				if (selectedValue == 'DAILY ORDERS') {
					$("#heading").text('Daily Orders');
				}
				if (selectedValue == 'CATERING ORDERS') {
					$("#heading").text('Catering Orders');
				}
			}
		});
	});

	$('.dropdown-menu a[data-value="' + selectedValue + '"]').trigger('click'); // trigger click on initial value
});



</script>


</body>
</html>
