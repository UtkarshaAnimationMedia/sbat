<?php $this->load->view('includes/head') ?>
<?php $this->load->view('includes/topbar') ?>
<?php $this->load->view('includes/header') ?>

<style type="text/css">
	.bookeventbtn:hover{
		box-shadow: 1px 1px 10px red;
		transition: .4s;
	}
</style>
<main id="main">

	<!-- ======= Temple Services Section ======= -->
	<section id="temple-services" class="temple-services">
		<div class="mt-2" style="padding: 40px 0px;background-image: url('<?=base_url('assets/img/botdownloader.com-1686119799.482487.jpg');?>'); background-size: 25%; background-repeat: repeat-x;"></div>
		<div class="container">
			<?php 

			if (isset($serviceDetails['bookingType']) && CheckEmptyNullVar($serviceDetails['bookingType']) != '') {

				if ($serviceDetails['bookingType'] == 'PAY NOW'  &&  $serviceDetails['serviceAmount'] > 0) {
					
					$payment_btn_check = 'PAY NOW';
				}else if($serviceDetails['bookingType'] == 'PAY LATER'  &&  $serviceDetails['serviceAmount'] > 0){
					$payment_btn_check = 'PAY LATER';
				}else{
					$payment_btn_check = 'SERVICE REQUEST';
				}
			}else{

				if ($serviceDetails['serviceAmount'] > 0) {
					$payment_btn_check = 'PAY NOW';
				}else{
					$payment_btn_check = 'SERVICE REQUEST';
				}
			}
			?>

			<?php   $ServicePrice = str_replace("$","",$serviceDetails['serviceAmount']);?>
			<div class="container-fluid">
				<h2 id="temple-services" class="text-center bottomborder"><?=$serviceDetails['refDataName'];?></h2>

				<div class="row">
					<?php if($serviceDetails['Image'] != ""){ ?>
						<div class="col-md-6" data-aos="fade-right">
							<img src="<?=ApiBaseUrl()['url'].$serviceDetails['Image'];?>" class="img-fluid" style="width: 100%; height:auto;">

						</div>
					<?php } ?>
					<div class="<?=$serviceDetails['Image'] ? 'col-md-6' : 'col-md-12' ;?>" data-aos="fade-left">
						<h5 class="title3 fw-bold mb-4"><u>EVENT DETAILS</u></h5>

						<?= $serviceDetails['refDataName'] && $serviceDetails['refDataName'] != 'null'?  '<h6 class="fw-bold">Event Name: </h5><p>'.$serviceDetails['refDataName'].'</p>' : '';?>

						<?= $serviceDetails['startDate'] && $serviceDetails['startDate'] != 'null' ?  ($serviceDetails['endDate'] && $serviceDetails['endDate'] != 'null' ? '<h6 class="fw-bold">Date: </h6><p>'.$serviceDetails['startDate'].' - '.$serviceDetails['startDate'].'</p>' : '<h6 class="fw-bold">Date: </h5><p>'.$serviceDetails['startDate'].'</p>' ) : '';?>

						<?= $serviceDetails['startTime'] && $serviceDetails['startTime'] != 'null' ?  ($serviceDetails['endTime'] && $serviceDetails['endTime'] != 'null' ? '<h6 class="fw-bold">Time: </h6><p>'.$serviceDetails['startTime'].' - '.$serviceDetails['startTime'].'</p>' : '<h6 class="fw-bold">Time: </h6><p>'.$serviceDetails['startTime'].'</p>' ) : '';?>


						<?= ($ServicePrice != 0.00  && $ServicePrice != 'null') ?  '<h6 class="fw-bold">Price: </h5><p>$'.sprintf("%.2f", $ServicePrice).'</p>' : '';?>


						<?= $serviceDetails['poojaList'] && $serviceDetails['poojaList'] != 'null' ?  '<h6 class="fw-bold">Pooja List: </h5><pre>'.$serviceDetails['poojaList'].'</pre>' : '';?>

						<?= isset($serviceDetails['description']) ? ($serviceDetails['description'] && $serviceDetails['description'] != 'null' ?  '<h6 class="fw-bold m-0">Event Details: </h5><p>'.$serviceDetails['description'].'</p>' : '') : '';?>

						<?= @$serviceDetails['venue'] && @$serviceDetails['venue'] != 'null' ?  '<h6 class="fw-bold">Venue: </h5><p>'.@$serviceDetails['venue'].'</p>' : '';?>

						<br>
						<?php if ($serviceDetails['serviceAmount'] != 0) { ?>

							<a href="javascript:void(0)" class="btn btn-primary bookeventbtn btn-sm" style="padding: 6px 20px;background: #910301;border: 1px solid white;" onclick="checkLoginStatus('<?= $ServicePrice ?>', '<?=str_replace("'", "`", $serviceDetails['refDataName'])?>', '<?=$serviceDetails['_id'] ?>', '<?=$serviceDetails['serviceCategoryTypes']?>','<?=$serviceDetails['serviceTypes']?>','<?=$serviceDetails['dayTypes']?>', '<?=$serviceDetails['startDate']?>','<?=$serviceDetails['startTime']?>')">BOOK NOW</a>

						<?php }else{ ?>
							<a href="javascript:void(0)" class="btn btn-success" style="background-color: #ffc107;padding: 5px 14px;color: #15102e;border-radius: 6px!important;font-size: 17px;font-weight: 1000;border: 0px!important;margin: 0px 8px;" onclick="BookNow('<?=$serviceDetails['serviceAmount'] ?>','<?=$serviceDetails['_id'] ?>','<?=$serviceDetails['refDataName'];?>','<?=$serviceDetails['serviceCategoryTypes']?>','<?=$serviceDetails['serviceTypes']?>','<?=$serviceDetails['startDate']?>', '<?=$serviceDetails['startTime']?>','<?=$payment_btn_check?>','<?=$this->session->userdata('logged_in')?>')">BOOK NOW</a>

						<?php } ?>


					</div>
				</div>
			</div>
		</div>
<div class="mt-2" style="padding: 40px 0px;background-image: url('<?=base_url('assets/img/botdownloader.com-1686119799.482487.jpg');?>'); background-size: 25%; background-repeat: repeat-x;"></div>
	</section><!-- End Temple Services Section -->


</main><!-- End #main -->

<script type="text/javascript">
	$(document).ready(function() {
		window.scrollTo({ top: 215, behavior: 'smooth'});
	});






	function BookNow(serviceAmt, serviceId, serviceName, serviceCategory, serviceTypes, startDate, startTime, payment_btn_check, logged_in) {
  var serviceAmt = serviceAmt;
  var serviceId = serviceId;
  var serviceName = serviceName;
  var serviceCategory = serviceCategory;
  var serviceTypes = serviceTypes;
  var startDate = startDate;
  var startTime = startTime;
  var payment_btn_check = payment_btn_check;

  if (logged_in == 0) {
    alert('Please Log in first!');
  } else {
    loader.on();
    swal({
      title: "Confirmation?",
      text: "Are you sure you want to request this service?",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#008080",
      confirmButtonText: "Yes",
      closeOnConfirm: false
    },
    function(isConfirmed) {
      if (isConfirmed) {
        // Disable the button
        $('.confirm').prop('disabled', true);

        loader.on();
        $.ajax({
          url: "<?=base_url('Services/AddServiceRequest')?>",
          type: "POST",
          dataType: "json",
          data: { 
            serviceAmt: serviceAmt,
            serviceId: serviceId,
            serviceName: serviceName,
            serviceCategory: serviceCategory,
            serviceTypes: serviceTypes,
            startDate: startDate,
            startTime: startTime,
            payment_btn_check: payment_btn_check
          },
          success: function(response) {
            loader.off();
            if (response.statusCode == 1) {
              swal({
                html: true,
                title: "Service Request Successful!",
                type: "success",
                confirmButtonText: 'OK',
                confirmButtonColor: '#008080',
              },
              function(){
                window.location.reload(); 
              });
            } else {
              swal({
                html: true,
                title: "Failed!",
                text: "<span>Transaction Failed!<span>",
                type: "error",
                confirmButtonText: 'OK',
                confirmButtonColor: '#008080',
              },
              function(){
                window.location.reload(); 
              });
            }
          }             
        });
      }
    });
  }
  loader.off();
}

</script>
<?php $this->load->view('includes/footer') ?>
<?php $this->load->view('includes/script') ?>
