<style type="text/css">
  .modalCloseBtn{position: absolute; left: 91%;}
  .modatTitle{
    display:block;margin-left: auto;margin-right: auto;font-size:16px;font-family: 'Open Sans', sans-serif!important;font-weight: 800;color: #7D1456;
  }

  /*  For Hide Arrow from input type number*/
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

.h5-title{
  font-size:16px;
  font-family: 'Open Sans', sans-serif!important;
  font-weight: 800;color: #B02135;
}
.modal-header {
  border-top: 6px solid #910301;
}

#sinupformid .form-control{ margin: auto!important; }

</style>
<?php
$header_data = $this->mongo_db2->where(['aspectType'=> 'headerSettings'])->get('wesiteSettings');

$modalClbtn = 'modalClbtn';
if ($this->session->userdata('logged_in') == 1 ) { $modalClbtn = ''; }

?>
<!-- Registration Modal -->
<div class="modal fade" id="signupModal" tabindex="-1"  role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form action="#" method="post" id="sinupformid" onsubmit="return SignupUser('<?=base_url('signup')?>')" autocomplete="off" >
        <div class="modal-header text-center">
          <h5 class="modal-title bottomborder modatTitle" style="">SIGN UP</h5>
          <button type="button" class="btn-close modalCloseBtn <?= $modalClbtn; ?>" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        
        <div class="modal-body p-0">
          <div class="container">
            <img src="<?=base_url('assets/img/logo-1.png') ?>" class="img-fluid my-3" height="120px" width="150px" style="display: block;margin-left: auto;margin-right: auto;">
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
                      <div class="col-md-6 mb-4">
                        <div class="form-outline">
                          <label class="form-label" for="fname">First name</label>
                          <input type="text" id="fname" name="fname" class="form-control" required autocomplete="off"  placeholder="Enter your first name" />
                        </div>
                      </div>
                      <div class="col-md-6 mb-4">
                        <div class="form-outline">
                          <label class="form-label" for="lname">Last name</label>
                          <input type="text" id="lname" name="lname" class="form-control" autocomplete="off"  placeholder="Enter your last name" />
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-12 mb-4">
                        <div class="form-outline">
                          <label class="form-label" for="signupEmail">Email</label>
                          <input type="email" id="signupEmail" name="email" class="form-control" required autocomplete="off"  placeholder="Enter your email" />
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-12 mb-4">
                        <div class="form-outline">
                          <label class="form-label" for="signupPhoneNumber">Phone Number</label>
                          <input type="tel" placeholder="Ex. +1 (702) 123-4567" minlength="10" maxlength="15" id="signupPhoneNumber" name="phone" class="phone-with-country-code form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57 || event.charCode==43 || event.charCode==13 ))" oninput="nonEditCuntryCode1(this);" value="+1" minlength="10"  autocomplete="none" required>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-12 mb-4">
                          <div class="form-outline text-center">
                           <div class="col-md-12">
                             <button type="submit" class="btn btn-warning ms-2" id="signupBtn">SIGN UP</button>
                             <button type="button" class="signupBtnClose btnClose btn btn-danger ms-2" data-dismiss="modal" hidden>CLOSE</button> 
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
         <div class="d-flex justify-content-center modal-footer">
           <div class="row mx-auto d-block my-4">

             <div class="col-md-12 my-4s">
               <a href="javascript:void()" onclick="openLoginModal()">Already registered? Sign In</a>
             </div>
           </div>
         </div>
       </form>
     </div>
   </div>
 </div>
 <!-- End Registration Modal -->

 <!-- Login  Modal -->
 <div class="modal fade modal-danger modal-outline" id="loginModal" tabindex="-1"  role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">




      <form action="#" method="post" id="phonemyForm"  autocomplete="off">
        <div class="modal-header text-center">
         <!-- <h5 class="modal-title text-center bottomborder modatTitle" >SIGN IN</h5> -->
         <button type="button" class="btn-close modalCloseBtn <?= $modalClbtn; ?>" data-bs-dismiss="modal" aria-label="Close"></button>
       </div>
       <div class="modal-body p-0">
         <img src="<?=base_url('assets/img/logo-1.png') ?>" class="img-fluid my-3" height="120px" width="150px" style="display: block;margin-left: auto;margin-right: auto;">
         <style type="text/css">
          .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
            color: #ffffff;
            background-color: #008080;
            border-color: var(--bs-nav-tabs-link-active-border-color);
          }
        </style>




        <div class="row">
          <h5 class="text-center bottomborder modatTitle" >SIGN IN</h5>
          <div class="col-md-12 mt-4">
            

            <ul id="tabs" class="nav nav-tabs nav-fill">
              <li class="nav-item"><a href="#AdministratorTab" id="AdministratorTab" tab-name="Management" data-toggle="tab" class="nav-link rounded-0 active border-0 m-0" onclick="AuthenticateUser('Management')">Management</a></li>
              <li class="nav-item"><a href="#devoteeTab" id="devoteeTab" tab-name="Devotee" data-toggle="tab" class="nav-link rounded-0 border-0 m-0" onclick="AuthenticateUser('Devotee')">Devotee</a></li>

            </ul>

             <div class="container mt-3">
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
                      <span class="email_section">
                        <div class="row">
                          <div class="col-md-12">
                            <input type="email" id="loginEmail" placeholder="Enter your email Id." name="email" class="form-control" data-onclick="<?=base_url('send-email-otp');?>" style="margin: 0px;" oninput="loginBy('email');"  autocomplete="none" />
                            <span class="otpsendmsg" style="color: green; font-size: 11px;margin-left: 12px;"></span>
                          </div>
                        </div>

                      </span>

                      <span class="mobile_section">
                        <div class="text-center mb-3">--OR--</div>
                        <div class="row" >
                          <div class="col-md-12 mb-4 ">

                            <input type="tel" placeholder="Ex. +1 (702) 123-4567"  id="loginPhoneNumber" name="phone" class="phone-with-country-code form-control" data-onclick="<?=base_url('send-email-otp');?>" minlength="10" maxlength="15" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57 || event.charCode==43  || event.charCode==13 ))" oninput="nonEditCuntryCode(this);loginBy('mobile')" value="+1" minlength="10" autocomplete="none">
                              <span class="otpsendmsg_number" style="color: green; font-size: 18px;margin-left: 12px;"></span>
                            </div>


                            <div class="col-md-12 mb-4">
                             <center>
                               <button id="emailotpntn" class="btn btn-success" onclick="sendEmailOtp('<?=base_url('send-email-otp')?>')">Login</button>
                             </center>
                           </div>
                         </div>
                       </span>

                       <div class="row vOtpBox" id="otptoggle" style="display:none;">
                        <div class="col-md-8 mb-4">
                          <input type="number" id="emailotp" name="emailotp" placeholder="Please enter OTP to continue." class="form-control" onkeypress="if(event.charCode==13 ){ verifyEmailOtp('<?=base_url('email-otp-verification');?>');  }"  required  />
                        </div>
                        <div class="col-md-4 mb-4">
                          <button id="emailotpverifybtn" class="btn btn-success verifyBtn" onclick="verifyEmailOtp('<?=base_url('email-otp-verification');?>')">VERIFY</button>
                        </div>
                      </div>
                      <div class="row mobile-section otpmobilebox vOtpBox" id="mobiletoggle"  style="display:none;">
                        <div class="col-md-8 mb-4">
                          <input type="number" id="mobileotp" name="mobileotp" placeholder="Please enter OTP to continue." class="form-control" />
                          <span class="otpsendmsg_number_error" style="color: red; font-size: 18px;margin-left: 12px;"></span>
                        </div>
                        <div class="col-md-4 mb-4">
                          <button id="mobileotpverifybtn" class="btn btn-success verifyBtn" onclick="submitPhoneNumberAuthCode()">VERIFY</button>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12" id="recaptcha-container"></div>
                      </div>
                    </div>
                  </div>
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
      <div class="col-md-12 my-4">   
        <a href="javascript:void()" onclick="openSignupModal()">New User? Sign Up</a>
      </div>
    </div>
  </div>
</form>

</div>
</div>
</div>
<!-- End Login Modal -->
<?php $serviceDetails = $this->session->userdata('serviceDetails')?>
<!-- Payment Modal -->
<div class="modal fade" id="paymentModal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">

      <form action="#" method="post"  onsubmit="return SignupUser('<?=base_url('signup')?>')">
        <div class="modal-header text-center">
          <h5 class="modal-title bottomborder modatTitle" >CHECKOUT</h5>
          <button type="button" class="btn-close modalCloseBtn <?= $modalClbtn; ?>" data-bs-dismiss="modal" aria-label="Close"></button>
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
                              <th><h5 class="h5-title">Service</h5></th>
                              <th><h5 class="h5-title">Amount to Pay</h5></th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td><span id="serviceName" class="serviceName"></span></td>

                              <td id="edittable">

                              </td>
                              <input type="hidden" name="" id="serviceCategoryTypes">
                              <input type="hidden" name="" id="serviceTypes">
                              <input type="hidden" name="" id="dayTypes">
                              <input type="hidden" name="" id="startDate">
                              <input type="hidden" name="" id="startTime">
                            </tr>
                          </tbody>
                        </table>


                        <table class="table table-responsive table-bordered text-center" id="dateTimeTable">
                          <tbody id="servicesDetails">

                           <tr>
                            <td>Date</td>
                            <td>
                              <input type='text' class='form-control datepicker-child-events' id='serviceStartDate' onkeyup='date_reformat_mm(this);' onkeypress='date_reformat_mm(this);' placeholder="MM/DD/YYYY" onpaste='date_reformat_mm(this);' autocomplete='off'>
                            </td>
                          </tr>

                          <tr>
                            <td>Time</td>
                            <td id='ServiceStartTime'>
                             <div class='timepicker_div'>
                              <input type='text'  class='form-control' id="timepicker" placeholder='Time'>
                            </div>
                          </td>
                        </tr>

                      </tbody>
                    </table>


                    <div id="addressField"></div>
                  </div>
                </div>

                <div class="d-flex justify-content-center text-center modal-footer">
                  <div class="row">

                    <div class="col-md-12">
                      <div class="oooooookkakak" id="paypal-button-container"></div>
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

<!-- Donate to Temple Payment Modal -->
<div class="modal fade" id="DonateToTemplePaymentModal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">


      <form action="#" method="post">
        <div class="modal-header text-center">
          <h5 class="modal-title bottomborder modatTitle" >DONATE TO TEMPLE</h5>

          <button type="button" class="btn-close modalCloseBtn <?= $modalClbtn; ?>" data-bs-dismiss="modal" aria-label="Close"></button>
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
                              <th style="display: none;"><h5 class="h5-title">SERVICE</h5></th>
                              <th><h5 class="h5-title">AMOUNT TO PAY (IN $)</h5></th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td style="display:none;"><span id="DonationName" class="DonationName"></span></td>
                              <td><input style="text-align: right;" type="number" class="form-control currency" id="DonationAmt" min="1.00" value="1.00" required/></td>
                              <input type="hidden" name="" id="DonateToTemple">
                              
                              <input type="hidden" name="" id="DonationId">
                              <input type="hidden" name="" id="DonationCategoryTypes">
                              <input type="hidden" name="" id="DonationTypes">
                              <input type="hidden" name="" id="DonationdayTypes">
                              <input type="hidden" name="" id="DonationstartDate">
                              <input type="hidden" name="" id="DonationstartTime">


                              <input type="hidden" id="donateToTempleBtnBeforeLogin" name="donateToTempleBtnBeforeLogin">

                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>

                    <div class="d-flex justify-content-center text-center modal-footer">
                      <div class="row">

                        <div class="col-md-12">
                          <div id="paypal-button-container-donation"></div>
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


<?php   $userSession = $this->session->userdata('refDataName'); 
if (isset($userSession)){?> 
  <input type="hidden" name="" id="refDataName" value="<?=$userSession?>">
<?php } ?>
<input type="hidden" name="serviceId" id="serviceId">
<input type="hidden" name="fromPage" id="fromPage">






