<?php $this->load->view('admin/includes/head'); ?>

<?php $this->load->view('admin/includes/sidebar'); ?>

<?php $this->load->view('admin/includes/topbar'); ?>



<!-- Main content-->
<div class="container my-3">

	<!-- <?=print_r($this->session->userdata());?> -->


	<div class="table-responsive">
		<table id="myDonations" class="table">
			<thead>
				<tr  style="background-color:#F1F1F1">
					<th>Token</th>
					<th>Donation Name</th>
					<th>Donation Amount</th>
					<th>Donation Category</th>
					<th>Donation</th>
					<!-- <th>Donated on Date/Time</th> -->
					<th>Donated on Date</th>
					<th>Download Receipt</th>
				</tr>
			</thead>
			<tbody>
				<?php $donations = array_reverse($donations_data); 


				foreach($donations as $val){ 


					?> 
					<tr>
						<td><?=$val['tokenNumber']?></td>
						<td><?=camelCase($val['ServiceSetup']);?></td>
						<td><?= '$'.sprintf("%.2f",$val['serviceAmount'])?></td>
						<td><?=camelCase($val['serviceCategoryTypes']);?></td>
						<td><?=camelCase($val['serviceTypes']);?></td>
						<td>
							<?=

							$val['recCreDate'] ?	$val['recCreDate'] : '' ;


							?>

						</td>
						<td style="text-align:center;"><a href="<?= base_url('admin/download-reciept/'.base64_encode($val['tokenNumber']).'/DONATIONS'); ?>" id="btnExport" target="_blank"><i class="fa fa-eye text-blue" style="font-size:22px"></i> </a></td>



					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>

</div>
<!-- End Main content-->

<?php $this->load->view('admin/includes/footer'); ?>
<script>

	$(document).ready(function() {
		$("#heading").text('My Donations');


		$('#myDonations').DataTable( {
			order: [[ 0, 'desc' ]]
		} );
	} );

</script>
</body>
</html>
