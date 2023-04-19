
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

.error{color: red;}

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
          <div class="center fill-remaining-space"><h4>Reschedule</h4></div>
        </div>
      </div>

      <div class="card-body login-card-body" >
  
   <form action="<?= base_url('Reschedule/saveReschedule'); ?>" method="post">
        
        <div class="modal-body">
          <div class="container">
            <!-- 
            <img src="<?=ApiBaseUrl()['url'].$header_data[0]['leftImage']?>" class="img-fluid mb-4" height="100px" width="100px" style="display: block;margin-left: auto;margin-right: auto;">
          -->
            <div class="row d-flex justify-content-center align-items-center">
              <div class="col-xl-12">
                <div class="row g-0">
                  <div class="col-xl-12">
                   



                    <?php if(!empty($serviceDetails)){ ?>
                    <div class="row"> 
                      <div class="col-md-12 mb-4">
                       
                        <div class="row">
                          <table class=" mb-4">
                            <tbody>
                              <tr>
                                <td>Member</td>
                                <td>:<strong> <?= ucfirst($loginUserDetails['refDataName']); ?></strong></td>
                              </tr>

                             <!--  <tr>
                                <td>Category</td>
                                <td>: <?= $serviceDetails->serviceCategoryTypes; ?></td>
                              </tr> -->

                              <tr>
                                <td>Service Type</td>
                                <td>: <?= $serviceDetails->serviceTypes; ?></td>
                              </tr>
                              <tr>
                                <td>Service</td>
                                <td>: <strong><?= $serviceDetails->ServiceSetup; ?></strong> </td>
                              </tr>
                              <tr>
                                <td>Amount</td>
                                <td>: <strong>$<?= ($serviceDetails->serviceAmount)?sprintf('%.2f', $serviceDetails->serviceAmount):'0'; ?></strong> </td>
                              </tr>
                              <tr>
                                <td>Service Date</td>
                                <td>: <?= $serviceDetails->requestDate; ?></td>
                              </tr>
                              <tr>
                                <td>Service Time</td>
                                <td>: <?= $serviceDetails->serviceTime; ?></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
            

                        <div class="row">
                          <!-- <div class="col-md-12"> -->
                            <label>Enter Note: <span class="error">*</span></label>
                            <textarea class="form-control" name="clientmessage"  rows="3"></textarea>
                          <!-- </div> -->
                        </div>

                      </div>
                    </div>

                      <div class="row">
                        <div class="col-md-12">
                          <div class="d-flex justify-content-center text-center modal-footer">
                            <button type="reset" class="btn btn-danger ms-2" data-dismiss="modal" >CLOSE</button> 
                            <input type="submit" class="btn btn-success ms-2" id="submit_btn" value="Submit">
                          </div>
                      </div>
                    </div>


                  <?php }else{ ?>


                    <div class="row">
                      <div class="col-md-12">
                        <div class=" text-center ">

                          <h3 class="text-danger mb-4">Not a valide service. </h3>

                            <a href="<?= base_url('logout'); ?>" class="btn btn-success ms-2"> Okey </a>
                            <a href="<?= base_url('logout'); ?>" class="btn btn-danger ms-2"> Cancel </a>

                        </div>
                      </div>
                    </div>

                  <?php } ?>


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

<?php } ?>


<!-- END HARE LOGIN CHECK -->








<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>

$(function(){
$('form').validate({
    rules: {
        // serviceStatus: "required",
        clientmessage: "required",
    }
});


$('form').on('submit', function(e) {
    if ($("form").validate().form()) {
        e.preventDefault();
        var formData = new FormData(this);
        var   url = $(this).attr('action');
        var serviceStatus = "<?= $rescheduleUser['status']; ?>";
      swal({
        title: "Are you sure you want to "+serviceStatus+"?",
        text: "",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes",
        closeOnConfirm: false
      },
      function(){
             $.ajax({
              type: 'POST',
              url: url,
              data: formData,
              beforeSend: function() {
                $('#submit_btn').prop('value', 'Please wait..');
              },
              cache: false,
              contentType: false,
              processData: false,
              dataType: "json",
              success: function(result) {
                  $('#submit_btn').prop('value', 'Send Message');
                  console.log(result);
                if(result.status > 0)
                {
                   $('form')[0].reset();
                           swal({
                            html: true,
                            title: result.message,
                            text: "",
                            type: "success",
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#008080',
                          },
                          function(){
                            // alert('DDDDDDDDDDDDDD');
                            window.location.href="<?= base_url('logout'); ?>";
                          });
                }
                else
                {
                   swal({
                            html: true,
                            title: result.message,
                            text: "",
                            type: "error",
                            confirmButtonText: 'OK',
                          });
                }
                
              }
            });

      });
    }
});




})

  </script>


