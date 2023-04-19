<?php $this->load->view('includes/head') ?>
<?php $this->load->view('includes/topbar') ?>
<?php $this->load->view('includes/header') ?>
<?php $this->load->view('includes/slider') ?>

<?php
$flash_news_data = $this->mongo_db2->where(['aspectType'=> 'flashNews'])->get('wesiteSettings');
// echo '<pre>';
// print_r($flash_news_data);
?>


<style type="text/css">
	.btn:hover {
		color: white;
		background-color: #F26938!important;
		border-color: black;
		transition: 0.2sec;
	}
	.community-div{
		padding: 40px;background-image: linear-gradient(89deg, #000000c9 5%, rgb(0 0 0 / 32%) 95%);overflow: hidden; background-size: cover;background-repeat: no-repeat; background-position: center;
	}



	.card-header{
		background-color:var(--headerFooter)!important;
		padding: 8px 0px 8px 0px;
		color: white!important;
		font-family: "Tienne", Sans-serif!important;
		font-size: 25px!important;
	}
	.title{
		color: var(--orange)!important;
		font-family: "Tienne", Sans-serif!important;
		font-weight: 600!important;
		line-height: 56px!important;
	}
	.title2{
		color: white!important;
		font-family: "Tienne", Sans-serif!important;
		font-weight: 600!important;
		font-size: 40px;
		line-height: 56px!important;
	}
	.btn-outline-light{
		border-radius: 0px!important;
		background-color: #F26938!important;
		color: white;
		border: 0px!important;
		padding: 11px 29px!important;
	}
	.community a:hover {
		background-color: #C2542D!important;
		color: white!important;
	}
	.flash-news-img{

	}
	.in-page-btn{
		color: #635C81;  border-color: transparent; background: transparent !important; border-radius: 25px;box-shadow: 1px 1px 10px #7e455561;padding: 10px 16px;
	}
	.hs-responsive-embed-youtube {
		position: relative;
		padding-bottom: 25px;
		padding-top: 25px;
	}


	.ViewAllEventBtn:hover{
		border-radius: 0px!important;
		word-break: keep-all!important;
		background: #642318!important;
		text-shadow: 1px 1px 10px black!important;
	}

	.change-bgcolor:hover{
		transition: all .3s!important;
		font-size: 15px;
		text-shadow: 1px 1px 10px yellow;
	}


</style>

<main id="main">
	<!-- ======= Temple Services Section ======= -->
	<section id="temple-services" class="temple-services" style="background-color: var(--page-wrapper-bg-color)!important;">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-sm-6">
					<div class="card shadow-lg mb-5" style="background-color: var(--home-card-bg);max-height: 600px;min-height: 450px;">

						<div class="card-body text-center p-0 m-0">
							<h3 class="card-header bottomborder"  style="background-color:var(--headerFooter)!important;;padding: 11px; font-weight: 700!important; text-shadow: 1px 0px 0px #ff2c00;">FLASH NEWS</h3>
							<marquee direction="up" onmouseover="this.stop();" onmouseout="this.start();" loop="" class="marq" style="max-height: 390px;min-height: 390px;overflow: hidden;padding: 0px 20px;" scrollamount="2"> 
								<?php foreach($flash_news_data as $news){?>
									<div class="row text-center">
										<?php if(!empty($news['Image'])){?>
											<div class="col-md-12">
												<img src="<?=ApiBaseUrl()['url'].$news['Image']?>" class="img-fluid rounded mx-auto d-block shadow-lg" height="400px" width="auto%" >
											</div>
											<br>
										<?php } ?>
										<?php if(!empty($news['refDataName'])){?>
											<div class="col-md-12">
												<?=$news['refDataName'];?><br>
											</div>
											<br>
										<?php } ?>
										<?php if(!empty($news['PDF'])){?>
											<div class="col-md-12">
												<a href="<?=ApiBaseUrl()['url'].$news['PDF']?>" style="color: #7D1456;" target="_blank">[Click Here to Download]<a>
												</div>
											<?php } ?>
										</div>
										
										<hr>
									<?php } ?>
								</marquee>
							</div>

						</div>
					</div>
					<div class="col-lg-4 col-sm-6">
						<div class="card shadow-lg mb-5" style="background-color: var(--home-card-bg);max-height: 600px;min-height: 450px;">
							<div class="card-body text-center p-0 m-0">
								<h3 class="card-header bottomborder" style="background-color:var(--headerFooter)!important;;padding: 11px;font-weight: 700!important; text-shadow: 1px 0px 0px #ff2c00;">TODAY'S PANCHANGAM</h3>
								<div id="panchangam"></div>
								
							</div>
						</div>
					</div>




					<div class="col-lg-4 col-sm-4">
						<div class="card shadow-lg rounded pt-0 widget-body" style="background-color: var(--home-card-bg);max-height: 600px;min-height: 450px;">

							<h3 class="card-header text-center bottomborder"  style="background-color:var(--headerFooter)!important;;padding: 11px;font-weight: 700!important; text-shadow: 1px 0px 0px #ff2c00;">UPCOMING EVENTS</h3>
							<div class="list-group list-group-flush px-0 mx-0"  style="overflow: auto; height: 400px;">

								<?php $i = 1;  foreach($upcoming_events as $val){ 


									if ($i < 11) {

										?> 


										<div style="border-style: dotted; background-color: #FEF395!important;" class="list-group-item justify-content-between text-left mx-0 px-0 pl-0 change-bgcolor" style="border-style: dotted">
											<div class="d-flex mx-0 px-0">

												<div class="col-md-12 m-0 p-0">
													<div class="row mx-0">

														<div class="col-md-12 mx-0 px-0">

															<div class="row mx-0 px-0">
																<div class="col-md-3 mx-0">
																	<a href="<?=base_url('event/'.urlencode($val['refDataName']).'/'.$val['_id'])?>">
																		<img src="<?=$val['Image'] ? ApiBaseUrl()['url'].$val['Image'] : base_url
																		('assets/img/srihanuman-watermark.png');?>" class="rounded shadow" style="width: 70px;height:70px">
																	</a>
																</div>
																<div class="col-md-9 m-auto px-0">

																	<div class="row m-0 p-0">
																		<div class="col-md-12 m-0 p-0">
																			<span style="color:#642318;font-size: 14px;">
																				<a href="<?=base_url('event/'.urlencode($val['refDataName']).'/'.$val['_id'])?>">
																					<?= $val['refDataName']; ?>
																				</a>
																			</span>
																		</div>
																	</div>

																	<div class="row m-0 p-0">
																		<div class="col-md-12 m-0 p-0">
																			<div class="row m-0 p-0">
																				<div class="col-md-8 m-0 p-0">
																					<span class="m-0 p-0" style="font-size: 13px;color: #0000009e">
																						<a href="<?=base_url('event/'.urlencode($val['refDataName']).'/'.$val['_id'])?>">

																							<?php


																							echo 	format_event_date($val['startDate'] , $val['endDate'], $val['startTime'], $val['endTime']);

																							?>
																						</a>

																					</span>
																				</div>
																				<div class="col-md-4 px-2 p-0">
																					<a href="<?=base_url('event/'.urlencode($val['refDataName']).'/'.$val['_id'])?>" class="btn loader btn-success btn-sm" style="float: right!important;background:var(--headerFooter)!important;;border: 0;font-size: 10px">Register</a>

																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>

											<?php if ($i == 10 ) { ?>

												<div class="row viewmoreevent">
													<a href="<?=base_url('all-upcoming-events')?>" class="col-6 loader btn ViewAllEventBtn btn-sm mx-auto d-block" style="border-radius: 0px!important;word-break: keep-all!important;background: #760014;color: white">VIEW MORE <i class="fa fa-paper-plane"></i>
													</a>
												</div>
											<?php } ?>
										</div>
										<?php $i++; } }?>



									</div>
								</div>
							</div>



							<!--======================= UPCOMING EVENT END ===================-->
						</div>
					</div>
				</section>

				<style type="text/css">
					.centered {
						position: absolute;
						top: 50%;
						left: 50%;
						font-size: 25px;
						transform: translate(-50%, -50%);
						color: white!important;
					}
				</style>

				<section  class="temple-services" style="background-color: var(--page-wrapper-bg-color)!important;">

					<div class="container">
						<div class="row">
							<div class="col-md-6" data-aos="fade-right">
								<h3 class="title bottomborder2 mb-4" style="text-align:left;">About <?= GetProjectName(); ?></h3>
								<!-- <span style="position: absolute!important;" class=""></span> -->
								<p style="text-align: left;font-size:15px!important; color: black!important; font-weight: 100; line-height: 2;">Sri Bhakta Anjaneya Temple’s (SBAT) mission is to provide authentic religious service per the sastras to help individuals, families and the community at large. The mission also is to preserve and propagate the learning of the Vedas, Sastras, Puranas, Hindu traditions and to imbibe the Sanatana dharma values, culture and heritage into the future generations.
								</p><br>
								<p style="text-align: left;font-size:15px!important; color: black!important; font-weight: 100; line-height: 2;">
								Our organization was established by some of the most prominent persons in the Hindu world. They were and still are the core people of our organization and the website itself.
								</p>
								<center><a href="<?=base_url('about-temple')?>" class="in-page-btn loader btn btn-primary my-3">
								KNOW MORE</a>
								<a href="<?=base_url('about-deities')?>" class="in-page-btn btn loader btn-primary mx-3 my-3">
								ABOUT DEITIES</a>
								<a href="<?=base_url('general-reference')?>" class="in-page-btn loader btn btn-primary">
								GENERAL INFO</a>
							</center>
						</div>
						<div class="col-md-6" data-aos="fade-left">
							<div class="container-fluid">
								<img src="<?=base_url('assets/img/Jai-Sriram.jpg');?>" class="img-fluid shadow-lg mb-5 rounded" style="float: left;width:100%;">
							</div>
						</div>
					</div>
				</div>


			</section>
			<!-- End Temple Services Section -->

			<!-- ======= Temple Services Section ======= -->
			<section  class="temple-services" style="padding:15px 0px;background-color: var(--page-wrapper-bg-color)!important;">
				<div class="container-fluid">
					<h2 id="temple-services" class="text-center bottomborder title"><?= GetProjectName(); ?></h2>
					<p class="text-center">Our Sri Bhaktha Anjaneya Temple has a dedicated team of experienced priests with specialized knowledge in various branches of Hindu rituals.</p>
					<div class="row pt-5 text-center">
						<div class="col-md-1"></div>
						<div class="col-md-5" data-aos="fade-right">
							<img src="<?=base_url('assets/img/temple-services/in-temple-Service.jpg');?>" class="img-fluid shadow-lg mb-5 rounded" style="float: right;width:100%;">
							<a href="<?=base_url('services')?>" class="loader"><h2 class="centered">In Temple Services</h2></a>
						</div>
						<div class="col-md-5" data-aos="fade-left">
							<img src="<?=base_url('assets/img/temple-services/away-temple-service.jpg');?>" class="img-fluid shadow-lg mb-5 rounded" style="float: left;width:100%;">
							<a href="<?=base_url('services')?>" class="loader"><h2 class="centered">Outside Temple Services</h2></a>
						</div>
						<div class="col-md-1"></div>
					</div>
				</div>
			</section><!-- End Temple Services Section -->


			<!-- ======= community Section ======= -->
			<section id="community" class="community p-0 m-0" style="background-image: linear-gradient(var(--page-wrapper-bg-color), white);">
				<div class="container-fluid p-0 m-0">
					<div class="row text-center p-0 m-0">
						<div class="col-md-4 col-lg-4 p-0 m-0" style="background-image: url('<?=base_url('assets/img/pada.jpg');?>');background-size: cover;background-repeat: no-repeat;">

							<div class=" text-white community-div" style="">
								<h4 class="title">Urgent Causes</h4>
								<h4 class="title2">Donate</h4>
								<span class="mt-4" style="color:#d1d1d1;font-weight: 400;font-size: 18px;line-height: 28px;">
									The Sri Bhaktha Anjaneya Temple is fully dedicated in its mission of providing Hindu religious services to its devotee community.
								</span><br>
								<a href="<?=base_url('donations')?>" class="btn font-weight-bold loader btn-outline-light mt-4">DONATE</a>
							</div>

						</div>
						<div class="col-md-4 col-lg-4 p-0 m-0" style="background-image: url('<?=base_url('assets/img/DSC0114.jpg');?>');background-size: cover;background-repeat: no-repeat;">
							<div class=" text-white community-div" style="">
								<h4 class="title">Expanding your reach</h4>
								<h4 class="title2">Volunteer</h4>
								<span class="mt-4" style="color:#d1d1d1;font-weight: 400;font-size: 18px;line-height: 28px;">
									The Sri Bhaktha Anjaneya Temple is fully dedicated in its mission of providing Hindu religious services to its devotee community.
								</span><br>
								<a href="<?=base_url('volunteer')?>" class="btn font-weight-bold loader btn-outline-light mt-4">REGISTER</a>
							</div>
						</div>
						<div class="bg-image col-md-4 col-lg-4 p-0 m-0" style="background-image: url('<?=base_url('assets/img/Subscribe.jpg');?>');background-size: cover;background-repeat: no-repeat;">
							<div class=" text-white community-div" style="">
								<h4 class="title">Subscribe on our newsletter</h4>
								<h4 class="title2">Subscribe</h4>
								<span class="mt-4" style="color:#d1d1d1;font-weight: 400;font-size: 18px;line-height: 28px;">
									The Sri Bhaktha Anjaneya Temple is fully dedicated in its mission of providing Hindu religious services to its devotee community.
								</span><br>
								<a  href="javascript:void(0)" onclick="subscribeNewsletterCheckLogin()" class="btn font-weight-bold loader btn-outline-light mt-4">SUBSCRIBE</a>
							</div>
						</div>
					</div>

				</div>
			</section>
		</main><!-- End #main -->

		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script type="text/javascript">

			if (navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(SendDataToPanchangamApi);
			} else { 
				console.log("Geolocation is not supported by this browser.");
			}
			function SendDataToPanchangamApi(position) {

				var Latitude= position.coords.latitude;

				var Longitude= position.coords.longitude;

		// We are using this Api (https://api.wheretheiss.at/v1/coordinates/latitude,Longitude) For get tzone by using Lat & Log.//

				$.ajax({
					url: "https://api.wheretheiss.at/v1/coordinates/"+Latitude+","+Longitude,
			//type: "POST",
			//dataType: "json",
					success: function(data) 
					{
						console.log(data.offset);
						var tzone = data.offset;
						getPanchangam(Latitude, Longitude, tzone);
					}             
				});
			}
			function getPanchangam(Latitude, Longitude, tzone){;
			$.ajax({
				url: "<?=base_url('get-panchangam')?>",
				type: "POST",
				dataType: "json",
				data : {'lat':Latitude,'long':Longitude,'tzone':tzone},
				success: function(data) 
				{
					$('#panchangam').html(data);
				}             
			});
		}




		function GetUpcomingEventByID(id, category, serviceType, serviceName, daytype, startDate, endDate, startTime, endTime, serviceAmount){


			var poojalist = $("#hidden_eventdetails"+id).text();

			var serviceID = id;
			var category = category;
			var serviceType = serviceType;
			var serviceName = serviceName;
			var daytype = daytype;
			var startDate = startDate;
			var endDate = endDate;
			var startTime = startTime;
			var endTime = endTime;
			var serviceAmount = serviceAmount;

		// $("#category").text(category);
		// $("#serviceType").text(serviceType);
		// $("#UpcomingEventsName").text(serviceName);
		// $("#daytype").text(daytype);
		// $("#startDate").text(startDate+' - '+endDate);
		// $("#startTime").text(startTime+' - '+endTime);
		// $("#serviceAmount").text('$'+serviceAmount);


			var html = '';
			if (serviceName != '') {
				html += '<tr><th>Service Name</th><td>'+serviceName+'</td></tr>';
			}
			if (daytype != '') {
				html += '<tr><th>Day</th><td>'+daytype+'</td></tr>';
			}
			if (startDate != '') {
				html += '<tr><th>Start Date</th><td>'+startDate+' - '+endDate+'</td></tr>';
			}
			if (startTime != '') {
				html += '<tr><th>Time</th><td>'+startTime+' - '+endTime+'</td></tr>'
			}
			if (serviceAmount > 0) {
				html += '<tr><th>Service Amount</th><td>$'+(serviceAmount / 1).toFixed(2)+'</td></tr>'
			}

			if (poojalist != '') {
				html += '<tr><th>Description</th><td><pre style="font-size: 16px;font-family: "Tienne",Sans-serif;font-weight: 600;">'+poojalist.trim()+'</pre></td></tr>'
			}
			$("#eventdetails").html(html);




			$("#booknowUpcomingEvent").html('<button class="btn btn-primary" style="float: right;background: #910301; border: 1px solid white;" onclick="checkLoginStatus('+"'"+serviceAmount+"'"+', '+"'"+serviceName+"'"+', '+"'"+serviceID+"'"+', '+"'"+category+"'"+', '+"'"+serviceType+"'"+', '+"'"+daytype+"'"+', '+"'"+startDate+"'"+', '+"'"+startTime+"'"+')">BOOK NOW</button>');


		}
	</script>


	<?php $this->load->view('includes/footer') ?>
	<?php $this->load->view('includes/script') ?>
