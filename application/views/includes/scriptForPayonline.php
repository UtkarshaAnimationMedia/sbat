  <a href="#" class="back-to-top d-flex align-items-center justify-content-center" style="background-color:#AA1F32"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="<?=base_url('assets/vendor/aos/aos.js');?>"></script>
  <script src="<?=base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js');?>"></script>
  <script src="<?=base_url('assets/vendor/glightbox/js/glightbox.min.js');?>"></script>
  <!-- <script src="<?=base_url('assets/vendor/isotope-layout/isotope.pkgd.min.js');?>"></script> -->
  <script src="<?=base_url('assets/vendor/swiper/swiper-bundle.min.js');?>"></script>
  <!-- <script src="<?=base_url('assets/vendor/waypoints/noframework.waypoints.js');?>"></script> -->

  <!-- Template Main JS File -->
  <script src="<?=base_url('assets/js/main.js');?>"></script>



  <script type="text/javascript">

    $(function(){
     $('.modal').modal({backdrop: 'static', keyboard: false});
   })

    $("#loginBtn").hide();

//<---======================== for donate to temple ===================-->//

    function checkLoginStatusForTemple(donationType) {

      var currentDate = '';
      var currentTime = '';
      const date = new Date();
      let day = date.getDate();
      let month = date.getMonth() + 1;
      let year = date.getFullYear();
      let hours = date.getHours(); 
      let minutes = date.getMinutes(); 
      let seconds = date.getSeconds(); 

      currentDate = month+'/'+day+'/'+year;
      currentTime = hours+':'+minutes+':'+seconds;

      var amt = '<?=sprintf("%.2f", 1)?>';
      var DonationName = donationType;
      var DonationTypes = 'Donated-to-temple';
      var DonationId = '';

      var DonationCategoryTypes = 'DONATIONS';
      var DonationdayTypes = '';
      var DonationstartDate = currentDate;
      var DonationstartTime = currentTime;

      event.preventDefault();
      $.ajax({
        url: "<?=base_url('check-login-status')?>",
        type: "POST",
        dataType: "json",
        success: function(data) 
        {
          if(data == 0){
            $("#signupModal").modal("hide");
            $("#loginModal").modal("show");
            // $('#DonationPrice').text('$'+amt);

            $('#mobileotp').focus();

            
            $('#DonationName').text(DonationName);
            $('#DonationAmt').val(amt);
            $('#DonationTypes').val(DonationTypes);
            $('#DonationdayTypes').val(DonationdayTypes);
            $('#DonationCategoryTypes').val(DonationCategoryTypes);
            $('#DonationstartDate').val(DonationstartDate);
            $('#DonationstartTime').val(DonationstartTime);

          }else{
            $("#loginModal").modal("hide");
            // $('#DonationPrice').text('$'+amt);
            $('#DonationName').text(DonationName);
            $('#DonationTypes').val(DonationTypes);
            $('#DonationdayTypes').val(DonationdayTypes);
            $('#DonationCategoryTypes').val(DonationCategoryTypes);
            $('#DonationstartDate').val(DonationstartDate);
            $('#DonationstartTime').val(DonationstartTime);

            $('#DonationAmt').val(amt);
            $("#DonateToTemple").val('DONATIONS');
            $("#DonateToTemplePaymentModal").modal("show");
          }
        }             
      });
    }

//<---======================== end for donate to temple ===================-->//

    function checkLoginStatus(serviceAmt='', serviceName='', service_Id='', serviceCategoryTypes='', serviceTypes='', dayTypes='', startDate='', startTime='') {

     var amt = (serviceAmt / 1).toFixed(2);;
     var serviceName = serviceName;
     var serviceId = service_Id;

     var serviceCategoryTypes = serviceCategoryTypes;
     var serviceTypes = serviceTypes;
     var dayTypes = dayTypes;
     var startDate = startDate;
     var startTime = startTime;

     if($("#DonateToTemple").val() == 'DONATIONS'){ $("#DonateToTemple").val('') };


     event.preventDefault();
     $.ajax({
      url: "<?=base_url('check-login-status')?>",
      type: "POST",
      dataType: "json",
      success: function(data) 
      {
        if(data == 0){
          $("#signupModal").modal("hide");
          $("#EventDetailsModal").modal("hide");
          $('#servicePrice').text('$'+amt);
          $('#serviceName').text(serviceName);
          $('#serviceId').val(serviceId);
          $('#serviceAmt').val(amt);
          $("#loginModal").modal("show");
          $('#serviceCategoryTypes').val(serviceCategoryTypes);
          $('#serviceTypes').val(serviceTypes);
          $('#dayTypes').val(dayTypes);
          $('#startDate').val(startDate);
          $('#startTime').val(startTime);

        }else{
          $("#loginModal").modal("hide");
          $('#servicePrice').text('$'+amt);
          $('#serviceName').text(serviceName);
          $('#serviceId').val(serviceId);
          $('#serviceCategoryTypes').val(serviceCategoryTypes);
          $('#serviceTypes').val(serviceTypes);
          $('#dayTypes').val(dayTypes);
          $('#startDate').val(startDate);
          $('#startTime').val(startTime);
          $('#serviceAmt').val(amt);
          $("#paymentModal").modal("show");
        }
      }             
    });
   }

   function openLoginModal(){
    var emailotpntn = document.getElementById('emailotpntn');

    emailotpntn.disabled = false;
    emailotpntn.innerText = 'LOGIN';


    $('.signupBtnClose').click();
    $("#signupModal").modal("hide");
    $("#loginModal").modal("show");
  }
  function openSignupModal(){
    var signupBtn = document.getElementById('signupBtn');

    signupBtn.disabled = false;
    signupBtn.innerText = 'SIGN UP';

    $('.loginBtnClose').click();
    $("#loginModal").modal("hide");
    $("#signupModal").modal("show");
  }




  function sendEmailOtp(url){
    //test
    var email = $('#loginEmail').val();
    var phoneval = $('#loginPhoneNumber').val();
    var phoneLength = $('#loginPhoneNumber').val().length;

    if (email == "" && phoneLength < 12) {
      $("#login-error-flashmsg").html("Please enter valid email or valid mobile number.");
    }else{
      $("#login-error-flashmsg").html("");

      if(email==""){
        event.preventDefault();
        LoginUser('<?=base_url('signin')?>');

      }else{

       var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
       if(email.match(mailformat))
       {

        var btn = document.getElementById('emailotpntn');
        btn.disabled =true;
        btn.innerText = 'SENDING';

        event.preventDefault();
        var url = url;
        var email = $('#loginEmail').val();
   //alert(email);
        $.ajax({
          url: url,
          type: "POST",
          dataType: "json",
          data : {'email' : email},
          success: function(data) 
          {


            if (data['statusCode'] == '1') {  
            $("#emailotpntn").hide();
            $(".mobile_section").hide();
            
              btn.disabled =true;
              btn.innerText = 'SENT';
              $('#otptoggle').toggle();
              var btn2 = document.getElementById('emailotpverifybtn');
              btn2.disabled =false;
              btn.disabled =true;
              $("#login-success-flashmsg").html("OTP send on this email id!");
              $(".mobile-section").hide();

            }else{


              $("#signup-error-flashmsg").html("This email id is not registerd please signup.");

              if(location.href.indexOf('Payonline') != -1){
                openBoxlog('signup');
                btn.disabled = false;
                btn.innerText = 'Login';

              }else if(location.href.indexOf('Reschedule') != -1){
                openBoxlog('signup');
                btn.disabled = false;
                btn.innerText = 'Login';
              }
              else
              {
               $("#loginModal").modal('hide');
               $("#signupModal").modal('show');
              }

           }
         }             
       });

      }else{
       btn.disabled =false;
       btn.innerText = 'LOGIN';
       $("#login-error-flashmsg").html("Please enter a valid email address.");
     }

        //test end

   }
 }
}

function verifyEmailOtp(url){
 var btn = document.getElementById('emailotpverifybtn');
 btn.disabled =true;
 btn.innerText = 'VERIFYING';

 event.preventDefault();
 var url = url;
 var otp = $('#emailotp').val();

 if (otp == "") {
   $("#login-success-flashmsg").html("");
   $("#login-error-flashmsg").html("Please enter 6 digit OTP!");
   btn.disabled =false;
   btn.innerText = 'VERIFY';

 }else{
   var email = $('#loginEmail').val();
   $.ajax({
    url: url,
    type: "POST",
    dataType: "json",
    data : {'otp' : otp,'email':email},
    success: function(data) 
    {

      if (data['statusCode'] == 1) { 
        btn.disabled =true;
        btn.innerText = 'VERIFIED';
        //$("#loginBtn").show();

        PhoneLogin('<?=base_url('signin')?>');


      }else{
        $("#login-error-flashmsg").html("");
        $("#login-success-flashmsg").html("");
        $("#login-error-flashmsg").html(data['message']);
        btn.disabled =false;
        btn.innerText = 'VERIFY';
      }


    }             
  });
 }
}




function LoginUser(url) {
  var btn = document.getElementById('emailotpntn');
  btn.disabled = true;
  btn.innerText = 'PLEASE WAIT...';

  event.preventDefault();
  var url = url;
  var email = $('#loginEmail').val();
  var phone = $('#loginPhoneNumber').val();


  // alert(email);  

// newphone = phone.replaceAll(" ","").slice(-10);
// NOTE: REMOVE COUNTRY CODE FROM MOBILE NO

  var newphone = 0;
  var cuntryCode =  $("#loginModal .iti__selected-flag").attr('title');
  cuntryCode     =   (cuntryCode.split(':')[1]).trim();
    var value  =  phone.replace(cuntryCode, ''); //replace all $ with empty string
    newphone   =  value; 

    $.ajax({
      url: url,
      type: "POST",
      dataType: "json",
      data : {'email' : email,'phone':newphone},
      success: function(data) 
      {

      // console.log(data);

        if (data.statusCode == 1) {
         btn.disabled =true;
         btn.innerText = 'SENT';

         if(phone!=""){
          submitPhoneNumberAuth();
          $("#emailotpntn").hide();
          $(".email_section").hide();
          $("#loginPhoneNumber").attr('disabled','disabled'); 
        }else{

         $('#otptoggle').css("display", "none");

         var btn2 = document.getElementById('emailotpverifybtn');
         btn2.disabled =false;
         btn.disabled =true;

       // alert('Login Successful.');
         $('.loginBtnClose').click();
         $("#loginModal").modal("hide");
         $("#paymentModal").modal("show");

       }

     }else{


       $("#signup-error-flashmsg").html("This phone no. is not registerd please signup !");

       if(location.href.indexOf('Payonline') != -1){
        openBoxlog('signup');
        btn.disabled = false;
        btn.innerText = 'Login';

      }else if(location.href.indexOf('Reschedule') != -1){
        openBoxlog('signup');
        btn.disabled = false;
        btn.innerText = 'Login';
      }
      else
      {
       $("#loginModal").modal('hide');
       $("#signupModal").modal('show'); 
     }




   }
 }             
});

  }


//Phone Login

  function PhoneLogin(url) {

    event.preventDefault();
    var url = url;
    var email = $('#loginEmail').val();
    var phone = $('#loginPhoneNumber').val();

  // newphone = phone.replaceAll(" ","").slice(-10);


    var newphone = 0;
    var cuntryCode =  $("#loginModal .iti__selected-flag").attr('title');
    cuntryCode =   (cuntryCode.split(':')[1]).trim();
    var value = phone.replace(cuntryCode, ''); //replace all $ with empty string
    newphone =  value; 


    $.ajax({
      url: url,
      type: "POST",
      dataType: "json",
      data : {'email' : email,'phone':newphone,'sessionCreate':1},
      success: function(data) 
      {
      // console.log(data);
        if(data.statusCode == 1) {
       // alert('Login Successful.');


         if($('#serviceId').val())
         {
           $('.loginBtnClose').click();
           $("#loginModal").modal("hide");
           $("#paymentModal").modal("show");
         }
         else
         {
           window.location.reload();
         }




       }else{
        $("#loginModal").modal('hide');
        $("#signupModal").modal('show');
        $("#signup-error-flashmsg").html("This phone no. is not registerd please signup !");
      }
    }             
  });

  }



  function SignupUser(url) {

    var btn = document.getElementById('signupBtn');
    btn.disabled = true;
    btn.innerText = 'PLEASE WAIT...';

    event.preventDefault();
    var url = url;
    var fname = $('#fname').val();
    var lname = $('#lname').val();
    var email = $('#signupEmail').val();
    var phone = $('#signupPhoneNumber').val();

    var newphone = 0;
    var cuntryCode =  $("#signupModal .iti__selected-flag").attr('title');
    cuntryCode =   (cuntryCode.split(':')[1]).trim();
    var value = phone.replace(cuntryCode, ''); //replace all $ with empty string
    newphone =  value; 

    $.ajax({
      url: url,
      type: "POST",
      dataType: "json",
      data : {'fname':fname,'lname':lname,'email' : email,'phone':newphone},
      success: function(data) 
      {
        var loginbtn = document.getElementById('loginBtn');
        var emailotpntn = document.getElementById('emailotpntn');

        const obj = JSON.parse(data);
        if (obj.message == '') {

          loginbtn.disabled = false;
          loginbtn.innerText = 'LOGIN';

          emailotpntn.disabled = false;
          emailotpntn.innerText = 'LOGIN';

          $("#login-success-flashmsg").html(data);


          if(location.href.indexOf('Payonline') != -1){
            openBoxlog('login');
          }
         else if(location.href.indexOf('Reschedule') != -1){
            openBoxlog('login');
          }
          else
          {
            $('.signupBtnClose').click();
            $("#signupModal").modal("hide");
            $("#loginModal").modal("show");
          }



        }else{

          if (obj.message == 'success') {
            loginbtn.disabled = false;
            loginbtn.innerText = 'LOGIN';

            emailotpntn.disabled = false;
            emailotpntn.innerText = 'LOGIN';

            $("#login-success-flashmsg").html(obj.message);


            if(location.href.indexOf('Payonline') != -1){
              openBoxlog('login');
            }
            else if(location.href.indexOf('Reschedule') != -1){
              openBoxlog('login');
            }
            else
            {
              $('.signupBtnClose').click();
              $("#signupModal").modal("hide");
              $("#loginModal").modal("show");
            }

            btn.disabled = false;
            btn.innerText = 'SIGN UP';
          }else{
            loginbtn.disabled = false;
            loginbtn.innerText = 'LOGIN';

            emailotpntn.disabled = false;
            emailotpntn.innerText = 'LOGIN';

            $("#signup-error-flashmsg").html(obj.message);

            btn.disabled = false;
            btn.innerText = 'SIGN UP';
          }
        }
      }             
    });
  }


</script>


<!-- Mobile OTP AUTH BY FIREBASE -->
<!-- Add the latest firebase dependecies from CDN -->
<script src="https://www.gstatic.com/firebasejs/6.3.3/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/6.3.3/firebase-auth.js"></script>


<script>
      // Paste the config your copied earlier
  var firebaseConfig = {
    // apiKey: "AIzaSyDOZaA5y9troVat374EID1ARxuMfMfL-dA",
    // authDomain: "partyplanet-65d19.firebaseapp.com",
    // databaseURL: "https://medium-d924f.firebaseio.com",
    // projectId: "partyplanet-65d19",
    // storageBucket: "partyplanet-65d19.appspot.com",
    // messagingSenderId: "1012225783641",
    // appId: "1:1012225783641:web:76cfa38acda53641e6be48"

    apiKey: "AIzaSyAcxU5AvD6qtVG76xDCXaf2vzuPIX_DwMw",
    authDomain: "login-7aff9.firebaseapp.com",
    projectId: "login-7aff9",
    storageBucket: "login-7aff9.appspot.com",
    messagingSenderId: "981533541532",
    appId: "1:981533541532:web:9846cc5487bb8fead35959",
    measurementId: "G-57D5BT4B2F"
  };


  firebase.initializeApp(firebaseConfig);

      // Create a Recaptcha verifier instance globally
      // Calls submitPhoneNumberAuth() when the captcha is verified
  window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier(
    "recaptcha-container",
    {
      size: "normal",
      callback: function(response) {
        submitPhoneNumberAuth();
      }
    }
    );

      // This function runs when the 'sign-in-button' is clicked
      // Takes the value from the 'phoneNumber' input and sends SMS to that phone number
  function submitPhoneNumberAuth() {
    var phoneNumber = document.getElementById("loginPhoneNumber").value;
    var appVerifier = window.recaptchaVerifier;
    firebase
    .auth()
    .signInWithPhoneNumber(phoneNumber, appVerifier)
    .then(function(confirmationResult) {
      window.confirmationResult = confirmationResult;

      if(confirmationResult.verificationId)
      {
        $("#mobiletoggle").toggle();
      $('#mobileotp').focus();
        $(".otpsendmsg_number").html("OTP has been sent on this mobile number.");
        $("#recaptcha-container").remove();
      }


    })
    .catch(function(error) {
      console.log(error);
        // $(".otpsendmsg_number").html("OTP has been sent on this mobile number.");
      $("#login-error-flashmsg").html(error.message);

    });
  }

  function submitPhoneNumberAuthCode() {
    var btn = document.getElementById('mobileotpverifybtn');
    btn.disabled =true;
    btn.innerText = 'VERIFYING';


    var code = document.getElementById("mobileotp").value;
    if (code == "") {
     btn.disabled =false;
     btn.innerText = 'VERIFY';
     $(".otpsendmsg_number").html("");
     $(".otpsendmsg_number_error").html("Please enter OTP");
   }else{
    confirmationResult
    .confirm(code)
    .then(function(result) {
      var user = result.user;
      // console.log(user);




      PhoneLogin('<?=base_url('signin')?>');


      // console.log("USER LOGGED IN");

    })
    .catch(function(error) {
      alert('Invalid OTP/OTP Expired!!')
      var btn = document.getElementById('mobileotpverifybtn');
      btn.disabled =false;
      btn.innerText = 'VERIFY';
      console.log(error);
    });

         //This function runs everytime the auth state changes. Use to verify if the user is logged in
    firebase.auth().onAuthStateChanged(function(user) {
    });
  }
}


</script>

<!-- --------------------------------------------------------------------------------------------- -->
<!-- --------------------------------------------------------------------------------------------- -->
<!-- --------------------------------------------------------------------------------------------- -->


<!-- Paypal Payment Method Integration -->
<script src="https://www.paypal.com/sdk/js?client-id=AZWa1v-41vEK0OBD5Gh4e7dzK1jDBktayNboPvTKQpmyaf4iOJdSQ9wg3uy_-d9fQZdWYRYnyDZKQxs0&currency=USD&intent=capture&enable-funding=venmo" data-sdk-integration-source="integrationbuilder"></script>
<script>

  const paypalButtonsComponent = paypal.Buttons({
    style: {
      shape: 'rect',
      color: 'gold',
      layout: 'vertical',
      label: 'paypal',

    },
// set up the transaction
    createOrder: (data, actions) => {

      if($("#DonateToTemple").val() == 'DONATIONS'){ 
        amt = $("#DonationAmt").val(); 
      }else{
       amt = $("#serviceAmt").val()
     }


     const createOrderPayload = {
      purchase_units: [
      {
        amount: {
          value:amt
        }
      }
      ]
    };

    return actions.order.create(createOrderPayload);
  },
   // finalize the transaction
  onApprove: (data, actions) => {
    const captureOrderHandler = (details) => {

      const payerName = details.payer.name.given_name;
      var payer_firstname = details.payer.name.given_name;
      var payer_lastname = details.payer.name.surname;
      var orderid = details.id;
      var status = details.status;
      var email = details.payer.email_address;
      var transaction_id = details.purchase_units[0].payments.captures[0].id;
      var serviceAmount = details.purchase_units[0].amount.value;


      if($("#DonateToTemple").val() == 'DONATIONS'){ 
        var serviceName = $("#DonationName").text();
        var service_Id = $("#DonationId").val();
        var serviceCategoryTypes = $("#DonationCategoryTypes").val();
        var serviceTypes = $("#DonationTypes").val();
        var dayTypes = $("#DonationdayTypes").val();
        var startDate = $("#DonationstartDate").val();
        var startTime = $("#DonationstartTime").val();
      }
      else
      {
        var serviceName = $("#serviceName").text();
        var service_Id = $("#serviceId").val();
        var serviceCategoryTypes = $("#serviceCategoryTypes").val();
        var serviceTypes = $("#serviceTypes").val();
        var dayTypes = $("#dayTypes").val();
        var startDate = $("#startDate").val();
        var startTime = $("#startTime").val();

      }

      $.ajax({
        url: "<?=base_url('add-service-cart')?>",
        type: "POST",
        dataType: "json",
        data : {
          'fname' : payer_firstname, 
          'lname': payer_lastname, 
          'orderid': orderid, 
          'status': status, 
          'email': email, 
          'services_Id': service_Id,
          'serviceAmount':serviceAmount, 
          'serviceName': serviceName,
          'transaction_id': transaction_id,
          'serviceCategoryTypes': serviceCategoryTypes,
          'serviceTypes': serviceTypes,
          'dayTypes': dayTypes,
          'startDate': startDate,
          'startTime': startTime,
          'qty': 1
        },
        success: function(response) 
        {
            // console.log(response);
          if (response.statusCode == 1) {
              // console.log(response);
            $('.PaymentClosebtn').click();
            $("#paymentModal").modal("hide");


            swal({
              html: true,
              title: "Service Booking Confirmed!",
              text: "<span style='font-weight: 600;margin:5px;padding:5px'>Invoice No:</span> "+response.data[0].invoiceNo+"<br> <span style='font-weight: 600;margin:5px;padding:5px'>Transaction Id:</span>"+transaction_id,
              type: "success",
              confirmButtonText: 'OK',
              confirmButtonColor: '#008080',
                // timer:5000,
            },
            function(){
             if(location.href.indexOf('Payonline') != -1){
              window.location.href="<?= base_url('logout'); ?>";
            }else if(location.href.indexOf('Reschedule') != -1){

              window.location.href="<?= base_url('Reschedule/RescheduleProcess'); ?>";
            }
            else
            {
              window.location.reload(); 
            }


          });


          }else{
           $('.PaymentClosebtn').click();
           $("#paymentModal").modal("hide");
           swal({
            html: true,
            title: "Failed!",
            text: "<span>Transaction Failed!<span><br><span style='font-weight: 600;margin:5px;padding:5px'>Invoice No:</span> "+response.data[0].invoiceNo+"<br> <span style='font-weight: 600;margin:5px;padding:5px'>Transaction Id:</span>"+transaction_id,
            type: "error",
            confirmButtonText: 'OK',
            confirmButtonColor: '#008080',
              // timer:5000,
          },
          function(){
            window.location.reload(); 
          });



         }

           // setTimeout(function(){
           //   window.location.reload();
           // }, 10000);

       }             
     });
    };

    return actions.order.capture().then(captureOrderHandler);
  },
  onError: (err) => {
    alert('Transaction failed!');
  }
});

  paypalButtonsComponent
  .render("#paypal-button-container")
  .catch((err) => {
    console.log('PayPal Buttons failed to render');
  });


 /* paypalButtonsComponent
  .render("#paypal-button-container-donation")
  .catch((err) => {
    console.log('PayPal Buttons failed to render');
  });*/





  function nonEditCuntryCode(el)
  {
   var cuntryCode =  $("#loginModal .iti__selected-flag").attr('title');
// alert(cuntryCode);
   cuntryCode =   (cuntryCode.split(':')[1]).trim();

   if(el.value.length > cuntryCode.length)
   {
        var value = el.value.replace(cuntryCode, '');; //replace all $ with empty string
        el.value = cuntryCode + value;     
      }else
      {
        el.value = cuntryCode;     
      }
    }



    function nonEditCuntryCode1(el)
    {
     var cuntryCode =  $("#signupModal .iti__selected-flag").attr('title');
     cuntryCode =   (cuntryCode.split(':')[1]).trim();
     if(el.value.length > cuntryCode.length)
     {
        var value = el.value.replace(cuntryCode, '');; //replace all $ with empty string
        el.value = cuntryCode + value;     
      }else
      {
        el.value = cuntryCode;     
      }
    }




    function openBoxlog(type)
    {
      if(type=='signup')
      {
       $(".login-box-msg h4").text('SIGN UP');
       $("#loginModal").hide();
       $(".inLogin").hide();
       $("#signupModal").show();
       $(".inSignup").show();

     }else if(type=='login')
     {
      $(".login-box-msg h4").text('LOGIN IN');
      $("#signupModal").hide();
      $(".inSignup").hide();
      $("#loginModal").show();
      $(".inLogin").show();
    }
  }

/*----------------------------------*/

/*==================================================*/
/*==================Script For Currency Input (.00)=================*/
/*==================================================*/
  (function($) {
  $.fn.currencyInput = function() {
    this.each(function() {
      var wrapper = $("<div class='currency-input' />");
      $(this).wrap(wrapper);
      // $(this).before("<span class='currency-symbol' style='padding:7px 13px'>$</span>");
      $(this).change(function() {
        var min = parseFloat($(this).attr("min"));
        var max = parseFloat($(this).attr("max"));
        var value = this.valueAsNumber;
        if(value < min)
          value = min;
        else if(value > max)
          value = max;
        $(this).val(value.toFixed(2)); 
      });
    });
  };
})(jQuery);

$(document).ready(function() {
  $('input.currency').currencyInput();
});

</script>


<script type="text/javascript" src="<?=base_url('assets/js/country_code.js')?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/country_code2.js')?>"></script>

</body>

</html>