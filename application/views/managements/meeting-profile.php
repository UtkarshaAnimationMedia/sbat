<?php $this->load->view('managements/includes/head'); ?>
<?php $this->load->view('managements/includes/sidebar'); ?>
<?php $this->load->view('managements/includes/topbar'); ?>
<!-- Main content-->
<div class="container my-3">
	<style type="text/css">
		.meetDetails{
			color: #BB001A;
			font-size: 19px;
		}
	</style>
	<div class="row mb-4">
		<div class="container">
			<section>
				<div class="container meetDetails">

					<div class="row">
						<div class="col-lg-4">
							<div class="card mb-4">
								<div class="card-body text-center">
									<h5 class="my-3 fw-bold" style="font-size:25px">Organizer:</h5>
									<p class="text-dark" style="font-size:20px"><?= @$meeting_data['data'][0]['refDataName5']; ?></p>
									<p class="text-dark" style="font-size:20px"><?= @$meeting_data['data'][0]['contactEmail']; ?></p>
									<p class="text-dark mb-4" style="font-size:20px"><?= @formatPhoneNumber($meeting_data['data'][0]['ContactPhone']); ?></p>
									<div class="d-flex justify-content-center mb-2">
										<a href="<?= (@$meeting_data['data'][0]['meetingUrl'] == '') ? 'javascript:void(0)' :   @$meeting_data['data'][0]['meetingUrl']  ?>" class="btn btn-outline-danger ms-1" style="font-size:20px">Meeting Link</a>
									</div>
									<?php if(isset($meeting_data['data'][0]['locationUrl'])){ ?> 
									<a href="<?= (@$meeting_data['data'][0]['locationUrl'] == '') ? 'javascript:void(0)' :   @$meeting_data['data'][0]['locationUrl']  ?>" class="text-danger ms-1" <?= @$meeting_data['data'][0]['locationUrl'] != '' ? 'target="_blank"' : ''; ?> style="font-size:20px">Direction <i class="fa fa-map-marker"></i></a>
									<?php } ?>
								</div>
							</div>
						</div>
						<div class="col-lg-8">
							<div class="card mb-4">
								<div class="card-body">
									<div class="row">
										<div class="col-sm-3">
											<p class="mb-0 fw-bold">Meeting Title</p>
										</div>
										<div class="col-sm-9">
											<p class="text-dark mb-0"><?= @$meeting_data['data'][0]['refDataName']; ?></p>
										</div>
									</div>
									<hr>
									<div class="row">
										<div class="col-sm-3">
											<p class="mb-0 fw-bold">Group</p>
										</div>
										<div class="col-sm-9">
											<p class="text-dark mb-0"><?= @$meeting_data['data'][0]['refDataName1']; ?></p>
										</div>
									</div>
									<hr>
									<div class="row">
										<div class="col-sm-3">
											<p class="mb-0 fw-bold">Day</p>
										</div>
										<div class="col-sm-9">
											<p class="text-dark mb-0"><?= @$meeting_data['data'][0]['refDataName7']; ?></p>
										</div>
									</div>
									<hr>
									<div class="row">
										<div class="col-sm-3">
											<p class="mb-0 fw-bold">Meeting Start Date</p>
										</div>
										<div class="col-sm-9">
											<p class="text-dark mb-0"><?= @$meeting_data['data'][0]['refDataName2']; ?></p>
										</div>
									</div>
									<hr>
									<div class="row">
										<div class="col-sm-3">
											<p class="mb-0 fw-bold">Meeting End Date</p>
										</div>
										<div class="col-sm-9">
											<p class="text-dark mb-0"><?= @$meeting_data['data'][0]['Meeting End Date']; ?></p>
										</div>
									</div>
									<hr>
									<div class="row">
										<div class="col-sm-3">
											<p class="mb-0 fw-bold">Meeting Start Time</p>
										</div>
										<div class="col-sm-9">
											<p class="text-dark mb-0"><?= @$meeting_data['data'][0]['refDataName3']; ?></p>
										</div>
									</div>
									<hr>
									<div class="row">
										<div class="col-sm-3">
											<p class="mb-0 fw-bold">Meeting End Time</p>
										</div>
										<div class="col-sm-9">
											<p class="text-dark mb-0"><?= @$meeting_data['data'][0]['meetingEndtTime']; ?></p>
										</div>
									</div>
									<hr>

									<div class="row">
										<div class="col-sm-3">
											<p class="mb-0 fw-bold">Location</p>
										</div>
										<div class="col-sm-9">
											<p class="text-dark mb-0"><?= @$meeting_data['data'][0]['refDataName4']; ?></p>
										</div>
									</div>
									<hr>

									<div class="row">
										<div class="col-sm-3">
											<p class="mb-0 fw-bold">Agenda</p>
										</div>
										<div class="col-sm-9">
											<p class="text-dark mb-0"><?= @$meeting_data['data'][0]['meetingPurpose']; ?></p>
										</div>
									</div>
									<hr>

								</div>
							</div>

						</div>
					</div>
				</div>
			</section>
		</div>
	</div>

	<!-- End Main content--> 
	<?php $this->load->view('managements/includes/footer'); ?>
</body>
</html>
