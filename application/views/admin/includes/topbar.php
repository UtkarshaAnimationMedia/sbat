				<style type="text/css">
					.btn-secondary:focus, .btn-check:active + .btn-secondary:focus, .btn-secondary:active:focus, .btn-secondary.active:focus, .show > .btn-secondary.dropdown-toggle:focus {
						box-shadow: 0 0 0 0.25rem rgb(130 138 145 / 0%);
					}
					.btn-secondary {
						color: #fff;
						background-color: #6c757d00;
						border-color: #ffffff;
					}
					.btn-secondary:focus {
						color: #fff;
						background-color: #b02135;
						border-color: #ffffff;
						box-shadow: none;
					}
					.btn-secondary:hover {
						color: #fff;
						background-color: #b02135;
						border-color: #ffffff;
						box-shadow: none;
					}
					.btn-check:checked+.btn, .btn.active, .btn.show, .btn:first-child:active, :not(.btn-check)+.btn:active {
						color: #fff;
						background-color: #b02135;
						border-color: #ffffff;
						box-shadow: none;
					}

					.dropdown-item {

						color: #ffffff;
						background-color: #b02135;
					}
					.dropdown-item:hover, .dropdown-item:focus {
						color: #ffffff;
						background-color: #5E1820;
					}
					.dropdown-menu{
						background-color: #b02135;
					}

					input::placeholder {
						color: #008080!important; /* change color to red */
					}
				</style>
				<!-- Top navigation-->
				<nav class="navbar navbar-expand-lg navbar-light border-bottom header-footer-bg">
					<div class="container-fluid">
						<a href="javascript:void(0)" id="sidebarToggle"> <img src="<?=base_url('admin_assets/img/icons/hamburger-icon.png');?>" height="18px"></a>
						<div class="collapse navbar-collapse" id="navbarSupportedContent">
							


							<h3 class="mt-2" id="heading" style="font-weight: 600!important;margin-left: 20px; color: var(--devotee-dashboard-menu-color)!important;font-family: Times New Roman;"></h3>

							<div id="dropdown-list" style="position: absolute;right: 185px"></div>

							<div style="right: 33px!important;position: absolute;vertical-align: middle!important;">
								<?php if ($header == 'MY PROFILE') { ?>

									<a  style="padding-right:5px;color: #ffffff00"  href="<?=base_url('admin/update-profile')?>"> <img src="<?=base_url('admin_assets/img/icons/save-icon.png')?>" height="40"width="40" style="vertical-align: middle!important;">
									</a>

								<?php }else if($header == 'EDIT PROFILE'){ ?> 


									<a href="javascript:void(0)" style="padding-right:5px;color: #0d6efd00;" id="saveDetails" onclick="submitForm()" ><img src="<?=base_url('admin_assets/img/icons/save-icon.png')?>" height="40"width="40" style="vertical-align: middle!important;"></a> 
									
									<a href="javascript:void(0)" style="padding-right:5px;color: #0d6efd00;" onclick="closeForm()"><img src="<?=base_url('admin_assets/img/icons/cancel-icon.png')?>" height="40"width="40" style="vertical-align: middle!important;"></a>
									
								<?php }else if($header == 'MY SERVICE REQUEST'){ ?> 

									<a href="<?=base_url('admin/ServiceRequest')?>" style="padding-right:5px;color: #0d6efd00;"><img src="<?=base_url('admin_assets/img/icons/add-icon.png')?>" height="40"width="40" style="vertical-align: middle!important;"></a>

									<a id="refresh" onclick="refresh()" style="padding-right:5px;color: #0d6efd00;" style="color: #ffffff00"  href="javascript:void(0)"> <img src="<?=base_url('admin_assets/img/icons/refresh-icon.png')?>"height="40"width="40" style="vertical-align: middle!important;">
									</a>
									
								<?php }else if($header == 'REQUEST A SERVICE'){ ?> 


									<a id="serviceRequestBtn" style="padding-right:5px;color: #0d6efd00;" onclick="submitForm()"   href="javascript:void(0)"><img src="<?=base_url('admin_assets/img/icons/save-icon.png')?>" height="40"width="40" style="vertical-align: middle!important;"></a>
									<a href="javascript:void(0)" style="padding-right:5px;color: #0d6efd00;" onclick="closeForm()"><img src="<?=base_url('admin_assets/img/icons/cancel-icon.png')?>" height="40"width="40" style="vertical-align: middle!important;"></a>

								<?php }else if($header == 'MY PAYMENTS'){ ?> 
									<a id="refresh" onclick="refresh()" style="padding-right:5px;color: #0d6efd00;"  href="javascript:void(0)"><img src="<?=base_url('admin_assets/img/icons/refresh-icon.png')?>" height="40"width="40" style="vertical-align: middle!important;">
									</a>

								<?php }else if($header == 'MY DONATIONS'){ ?>
									<a href="<?=base_url('donations')?>" style="padding-right:5px;color: #0d6efd00;"><img src="<?=base_url('admin_assets/img/icons/add-icon.png')?>" height="40"width="40" style="vertical-align: middle!important;"></a> 

									<a id="refresh" onclick="refresh()" style="padding-right:5px;color: #0d6efd00;"   href="javascript:void(0)"><img src="<?=base_url('admin_assets/img/icons/refresh-icon.png')?>" height="40"width="40" style="vertical-align: middle!important;">
									</a>

									
								<?php }else if($header == 'MY ORDERS'){ ?> 

									<a href="javascript:void(0)" style="padding-right:5px;"><img src="<?=base_url('admin_assets/img/icons/add-icon.png')?>" height="40"width="40" style="vertical-align: middle!important;">
									</a>


									<a id="refresh" onclick="refresh()" style="padding-right:5px;color: #0d6efd00;"  href="javascript:void(0)"><img src="<?=base_url('admin_assets/img/icons/refresh-icon.png')?>" height="40px" width="40px" style="vertical-align: middle!important;">
									</a>

								<?php }else if($header == 'MY BOOKINGS'){ ?> 

									<a href="<?=base_url('services')?>" style="padding-right:5px;"><img src="<?=base_url('admin_assets/img/icons/add-icon.png')?>" height="40"width="40" style="vertical-align: middle!important;"></a>


									<a id="refresh" onclick="refresh()" style="padding-right:5px;color: #0d6efd00;"   href="javascript:void(0)"><img src="<?=base_url('admin_assets/img/icons/refresh-icon.png')?>" height="40px" width="40px" style="vertical-align: middle!important;"></a>

									
								<?php }  ?>

								<a href="<?=base_url()?>" style="padding-right:5px;color: #0d6efd00;"><img src="<?=base_url('admin_assets/img/icons/home-icon.png')?>" height="18px" width="18px" style="vertical-align: middle!important;"></a> 



								<style type="text/css">
									
									.dropdown-menu[data-bs-popper] {
										top: 100%;
										position: absolute;
										margin-left: -630%;
										margin-top: 133%;
									}


								</style>
								

								<!-- Example single danger button -->
								<div class="btn-group">

									<a href="javascript:void(0)"  data-bs-toggle="dropdown" aria-expanded="false"><img src="<?=base_url('admin_assets/img/icons/bars-icon.png')?>" height="18px" width="18px" style="vertical-align: middle!important;"></a>

									<ul class="dropdown-menu">
										<li>	<a class="dropdown-item <?php if($page == 'MY-PROFILE') { ?> active  <?php } ?>" href="<?=base_url('admin/my-profile')?>"><img src="<?=base_url('admin_assets/img/icons/profile-icon.png')?>" height="30px" style="vertical-align: middle!important;">  <span style="padding-left: 9px;font-size: 18px;">My Profile</span></a></li>
										<li><a class="dropdown-item" href="<?=base_url('logout')?>" href="#"><img src="<?=base_url('admin_assets/img/icons/logout-icon.png')?>" height="30px" style="vertical-align: middle!important;">  <span style="padding-left: 9px;font-size: 18px;">Logout</span></a></li>
									</ul>
								</div>


							</div>
						</div>
					</div>
				</nav>
				<script type="text/javascript">
					$("#refresh").click(function() {
						location.reload();
					});
				</script>