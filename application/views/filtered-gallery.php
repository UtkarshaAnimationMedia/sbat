<?php $this->load->view('includes/head') ?>
<?php $this->load->view('includes/topbar') ?>
<?php $this->load->view('includes/header') ?>

<style type="text/css">
	
	.gallery-title
	{
		font-size: 36px;
		color: #42B32F;
		text-align: center;
		font-weight: 500;
		margin-bottom: 70px;
	}
	.gallery-title:after {
		content: "";
		position: absolute;
		width: 7.5%;
		left: 46.5%;
		height: 45px;
		border-bottom: 2px solid #D9950B;
	}
	.filter-button
	{
		font-size: 18px;
		border: 1px solid #42B32F;
		border-radius: 5px;
		text-align: center;
		color: #42B32F;
		margin-bottom: 30px;

	}
	.filter-button:hover
	{
		border: 1px solid #42B32F;
		border-radius: 5px;
		text-align: center;
		color: #ffffff;
		background-color: #FFEFE2;

	}
	.btn-default:active .filter-button:active
	{
		background-color: #FFEFE2!important;
		color: white!important;
	}

	.port-image
	{
		width: 100%;
		height: 30px;
	}

	.gallery_product
	{
		margin-bottom: 30px;
	}
	.btn-default {
		color: #333!important;
		padding: 11px 39px!important;
		background-color: #fff!important;
		font-size: 14px!important;
		font-weight: 550!important;
		box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
		border-radius: 45px;
		text-transform: uppercase;
		border: none!important;
	}
	.btn-default:hover{
		color: #fff!important;
		background-color: #530a3a!important;
		border-color: #000000!important;
	}
	.btn.active {
		box-shadow: inset 0 3px 5px rgb(0 0 0 / 13%);
		background-color: #530a3a!important;
		color: white!important;
	}
	.responsive {
		width: auto;
		height: 350px!important;
	}
}

</style>

<main id="main"  style="background-color:var(--page-wrapper-bg-color)!important">

	<div class="container">
		<div class="row">
			<div class="gallery col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<h2 id="temple-services" class="text-center bottomborder mt-5">Gallery of <?= GetProjectName(); ?></h2>
			</div>

			<div align="center">
				<button class="btn btn-default filter-button active my-2" data-filter="all">All</button>
				<button class="btn btn-default filter-button my-2" data-filter="images">Images</button>
				<button class="btn btn-default filter-button my-2" data-filter="videos">Videos</button>

			</div>
			<br/>
		</div>

		<div class="row mt-5">
			<?php foreach($Child_Grid as $item){ ?>

				<div class="text-center gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter <?= $parent_data['refDataName']; ?> images">
					<img src="<?= ApiBaseUrl()['url'].$item['eventImage']; ?>" class="responsive" alt="<?= $item['altImage'] ?>" style="border: 4px solid #530a3a;">
				</div>

			<?php } ?>


		</div>
	</div>


</main>

<script type="text/javascript">
	$(document).ready(function(){

		$(".filter-button").click(function(){
			var value = $(this).attr('data-filter');
			if ($(".filter-button").removeClass("active")) {
				$(this).removeClass("active");
			}
			$(this).addClass("active");
			if(value == "all")
			{
				$('.filter').show('1000');
			}
			else
			{
				$(".filter").not('.'+value).hide('3000');
				$('.filter').filter('.'+value).show('3000');
			}
		});

		

	});
</script>
<script type="text/javascript">
	$(document).ready(function() {
    window.scrollTo({ top: 250, behavior: 'smooth'});
});
</script>

<?php $this->load->view('includes/footer') ?>
<?php $this->load->view('includes/script') ?>
