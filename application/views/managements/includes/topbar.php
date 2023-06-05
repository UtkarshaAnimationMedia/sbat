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

					/*Page Tabs button */
					.now-ui-icons {
						display: inline-block;
						font: normal normal normal 14px/1 'Nucleo Outline';
						font-size: inherit;
						speak: none;
						text-transform: none;
						-webkit-font-smoothing: antialiased;
						-moz-osx-font-smoothing: grayscale;
					}


					.nav-tabs {
						border: 0;
						padding: 0px 20px;
					}

					.nav-tabs:not(.nav-tabs-neutral)>.nav-item>.nav-link.active {
						box-shadow: 0px 1px 15px 0px rgba(0, 0, 0, 0.3);
					}


					.nav-tabs>.nav-item>.nav-link {
						color: #fff;
						margin: 0;
						margin-right: 0px;
						border-radius: 30px;
						font-size: 16px;
						padding: 13px 20px;
					}

					.nav-tabs .nav-link:hover, .nav-tabs .nav-link:focus {
						border-color: #F44336 #F44336 #F44336;
						isolation: isolate;
					}

					.nav-tabs:not(.nav-tabs-neutral)>.nav-item>.nav-link.active {
						box-shadow: 0px 1px 15px 0px #FFEB3B;
					}

					.nav-tabs>.nav-item>.nav-link.active {
						background-color: #bb001a;
						border-radius: 30px;
						color: #FFFFFF;
					}
					.nav-tabs.nav-tabs-neutral>.nav-item>.nav-link {
						color: #FFFFFF;
					}

					.nav-tabs.nav-tabs-neutral>.nav-item>.nav-link.active {
						background-color: rgba(255, 255, 255, 0.2);
						color: #FFFFFF;
					}



					@media screen and (max-width: 768px) {

						.nav-tabs {
							display: inline-block;
							width: 100%;
							padding-left: 100px;
							padding-right: 100px;
							text-align: center;
						}

						.nav-tabs .nav-item>.nav-link {
							margin-bottom: 5px;
						}
					}
					.navbar {
						padding-top: 1.48rem!important;
						padding-bottom: 1.48rem!important;
					}

				</style>
				<!-- Top navigation-->
				<nav class="navbar navbar-expand-lg navbar-light border-bottom header-footer-bg">
					<div class="container-fluid">
						<a href="javascript:void(0)" id="sidebarToggle"> <img src="<?=base_url('admin_assets/img/icons/hamburger-icon.png');?>" height="18px"></a>
						<div class="collapse navbar-collapse" id="navbarSupportedContent">
							


							<h3 class="mt-2" id="heading" style="font-weight: 600!important;margin-left: 20px; color: var(--devotee-dashboard-menu-color)!important;font-family: Times New Roman;"></h3>
							<span class="memberDirectoryHeading" style="font-size: 27px; font-weight: bold; padding-left: 10px;;"></span>


							<?php if ($header == 'Meeting Calendar' ) { ?>
								<a href="<?=base_url('managements/meeting-calendar')?>"><img src="<?=base_url('admin_assets/img/icons/calendar-view.png')?>" style="height: 30px; padding-left: 21px;"></a>
								<a href="<?=base_url('managements/meeting-list')?>"><img src="<?=base_url('admin_assets/img/icons/list-icon.png')?>" style="height: 30px; padding-left: 21px;"></a>
							<?php }else if($header == 'Meetings List'){ ?> 
								<a href="<?=base_url('managements/meeting-list')?>"><img src="<?=base_url('admin_assets/img/icons/list-icon.png')?>" style="height: 30px; padding-left: 21px;"></a>
								<a href="<?=base_url('managements/meeting-calendar')?>"><img src="<?=base_url('admin_assets/img/icons/calendar-view.png')?>" style="height: 30px; padding-left: 21px;"></a>
							<?php } ?>

							<?php

							$memberDirectory = $this->uri->segment(3);
							$meetingName = $this->uri->segment(4);
							$meetingId = $this->uri->segment(5);

							?>

							<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
							<?php if ($header == 'Meeting Profile' || $header == 'Meeting Attendees' || $header == 'Meeting Minutes' || $header == 'Action Items' || $header == 'Notes' || $header == 'Voting Details Register') { ?>
								<ul class="nav nav-tabs justify-content-center" role="tablist">
									<li class="nav-item">
										<a class="nav-link <?= $header == 'Meeting Profile' ? 'active' : '' ?>" data-toggle="tab" href="<?=base_url('managements/meeting-profile/'.$memberDirectory.'/'.$meetingName.'/'.$meetingId);?>" role="tab">
											<i class="fa fa-user" aria-hidden="true"></i> Meeting Profile
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link <?= $header == 'Meeting Attendees' ? 'active' : '' ?>" data-toggle="tab" href="<?=base_url('managements/meeting-attendance/'.$memberDirectory.'/'.$meetingName.'/'.$meetingId);?>" role="tab">
											<i class="fa fa-clock-o" aria-hidden="true"></i> Meeting Attendees
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link <?= $header == 'Meeting Minutes' ? 'active' : '' ?>" data-toggle="tab" href="<?=base_url('managements/meeting-minutes/'.$memberDirectory.'/'.$meetingName.'/'.$meetingId);?>" role="tab">
											<i class="fa fa-clock-o" aria-hidden="true"></i> Meeting Minutes
										</a>
									</li>

									<li class="nav-item">
										<a class="nav-link <?= $header == 'Voting Details Register' ? 'active' : '' ?>" data-toggle="tab" href="<?=base_url('managements/voting-detail-register/'.$memberDirectory.'/'.$meetingName.'/'.$meetingId);?>" role="tab">
											<i class="fa fa-check-square-o" aria-hidden="true"></i> Voting Details Register
										</a>
									</li>

									<li class="nav-item">
										<a class="nav-link <?= $header == 'Action Items' ? 'active' : '' ?>" data-toggle="tab" href="#" role="tab">
											<i class="fa fa-tasks" aria-hidden="true"></i> Action Items
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link <?= $header == 'Notes' ? 'active' : '' ?>" data-toggle="tab" href="#" role="tab">
											<i class="fa fa-sticky-note-o" aria-hidden="true"></i> Documents
										</a>
										<!-- <?=base_url('managements/meeting-notes');?> -->
									</li>
								</ul>

							<?php } ?>
							<script type="text/javascript">
								$(document).ready(function(){
									$('.nav-tabs a').click(function(){
										var href = $(this).attr('href');
										window.location.href= href;
									});
								});
							</script>

							<div id="dropdown-list" style="position: absolute;right: 121px;"></div>

							<div style="right: 33px!important;position: absolute;vertical-align: middle!important;">
								<?php if($header == 'Meetings List'){ ?>
									<input type="text" name="filterDate" id="filterDate"   class="datepicker text-center"  placeholder="MM/DD/YYYY" aria-label="filterDate" aria-describedby="basic-addon1" style="margin-right: 22px; border: 1px solid black; border-radius: 5px; padding: 6px">
								<?php }else if($header == 'Meeting Attendance'){ ?>

									<a  style="padding-right:5px;color: #0d6efd00;"  href="javascript:void(0)" onclick="AddAttendance();"><img src="<?=base_url('admin_assets/img/icons/add-icon.png')?>" height="40"width="40" style="vertical-align: middle!important;">
									</a>

								<?php } ?>

								<a href="<?=base_url()?>" style="padding-right:5px;color: #0d6efd00;"><img src="<?=base_url('admin_assets/img/icons/home-icon.png')?>" height="18px" width="18px" style="vertical-align: middle!important;"></a> 

							</div>
						</div>
					</div>
				</nav>
				<script type="text/javascript">
					$("#refresh").click(function() {
						location.reload();
					});
				</script>