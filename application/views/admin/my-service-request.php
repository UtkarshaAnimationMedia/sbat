<?php $this->load->view('admin/includes/head'); ?>
<?php $this->load->view('admin/includes/sidebar'); ?>
<?php $this->load->view('admin/includes/topbar'); ?>
<!-- Main content-->

<div class="container my-3">
	<?php echo $this->session->flashdata('success');?>

	<?php if (isset($myServiceRequests_data) && !empty($myServiceRequests_data)) { ?>
		
	
	<div class="table-responsive">
		<table id="myServiceRequest" class="table">
			<thead>
				<tr style="background-color:#F1F1F1">
					<th>Service Name</th>
					<th>Amount</th>
					<th>Service Requested Date/Time</th>
					<th>Service Category</th>
					<th>Preferred Priest</th>
					<th>Service Location</th>
					<th>Preferred Language</th>
					<th>No. of Adults, children</th>
					<th>Status</th>
					<th>Booking Date</th>
				</tr>
			</thead>
			<tbody>
				<?php 


							//Multidiamensional array sort by date key
				usort($myServiceRequests_data, function ($a, $b) {
					$dateA = DateTime::createFromFormat('m/d/Y h:i:s A', $a->recCreDate.' '.$a->recCreTime);
					$dateB = DateTime::createFromFormat('m/d/Y h:i:s A', $b->recCreDate.' '.$b->recCreTime);
   									 // ascending ordering, use `<=` for descending
					return $dateA <= $dateB;
				});



				foreach($myServiceRequests_data as $val){ ?> 



					<tr>
						<td><?=camelCase($val->ServiceSetup); ?></td>
						<td><?= '$ '.sprintf("%.2f",$val->serviceAmount);?></td>

						<td><?= $val->serviceDate || $val->serviceTime ? $val->serviceDate .' / '.$val->serviceTime : '' ; ?></td>

						<td><?=camelCase($val->serviceCategoryTypes); ?></td>
						<td><?=$val->priestName?></td>


						<?php if ($val->serviceCategoryTypes == 'AWAY-TEMPLE') { ?>
							<td><?=camelCase($val->serviceAddress); ?></td>
						<?php }else{ ?>
							<td><?=camelCase($val->serviceLocationName); ?></td>
						<?php } ?>
						<td><?=$val->languagePreferenceName; ?></td>

						<td>
							<?php echo $val->adults  ?  'Aduts: '.sprintf("%02d", $val->adults) : '';  
							echo $val->children ? ",\n".'Children: '.sprintf("%02d", $val->children) : ''; 
							?>

						</td>

						<?php if ($val->serviceStatus == 'SCHEDULED') {
							$status =  '<img src="'.base_url('admin_assets/img/icons/booking-confirmed-icon.png').'" height="35"width="35" style="vertical-align: middle!important;">';
						}else{
							$status =  '<span class="badge">'.$val->serviceStatus.'</span>';
						} ?>
						<td><?= $status;?></td>
						<td><?= $val->recCreDate ? $val->recCreDate : '' ; ?></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>


	<?php }else if(isset($err_msg)){

		echo $err_msg;

	 } ?>



</div>
<!-- End Main content--> 


<?php $this->load->view('admin/includes/footer'); ?>

<script>

	$(document).ready(function() {
		$("#heading").text('My Service Requests');
		$('#myServiceRequest').DataTable({
			ordering: false
		});
	} );

</script>
</body>
</html>
