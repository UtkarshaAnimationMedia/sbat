
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />

  <title><?php if(isset($title) && !empty($title)){echo $title.' | ';} ?><?= GetProjectName(); ?></title>
  <meta content="Sri Venkateswara Temple" name="description">
  <meta content="Sri Venkateswara Temple" name="keywords">

  <!-- Favicons -->
  <link href="<?=base_url('assets/img/favicon.ico'); ?>" rel="icon">
  <link href="<?=base_url('assets/img/apple-touch-icon.png');?>" rel="apple-touch-icon">
  <!-- Vendor CSS Files -->
  <link href="<?=base_url('assets/vendor/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet">
  <link href="<?=base_url('assets/vendor/bootstrap-icons/bootstrap-icons.css');?>" rel="stylesheet">
  <link href="<?=base_url('assets/vendor/boxicons/css/boxicons.min.css');?>" rel="stylesheet">
  <link href="<?=base_url('assets/vendor/glightbox/css/glightbox.min.css');?>" rel="stylesheet">
  <link href="<?=base_url('assets/vendor/swiper/swiper-bundle.min.css');?>" rel="stylesheet">

  <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
  <script type="text/javascript" src="<?=base_url('assets/js/jquery.min.js')?>"></script>
  <script type="text/javascript" src="<?=base_url('assets/js/bootstrap.bundle.min.js')?>"></script>
  <!-- Template Main CSS File -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="<?=base_url('assets/css/style.css');?>" rel="stylesheet">
  <link href="<?=base_url('assets/css/custom.css');?>" rel="stylesheet">

  <!-- responsive css -->
  <link href="<?=base_url('assets/css/responsive.css');?>" rel="stylesheet">
  <script src="<?=base_url('assets/js/bootstrap.min.js')?>"></script>
  <script type="text/javascript" src="<?=base_url('assets/js/moment.min.js')?>"></script>

  <link href="<?=base_url('assets/vendor/animate.css/animate.min.css');?>" rel="stylesheet">
  <link href="<?=base_url('assets/vendor/aos/aos.css');?>" rel="stylesheet">

  <!-- country_code links -->
  <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/intlTelInput.css?1549804213570');?>">
  <script type="text/javascript" src="<?=base_url('assets/js/intlTelInput.js?1549804213570');?>"></script>
  <!-- country_code links -->

  <style type="text/css">
    .iti{
      width: 100%!important;
    }
  </style>     

  <!-- sweet alert -->
  <script src="<?=base_url('assets/js/sweet-alert.min.js')?>"></script>
  <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/sweet-alert.css')?>">
  <!-- sweet alert -->

  <!-- calendar links -->
  <link rel="stylesheet" href="<?=base_url('assets/css/fullcalendar.min.css')?>" />
  <script src="<?=base_url('assets/js/moment.js')?>"></script>
  <script src="<?=base_url('assets/js/fullcalendar.min.js')?>"></script>
  <script src="<?=base_url('assets/js/locale-all.js')?>"></script>
  <!-- calendar links -->
  <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins"> -->

  <link rel="stylesheet" href="<?=base_url('assets/css/time-picker.css')?>"/>
  <!-- Include the date picker library -->
  <link rel="stylesheet" href="<?=base_url('assets/css/jquery-ui.css')?>">



  <!-- ======================================================================================= -->

  <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/ldld.min.css');?>">
  <script type="text/javascript" charset="utf8" src="<?=base_url('assets/js/ldld.min.js'); ?>"></script>

  <!-- ======================================================================================= -->


  <div class="gtranslate_wrapper"></div>
  <script>window.gtranslateSettings = {"default_language":"en","native_language_names":true,"languages":["en","hi","ta","pa","ml","te","gu","kn"],"wrapper_selector":".gtranslate_wrapper","alt_flags":{"en":"usa"}}</script>
  <script src="https://cdn.gtranslate.net/widgets/latest/float.js" defer></script>

  <link href="<?=base_url('assets/css/customColorCode.css');?>" rel="stylesheet">
</head>