<?php $this->load->view('admin/includes/head'); ?>
<body>
<?php
$header_data = $this->mongo_db2->where(['aspectType'=> 'headerSettings'])->get('wesiteSettings');
?>
<style type="text/css">
	.fa2{
		margin-top: 7px;

	}
	.fa{
		padding-top: 3px;
	}
	input{
		padding-top: 0px!important;
		padding-left: 15px!important;
	}

</style>
<div class="d-flex" id="wrapper">
	<?php $this->load->view('admin/includes/sidebar'); ?>
	<!-- Page content wrapper-->
	<div id="page-content-wrapper">
		<!-- Top navigation-->
		<?php $this->load->view('admin/includes/topbar'); ?>
		<!-- Main content-->
		<div class="container" >
			<div class="row p-4 ">

				<div class="col-md-12 mx-auto d-block shadow-lg bg-body rounded">
					<?php echo $this->session->flashdata('success'); ?>
					<!-- <form action="<?=base_url('admin/update/profile')?>" class="contact-form" method="post"> -->
						<?= form_open('admin/update/profile', ' method="post" id="UpdateProfileForm"') ?>
						

						<fieldset class="border-2">
							<legend  class="legend-outer  float-none w-auto"> Personal Details </legend>

							<div class="row">



								<div class="col-md-6">
									<?php 
									$parts = explode(" ", @$userDetails->refDataName);
									$lastname = array_pop($parts);
									$firstname = implode(" ", $parts);
								// echo '<pre>';
								// print_r($userDetails);
									?>
									<fieldset class="border">
										<legend  class="legend-inner float-none w-auto">First Name</legend>
										<!-- <div class="input-group"></div> -->

										<div class="input-group">
											<i class="fa fa-user"></i>
											<input type="text" class="form-control" id="fname" name="fname" placeholder="First Name*" value="<?=set_value('fname', @$firstname)?>" required aria-label="fname" aria-describedby="basic-addon1">
										</div>
									</fieldset>
								</div>
								<div class="col-md-6">
									<fieldset class="border">
										<legend  class="legend-inner float-none w-auto">Last Name</legend>
										<div class="input-group">
											<i class="fa fa-user"></i>
											<input type="text" class="form-control" id="lname" name="lname" value="<?= set_value('lname', @$lastname)?>" placeholder="Last Name" aria-label="lname" required aria-describedby="basic-addon1">
										</div>
									</fieldset>

								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<fieldset class="border">
										<legend  class="legend-inner float-none w-auto">Gothram</legend>
										<div class="input-group">
											<input type="text" class="form-control" id="gothram" name="gothram" placeholder="Gothram"  value="<?= set_value('gothram', @$userDetails->gotra)?>" aria-label="gothram">
										</div>
									</fieldset>

								</div>
								<div class="col-md-4">
									<fieldset class="border">
										<legend  class="legend-inner float-none w-auto">Stars</legend>
										<div class="input-group">
											<input type="text" class="form-control" id="stars" name="stars" placeholder="Stars" value="<?= set_value('stars', @$userDetails->Nakshtra)?>" aria-label="stars">
										</div>
									</fieldset>
								</div>
								<div class="col-md-4">
									<fieldset class="border">
										<legend  class="legend-inner float-none w-auto">Rashi</legend>
										<div class="input-group">
											<input type="text" class="form-control" id="rashi" name="rashi" placeholder="Rashi" value="<?= set_value('rashi', @$userDetails->rashi)?>" aria-label="rashi">
										</div>
									</fieldset>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<fieldset class="border">
										<legend  class="legend-inner float-none w-auto">Email</legend>
										<div class="input-group">
											<i class="fa fa-envelope"></i>
											<input type="email" class="form-control" id="main_email" name="main_email" placeholder="Email*" value="<?= set_value('main_email', base64_decode(@$userDetails->email))?>" readonly  aria-label="main_email">
										</div>
									</fieldset>
								</div>
								<div class="col-md-6">
									<fieldset class="border">
										<legend  class="legend-inner float-none w-auto">Phone Number</legend>
										<div class="input-group">
											<i class="fa fa-phone"></i>
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
											<input type="text" class="form-control" id="spouseName" name="spouseName" placeholder="Spouse Name"  value="<?= set_value('spouseName', @$userDetails->spouseName)?>"  aria-label="spouseName">
										</div>
									</fieldset>

								</div>
								<div class="col-md-4">
									<fieldset class="border">
										<legend  class="legend-inner float-none w-auto">Spouse Phone</legend>
										<div class="input-group">
											<input type="text" class="form-control phone" id="spousePhone" name="spousePhone" placeholder="Spouse Phone" value="<?= set_value('spousePhone',  formatPhoneNumber(base64_decode(@$userDetails->spousePhone)))?>"  aria-label="spousePhone">
										</div>
									</fieldset>
								</div>
								<div class="col-md-4">
									<fieldset class="border">
										<legend  class="legend-inner float-none w-auto">Spouse Email</legend>
										<div class="input-group">
											<input type="email" class="form-control" id="spouseEmail" name="spouseEmail" placeholder="Spouse Email" value="<?= set_value('spouseEmail', base64_decode(@$userDetails->spouseEmail))?>" aria-label="spouseEmail">
										</div>
									</fieldset>
								</div>
							</div>


							<div class="row">
								<div class="col-md-4">
									<fieldset class="border">
										<legend  class="legend-inner float-none w-auto">Spouse Gothram</legend>
										<div class="input-group">
											<input type="text" class="form-control" id="spouseGothram" name="spouseGothram" placeholder="Spouse Gothram"  value="<?= set_value('spouseGothram', @$userDetails->spouseGotra)?>" aria-label="spouseGothram" >
										</div>
									</fieldset>

								</div>
								<div class="col-md-4">
									<fieldset class="border">
										<legend  class="legend-inner float-none w-auto">Spouse Stars</legend>
										<div class="input-group">
											<input type="text" class="form-control" id="spouseStars" name="spouseStars" placeholder="Spouse Stars" value="<?= set_value('spouseStars', @$userDetails->spouseNakshtra)?>"  aria-label="spouseStars">
										</div>
									</fieldset>
								</div>
								<div class="col-md-4">
									<fieldset class="border">
										<legend  class="legend-inner float-none w-auto">Spouse Rashi</legend>
										<div class="input-group">
											<input type="text" class="form-control" id="spouseRashi" name="spouseRashi" placeholder="Spouse Rashi" value="<?= set_value('spouseRashi', @$userDetails->spouseRashi)?>"  aria-label="spouseRashi">
										</div>
									</fieldset>
								</div>
							</div>

							<div class="row">
								<div class="col-md-6">
									<fieldset class="border">
										<legend  class="legend-inner float-none w-auto">Company Name</legend>
										<div class="input-group">
											<i class="fa fa-building-o"></i>
											<input type="text" class="form-control" name="company_name" id="company_name" value="<?= set_value('company_name', @$userDetails->companyName)?>" placeholder="Company Name" aria-label="company_name" aria-describedby="basic-addon1">
										</div>
									</fieldset>
								</div>
								<div class="col-md-6">
									<fieldset class="border">
										<legend  class="legend-inner float-none w-auto">Company Email</legend>
										<div class="input-group">
											<i class="fa fa-envelope"></i>
											<input type="email" class="form-control" name="company_email" id="company_email" value="<?= set_value('company_email', base64_decode(@$userDetails->companyEmail))?>" placeholder="Company Email" aria-label="company_email" aria-describedby="basic-addon1">
										</div>
									</fieldset>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<fieldset class="border">
										<legend  class="legend-inner float-none w-auto">Company Phone Number</legend>
										<div class="input-group">
											<i class="fa fa-phone"></i>
											<input type="text" class="form-control phone" name="company_phone" id="company_phone" value="<?= set_value('company_phone', formatPhoneNumber(base64_decode(@$userDetails->companyPhone)))?>" placeholder="Company Phone Number" aria-label="company_phone" aria-describedby="basic-addon1">
										</div>
									</fieldset>
								</div>
								<div class="col-md-6">
									<fieldset class="border">
										<legend  class="legend-inner float-none w-auto">Company Website</legend>
										<div class="input-group">
											<i class="fa fa-globe"></i>
											<input type="url" class="form-control" name="company_website" id="company_website" value="<?= set_value('company_website', @$userDetails->website)?>" placeholder="Company Website" aria-label="company_website" aria-describedby="basic-addon1">
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
											<input type="text" class="form-control" name="address_line1" id="address_line1" value="<?= set_value('address_line1', @$userDetails->addressLine1)?>" placeholder="Address Line 1"  aria-label="address_line1">
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
											<input type="text" class="form-control" name="address_line2" id="address_line2" value="<?= set_value('address_line2', @$userDetails->addressLine2)?>" placeholder="Address Line 2"   aria-label="address_line2">
										</div>
									</fieldset>
								</div>
							</div>



							<div class="row">
								<div class="col-md-4">
									<fieldset class="border">
										<legend  class="legend-inner float-none w-auto">State</legend>
										<div class="input-group">
											<select class="form-control" name="state" id="stateSelect">
												<option value="" selected disabled>Select State</option>
												<?php

												print_r($userDetails);

												$keys = array_column($GetState, 'refDataName'); /// Multidiamensional array sort by key
												array_multisort($keys, SORT_ASC, $GetState);
												
												foreach ($GetState as $state) { ?>
													<option value="<?=@$state->refDataName?>" <?= @$state->refDataName == @$userDetails->stateTypes ? 'selected' : ''; ?>><?=@$state->refDataName?></option>
												<?php } ?>
											</select>
										</div>
									</fieldset>
								</div>
								<div class="col-md-4">
									<fieldset class="border">
										<legend  class="legend-inner float-none w-auto">City</legend>
										<div class="input-group">
											<select class="form-control" name="city" id="city" >
												<option value="" selected disabled>Select City</option>
											</select>
										</div>
									</fieldset>
								</div>
								<div class="col-md-4">
									<fieldset class="border">
										<legend  class="legend-inner float-none w-auto">Zip Code</legend>
										<div class="input-group">
											<i class="fa fa-file"></i>
											<input type="number" class="form-control" onKeyPress="if(this.value.length==6) return false;" name="zipcode" id="zipcode" value="<?= set_value('zipcode', @$userDetails->zip)?>" placeholder="Zip Code"  aria-label="zipcode" aria-describedby="basic-addon1">
										</div>
									</fieldset>
								</div>
							</div>


							<div class="row my-3">
								<div class="col-md-6">
									<legend  class="legend-inner float-none w-auto">Notification Preference</legend>


									<div class="form-check form-check-inline mx-4">
										<input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="emailNotification"  <?= @$userDetails->emailPref == TRUE ? 'checked' : '' ?>>
										<label class="form-check-label m-auto pt-1" for="inlineCheckbox2">Email</label>
									</div>

									<div class="form-check form-check-inline mx-4">
										<input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="phoneNotification" <?= @$userDetails->smsPref == TRUE ? 'checked' : '' ?>>
										<label class="form-check-label m-auto pt-1" for="inlineCheckbox1">SMS</label>
									</div>
									

									<div class="form-check form-check-inline mx-4">
										<input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="phoneCallPref"  <?= @$userDetails->phoneCallPref == TRUE ? 'checked' : '' ?>>
										<label class="form-check-label m-auto pt-1" for="inlineCheckbox2">Phone Call</label>
									</div>
								</div>
							</div>

						</fieldset>



						<fieldset class="border-2">
							<legend  class="legend-outer float-none w-auto">Family Members, Rashi & Star</legend>

							<div class="row">	



								<?php if(@$userDetails->memberDetail[0]->memberName != '' && @$userDetails->memberDetail[0]->rashi != '' && @$userDetails->memberDetail[0]->dob && @$userDetails->memberDetail[0]->relationship   != '' && @$userDetails->memberDetail[0]->anniversaryDate   != '' && @$userDetails->memberDetail[0]->nakshatra != ''){ ?>

									<div class="customer_records">

										<div class="row">
											<div class="col-md-2">
												<fieldset class="border">
													<legend  class="legend-inner float-none w-auto">Family Member 1</legend>
													<div class="input-group">
														<i class="fa fa-user"></i>
														<input name="family_member_name[]" id="familyMember" value="<?= set_value('family_member_name',@$userDetails->memberDetail[0]->memberName); ?>" id="family_member_name" type="text" class="form-control" placeholder="Family Member 1" aria-label="familyMember" aria-describedby="basic-addon1">
													</div>
												</fieldset>
											</div>


											<div class="col-md-2">	
												<fieldset class="border">
													<legend  class="legend-inner float-none w-auto">DOB</legend>
													<div class="input-group">
														<input  name="dateofbirth[]" id="dateofbirth" type="text"  class="form-control datepicker" placeholder="MM/DD/YYYY" aria-label="dateofbirth" aria-describedby="basic-addon1"  value="<?= set_value('dateofbirth',@$userDetails->memberDetail[0]->dob); ?>">
													</div>
												</fieldset>
											</div>


											<div class="col-md-2">	
												<fieldset class="border">
													<legend  class="legend-inner float-none w-auto">Stars</legend>
													<div class="input-group">
														<input name="family_member_stars[]" id="familyMemberStar"  value="<?= set_value('family_member_stars',@$userDetails->memberDetail[0]->nakshatra); ?>" id="family_member_stars" type="text"  class="form-control" placeholder="Stars" aria-label="familyMemberStar" aria-describedby="basic-addon1">
													</div>
												</fieldset>
											</div>
											<div class="col-md-2">	
												<fieldset class="border">
													<legend  class="legend-inner float-none w-auto">Rashi</legend>
													<div class="input-group">
														<input name="family_member_rashi[]" id="familyMemberRashi" value="<?= set_value('family_member_rashi',@$userDetails->memberDetail[0]->rashi); ?>" id="family_member_rashi" type="text" class="form-control" placeholder="Rashi" aria-label="familyMemberRashi" aria-describedby="basic-addon1">
													</div>
												</fieldset>
											</div>

											<div class="col-md-2">
												<fieldset class="border">
													<legend  class="legend-inner float-none w-auto">Relationship</legend>
													<div class="input-group">
														<select class="form-control" name="relationship[]">
															<option value=" " selected>Select</option>
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
														<input name="anniversary[]" id="anniversary" type="text" class="form-control datepicker" placeholder="MM/DD/YYYY" aria-label="anniversary" aria-describedby="basic-addon1" value="<?= set_value('anniversary',@$userDetails->memberDetail[0]->anniversaryDate); ?>">
													</div>
												</fieldset>
											</div>

										</div>
									</div>

									<div class="customer_records_dynamic">

										<?php 
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
																	<i class="fa fa-user"></i>
																	<input name="family_member_name[]<?= $setzero; ?>" value="<?= set_value('family_member_name',@$val->memberName); ?>" id="family_member_name" type="text" class="form-control" placeholder="Family Member <?=$key+1?>" aria-label="family_member_name" aria-describedby="basic-addon1">
																</div>
															</fieldset>

														</div>


														<div class="col-md-2">	
															<fieldset class="border">
																<legend  class="legend-inner float-none w-auto">DOB</legend>
																<div class="input-group">
																	<input  name="dateofbirth[]<?= $setzero; ?>" id="dateofbirth<?=$key?>" type="text"  class="form-control datepicker" placeholder="MM/DD/YYYY" aria-label="dateofbirth" aria-describedby="basic-addon1"  value="<?= set_value('dateofbirth',@$val->dob); ?>">
																</div>
															</fieldset>
														</div>


														<div class="col-md-2">
															<fieldset class="border">
																<legend  class="legend-inner float-none w-auto">Stars</legend>
																<div class="input-group">
																	<input  name="family_member_stars[]<?= $setzero; ?>" value="<?= set_value('family_member_stars',@$val->nakshatra); ?>" id="family_member_stars" type="text"  class="form-control" placeholder="Stars" aria-label="family_member_stars" aria-describedby="basic-addon1">
																</div>
															</fieldset>
														</div>
														<div class="col-md-2">
															<fieldset class="border">
																<legend  class="legend-inner float-none w-auto">Rashi</legend>
																<div class="input-group">
																	<input name="family_member_rashi[]<?= $setzero; ?>" value="<?= set_value('family_member_rashi',@$val->rashi); ?>" id="family_member_rashi" type="text" class="form-control" placeholder="Rashi" aria-label="family_member_rashi" aria-describedby="basic-addon1">
																</div>	
															</fieldset>												
														</div>


														<div class="col-md-2">
															<fieldset class="border">
																<legend  class="legend-inner float-none w-auto">Relationship</legend>
																<div class="input-group">
																	<select class="form-control" name="relationship[]<?= $setzero; ?>">
																		<option value=" " disabled selected>Select</option>
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
																	<input name="anniversary[]<?= $setzero; ?>" id="anniversary<?=$key?>" type="text" class="form-control datepicker" placeholder="MM/DD/YYYY" aria-label="anniversary" aria-describedby="basic-addon1" value="<?= set_value('anniversary',@$val->anniversaryDate); ?>">
																</div>
															</fieldset>
														</div>


														<div class="col-1 addremovebtn">
															<a href="#" class="remove-field btn-remove-customer btn btn-danger">
																<i class="fa fa-trash"></i>
															</a>
														</div>
													</div>



												</div>

												<?php
												$setzero = $setzero.'0'; 
											}
										}
										?>


									</div>

								<?php }else{ ?>

									<div class="customer_records">
										<div class="row">
											<div class="col-md-2">
												<fieldset class="border">
													<legend  class="legend-inner float-none w-auto">Family Member 1</legend>
													<div class="input-group">
														<i class="fa fa-user"></i>
														<input name="family_member_name[]" id="family_member_name" type="text" class="form-control" placeholder="Family Member 1" aria-label="family_member_name" aria-describedby="basic-addon1">
													</div>
												</fieldset>
											</div>
											<div class="col-md-2">	
												<fieldset class="border">
													<legend  class="legend-inner float-none w-auto">DOB</legend>
													<div class="input-group">
														<input  name="dateofbirth[]" id="dateofbirth" type="text"  class="form-control datepicker" placeholder="MM/DD/YYYY" aria-label="dateofbirth" aria-describedby="basic-addon1">
													</div>
												</fieldset>
											</div>
											<div class="col-md-2">	
												<fieldset class="border">
													<legend  class="legend-inner float-none w-auto">Stars</legend>
													<div class="input-group">
														<input  name="family_member_stars[]" id="family_member_stars" type="text"  class="form-control" placeholder="Stars" aria-label="family_member_stars" aria-describedby="basic-addon1">
													</div>
												</fieldset>
											</div>
											<div class="col-md-2">	
												<fieldset class="border">
													<legend  class="legend-inner float-none w-auto">Rashi</legend>
													<div class="input-group">
														<input name="family_member_rashi[]" id="family_member_rashi" type="text" class="form-control" placeholder="Rashi" aria-label="family_member_rashi" aria-describedby="basic-addon1">
													</div>
												</fieldset>
											</div>
											<div class="col-md-2">
												<fieldset class="border">
													<legend  class="legend-inner float-none w-auto">Relationship</legend>
													<div class="input-group">
														<select class="form-control" name="relationship[]">
															<option value=" " disabled selected>Select</option>
															<option value="FATHER">FATHER</option>
															<option value="MOTHER">MOTHER</option>
															<option value="SPOUSE">SPOUSE</option>
															<option value="SON">SON</option>
															<option value="DAUGHTER">DAUGHTER</option>
														</select>





													</div>
												</fieldset>
											</div>


											<div class="col-md-2">	
												<fieldset class="border">
													<legend  class="legend-inner float-none w-auto">Anniversary</legend>
													<div class="input-group">
														<input name="anniversary[]" id="anniversary" type="text" class="form-control datepicker" placeholder="MM/DD/YYYY" aria-label="anniversary" aria-describedby="basic-addon1">
													</div>
												</fieldset>
											</div>

										</div>







									</div>



									<div class="customer_records_dynamic"></div>


								<?php } ?>

								<div class="col-md-12 addremovebtn">	
									<a style="float:right;background-color:#008080;color:white;" class="mb-3 extra-fields-customer btn btn-sm" href="javascript:void(0)">
										ADD MORE
									</a>
								</div>
							</div>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
		<!-- End Main content-->
	</div>
</div>
<!-- Bootstrap core JS-->
<script src="<?=base_url('admin_assets/js/bootstrap.bundle.min.js')?>"></script>
<!-- Core theme JS-->
<script src="<?=base_url('admin_assets/js/theme.js')?>"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="<?=base_url('assets/js/jquery-ui.min.js');?>"></script>

<script type="text/javascript">


	$('#UpdateProfileForm').keypress(function (e) {
		if (e.which == 13) {
			$('#UpdateProfileBtn').click();
			return false;
		}
	});


	$(".phone").on('input', function(){

		var  phoneField = this;
		var phoneValue = phoneField.value;
		var output;
		phoneValue = phoneValue.replace(/[^0-9]/g, '');
		var area = phoneValue.substr(0, 3);
		var pre = phoneValue.substr(3, 3);
		var tel = phoneValue.substr(6, 4);
		if (area.length < 3) {
			output = "(" + area;
		} else if (area.length == 3 && pre.length < 3) {
			output = "(" + area + ")" + " " + pre;
		} else if (area.length == 3 && pre.length == 3) {
			output = "(" + area + ")" + " " + pre + " - "+tel;
		}
		phoneField.value = output;

	});


	var count = 0;
	var i = 1;
	$('.extra-fields-customer').click(function() {

		var familyMember = $("#familyMember").val().length;
		// $("#dateofbirth").val().length
		// $("#dateofbirth").val().length

		if (familyMember > 0 || familyMemberStar > 0) {



			$('.customer_records_dynamic').append('<div class="customer_records"><div class="row"><div class="col-md-2"><fieldset class="border"><legend  class="legend-inner float-none w-auto">Family Member <span class="numberCount"></span> </legend><div class="input-group"><i class="fa fa-user"></i><input name="family_member_name[]'+count+'" id="family_member_name" type="text" class="form-control  " placeholder="Family Member" aria-label="family_member_name" aria-describedby="basic-addon1"></div></fieldset></div><div class="col-md-2"><fieldset class="border"><legend  class="legend-inner float-none w-auto">DOB</legend><div class="input-group"><input  name="dateofbirth[]'+count+'" id="dateofbirth'+i+'" type="text"  class="form-control datepicker" placeholder="MM/DD/YYYY" aria-label="dateofbirth" aria-describedby="basic-addon1"></div></fieldset></div><div class="col-md-2"><fieldset class="border">			<legend  class="legend-inner float-none w-auto">Stars</legend><div class="input-group"><input  name="family_member_stars[]'+count+'" id="family_member_stars" type="text"  class="form-control" placeholder="Stars" aria-label="family_member_stars" aria-describedby="basic-addon1">			</div></fieldset></div>		<div class="col-md-2">			<fieldset class="border">				<legend  class="legend-inner float-none w-auto">Rashi</legend>				<div class="input-group">					<input name="family_member_rashi[]'+count+'" id="family_member_rashi" type="text" class="form-control" placeholder="Rashi" aria-label="family_member_rashi" aria-describedby="basic-addon1">				</div>			</fieldset>		</div>		<div class="col-md-2">		<fieldset class="border">			<legend  class="legend-inner float-none w-auto">Relationship</legend>			<div class="input-group">				<select class="form-control" name="relationship[]'+count+'">					<option value=" " disabled selected>RELATIONSHIP</option>					<option value="FATHER">FATHER</option>					<option value="MOTHER">MOTHER</option>					<option value="SPOUSE">SPOUSE</option>					<option value="SON">SON</option>					<option value="DAUGHTER">DAUGHTER</option>				</select>			</div>		</fieldset>	</div>	<div class="col-md-2">			<fieldset class="border">			<legend  class="legend-inner float-none w-auto">Anniversary</legend>			<div class="input-group">				<input name="anniversary[]'+count+'" id="anniversary'+i+'" type="text" class="form-control datepicker" placeholder="MM/DD/YYYY" aria-label="anniversary" aria-describedby="basic-addon1">			</div>		</fieldset>	</div>		<div class="col-1 addremovebtn">			<a class="extra-fields-customer btn btn-danger" href="javascript:void(0)">				<i class="fa fa-plus"></i>			</a>		</div>	</div></div></div>');

		}else{

			if (familyMember == 0 ) {

				$("#familyMember").focus();
			}
		}

		$( ".datepicker" ).datepicker({
			dateFormat: "mm/dd/yy"
		});

		AddNnewFamilyMember();
		



		$('.customer_records_dynamic .customer_records').addClass('single remove');
		$('.single .extra-fields-customer').remove();

		$('.single  .addremovebtn').append('<a href="#" class="remove-field btn-remove-customer btn btn-danger"><i class="fa fa-trash"></i></a>');
		$('.customer_records_dynamic > .single').attr("class", "remove");

		$('.customer_records_dynamic input').each(function() {

			var fieldname = $(this).attr("name");

			$(this).attr('name', fieldname + count);

			count++;
			i++;
		});

	});




	function AddNnewFamilyMember(){

		var i = "<?= (isset($userDetails->memberDetail))?count($userDetails->memberDetail):1; ?>";
		$(".numberCount").map(function () {

			i++;
			$(this).text(i);
			$(this).parent().parent().find('input').attr('placeholder','Family Member '+i);

		});
	}



	$(document).on('click', '.remove-field', function(e) {

		$(this).parent().parent().remove();
		AddNnewFamilyMember();
		e.preventDefault();
	});




	$('#stateSelect').change(function(){

		var stateCode = $(this).val();
		$.ajax({
			url:"<?= base_url('admin/getCityByState') ?>",
			type: "POST",
					// dataType: "json",
			data : {'stateCode':stateCode},
			success: function(data) 
			{
				$("#city").html(data);
			}             
		});

	});

	$(document).ready(function(){
		$('#stateSelect').change();
		$('#heading').text('Update Profile');


		setTimeout(function(){
			$("select[name='city'] option[value='<?= @$userDetails->cityTypes; ?>']").attr('selected', 'selected');
		}, 1500);


	});


	$( ".datepicker" ).datepicker({
		dateFormat: "mm/dd/yy"
	});




	function submitForm(){


		Swal.fire({
			title: 'Do you want to save the changes?',
			showDenyButton: false,
			showCancelButton: true,
			confirmButtonText: 'Save',
			denyButtonText: `Don't save`,
		}).then((result) => {

			if (result.isConfirmed) {
				$("#UpdateProfileForm").submit();
			} else if (result.isDenied) {
				Swal.fire('Changes are not saved', '', 'info')
			}
		});
	}



	function closeForm() {

		Swal.fire({
			title: 'Do you want to cancel the changes?',
			showDenyButton: true,
			showCancelButton: true,
			showConfirmButton:false,
			cancelButtonText: 'No',
			denyButtonText: `Yes`,
		}).then((result) => {
  /* Read more about isConfirmed, isDenied below */
			if (result.isConfirmed) {
				Swal.fire('Saved!', '', 'success')
			} else if (result.isDenied) {

				window.location.href = "<?=base_url('admin/my-profile')?>";
			}
		})
	}




		// window.onbeforeunload = (event) => {
		// 	event.preventDefault();
		// 	event.returnValue = '';
		// }


</script>


</body>
</html>
