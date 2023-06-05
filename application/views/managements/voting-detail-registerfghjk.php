<?php $this->load->view('managements/includes/head'); ?>
<?php $this->load->view('managements/includes/sidebar'); ?>
<?php $this->load->view('managements/includes/topbar'); ?>


<style type="text/css">
	thead input {
		width: 100%;
	}
	body{
		padding-top:50px;
		background-color:#34495e;
	}



	.hiddenRow {
		padding: 0 !important;
	}
</style>
<!-- Main content-->
<div class="container my-3">
	<div class="table-responsive" id="votingRegister">

		<div class="container">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
					</div>
					<div class="panel-body">
						<table class="table table-condensed table-striped">
							<thead>
								<tr style="background-color: #008080;color: white;">
									<th>Category</th>
									<th>Meeting Name</th>
									<th>Meeting Date</th>		
									<th>Meeting Time</th>	
									<th></th>
								</tr>
							</thead>


							<?php 
							if (isset($votingDetails) && !empty($votingDetails)) {
							foreach ($votingDetails as $key => $value) { ?>
								<tbody>
									<tr data-toggle="collapse" data-target="#demo<?=$key?>" style="background-color: #fff5d5;" class="accordion-toggle">
										<td><?= $value['Parent']['refDataName1']; ?></td>
										<td><?= $value['Parent']['refDataName']; ?></td>
										<td><?= $value['Parent']['meetingDate']; ?></td>
										<td><?= $value['Parent']['meetingTime']; ?></td>
										<td><a href="javascript:void(0)"><i class="fa fa-eye"></i></a></td>
									</tr>

									<tr>
										<td colspan="12" class="hiddenRow">
											<div class="accordian-body collapse" id="demo<?=$key?>"> 
												<table class="table table-striped">
													<thead>
														<tr class="info" style="background-color: #00968857;">
															<th>Member Name</th>
															<th colspan="2">Meeting Notes</th>
															<th>Voting Options</th>			
														</tr>
													</thead>	

													<tbody>

														<?php foreach ($value['Child Grid'] as $key => $value) { ?>
															<tr>
																<td><?=$value['refDataName']?></td>
																<td colspan="2"><?=$value['Meeting Notes']?></td>
																<td><?=$value['votingOptions']?></td>
															</tr>
														<?php } ?>
													</tbody>
												</table>

											</div> 
										</td>
									</tr>

								</tbody>
							<?php } }?>
						</table>
					</div>

				</div> 

			</div>
		</div>



	</div>

</div>
<!-- End Main content--> 
<?php $this->load->view('managements/includes/footer'); ?>
<script>
	$(document).ready(function() {

		$("#heading").text('Voting Details Register');
	} );
	
</script>
</body>
</html>
