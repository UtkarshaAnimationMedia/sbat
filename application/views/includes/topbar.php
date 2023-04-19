<body>

  <style type="text/css">
    #topbar{
      background-color: #B02135;   
      padding: 9px 0;
      font-size: 11x;
    }
    #topbar .contact-info i a, #topbar .contact-info i span {
      color: white;
    }
  
    .navbar a, .navbar a:focus {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 10px 0 10px 50px;
      font-size: 13px;
      color: #ffffff;
      white-space: nowrap;
      text-transform: uppercase;
      transition: 0.3s;
    }
    .navbar a:hover, .navbar .active, .navbar .active:focus, .navbar li:hover>a {
      color: #c00000;
      background: white;
    }

    #logo-2 {
      float: right;
      height: 200px;
      margin: -8px 45px 8px 0px;
    }
    .head-line{
      color: #FFFFFF;
      font-weight: 500;
    }
    .head-line2{
      color: var(--home-header-subheading-color)!important;
      font-size: 1.125em!important;
      font-weight: 600;
      font-style: normal;
      font-family: "Tienne", Sans-serif!important;
    }
    .row{
      margin-right: 0px!important;
      margin-left: 0px!important;
    }
  </style>


  <?php
  $header_data = $this->mongo_db2->where(['aspectType'=> 'headerSettings'])->get('wesiteSettings');
  ?>

  <!-- ======= Top Bar ======= -->
  <section id="topbar" class="header-footer-bg d-flex align-items-center m-0 p-0">
    <img src="<?=base_url('assets/img/header-1.png');?>" width="100%">
  </section>

  <!-- ======= Top Bar ======= -->
  <div class="header-footer-bg">  
    <div class="row" >
      <div class="col-md-3"  data-aos="zoom-in">
       <a href="<?=base_url()?>"><img id="logo-1" src="<?=ApiBaseUrl()['url'].@$header_data[0]['leftImage']?>" class="img-fluid mx-auto d-block"></a>
     </div>
     <div class="col-md-6 text-center">
       <div class="media-query">
         <a href="<?=base_url()?>" class="loader"><h2 class="head-line text-white" style="font-family: 'Tienne', Sans-serif !important;text-shadow: 1px 1px 3px #f6d700;font-weight: bold!important;font-size: 2.75em;font-weight: 700;font-style: normal;"><?= @$header_data[0]['refDataName'] ? @$header_data[0]['refDataName'] : GetProjectName(); ?></h2></a>
       </div>
       <a href="<?=base_url()?>" class="loader"><h3 class="head-line2"><?= @$header_data[0]['subHeading'] ? $header_data[0]['subHeading'] : 'A Non-Profit Organization Registered in the State of Georgia'; ?></h3></a>

       <div class="media-query">
         <p class="text-white" style="font-size:15px"><a href="https://maps.google.com/?q=<?= @$header_data[0]['address'] ? $header_data[0]['address'] : '390 Cumming Street Suite B, Alpharetta, GA 30004'; ?>" target="_blank" style="color: white;" rel="nofollow"><?= @$header_data[0]['address'] ? $header_data[0]['address'] : '390 Cumming Street Suite B, Alpharetta, GA 30004'; ?><a><br>


           <i class="fa fa-phone"></i>  <a href='tel:+1 <?= @$header_data[0]['phone'] ? $header_data[0]['phone'] : formatPhoneNumber('770-475-7701'); ?>' style="color: white;">+1 <?= @$header_data[0]['phone'] ? $header_data[0]['phone'] : formatPhoneNumber('770-475-7701'); ?></a>


           , <i class="fa fa-envelope"></i>  <a href="mailto:<?= @$header_data[0]['email'] ? $header_data[0]['email'] : 'manager@srihanuman.org'; ?>" style="color: white;"><?= @$header_data[0]['email'] ? $header_data[0]['email'] : 'manager@srihanuman.org'; ?></a>
         </p>
       </div>
     </div>
     
     <div class="col-md-3"  data-aos="zoom-in">
       <div class="media-query">
        <a href="<?=base_url()?>"><img id="logo-2" src="<?=ApiBaseUrl()['url'].@$header_data[0]['rightImage']?>" class="img-fluid" style="height: 180px;"></a>
      </div>
    </div>
  </div>
</div>
