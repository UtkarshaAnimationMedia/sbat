<html lang="en">
<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />

	<title><?php if(isset($title) && !empty($title)){echo $title.' | ';} ?><?=GetProjectName();?></title><!DOCTYPE html>
	<meta content="<?=GetProjectName();?>" name="description">
	<meta content="<?=GetProjectName();?>" name="keywords">


	<!-- Favicons -->
	<link href="<?=base_url('assets/img/favicon.ico'); ?>" rel="icon">
	<link href="<?=base_url('assets/img/apple-touch-icon.png');?>" rel="apple-touch-icon">

	<!-- Core theme CSS (includes Bootstrap)-->
	<link rel="stylesheet" href="<?=base_url('assets/vendor/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet">
	<link rel="stylesheet" href="<?=base_url('admin_assets/css/style.css')?>" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script type="text/javascript" src="<?=base_url('assets/js/jquery.min.js')?>"></script>


	<!-- dataTables -->
	<link rel="stylesheet" type="text/css" href="<?=base_url('admin_assets/css/jquery.dataTables.css');?>">
	<script type="text/javascript" src="<?=base_url('admin_assets/js/jquery.dataTables.js'); ?>"></script>
	<!-- dataTables -->


	<link href="<?=base_url('admin_assets/css/customStyle.css');?>" rel="stylesheet">
	<script type="text/javascript" src="<?=base_url('admin_assets/js/jquery.validate.js');?>"></script>


	<!-- Time Picker Css -->
	<link rel="stylesheet" href="<?=base_url('assets/css/time-picker.css')?>"/>
	<link rel="stylesheet" href="<?=base_url('assets/css/jquery-ui.css');?>">
	<script type="text/javascript" src="<?=base_url('admin_assets/js/sweetalert2.all.min.js')?>"></script>
	<link href="<?=base_url('admin_assets/css/dist/sweetalert2.min.css')?>" rel="stylesheet">

	<!-- Loader -->

	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/ldld.min.css');?>">
	<script type="text/javascript" charset="utf8" src="<?=base_url('assets/js/ldld.min.js'); ?>"></script>

	<!-- custom color code -->
	<link href="<?=base_url('assets/css/customColorCode.css');?>" rel="stylesheet">


	<style type="text/css">
    .ui-icon,.ui-widget-content .ui-icon {
      background-image: url("<?=base_url('assets/js/ui-icons_444444_256x240.png'); ?>")!important;
    }
    .ui-widget-header .ui-icon {
      background-image: url("<?=base_url('assets/js/ui-icons_444444_256x240.png'); ?>")!important;
    }
  </style>
</head>

<body>
	<?php $header_data = $this->mongo_db2->where(['aspectType'=> 'headerSettings'])->get('wesiteSettings'); ?>
	<div class="d-flex" id="wrapper">