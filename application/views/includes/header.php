<style type="text/css">
  .navbar>ul>li>a{
    font-weight: 1000 !important;
    font-size: 15px!important;
    font-style: normal;
    text-decoration: none;
    text-transform: none;
    letter-spacing: 0.5px;
  }
  .navbar-mobile ul {
    display: block;
    position: absolute;
    top: 55px;
    right: 15px;
    bottom: 15px;
    left: 15px;
    padding: 10px 0;
    overflow-y: auto;
    transition: 0.3s;
    background: #560b3c78 !important;
  }
  @media  only screen and (min-width: 992px) {
    #navmobile{
      justify-content: center!important;
    }
  }
  .navbar .dropdown ul{    background: #b02135;}
  .navbar .dropdown ul a {
    color: white;
  }
  .dropdown-item.active, .dropdown-item:active {
    background-color: #780011fc!important;
  }
  .navbar .dropdown ul a:hover, .navbar .dropdown ul .active:hover, .navbar .dropdown ul li:hover>a {
    color: #fff;
    background-color: #790012;
  }
  .navlink:after {    
    background: none repeat scroll 0 0 transparent;
    bottom: 0;
    content: "";
    display: block;
    height: 2px;
    position: absolute;
    background: #F08B54;
    transition: width 0.3s ease 0s, left 0.3s ease 0s;
    width: 0;
  }
  .navlink:hover:after { 
    width: 100%; 
    left: 0; 
  }
  .navbar a, .navbar a:focus {
    padding: 10px 20px 10px 20px!important;
  }
  #header{
    color: white;
    transition: all 0.5s;
    z-index: 997;
    transition: all 0.5s;
    font-weight: 1000;
    height: 55px;
  }
</style>

<!-- ======= Header ======= -->
<header id="header" class="d-flex align-items-center menu-bg" style="border-top: 1px solid white;">
  <div class="container d-flex justify-content-center" id="navmobile">
    <nav id="navbar" class="navbar">
      <ul>
        <li><a class="navlink  <?php if($page == 'Home') { ?> active<?php } ?>" href="<?=base_url()?>">HOME</a></li>

        <li><a class="navlink <?php if($page == 'Services') { ?> active  <?php } ?>" href="<?=base_url('services')?>">SERVICES</a></li>

        <li><a class="navlink <?php if($page == 'Facilities') { ?> active  <?php } ?>" href="<?=base_url('facilities')?>">FACILITIES</a></li>

        <li><a class="navlink <?php if($page == 'Calendar') { ?> active  <?php } ?>" href="<?=base_url('calendar')?>">CALENDAR</a></li>

        <li><a class="navlink <?php if($page == 'Donations') { ?>  active   <?php } ?>" href="<?=base_url('donations')?>"<?php if($page == 'Donation') { ?> class="active"  <?php } ?>>DONATIONS</a></li>

        <li><a class="navlink <?php if($page == 'Gallery') { ?> active  <?php } ?>" href="<?=base_url('gallery')?>">GALLERY</a></li>

        <li class="dropdown">
          <a class="navlink <?php if($page == 'ABOUT-TEMPLE' || $page == 'ABOUT-COMMITTEE' || $page == 'ABOUT-DEITY' || $page == 'ABOUT-TEMPLE' || $page == 'ABOUT-PRIEST' || $page == 'GENERAL-REFERENCE' || $page == 'FINANCIAL-STATEMENTS')  { ?>active<?php } ?>" href="javascript:void()" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> ABOUT TEMPLE <i class="fa fa-caret-down"></i></a>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <li><a  href="<?=base_url('about-temple')?>" class="text-uppercase dropdown-item navlink <?php if($page == 'ABOUT-TEMPLE') { ?>active<?php } ?>" >ABOUT TEMPLE</a></li>
            <li><a  href="<?=base_url('about-deities')?>" class="text-uppercase dropdown-item navlink <?php if($page == 'ABOUT-DEITY') { ?>active<?php } ?>">ABOUT DEITIES</a></li>
            <li><a  href="<?=base_url('about-priest')?>" class="text-uppercase dropdown-item navlink <?php if($page == 'ABOUT-PRIEST') { ?>active<?php } ?>">ABOUT PRIESTS</a></li>
            <li><a  href="<?=base_url('about-committee')?>" class="text-uppercase dropdown-item navlink <?php if($page == 'ABOUT-COMMITTEE') { ?>active<?php } ?>">ABOUT COMMITTEE</a></li>
            <li><a  href="<?=base_url('general-reference')?>" class="text-uppercase dropdown-item navlink <?php if($page == 'GENERAL-REFERENCE') { ?>active<?php } ?>">GENERAL REFERENCE</a></li>
            <li><a  href="<?=base_url('financial-statements')?>" class="text-uppercase dropdown-item navlink <?php if($page == 'FINANCIAL-STATEMENTS') { ?>active<?php } ?>">FINANCIAL STATEMENTS</a></li>
          </ul>
        </li>

        <li><a class="navlink <?php if($page == 'CONTACT-US') { ?>  active   <?php } ?>" href="<?=base_url('contact-us')?>">CONTACT US</a></li>


        <?php if ($this->session->userdata('logged_in') == 1 ) {
         $userSession = $this->session->userdata('refDataName'); ?>

         <li class="dropdown">
          <a href="javascript:void()" class="navlink" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> MY ACCOUNT <i class="fa fa-caret-down"></i></a>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">

           <?php if ($this->session->userdata('userType') == 'Devotee') { ?>
             <li><a class="text-uppercase dropdown-item navlink <?php if($page == 'Dashboard') { ?> active  <?php } ?>" href="<?=base_url('admin/my-profile')?>">MY ACCOUNT</a></li>

           <?php }else if($this->session->userdata('userType') == 'Managements'){ ?>
            <li><a class="text-uppercase dropdown-item navlink <?php if($page == 'MEMBER DIRECTORY') { ?> active  <?php } ?>" href="<?=base_url('managements/member-directory')?>">MY ACCOUNT</a></li>

          <?php } ?>

          <li><a class="text-uppercase dropdown-item navlink <?php if($page == 'Volunteers-Form') { ?> active  <?php } ?>" href="<?=base_url('volunteer')?>">VOLUNTEERS FORM</a></li>
          <li><a class="text-uppercase dropdown-item navlink <?php if($page == 'Membership-Form') { ?> active  <?php } ?>" href="<?=base_url('membership')?>">MEMBERSHIP FORM</a></li>
          <li><a class="text-uppercase dropdown-item navlink <?php if($page == 'Logout') { ?> active  <?php } ?>" href="<?=base_url('logout')?>">LOGOUT</a></li>
        </ul>
      </li>

    <?php }else { ?>
     <li><a  href="javascript:void(0);" class="navlink dotlgbtn <?php if($page == 'Devotee Sign In') { ?> active  <?php } ?>" onclick="checkLoginStatus()">SIGN-IN</a></li>
   <?php }?>


 </ul>
 <i class="bi bi-list mobile-nav-toggle text-white"></i>
</nav><!-- .navbar -->

</div>
</header><!-- End Header -->
