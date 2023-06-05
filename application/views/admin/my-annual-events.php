<?php $this->load->view('admin/includes/head'); ?>
<?php $this->load->view('admin/includes/sidebar'); ?>
<?php $this->load->view('admin/includes/topbar'); ?>
<div class="container">
	<?php 


	$success_msg = $this->session->flashdata('success');
	$failure_msg = $this->session->flashdata('failure');

	if (isset($success_msg)) {
		echo $success_msg;
	}else if($failure_msg){
		echo $failure_msg;
	}
	?>
	<div id="TableData" class="table-responsive">


	</div>

</div>
<!-- End Main content-->

<?php $this->load->view('admin/includes/footer'); ?>
<script type="text/javascript">


	$(document).ready(function(){


		var list = ''; 
		<?php 

		if (!empty($EventData->data)) {

			foreach ($EventData->data as $key => $value) { ?>

				list +=  '<li><a class="dropdown-item" href="#" data-value="<?= $value->refDataName; ?>"><?= $value->refDataName; ?></a></li>';

				<?php 

					if ($key == 0) { ?> var selectedValue = '<?=$value->refDataName?>' <?php }

				?>

			<?php 	} 
		} ?>

		$("#dropdown-list").html('<div class="dropdown"><button class="btn dropdown-toggle text-white border-white" type="button" id="filter-bookings" data-bs-toggle="dropdown" aria-expanded="false">SELECT EVENT TYPE</button><ul class="dropdown-menu filter-bookings" aria-labelledby="filter-bookings">'+list+'</ul></div>');

	$("#filter-bookings").text(selectedValue); // set initial text

	$('.dropdown-menu a').click(function(e) {
		e.preventDefault(); // prevent link from navigating

		var selectedValue = $(this).data('value');

		$("#filter-bookings").text($(this).text()); // update button text

		$.ajax({
			url: '<?=base_url('Admin/Dashboard/getAnnualEvent')?>',
			type: 'POST',
			data: {selectedValue : selectedValue},
			success: function(data) {


				$("#TableData").html(data);
				$('#myBookings').DataTable( {
					order: [[ 0, 'desc' ]],
					language: {
						emptyTable: "No Annual Events Available to show.."
					}
				} );

				$("#heading").text('My Events');
			}
		});
	});

	$('.dropdown-menu a[data-value="' + selectedValue + '"]').trigger('click'); // trigger click on initial value



});
</script>


</body>
</html>
