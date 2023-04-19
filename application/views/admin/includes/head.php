<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />

	<title><?php if(isset($title) && !empty($title)){echo $title.' | ';} ?><?=GetProjectName();?></title>
	<meta content="<?=GetProjectName();?>" name="description">
	<meta content="<?=GetProjectName();?>" name="keywords">


	<!-- Favicons -->
	<link href="<?=base_url('assets/img/favicon.ico'); ?>" rel="icon">
	<link href="<?=base_url('assets/img/apple-touch-icon.png');?>" rel="apple-touch-icon">

	<!-- Core theme CSS (includes Bootstrap)-->
	<link href="<?=base_url('assets/vendor/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet">
	<link href="<?=base_url('admin_assets/css/style.css')?>" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tienne">

	<script type="text/javascript" src="<?=base_url('assets/js/jquery.min.js')?>"></script>


	<!-- dataTables -->
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/jquery.dataTables.css');?>">
	<script type="text/javascript" charset="utf8" src="<?=base_url('assets/js/jquery.dataTables.js'); ?>"></script>
	<!-- dataTables -->


	<link href="<?=base_url('admin_assets/css/customStyle.css');?>" rel="stylesheet">
	<script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.js"></script>

	<style type="text/css">
		.dataTables_length{
			display: none;
		}

		.dataTables_filter{
			display: none;
		}

		.dataTables_info{
			margin-top: 30px;
		}

		.dataTables_paginate {
			margin-top: 30px;
		}
		.ui-datepicker {
			font-size: 16px;
			background-color: #570000!important;
			color: #FF9300!important;
		}
		.ui-datepicker-header {
			background-color: #008080!important;
			color: white!important;
		}
		.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default, .ui-button, html .ui-button.ui-state-disabled:hover, html .ui-button.ui-state-disabled:active {
			border: 1px solid #000000!important;
			background: #ff2828!important;
			font-weight: normal!important;
			color: #ffffff!important;
		}

		.form-check-input[type=checkbox] {
			border-radius: 0.25em;
			padding: 10px!important;
			font-size: 18px;
			border: 3px solid #005D4B;
		}
		.form-check-input:checked[type="checkbox"] {
			background-color: #005D4B;
			border-radius: 0.25em;
			padding: 10px!important;
			font-size: 18px;
			border: 3px solid #005D4B;
		}
		.form-check-input:checked[type="checkbox"] + .form-check-label::before {
			background-color: #005D4B;
			font-weight: bold;
			font-size: 18px;
		}
		.form-check-input:checked[type="checkbox"] + .form-check-label::after {
			background-color: #005D4B;
			border-radius: 0.25em;
			padding: 10px;
			color: yellow!important;
			background-image: url('data:image/svg+xml,%3csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"%3e%3cpath fill="yellow" stroke="%23FFFF00" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5.5 8l4 4 4-4"/%3e%3c/svg%3e')!important;
		}
		.form-check-input:focus {
			border-color: #005D4B!important;
			outline: 0!important;
			box-shadow: none!important;
		}

		/* For Hide Arrow from input type number*/
/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
	-webkit-appearance: none;
	margin: 0;
}

/* Firefox */
input[type=number] {
	-moz-appearance: textfield;
}

</style>


<!-- Time Picker Css -->

<link rel="stylesheet" href="<?=base_url('assets/css/time-picker.css')?>"/>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.2/dist/sweetalert2.all.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.2/dist/sweetalert2.min.css" rel="stylesheet">


<!-- asssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss -->

<!-- /// Laoder CDNs -->

<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/ldld.min.css');?>">
<script type="text/javascript" charset="utf8" src="<?=base_url('assets/js/ldld.min.js'); ?>"></script>
<!-- asssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss -->



<link href="<?=base_url('assets/css/customColorCode.css');?>" rel="stylesheet">
</head>

<body>
	<?php
	$header_data = $this->mongo_db2->where(['aspectType'=> 'headerSettings'])->get('wesiteSettings');
	?>

	<div class="d-flex" id="wrapper">