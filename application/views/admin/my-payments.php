<?php $this->load->view('admin/includes/head'); ?>
<?php $this->load->view('admin/includes/sidebar'); ?>
<?php $this->load->view('admin/includes/topbar'); ?>
<!-- Main content-->

<div class="container my-3">
	<div class="table-responsive">
		<table id="myDonations" class="table">
			<thead>
				<tr style="background-color:#F1F1F1">
					<th>Token</th>
					<th>Txn&nbsp;ID</th>
					<th>Service&nbsp;Name</th>
					<th>Total&nbsp;Amount</th>
					<th>Payment&nbsp;Type</th>
					<th>Payment&nbsp;Source</th>
					<th>Txn&nbsp;Initiated&nbsp;Date</th>
					<th>Txn&nbsp;Status</th>
					<th>View&nbsp;Receipt</th>
				</tr>
			</thead>
			<tbody>
				<?php $Mypayments = array_reverse($payments_data); foreach($Mypayments as $val){ 


					?> 
					<tr>
						<td><?=$val->batchNo;?></td>
						<td><?=$val->transactionId;?></td>
						<td><?=camelCase($val->paymentsData[0]->ServiceSetup);?></td>
						<td style="text-align: right;padding-right: 21px"><?= '$'.sprintf("%.2f",$val->totalAmount);?></td>
						<td><?=camelCase($val->paymentType);?></td>
						<td><?=camelCase($val->source);?></td>
						<td><?=$val->recCreDate;?></td>
						<td ><?=$val->paymentStatus == 'COMPLETED' ? '<span class="badge">'.$val->paymentStatus.'</span>' : '<span style="background:#FAA21B!important;color:#FFFFFF!important;text-shadow:1px 0px 0px black" class="badge" >'.$val->paymentStatus.'</span>' ;?></td>
						<td class="text-center"><a href="<?=base_url('admin/download-reciept/'.base64_encode($val->tokenNumber).'/PAYMENTS')?>" target="_blank"><i class="fa fa-eye" style="font-size:22px"></i></a></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>

</div>
<!-- End Main content--> 
<script>

	$(document).ready(function() {
		$("#heading").text('My Payments');
		$('#myDonations').DataTable( {
			order: [[ 0, 'desc' ]]
		} );
	} );
	
</script>
</body>
</html>
