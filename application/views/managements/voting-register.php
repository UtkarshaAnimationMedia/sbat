<?php $this->load->view('managements/includes/head'); ?>
<?php $this->load->view('managements/includes/sidebar'); ?>
<?php $this->load->view('managements/includes/topbar'); ?>
<style type="text/css">
	thead input {
		width: 100%;
	}
	.meetDetails{
			color: #BB001A;
			font-size: 25px;
		}
	.hiddenRow {
		padding: 0 !important;
	}
</style>
<?php  $votingDetails = json_decode(json_encode($votingDetails), true)['data'];  

	// print_r($meeting_data);
	?>
<!-- Main content-->
<div class="container my-3">

	<div class="row mb-4">
		<div class="container">
			<div class="row container p-2">

				<div class="col-md-4" style="font-size:20px"><span class="meetDetails py-2 fw-bold">Meeting Title: </span><?= @$meeting_data['data'][0]['refDataName']; ?></div>
				<div class="col-md-4" style="font-size:20px"><span class="meetDetails py-2 fw-bold">Organizer: </span><?= @$meeting_data['data'][0]['refDataName5']; ?></div>
				<div class="col-md-4" style="font-size:20px"><span class="meetDetails py-2 fw-bold">Group: </span><?= @$meeting_data['data'][0]['refDataName1']; ?></div>
				
			</div>
		</div>
	</div>

	<div class="table-responsive" id="votingRegister">

		<div class="container">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
					</div>
					<div class="panel-body">
						<table class="table table-condensed shadow bg-white">
							<thead>
								<tr style="background-color: #BB001A;color: white;">
									<th>#</th>
									<th>Category</th>
									<th>Meeting Name</th>
									<th>Meeting Date</th>		
									<th>Meeting Time</th>	
									<th></th>
								</tr>
							</thead>


							<?php foreach ($votingDetails as $key => $value) { ?>
								<tbody>
									<tr data-toggle="collapse" data-target="#demo<?=$key?>" class="accordion-toggle  bg-white">
										<td class="fw-bold"><?= $key+1; ?></td>
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
														<tr class="info">
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
							<?php } ?>
						</table>
					</div>

				</div> 

			</div>
		</div>



	</div>

</div>
	<!-- End Main content--> 
	<?php $this->load->view('managements/includes/footer'); ?>
	<script type="text/javascript" src="<?=base_url('assets/js/time-picker.js')?>"></script>
	<script src="<?=base_url('assets/js/jquery-ui.min.js');?>"></script>
	<script>
		$(document).ready(function() {
			$('#attendanceData').DataTable( {
				order: [[ 0, 'desc' ]],
				language: {
					emptyTable: "No Attendance Available to Show.."
				}
			});
		} );
	</script>
</body>
</html>
