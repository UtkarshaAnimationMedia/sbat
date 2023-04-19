<?php $this->load->view('includes/head') ?>
<?php $this->load->view('includes/topbar') ?>
<?php $this->load->view('includes/header') ?>
<style type="text/css">
	.bookeventbtn:hover{
		box-shadow: 1px 1px 10px red;
		transition: .4s;
	}

	.viewmorebtn:hover{
		box-shadow: 1px 1px 10px green;
		transition: .4s;
	}
</style>
<main id="main">


	<section style="background-color:var(--page-wrapper-bg-color)!important">
		<h2 id="temple-services" class="text-center">All Upcoming Events<br><img src="<?=base_url('assets/img/border.png')?>" class="img-fluid img-responsive"></h2>
		<div class="container pb-5">

			<?php 
			//Multidiamensional array sort by date key
			usort($upcoming_events, function ($a, $b) {
				$dateA = DateTime::createFromFormat('m/d/Y', $a['startDate']);
				$dateB = DateTime::createFromFormat('m/d/Y', $b['startDate']);
   									 // ascending ordering, use `<=` for descending
				return $dateA >= $dateB;
			});

			foreach($upcoming_events as $item){ 


				if($item['startDate'] >= date('m/d/Y') || $item['endDate'] >= date('m/d/Y')) {



			  $ServicePrice = str_replace("$","",$item['serviceAmount']);?>



				<div class="row justify-content-center mb-3">
					<div class="col-md-12 col-xl-10">
						<div class="card shadow-0 border rounded-3">
							<div class="card-body">
								<div class="row">
									<div class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0">
										<div class="bg-image hover-zoom ripple rounded ripple-surface">
											<?php if (!empty($item['Image'])) { ?>
												<img src="<?=ApiBaseUrl()['url'].$item['Image']?>"
												class="img-fluid" style="max-height: 150px; width:150px" />
											<?php }else{ ?>
												<img src="<?=base_url('assets/img/bskst-watermark.png')?>"
												class="img-fluid" style="max-height: 150px; width:150px" />
											<?php } ?>

											<a href="#!">
												<div class="hover-overlay">
													<div class="mask" style="background-color: rgba(253, 253, 253, 0.15);"></div>
												</div>
											</a>
										</div>
									</div>
									<div class="col-md-6 col-lg-6 col-xl-6">
										<h5 class="fw-bold"><?=$item['refDataName']?></h5>
										<div class="mt-1 mb-0 text-danger small" style="text-shadow: yellow!important;">
											
											<?php if (!empty($item['startDate'])) { ?>
												<div class="mt-2">
													<?= $item['endDate'] ? "<span><i class='fa fa-calendar'></i> ".$item['startDate']."</span><span class'text-primary'> - ".$item['endDate']."</span><br>" :  "<span><i class='fa fa-calendar'></i> ".$item['startDate']."</span><br>"?>
												</div>
											<?php } ?>
											<?php if (!empty($item['startTime'])) { ?>
												<div class="mt-2">
													<?= $item['endTime'] ? "<span><i class='fa fa-clock-o'></i> ".$item['startTime']."</span><span class'text-primary'> - ".$item['endTime']."</span><br>" :  "<span><i class='fa fa-clock-o'></i> ".$item['startTime']."</span><br>"?>
												</div>
											<?php } ?>
										</div>
										<p class="text-truncate mb-4 mb-md-0">
											<?=CheckEmptyNullVar(@$item['description']); ?>
										</p>
									</div>

									
									<?php   $ServicePrice = str_replace("$","",$item['serviceAmount']);?>
									<div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">

										<?php if($ServicePrice != 0.00 ){ ?> 
											<div class="d-flex flex-row align-items-center mb-1">
												<h4 class="mb-1 me-1"><?= $ServicePrice ?   '$'.sprintf("%.2f", $ServicePrice) : '$0.00';?></h4>
												<!-- <span class="text-danger"><s>$20.99</s></span> -->
											</div>
											<div class="d-flex flex-column mt-4">

												

												<a href="javascript:void(0)" class="btn btn-primary bookeventbtn btn-sm" style="background: #910301;border: 1px solid white;" onclick="checkLoginStatus('<?= $ServicePrice ?>', '<?=str_replace("'", "`", $item['refDataName'])?>', '<?=$item['_id'] ?>', '<?=$item['serviceCategoryTypes']?>','<?=$item['serviceTypes']?>','<?=$item['dayTypes']?>', '<?=$item['startDate']?>','<?=$item['startTime']?>')" type="button">BOOK NOW</a>



												<a href="<?=base_url('event/'.urlencode($item['refDataName']).'/'.$item['_id'])?>" class="mt-3 btn btn-primary viewmorebtn btn-sm" style="background-color: #008080;padding: 5px 15px;border: 1px solid white;color: white!important;" type="button">EVENT DETAILS</a>

											</div>
										<?php }else{?>
											<div class="d-flex flex-column mt-4">
												<a href="<?=base_url('event/'.urlencode($item['refDataName']).'/'.$item['_id'])?>" class="mt-3 btn btn-primary viewmorebtn btn-sm" style="background-color: #008080;padding: 5px 15px;border: 1px solid white;color: white!important;" type="button">EVENT DETAILS</a>



											</div>
										<?php } ?>

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php 			} } ?>

		</div>
	</section>


</main><!-- End #main -->

<script type="text/javascript">
	$(document).ready(function() {
		window.scrollTo({ top: 215, behavior: 'smooth'});
	});
</script>
<?php $this->load->view('includes/footer') ?>
<?php $this->load->view('includes/script') ?>
