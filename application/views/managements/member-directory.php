<?php $this->load->view('managements/includes/head'); ?>
<?php $this->load->view('managements/includes/sidebar'); ?>
<?php $this->load->view('managements/includes/topbar'); ?>


<style type="text/css">
	thead input {
		width: 100%;
	}
</style>
<!-- Main content-->
<div class="container my-3">
	<div class="table-responsive" id="memberDirectoryData">
		<!-- Data Will be Come by Jquery -->
	</div>

</div>
<!-- End Main content--> 
<?php $this->load->view('managements/includes/footer'); ?>
<script>
	$(document).ready(function() {
		loader.on();

		$("#heading").text('Management Directory');



		var list = '<li><a class="dropdown-item" href="#" data-value="SELECT YEAR">SELECT YEAR</a></li>';


		<?php 
		for ($i = date('Y'); $i >= date('Y') - 10; $i--) {
			?>
			list += '<li><a class="dropdown-item" href="#" data-value="<?= $i ?>"><?= ($i-1).' - '.$i ?></a></li>';
			<?php 
		} 
		?>



		$("#dropdown-list").html('<div class="dropdown"><button class="btn dropdown-toggle text-white border-white" type="button" id="filter-bookings" data-bs-toggle="dropdown" aria-expanded="false">SELECT YEAR</button><ul class="dropdown-menu filter-bookings" aria-labelledby="filter-bookings">'+list+'</ul></div>');

		var selectedValue = 'SELECT YEAR';

	$("#filter-bookings").text("SELECT YEAR"); // set initial text

	$('.dropdown-menu a').click(function(e) {
		loader.on();
		e.preventDefault(); // prevent link from navigating

		var selectedValue = $(this).data('value');
		$("#filter-bookings").text($(this).text()); // update button text

		$.ajax({
			url: '<?=base_url('Managements/Managements/FilterMemberDirectory')?>',
			type: 'POST',
			data: {selectedValue : selectedValue},
			success: function(data) {
				$("#memberDirectoryData").html('');
				$("#memberDirectoryData").html(data);
				if (selectedValue === 'SELECT YEAR') {
					selectedValue = new Date().getFullYear(); 
				}

				var startDate = new Date(selectedValue - 1, 9, 1);
				var endDate = new Date(selectedValue, 8, 30);

				var startMonth = ("0" + (startDate.getMonth() + 1)).slice(-2); 
				var startDay = ("0" + startDate.getDate()).slice(-2); 
				var endMonth = ("0" + (endDate.getMonth() + 1)).slice(-2); 
				var endDay = ("0" + endDate.getDate()).slice(-2); 

				var dateRangeString = "for " + startMonth + "/" + startDay + "/" + (selectedValue - 1) + " - " + endMonth + "/" + endDay + "/" + selectedValue; 

				$(".memberDirectoryHeading").text(dateRangeString);

				$("#heading").text('Management Directory');
				$('#DataTable thead tr')
				.clone(true)
				.addClass('filters')
				.appendTo('#DataTable thead');

				var table = $('#DataTable').DataTable({
					orderCellsTop: true,
					fixedHeader: true,
					language: {
						emptyTable: "No Management Directory Available to show.."
					},
					initComplete: function () {
						var api = this.api();
						api
						.columns()
						.eq(0)
						.each(function (colIdx) {
							var cell = $('.filters th').eq(
								$(api.column(colIdx).header()).index()
								);
							var title = $(cell).text();
							$(cell).html('<input type="text" placeholder="' + title + '" />');
							$(
								'input',
								$('.filters th').eq($(api.column(colIdx).header()).index())
								)
							.off('keyup change')
							.on('change', function (e) {
								$(this).attr('title', $(this).val());
								var regexr = '({search})';

								var cursorPosition = this.selectionStart;
								api
								.column(colIdx)
								.search(
									this.value != ''
									? regexr.replace('{search}', '(((' + this.value + ')))')
									: '',
									this.value != '',
									this.value == ''
									)
								.draw();
							})
							.on('keyup', function (e) {
								e.stopPropagation();

								$(this).trigger('change');
								$(this)
								.focus()[0]
								.setSelectionRange(cursorPosition, cursorPosition);
							});
						});
					},
				});

				loader.off();
			}
		});
	});

	$('.dropdown-menu a[data-value="' + selectedValue + '"]').trigger('click'); // trigger click on initial value
} );
	
</script>
</body>
</html>
