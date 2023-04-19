
<!-- DEBUG-VIEW START 1 APPPATH/Views/login.php -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $pageTitle; ?> | <?= PROJECT_NAME; ?></title>
  <link rel="icon" type="image/x-icon" href="<?= base_url('assets/payonline'); ?>/images/favicon.png">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('assets/payonline'); ?>/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url('assets/payonline'); ?>/css/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets/payonline'); ?>/css/adminlte.min.css">
  <!-- SweetAlert2 -->


<!-- sweet alert -->
<script src="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.css">


 <link rel="stylesheet" type="text/css" href="https://intl-tel-input.com/node_modules/intl-tel-input/build/css/intlTelInput.css?1549804213570">
  
  <!-- <script src='https://www.google.com/recaptcha/api.js'></script> -->
  <style>
    .login-box-msg,
    .register-box-msg {
      padding: 0;
    }

    .submitbutton {
      background-color: #7E4555;
    }

    .submitbutton:hover {
      background-color: #EE4D23;
    }

/*body .modal-dialog { margin-left: 0; }*/

.iti {
    /*position: relative;*/
    display: -webkit-box!important;
}


#signupModal{display: none;}
.inSignup{display: none;}

  </style>
</head>

<body class="hold-transition login-page">

  <!--- popup --->
  <div class="modal fade" id="exampleModal"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position:absolute;z-index: 999">
            <span aria-hidden="true">&times;</span>
          </button>
          <h5 class="col-12 modal-title text-center" id="exampleModalLabel">Welcome</h5>          
        </div>
        <div class="modal-body" style="text-align: justify">

          <a class="" href="#"><img style="width:95%" alt="Devotee Portal" src="<?= base_url('assets/payonline'); ?>/images/devotee_portal.jpeg" /></a>

          <div class="row p1">
            <div class="col-sm-12 p-1 text-left">

              <ul class="list-group">
                <li class="list-group-item">Click on Create Account</li>
                <li class="list-group-item"></i>Enter your Name, Email and Phone number and click on register</li>
                <li class="list-group-item">Check your email for the activation or password reset link (check your spam folder)</li>
                <li class="list-group-item">If you see message, "Your email is already registered...", click on Reset Password link to generate a new password</li>
              </ul>

            </div>
          </div>

        </div>
      </div>
    </div>
  </div>



<?php
if ($this->session->userdata('logged_in') == 1 ) {?>
  <div class="login-box">
    <div class="card card-outline card-danger">
      <div class=" card-header text-center">
       <div class="login-box-msg parent">
          <div class="center fill-remaining-space"><h4>CHECKOUT</h4></div>
        </div>
      </div>

      <div class="card-body login-card-body" >
  
   <form action="#" method="post" onsubmit="return SignupUser('<?=base_url('signup')?>')">
        
        <div class="modal-body">
          <div class="container">
            <img src="<?=ApiBaseUrl()['url'].$header_data[0]['leftImage']?>" class="img-fluid mb-4" height="100px" width="100px" style="display: block;margin-left: auto;margin-right: auto;">
            <div class="row d-flex justify-content-center align-items-center">
              <div class="col-xl-12">
                <div class="row g-0">
                  <div class="col-xl-12">
                    <div class="row"> 
                      <div class="col-md-12 mb-4">
                        <table class="table table-responsive table-bordered text-center">
                          <thead>
                            <tr>
                              <th><h5 style="font-size:16px;font-family: 'Open Sans', sans-serif!important;font-weight: 800;color: #B02135;">SERVICE TYPE</h5></th>
                              <th><h5 style="font-size:16px;font-family: 'Open Sans', sans-serif!important;font-weight: 800;color: #B02135;">TOTAL AMOUNT TO PAY</h5></th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td><span id="serviceName" class="serviceName"><?= @$servicesDetail['refDataName']; ?></span></td>
                              <td><h4 id="servicePrice">$<?= sprintf("%.2f", @$servicesDetail['serviceAmount']); ?></h4></td>
                              <input type="hidden" name="" value="<?= @$servicesDetail['serviceAmount']; ?>" id="serviceAmt">

                              <input type="hidden" name="" value="<?= @$servicesDetail['serviceCategoryTypes']; ?>" id="serviceCategoryTypes">
                              <input type="hidden" name="" value="<?= @$servicesDetail['serviceTypes']; ?>" id="serviceTypes">
                              <input type="hidden" name="" value="<?= @$servicesDetail['dayTypes']; ?>" id="dayTypes">
                              <input type="hidden" name="" value="<?= @$servicesDetail['startDate']; ?>" id="startDate">
                              <input type="hidden" name="" value="<?= @$servicesDetail['startTime']; ?>" id="startTime">
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>

                    <div class="d-flex justify-content-center text-center modal-footer">
                      <div class="row">

                        <div class="col-md-12">
                          <div id="paypal-button-container"></div>
                          <button type="button" class="btn PaymentClosebtn btn-danger ms-2" data-dismiss="modal" hidden>CLOSE</button> 
                        </div>


                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>

      </div>

    </div>

  </div>

<?php }else{ ?>


  <div class="login-box">
    <div class="login-logo">
   <!--    <h1><img src="<?= ApiBaseUrl()['url'].$header_data[0]['leftImage']; ?>" style="height: 130px; width: 150px;"  class="img-fluid" /></h1> -->
    </div>
    <!-- /.login-logo -->
    <div class="card card-outline card-danger">
      <div class=" card-header text-center">
       <div class="login-box-msg parent">
          <div class="center fill-remaining-space"><h4>LOGIN IN </h4></div>
        </div>
      </div>

      <div class="card-body login-card-body" >
        <!-- <p class="login-box-msg">Sign in to start your session</p> -->

        <div class="row">

          <!-- SIGNUP BOX -->
          <div class="col-md-12" id="signupModal">

           <form action="#" method="post" onsubmit="return SignupUser('<?=base_url('signup')?>')">
          
            <div class="modal-body p-0">
              <div class="container">
                <img src="<?= ApiBaseUrl()['url'].$header_data[0]['leftImage']; ?>" class="img-fluid my-1" height="120px" width="120px" style="display: block;margin-left: auto;margin-right: auto;">
                <div class="row" style="text-align:center;">
                  <div class="col-md-12">
                    <span id="signup-error-flashmsg" class="text-center" style="color: red;"></span>
                    <span id="signup-success-flashmsg" class="text-center" style="color: green;"></span>
                  </div>
                </div>
                <div class="row d-flex justify-content-center align-items-center">
                  <div class="col-xl-12">
                    <div class="row g-0">
                      <div class="col-xl-12">
                        <div class="row">
                          <div class="col-md-6 mb-2">
                            <div class="form-outline">
                              <label class="form-label" for="fname">First name</label>
                              <input type="text" id="fname" name="fname" class="form-control" required />
                            </div>
                          </div>
                          <div class="col-md-6 mb-2">
                            <div class="form-outline">
                              <label class="form-label" for="lname">Last name</label>
                              <input type="text" id="lname" name="lname" class="form-control" />
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-12 mb-2">
                            <div class="form-outline">
                              <label class="form-label" for="signupEmail">Email</label>
                              <input type="email" id="signupEmail" name="email" class="form-control" required />
                            </div>
                          </div>
                        </div>


                        <div class="row">
                          <div class="col-md-12 mb-2">
                            <div class="form-outline">
                              <label class="form-label" for="signupPhoneNumber">Phone Number</label>
                              <input type="tel" placeholder="Ex. +1 (702) 123-4567" minlength="10" maxlength="15" id="signupPhoneNumber" name="phone" class="phone-with-country-code form-control" value="" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57 || event.charCode==43 ))"  oninput="nonEditCuntryCode1(this);" value="+1">
                              </div>
                            </div>
                          </div>


                        
                          <div class="row">
                            <div class="col-md-12 p-3">
                              <center>
                               <button type="submit" class="btn btn-info ms-2" id="signupBtn">SIGN UP</button>
                             </center>
                           </div>
                         </div>



                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="d-flex justify-content-center modal-footer">
             <!--   <div class="row mx-auto d-block">
                <div class="col-md-12">
                 <button type="submit" class="btn btn-warning ms-2" id="signupBtn">SIGN UP</button>
                 <button type="button" class="signupBtnClose btnClose btn btn-danger ms-2" data-dismiss="modal" hidden>CLOSE</button> 
               </div>

             </div> -->
           </div>
         </form>


</div>
          

          <!-- LOGIN BOX -->
          <div class="col-md-12" id="loginModal">
            <form action="#" method="post" id="phonemyForm" onsubmit="return LoginUser('<?=base_url('signin')?>')">
             <div class="modal-body p-0">
              <div class="container">
                <img src="<?= ApiBaseUrl()['url'].$header_data[0]['leftImage']; ?>" class="img-fluid my-3" height="120px" width="120px" style="display: block;margin-left: auto;margin-right: auto;">


                <div class="row g-0">
                  <div class="col-xl-12">
                    <div class="row" style="text-align:center;">
                      <div class="col-md-12">
                        <span id="login-error-flashmsg" class="text-center" style="color: red;"></span>
                        <span id="login-success-flashmsg" class="text-center" style="color: green;"></span>

                      </div>
                    </div>
                  </div>
                </div>


                <div class="row d-flex justify-content-center align-items-center">
                  <div class="col-xl-12">
                    <div class="row">
                      <div class="col-xl-12">


                        <span class="email_section ">
                          <div class="row ">
                            <div class="col-md-12 mb-2">
                              <input type="email" id="loginEmail" placeholder="Enter your email Id." name="email" class="form-control" />
                              <span class="otpsendmsg" style="color: green; font-size: 13px;"></span>
                            </div>
                          </div>

                          <div class="row" id="otptoggle" style="display:none;">
                            <div class="col-md-8 mb-2">
                              <input type="number" id="emailotp" name="emailotp" placeholder="Please enter OTP to continue." class="form-control" required />
                            </div>
                            <div class="col-md-4 mb-2">
                              <button id="emailotpverifybtn" class="btn btn-success verifyBtn" onclick="verifyEmailOtp('<?=base_url('email-otp-verification')?>')">VERIFY</button>
                            </div>
                          </div>
                        </span>

                        <span class="mobile_section">
                          <div class="text-center mb-2">--OR--</div>
                          <div class="row" >
                            <div class="col-md-12 mb-0 ">
                              <input type="tel" placeholder="Ex. +1 (702) 123-4567"  id="loginPhoneNumber" name="phone" class="phone-with-country-code form-control" value="+1" minlength="10" maxlength="15" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57 || event.charCode==43 ))" oninput="nonEditCuntryCode(this);">
                                <span class="otpsendmsg_number" style="color: green; font-size: 18px;margin-left: 12px;"></span>
                              </div>

                              <div class="col-md-12 mb-4">
                               <center>
                                 <button id="emailotpntn" class="btn btn-success" onclick="sendEmailOtp('<?=base_url('send-email-otp')?>')">Login</button>
                               </center>
                             </div>
                           </div>
                         </span>

                         <div class="row mobile-section otpmobilebox" id="mobiletoggle"  style="display:none;">
                          <div class="col-md-8 mb-4">
                            <input type="number" id="mobileotp" name="mobileotp" placeholder="Please enter OTP to continue." class="form-control" />
                            <span class="otpsendmsg_number_error" style="color: red; font-size: 18px;margin-left: 12px;"></span>
                          </div>
                          <div class="col-md-4 mb-4">
                            <button id="mobileotpverifybtn" class="btn btn-success verifyBtn" onclick="submitPhoneNumberAuthCode()">VERIFY</button>
                          </div>
                        </div>
                        <div id="recaptcha-container"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="d-flex justify-content-center text-center modal-footer">
              <div class="row">
                <div class="col-md-12">
                  <button type="submit" class="btn btn-warning" id="loginBtn">LOGIN</button>
                  <button type="button" class="loginBtnClose btnClose btn btn-danger ms-2" data-dismiss="modal" hidden>CLOSE</button> 
                </div>
              </div>
            </div>

          </form>
        </div>

                <div class="row">
                  <div class="col-12 ml-4 mb-2" style="padding-right: 3.5rem;">

                    <a href="javascript:void(0);" onclick="openBoxlog('signup')"  class="inLogin" style="float: left;color:#EE4D23">New User? Sign Up</a>
                    <a href="javascript:void(0);" onclick="openBoxlog('forgot')"  class="inLogin" style="float: right;color:#EE4D23">Forgot password ?</a>
                    <a href="javascript:void(0);" onclick="openBoxlog('login')" class="inSignup" >Already registered? Login</a>
                  </div>
                </div>
        </div>









        <!-- /.social-auth-links -->

        <!--  <p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
      </p> -->
      </div>
      <!-- /.login-card-body -->



<!-- Payment Modal -->
<div class="modal fade" id="paymentModal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">


      <form action="#" method="post" onsubmit="return SignupUser('<?=base_url('signup')?>')">
        <div class="modal-header text-center">
          <h5 class="modal-title bottomborder modatTitle" >CHECKOUT</h5>
       
              <button type="button" class="btn-close modalCloseBtn" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="container">
            <img src="<?=ApiBaseUrl()['url'].$header_data[0]['leftImage']?>" class="img-fluid mb-4" height="100px" width="100px" style="display: block;margin-left: auto;margin-right: auto;">
            <div class="row d-flex justify-content-center align-items-center">
              <div class="col-xl-12">
                <div class="row g-0">
                  <div class="col-xl-12">
                    <div class="row"> 
                      <div class="col-md-12 mb-4">
                        <table class="table table-responsive table-bordered text-center">
                          <thead>
                            <tr>
                              <th><h5 style="font-size:20px;font-family: 'Open Sans', sans-serif!important;font-weight: 800;color: #DB9619;">SERVICE TYPE</h5></th>
                              <th><h5 style="font-size:20px;font-family: 'Open Sans', sans-serif!important;font-weight: 800;color: #DB9619;">TOTAL AMOUNT TO PAY</h5></th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td><span id="serviceName" class="serviceName"></span></td>
                              <td><h4 id="servicePrice"></h4></td>
                              <input type="hidden" name="" id="serviceAmt">

                              <input type="hidden" name="" id="serviceCategoryTypes">
                              <input type="hidden" name="" id="serviceTypes">
                              <input type="hidden" name="" id="dayTypes">
                              <input type="hidden" name="" id="startDate">
                              <input type="hidden" name="" id="startTime">
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>

                    <div class="d-flex justify-content-center text-center modal-footer">
                      <div class="row">

                        <div class="col-md-12">
                          <div id="paypal-button-container"></div>
                          <button type="button" class="btn PaymentClosebtn btn-danger ms-2" data-dismiss="modal" hidden>CLOSE</button> 
                        </div>


                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- End Registration Modal -->



    </div>
  </div>
  <!-- /.login-box -->

<?php } ?>
<!-- END HARE LOGIN CHECK -->




<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 <script type="text/javascript" src="https://intl-tel-input.com/node_modules/intl-tel-input/build/js/intlTelInput.js?1549804213570"></script>
  <script>
    $('#email').popover();
  </script>
<?php $this->load->view('includes/scriptForPayonline.php') ?>

