<style type="text/css">
	.fa2{
		margin-top: 7px;
	}

</style>
<?php $this->load->view('admin/includes/head'); ?>
<?php $this->load->view('admin/includes/sidebar'); ?>
<?php $this->load->view('admin/includes/topbar'); ?>

<!-- ======= Service Request ======= -->
<div class="container" >
	<div class="row p-4">

		<div class="col-md-12 mx-auto d-block shadow-lg   bg-body rounded">
			<?php echo $this->session->flashdata('success'); ?>


			<?= form_open('admin/update/profile', 'class="contact-form" method="post"') ?>


			<fieldset class="border-2">
				<legend  class="legend-outer  float-none w-auto"> Personal Details </legend>
				<div class="row">

					<div class="col-md-4">
						<?php 

									// print_r($userDetails);
						$parts = explode(" ", @$userDetails->refDataName);
						$lastname = array_pop($parts);
						$firstname = implode(" ", $parts);
						?>
						<fieldset class="border">
							<legend  class="legend-inner float-none w-auto">First Name</legend>
							<div class="input-group">
								<i class="fa fa2 fa-user"></i>
								<input type="text" class="form-control" id="fname" name="fname" placeholder="First Name*" value="<?=set_value('fname', @$firstname)?>" required aria-label="fname" aria-describedby="basic-addon1"  readonly>
							</div>
						</fieldset>
					</div>
					<div class="col-md-4">
						<fieldset class="border">
							<legend  class="legend-inner float-none w-auto">Last Name</legend>
							<div class="input-group">
								<i class="fa fa2 fa-user"></i>
								<input type="text" class="form-control" id="lname" name="lname" value="<?= set_value('lname', @$lastname)?>" placeholder="Last Name" aria-label="lname" aria-describedby="basic-addon1" readonly>
							</div>
						</fieldset>

					</div>

					<div class="col-md-4">
						<fieldset class="border">
							<legend  class="legend-inner float-none w-auto">Date of Birth</legend>
							<div class="input-group">
								<i class="fa fa2 fa-user"></i>
								<input type="text" class="form-control" id="dob" name="dob" value="<?= set_value('dob', @$userDetails->dob)?>" placeholder="MM/DD/YYYY" aria-label="dob" aria-describedby="basic-addon1" readonly>
							</div>
						</fieldset>

					</div>


				</div>
				<div class="row">
					<div class="col-md-4">
						<fieldset class="border">
							<legend  class="legend-inner float-none w-auto">Gothram</legend>
							<div class="input-group">
								<input type="text" class="form-control" id="gothram" name="gothram" placeholder="Gothram*"  value="<?= set_value('gothram', @$userDetails->gotra)?>" required aria-label="gothram" readonly>
							</div>
						</fieldset>

					</div>
					<div class="col-md-4">
						<fieldset class="border">
							<legend  class="legend-inner float-none w-auto">Stars</legend>
							<div class="input-group">
								<input type="text" class="form-control" id="stars" name="stars" placeholder="Stars*" value="<?= set_value('stars', @$userDetails->Nakshtra)?>" readonly aria-label="stars">
							</div>
						</fieldset>
					</div>
					<div class="col-md-4">
						<fieldset class="border">
							<legend  class="legend-inner float-none w-auto">Rashi</legend>
							<div class="input-group">
								<input type="text" class="form-control" id="rashi" name="rashi" placeholder="Rashi*" value="<?= set_value('rashi', @$userDetails->rashi)?>" readonly aria-label="rashi">
							</div>
						</fieldset>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<fieldset class="border">
							<legend  class="legend-inner float-none w-auto">Email</legend>
							<div class="input-group">
								<i class="fa fa2 fa-envelope"></i>
								<input type="email" class="form-control" id="main_email" name="main_email" placeholder="Email*" value="<?= set_value('main_email', base64_decode(@$userDetails->email))?>" readonly  aria-label="main_email">
							</div>
						</fieldset>
					</div>
					<div class="col-md-6">
						<fieldset class="border">
							<legend  class="legend-inner float-none w-auto">Phone Number</legend>
							<div class="input-group">
								<i class="fa fa2 fa-phone"></i>
								<input type="text" class="form-control" id="main_phone" name="main_phone" placeholder="Phone Number*" value="<?= set_value('main_phone', formatPhoneNumber(base64_decode(@$userDetails->phone)))?>" readonly  aria-label="main_phone">
							</div>
						</fieldset>
					</div>
				</div>



				<div class="row">
					<div class="col-md-4">
						<fieldset class="border">
							<legend  class="legend-inner float-none w-auto">Spouse Name</legend>
							<div class="input-group">
								<input type="text" class="form-control" id="spouseName" name="spouseName" placeholder="Spouse Name*"  value="<?= set_value('spouseName', @$userDetails->spouseName)?>" required aria-label="spouseName" readonly>
							</div>
						</fieldset>

					</div>
					<div class="col-md-4">
						<fieldset class="border">
							<legend  class="legend-inner float-none w-auto">Spouse Phone</legend>
							<div class="input-group">
								<input type="text" class="form-control" id="spousePhone" name="spousePhone" placeholder="Spouse Phone*" value="<?= set_value('spousePhone', formatPhoneNumber(base64_decode(@$userDetails->spousePhone)))?>" readonly aria-label="spousePhone">
							</div>
						</fieldset>
					</div>
					<div class="col-md-4">
						<fieldset class="border">
							<legend  class="legend-inner float-none w-auto">Spouse Email</legend>
							<div class="input-group">
								<input type="email" class="form-control" id="spouseEmail" name="spouseEmail" placeholder="Spouse Email*" value="<?= set_value('spouseEmail', base64_decode(@$userDetails->spouseEmail))?>" readonly aria-label="spouseEmail">
							</div>
						</fieldset>
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">
						<fieldset class="border">
							<legend  class="legend-inner float-none w-auto">Spouse Gothram</legend>
							<div class="input-group">
								<input type="text" class="form-control" id="spouseGothram" name="spouseGothram" placeholder="Spouse Gothram*"  value="<?= set_value('spouseGothram', @$userDetails->spouseGotra)?>" required aria-label="spouseGothram" readonly>
							</div>
						</fieldset>

					</div>
					<div class="col-md-4">
						<fieldset class="border">
							<legend  class="legend-inner float-none w-auto">Spouse Stars</legend>
							<div class="input-group">
								<input type="text" class="form-control" id="spouseStars" name="spouseStars" placeholder="Spouse Stars*" value="<?= set_value('spouseStars', @$userDetails->spouseNakshtra)?>" readonly aria-label="spouseStars">
							</div>
						</fieldset>
					</div>
					<div class="col-md-4">
						<fieldset class="border">
							<legend  class="legend-inner float-none w-auto">Spouse Rashi</legend>
							<div class="input-group">
								<input type="text" class="form-control" id="spouseRashi" name="spouseRashi" placeholder="Spouse Rashi*" value="<?= set_value('spouseRashi', @$userDetails->spouseRashi)?>" readonly aria-label="spouseRashi">
							</div>
						</fieldset>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<fieldset class="border">
							<legend  class="legend-inner float-none w-auto">Company Name</legend>
							<div class="input-group">
								<i class="fa fa2 fa-building-o"></i>
								<input type="text" class="form-control" name="company_name" id="company_name" value="<?= set_value('company_name', @$userDetails->companyName)?>" placeholder="Company Name" aria-label="company_name" aria-describedby="basic-addon1" readonly>
							</div>
						</fieldset>
					</div>
					<div class="col-md-6">
						<fieldset class="border">
							<legend  class="legend-inner float-none w-auto">Company Email</legend>
							<div class="input-group">
								<i class="fa fa2 fa-envelope"></i>
								<input type="email" class="form-control" name="company_email" id="company_email" value="<?= set_value('company_email', base64_decode(@$userDetails->companyEmail))?>" placeholder="Company Email" aria-label="company_email" aria-describedby="basic-addon1" readonly>
							</div>
						</fieldset>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<fieldset class="border">
							<legend  class="legend-inner float-none w-auto">Company Phone Number</legend>
							<div class="input-group">
								<i class="fa fa2 fa-phone"></i>
								<input type="text" class="form-control" name="company_phone" id="company_phone" value="<?= set_value('company_phone', formatPhoneNumber(base64_decode(@$userDetails->companyPhone)))?>" placeholder="Company Phone Number" aria-label="company_phone" aria-describedby="basic-addon1" readonly>
							</div>
						</fieldset>
					</div>
					<div class="col-md-6">
						<fieldset class="border">
							<legend  class="legend-inner float-none w-auto">Company Website</legend>
							<div class="input-group">
								<i class="fa fa2 fa-globe"></i>
								<input type="url" class="form-control" name="company_website" id="company_website" value="<?= set_value('company_website', @$userDetails->website)?>" placeholder="Company Website" aria-label="company_website" aria-describedby="basic-addon1" readonly>
							</div>
						</fieldset>
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<fieldset class="border">
							<legend  class="legend-inner float-none w-auto">Address Line 1</legend>
							<div class="input-group">
								<i class="fa fa2 fa-map-marker"></i>
								<input type="text" class="form-control" name="address_line1" id="address_line1" value="<?= set_value('address_line1', @$userDetails->addressLine1)?>" placeholder="Address Line 1*"  aria-label="full_address" readonly>
							</div>
						</fieldset>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<fieldset class="border">
							<legend  class="legend-inner float-none w-auto">Address Line 2</legend>
							<div class="input-group">
								<i class="fa fa2 fa-map-marker"></i>
								<input type="text" class="form-control" name="address_line2" id="address_line2" value="<?= set_value('address_line2', @$userDetails->addressLine2)?>" placeholder="Address Line 2*" readonly  aria-label="address_line2">
							</div>
						</fieldset>
					</div>
				</div>


				<div class="row">
					<div class="col-md-4">
						<fieldset class="border">
							<legend  class="legend-inner float-none w-auto">State</legend>
							<div class="input-group">
								<input type="text" class="form-control" name="state" id="stateSelect" value="<?= set_value('state', @$userDetails->stateTypes)?>" readonly  aria-label="state">
							</div>
						</fieldset>
					</div>
					<div class="col-md-4">
						<fieldset class="border">
							<legend  class="legend-inner float-none w-auto">City</legend>
							<div class="input-group">
								<input type="text" class="form-control" name="city" id="city" value="<?= set_value('city', @$userDetails->cityTypes)?>" readonly  aria-label="city">
							</div>
						</fieldset>
					</div>
					<div class="col-md-4">
						<fieldset class="border">
							<legend  class="legend-inner float-none w-auto">Zip Code</legend>
							<div class="input-group">
								<i class="fa fa2 fa-file"></i>
								<input type="number" class="form-control" name="zipcode" id="zipcode" value="<?= set_value('zipcode', @$userDetails->zip)?>" placeholder="Zip Code*" readonly  aria-label="zipcode" aria-describedby="basic-addon1" >
							</div>
						</fieldset>
					</div>
				</div>


				<div class="row my-3">
					<div class="col-md-6">
						<legend  class="legend-inner float-none w-auto">Notification Preference</legend>
						<div class="form-check form-check-inline mx-3">
							<?= @$userDetails->emailPref == 'true' ? '<img src="'.base_url
							('assets/img/check.png').'" style="max-height:40px;max-width:40px" class="img-fluid"></img>' : '<img src="'.base_url
							('assets/img/unchecked.png').'" style="max-height:40px;max-width:40px" class="img-fluid"></img>' ?>
							<label class="form-check-label m-auto" for="inlineCheckbox2">Email</label>
						</div>
						<div class="form-check form-check-inline">
							<?= @$userDetails->smsPref == 'true' ? '<img src="'.base_url
							('assets/img/check.png').'" style="max-height:40px;max-width:40px" class="img-fluid"></img>' : '<img src="'.base_url
							('assets/img/unchecked.png').'" style="max-height:40px;max-width:40px" class="img-fluid"></img>' ?> 
							<label class="form-check-label m-auto" for="inlineCheckbox1">SMS</label>
						</div>

						<div class="form-check form-check-inline mx-3">
							<?= @$userDetails->phoneCallPref == 'true' ? '<img src="'.base_url
							('assets/img/check.png').'" style="max-height:40px;max-width:40px" class="img-fluid"></img>' : '<img src="'.base_url
							('assets/img/unchecked.png').'" style="max-height:40px;max-width:40px" class="img-fluid"></img>' ?> 
							<label class="form-check-label m-auto" for="inlineCheckbox2">Phone Call</label>
						</div>
					</div>
				</div>

			</fieldset>



			<fieldset class="border-2">
				<legend  class="legend-outer float-none w-auto">Family Members, Rashi & Star</legend>

				<div class="row">	
					<?php if(!empty($userDetails->memberDetail)){ ?>

						<div class="customer_records">

							<div class="row">
								<div class="col-md-2">
									<fieldset class="border">
										<legend  class="legend-inner float-none w-auto">Family Member 1</legend>
										<div class="input-group">
											<i class="fa fa2 fa-user"></i>
											<input name="family_member_name[]" id="familyMember" value="<?= set_value('family_member_name',@$userDetails->memberDetail[0]->memberName); ?>" id="family_member_name" type="text" class="form-control" placeholder="Family Member" aria-label="familyMember" aria-describedby="basic-addon1" readonly>
										</div>
									</fieldset>
								</div>

								<div class="col-md-2">	
									<fieldset class="border">
										<legend  class="legend-inner float-none w-auto">DOB</legend>
										<div class="input-group">
											<input  name="dateofbirth[]" id="dateofbirth" type="text"  class="form-control datepicker" placeholder="DOB" aria-label="dateofbirth" aria-describedby="basic-addon1"  value="<?= set_value('dateofbirth',@$userDetails->memberDetail[0]->dob); ?>" disabled>
										</div>
									</fieldset>
								</div>

								<div class="col-md-2">	
									<fieldset class="border">
										<legend  class="legend-inner float-none w-auto">Stars</legend>
										<div class="input-group">
											<input name="family_member_stars[]" id="familyMemberStar"  value="<?= set_value('family_member_stars',@$userDetails->memberDetail[0]->nakshatra); ?>" id="family_member_stars" type="text"  class="form-control" placeholder="Stars" aria-label="familyMemberStar" aria-describedby="basic-addon1" readonly>
										</div>
									</fieldset>
								</div>
								<div class="col-md-2">	
									<fieldset class="border">
										<legend  class="legend-inner float-none w-auto">Rashi</legend>
										<div class="input-group">
											<input name="family_member_rashi[]" id="familyMemberRashi" value="<?= set_value('family_member_rashi',@$userDetails->memberDetail[0]->rashi); ?>" id="family_member_rashi" type="text" class="form-control" placeholder="Rashi" aria-label="familyMemberRashi" aria-describedby="basic-addon1" readonly>
										</div>
									</fieldset>
								</div>

								<div class="col-md-2">
									<fieldset class="border">
										<legend  class="legend-inner float-none w-auto">Relationship</legend>
										<div class="input-group">
											<select class="form-control" name="relationship[]" disabled>
												<option value=" " disabled selected>RELATIONSHIP</option>
												<option value="FATHER" <?= @$userDetails->memberDetail[0]->relationship == 'FATHER' ? 'selected' : ''?>>FATHER</option>
												<option value="MOTHER" <?= @$userDetails->memberDetail[0]->relationship == 'MOTHER' ? 'selected' : ''?>>MOTHER</option>
												<option value="SPOUSE" <?= @$userDetails->memberDetail[0]->relationship == 'SPOUSE' ? 'selected' : ''?>>SPOUSE</option>
												<option value="SON" <?= @$userDetails->memberDetail[0]->relationship == 'SON' ? 'selected' : ''?>>SON</option>
												<option value="DAUGHTER" <?= @$userDetails->memberDetail[0]->relationship == 'DAUGHTER' ? 'selected' : ''?>>DAUGHTER</option>
											</select>
										</div>
									</fieldset>
								</div>

								<div class="col-md-2">	
									<fieldset class="border">
										<legend  class="legend-inner float-none w-auto">Anniversary</legend>
										<div class="input-group">
											<input name="anniversary[]" id="anniversary" type="text" class="form-control" placeholder="Anniversary" aria-label="anniversary" aria-describedby="basic-addon1" value="<?= set_value('anniversary',@$userDetails->memberDetail[0]->anniversaryDate); ?>" disabled>
										</div>
									</fieldset>
								</div>

							</div>
						</div>
						<div class="customer_records_dynamic">

							<?php 
										// print_r($userDetails);
							$setzero = '0';
							foreach ($userDetails->memberDetail  as $key => $val) {
								if($key > 0){
									?>
									<div class="remove">
										<div class="row">


											<div class="col-md-2">
												<fieldset class="border">
													<legend  class="legend-inner float-none w-auto">Family Member <?=$key+1?></legend>
													<div class="input-group">
														<i class="fa fa2 fa-user"></i>
														<input name="family_member_name[]<?= $setzero; ?>" value="<?= set_value('family_member_name',@$val->memberName); ?>" id="family_member_name" type="text" class="form-control" placeholder="Family Member <?=$key+1?>" aria-label="family_member_name" aria-describedby="basic-addon1" readonly>
													</div>
												</fieldset>

											</div>

											<div class="col-md-2">	
												<fieldset class="border">
													<legend  class="legend-inner float-none w-auto">DOB</legend>
													<div class="input-group">
														<input  name="dateofbirth[]" id="dateofbirth" type="text"  class="form-control datepicker" placeholder="MM/DD/YYYY" aria-label="dateofbirth" aria-describedby="basic-addon1"  value="<?= set_value('dateofbirth',@$val->dob); ?>" readonly>
													</div>
												</fieldset>
											</div>

											<div class="col-md-2">
												<fieldset class="border">
													<legend  class="legend-inner float-none w-auto">Stars</legend>
													<div class="input-group">
														<input  name="family_member_stars[]<?= $setzero; ?>" value="<?= set_value('family_member_stars',@$val->nakshatra); ?>" id="family_member_stars" type="text"  class="form-control" placeholder="Stars" aria-label="family_member_stars" aria-describedby="basic-addon1" readonly>
													</div>
												</fieldset>
											</div>
											<div class="col-md-2">
												<fieldset class="border">
													<legend  class="legend-inner float-none w-auto">Rashi</legend>
													<div class="input-group">
														<input name="family_member_rashi[]<?= $setzero; ?>" value="<?= set_value('family_member_rashi',@$val->rashi); ?>" id="family_member_rashi" type="text" class="form-control" placeholder="Rashi" aria-label="family_member_rashi" aria-describedby="basic-addon1" readonly>
													</div>	
												</fieldset>												
											</div>


											<div class="col-md-2">
												<fieldset class="border">
													<legend  class="legend-inner float-none w-auto">Relationship</legend>
													<div class="input-group">
														<select class="form-control" name="relationship[]"disabled>
															<option value=" " disabled selected>RELATIONSHIP</option>
															<option value="FATHER" <?= @$val->relationship == 'FATHER' ? 'selected' : ''?>>FATHER</option>
															<option value="MOTHER" <?= @$val->relationship == 'MOTHER' ? 'selected' : ''?>>MOTHER</option>
															<option value="SPOUSE" <?= @$val->relationship == 'SPOUSE' ? 'selected' : ''?>>SPOUSE</option>
															<option value="SON" <?= @$val->relationship == 'SON' ? 'selected' : ''?>>SON</option>
															<option value="DAUGHTER" <?= @$val->relationship == 'DAUGHTER' ? 'selected' : ''?>>DAUGHTER</option>
														</select>
													</div>
												</fieldset>
											</div>

											<div class="col-md-2">	
												<fieldset class="border">
													<legend  class="legend-inner float-none w-auto">Anniversary</legend>
													<div class="input-group">
														<input name="anniversary[]" id="anniversary" type="text" class="form-control" placeholder="Anniversary" aria-label="anniversary" aria-describedby="basic-addon1" value="<?= set_value('anniversary',@$val->anniversaryDate); ?>" disabled>
													</div>
												</fieldset>
											</div>
										</div>
									</div>

									<?php $setzero = $setzero.'0'; }  } ?>

								</div>

							<?php }else{ ?>

								<div class="customer_records">
									<div class="row">
										<div class="col-md-4">
											<fieldset class="border">
												<legend  class="legend-inner float-none w-auto">Family Member</legend>
												<div class="input-group">
													<i class="fa fa2 fa-user"></i>
													<input name="family_member_name[]" id="family_member_name" type="text" class="form-control" placeholder="Family Member" aria-label="family_member_name" aria-describedby="basic-addon1" readonly>
												</div>
											</fieldset>
										</div>
										<div class="col-md-4">	
											<fieldset class="border">
												<legend  class="legend-inner float-none w-auto">Stars</legend>
												<div class="input-group">
													<input  name="family_member_stars[]" id="family_member_stars" type="text"  class="form-control" placeholder="Stars" aria-label="family_member_stars" aria-describedby="basic-addon1" readonly>
												</div>
											</fieldset>
										</div>
										<div class="col-md-4">	
											<fieldset class="border">
												<legend  class="legend-inner float-none w-auto">Rashi</legend>
												<div class="input-group">
													<input name="family_member_rashi[]" id="family_member_rashi" type="text" class="form-control" placeholder="Rashi" aria-label="family_member_rashi" aria-describedby="basic-addon1" readonly>
												</div>
											</fieldset>
										</div>
													<!-- <div class="col-1 addremovebtn">	
														<a class="extra-fields-customer btn btn-info" href="javascript:void(0)"><i class="fa fa2 fa-plus"></i></a>
													</div> -->
												</div>

											</div>
											<div class="customer_records_dynamic"></div>

										<?php } ?>

									</div>
								</fieldset>


							</form>
						</div>
					</div>
				</div>
				<!-- End Main content-->
				<?php $this->load->view('admin/includes/footer'); ?>
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

				<script type="text/javascript">
					$("#heading").text('My Profile');
					$('.extra-fields-customer').click(function() {


						$('.customer_records').clone().appendTo('.customer_records_dynamic');
						$('.customer_records_dynamic .customer_records').addClass('single remove');
						$('.single .extra-fields-customer').remove();

						$('.single  .addremovebtn').append('<a href="#" class="remove-field btn-remove-customer btn btn-danger"><i class="fa fa2 fa-trash"></i></a>');
						$('.customer_records_dynamic > .single').attr("class", "remove");

						$('.customer_records_dynamic input').each(function() {
							var count = 0;
							var fieldname = $(this).attr("name");
							$(this).attr('name', fieldname + count);
							count++;
						});

					});

					$(document).on('click', '.remove-field', function(e) {
						$(this).parent().parent().remove();
						e.preventDefault();
					});

				</script>

			</body>
			</html>
