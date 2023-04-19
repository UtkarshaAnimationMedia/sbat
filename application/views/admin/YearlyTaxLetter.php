<?php $this->load->view('admin/includes/head'); ?>
<?php $this->load->view('admin/includes/sidebar'); ?>
<?php $this->load->view('admin/includes/topbar'); ?>

<?php 
if ($this->session->flashdata('failure')) {
	echo "<div class='m-3 alert alert-danger alert-dismissible fade show text-center'><strong>Failed!</strong>".$this->session->flashdata('failure')."<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
}
if ($this->session->flashdata('success')) {
	echo "<div class='m-3 alert alert-success alert-dismissible fade show text-center'><strong>Success!</strong>".$this->session->flashdata('success')."<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
}
?>
<div style="float:left;margin-left: 20px; margin-top: 20px;">
	<form action="<?=base_url('admin/download/yearly/Tax-Letter')?>" method="POST">
		<div class="col-md-12">
			<div class="row">
				<p class="text-danger"><span class="fw-bold">*Note</span>: Pdf Will Be Sent To Your Email Id.</p>
				<div class="col-md-12">
					<select class="form-select border-dark" id="downloadTaxLetterByYear" name="Year" required>
						<option value=" " selected disabled>Year</option>
						<option value="2023" selected><?=date('Y')?></option>
									<!-- <?php for($i = 1; $i <=9; $i++){ ?> 
										<option value="<?=date('Y', strtotime('-'.$i.' years'))?>"><?=date('Y', strtotime('-'.$i.' years'))?></option>
										<?php } ?> -->

									</select>
								</div>
								<div class="col-md-12 mt-3">
									<button class="btn btn-success loader" type="submit" style="background-color:#007673">Email Pdf <i class="fa fa-envelope"></i></button>
								</div>
							</div>
						</div>
					</form>
				</div>
				<?php $this->load->view('admin/includes/footer'); ?>
				<script>

					$(document).ready(function() {
						$("#heading").text('Yearly Tax Letter');

					} );

				</script>


			</body>
			</html>
