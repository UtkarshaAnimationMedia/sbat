<!-- date picker -->
<script src="<?=base_url('assets/js/jquery-ui.min.js');?>"></script>
<!-- date picker -->


<a href="#" class="back-to-top d-flex align-items-center justify-content-center" style="background-color:var(--headerFooter)!important;"><i class="bi bi-arrow-up-short"></i></a>


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


  // Create a new ldLoader object
  var loader = new ldLoader({root: ".ldld.full"});


  if (window.performance && window.performance.navigation.type === window.performance.navigation.TYPE_BACK_FORWARD) {
  // Show the loader if the page is being loaded from the cache
    loader.on();
  }



// Add a click event listener to the document object
  document.addEventListener("click", function(event) {


  // Check if the clicked element matches a specific selector
    if (event.target.matches(".navlink, .loader")) {
    // Show the loader
      loader.on();
    }
  });

// Wait for the page to finish loading
  window.onload = function() {
  // Hide the loader
    loader.off();
  };





  $(function(){
   $('#timepicker').mdtimepicker();
   $('.modal').modal({backdrop: 'static', keyboard: false});
 });
  $("#loginBtn").hide();

//<---======================== for donate to temple ===================-->//


  function checkLoginStatusForTemple(donationType) {

   loader.on();

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
     loader.off();
     if(data == 0){
      $("#signupModal").modal("hide");
      $("#loginModal").modal("show");
            // $('#DonationPrice').text('$'+amt);

      $('#DonationName').text(DonationName);
      $('#DonationAmt').val(amt);
      $('#DonationTypes').val(DonationTypes);
      $('#DonationdayTypes').val(DonationdayTypes);
      $('#DonationCategoryTypes').val(DonationCategoryTypes);
      $('#DonationstartDate').val(DonationstartDate);
      $('#DonationstartTime').val(DonationstartTime);


      $("#donateToTempleBtnBeforeLogin").val('donatetotempleclicked');


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

   loader.on();

   var amt = (serviceAmt / 1).toFixed(2);
   var serviceName = serviceName;
   var serviceId = service_Id;

   var serviceCategoryTypes = serviceCategoryTypes;
   var serviceTypes = serviceTypes;
   var dayTypes = dayTypes;
   var startDate = startDate;
   var startTime = startTime;



   if (serviceCategoryTypes == 'DONATIONS') {
    $("#dateTimeTable").css('display','none');
  }
  if($("#DonateToTemple").val() == 'DONATIONS'){ $("#DonateToTemple").val('') };

  if (serviceCategoryTypes == 'DONATIONS' && amt == 0.00) {
    $("#edittable").html('<input style="text-align: right;" type="number" class="form-control currency" id="serviceAmt" min="1.00" value="1.00" required/>');
  }else{

    $("#edittable").html('<h4 id="servicePrice">'+amt+'</h4><input type="hidden" name="" value="'+amt+'" id="serviceAmt">');
  }

  event.preventDefault();
  $.ajax({
    url: "<?=base_url('check-login-status')?>",
    type: "POST",
    dataType: "json",
    success: function(data) 
    {
     loader.off();
     if(data == 0){
      $("#signupModal").modal("hide");
      $("#EventDetailsModal").modal("hide");
      $('#servicePrice').text('$'+amt);
      $('#serviceName').text(serviceName);
      $('#serviceId').val(serviceId);
      if (amt != 0.00) {
        $('#serviceAmt').val(amt);
      }
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
      if (amt != 0.00) {
        $('#serviceAmt').val(amt);
      }

      $.ajax({
        url: "<?= base_url('Home/getServiceDetailsById')?>",
        type: "POST",
        data : {'serviceId' : serviceId},
        success: function(serviceDetails) 
        {
         loader.off();
         var details = JSON.parse(serviceDetails);

              // console.log(details._id);


         if (serviceDetails != '') {
          $("#servicesDetails").html();



          if (details.startDate != '') {
            if ($("#serviceStartDate").val() != '') {
              $("#serviceStartDate").val('');
            }
            $("#serviceStartDate").val('');
            $("#serviceStartDate").val(details.startDate);
            $("#serviceStartDate").prop('readonly', true);
          }else{
           if ($("#serviceStartDate").val() != '') {
            $("#serviceStartDate").val('');
          }
          $("#serviceStartDate").val('');
          $("#serviceStartDate").val(details.startDate);
          $("#serviceStartDate").prop('readonly', false);
        }

        if (details.startTime != '') {

          if ($("#timepicker").val() != '') {
            $("#timepicker").val('');
          }

          $("#timepicker").val(details.startTime);
          $("#timepicker").prop('readonly', true);
          $("#timepicker").prop('disabled', true);


        }else{
         if ($("#timepicker").val() != '') {
          $("#timepicker").val('');
        }

        $("#timepicker").val(details.startTime);
        $("#timepicker").prop('readonly', false);
        $("#timepicker").prop('disabled', false);
      }


      $("#modaleventCloseBtn").click();
      $("#paymentModal").modal("show");
    }
  }             
});



      if ($("#serviceCategoryTypes").val() == 'AWAY-TEMPLE') {
        $("#addressField").html('<p>Please Select Your Service Location:</p> <input type="radio" id="home" name="ServiceAddress" value="home" checked required>  <label for="home">Home</label><br> <input type="radio" id="other" name="ServiceAddress" value="other">  <label for="other">Other Location</label><br><textarea class="form-control my-3" placeholder="Enter Your Full address" id="Address" name="Address" style="display:none" required></textarea>');


        $('input:radio[name="ServiceAddress"]').change(function(){
          if($(this).val() == 'home'){
           $("#Address").css('display','none');
         }else{
          $("#Address").css('display','inline-flex');
        }
      });

      }
    }
  }             
});
}


function subscribeNewsletterCheckLogin(){
 loader.on();

 event.preventDefault();
 $.ajax({
  url: "<?=base_url('check-login-status')?>",
  type: "POST",
  dataType: "json",
  success: function(data) 
  {
   loader.off();
   if (data == 0) {
    openLoginModal('newsletter');
  }else{
    subscribeNewsletter();
  }

}
});
}

function subscribeNewsletter() {

 event.preventDefault();

 loader.on();
 $.ajax({
  url: "<?=base_url('Home/subscribeNewsletter')?>",
  type: "POST",
  dataType: "json",
  success: function(data) 
  {
    // alert(data);
   loader.off();

   swal({
     html: true,
     title: data,
     type: "success",
     confirmButtonText: 'OK',
     confirmButtonColor: '#008080',
   },

   function(){
     if((location.href.match(/([^\/]*)\/*$/)[1]).indexOf('Payonline') != -1){
      window.location.href="<?= base_url('logout'); ?>"
    }
    else
    {
      window.location.reload(); 
    }

  });
 }
});

}

function openLoginModal(page = ''){


  var fromPage = page;
  $("#fromPage").val(page);
  $("form").get(0).reset();

  var emailotpntn = document.getElementById('emailotpntn');

  emailotpntn.disabled = false;
  emailotpntn.innerText = 'LOGIN';

  $('.signupBtnClose').click();
  $("#signupModal").modal("hide");
  $("#loginModal").modal("show");


  $(".vOtpBox").hide();
  $("#emailotpntn").show();
  $(".mobile_section").show();
  $(".email_section").show();
}

function openSignupModal(){
  $("form").get(0).reset();

  var signupBtn = document.getElementById('signupBtn');
  signupBtn.disabled = false;
  signupBtn.innerText = 'SIGN UP';
  $('.loginBtnClose').click();
  $("#loginModal").modal("hide");
  $("#signupModal").modal("show");
}


function sendEmailOtp(url){
 loader.on();
    //test
 var email = $('#loginEmail').val();
 var phoneval = $('#loginPhoneNumber').val();
 var phoneLength = $('#loginPhoneNumber').val().length;

 if (email == "" && phoneLength < 12) {
  $("#login-error-flashmsg").html("Please enter valid email or valid mobile number.");
  setTimeout(function(){$("#login-error-flashmsg").text('');},6000);
  loader.off();

}else{
  $("#login-error-flashmsg").html("");

  if(email==""){
    event.preventDefault();
    LoginUser('<?=base_url('signin')?>');
    loader.off();
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
       loader.off();


       if (data['statusCode'] == '1') {  




        $("#emailotpntn").hide();
        $(".mobile_section").hide();

        btn.disabled =true;
        btn.innerText = 'SENT';
            // $('#otptoggle').toggle();
        $('#otptoggle').css('display','inline-flex');
        var btn2 = document.getElementById('emailotpverifybtn');
        btn2.disabled =false;
        btn.disabled =true;
        $("#emailotp").focus();
        $("#login-success-flashmsg").text("OTP send on this email id!");
        $(".mobile-section").hide();
        setTimeout(function(){$("#login-success-flashmsg").text('');},6000);

      }
      else if (data['statusCode'] == '2') {
       btn.disabled =false;
       btn.innerText = 'LOGIN';
       $("#login-success-flashmsg").html("<i class='fa fa-exclamation-triangle text-danger'> <b class='text-danger'>Technical Error! Please Login With Phone Number or Contact Admin.</b>");
     }else{
      $("#loginModal").modal('hide');
      $("#signupModal").modal('show');

      $("#signupEmail").val(email);

                 // $("#signupPhoneNumber").val(phoneval);

      $("#signup-error-flashmsg").html("This email id is not registerd please signup.");
      setTimeout(function(){$("#signup-error-flashmsg").text('');},6000);
    }
  }             
});

  }else{
   btn.disabled =false;
   btn.innerText = 'LOGIN';
   $("#login-error-flashmsg").html("Please enter a valid email address.");
   setTimeout(function(){$("#login-error-flashmsg").text('');},6000);
   loader.off();
 }

        //test end

}
loader.off();
}
}

function verifyEmailOtp(url){
 loader.on();
 var btn = document.getElementById('emailotpverifybtn');
 btn.disabled =true;
 btn.innerText = 'VERIFYING';


 event.preventDefault();
 var url = url;
 var otp = $('#emailotp').val();

 if (otp == "") {
   $("#login-success-flashmsg").html("");
   $("#login-error-flashmsg").html("Please enter 6 digit OTP!");
   setTimeout(function(){$("#login-error-flashmsg").text('');},6000);
   btn.disabled =false;
   btn.innerText = 'VERIFY';
   loader.off();

 }else{
   var email = $('#loginEmail').val();
   $.ajax({
    url: url,
    type: "POST",
    dataType: "json",
    data : {'otp' : otp,'email':email},
    success: function(data) 
    {
     loader.off();

     if (data['statusCode'] == 1) { 
      btn.disabled =true;
      btn.innerText = 'VERIFIED';
        //$("#loginBtn").show();
      PhoneLogin('<?=base_url('signin')?>');

    }else{
      $("#login-error-flashmsg").html("");
      $("#login-success-flashmsg").html("");
      $("#login-error-flashmsg").html(data['message']);
      setTimeout(function(){$("#login-error-flashmsg").text('');},6000);
      btn.disabled =false;
      btn.innerText = 'VERIFY';
    }


  }             
});
 }
}




function LoginUser(url) {
 loader.on();
 var btn = document.getElementById('emailotpntn');
 btn.disabled = true;
 btn.innerText = 'PLEASE WAIT...';

 event.preventDefault();
 var url = url;
 var email = $('#loginEmail').val();
 var phone = $('#loginPhoneNumber').val();


// newphone = phone.replaceAll(" ","").slice(-10);
// NOTE: REMOVE COUNTRY CODE FROM MOBILE NO

 var newphone = 0;
 var cuntryCode =  $("#loginModal .iti__selected-flag").attr('title');
 cuntryCode     =   (cuntryCode.split(':')[1]).trim();
    var value  =  phone.replace(cuntryCode, ''); //replace all $ with empty string
    newphone   =  value; 


    // get the active tab element
    const activeLoginTab = $('.nav-link.active');

// get the value of the 'tab-name' attribute
    const LoginTabName = activeLoginTab.attr('tab-name');

// use the value of 'tabName' as needed
    console.log(LoginTabName);



    $.ajax({
      url: url,
      type: "POST",
      dataType: "json",
      data : {'email' : email,'phone':newphone, 'LoginTabName' : LoginTabName},
      success: function(data) 
      {
       loader.off();
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
       setTimeout(function(){$("#signup-error-flashmsg").text('');},6000);

       if((location.href.match(/([^\/]*)\/*$/)[1]).indexOf('Payonline') != -1){
        openBoxlog('signup');
        btn.disabled = false;
        btn.innerText = 'Login';
      }
      else
      {

        $("#signupEmail").val(email);
        $("#signupPhoneNumber").val(phone);    




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
    loader.on();
    var url = url;
    var email = $('#loginEmail').val();
    var phone = $('#loginPhoneNumber').val();

  // newphone = phone.replaceAll(" ","").slice(-10);
    var newphone = 0;
    var cuntryCode =  $("#loginModal .iti__selected-flag").attr('title');
    cuntryCode =   (cuntryCode.split(':')[1]).trim();
    var value = phone.replace(cuntryCode, ''); //replace all $ with empty string
    newphone =  value; 


      // get the active tab element
    const activeLoginTab = $('.nav-link.active');

// get the value of the 'tab-name' attribute
    const LoginTabName = activeLoginTab.attr('tab-name');

// use the value of 'tabName' as needed
    console.log(LoginTabName);



    $.ajax({
      url: url,
      type: "POST",
      dataType: "json",
      data : {'email' : email,'phone':newphone,'sessionCreate':1, 'LoginTabName' : LoginTabName},
      success: function(data) 
      {
       loader.off();
      // console.log(data);
       if(data.statusCode == 1) {
          // alert('Login Successful.');
        $(".dotlgbtn").text('MY ACCOUNT');

        if($('#serviceId').val())
        {
         $('.loginBtnClose').click();
         $("#loginModal").modal("hide");
         $("#paymentModal").modal("show");


       } else if($('#donateToTempleBtnBeforeLogin').val())
       {
         $('.loginBtnClose').click();
         $("#loginModal").modal("hide");
         $("#DonateToTemple").val('DONATIONS');
         $("#DonateToTemplePaymentModal").modal("show");

       }
       else
       {

// =============================================================
         if ($("#fromPage").val() == 'newsletter') {
          $('.loginBtnClose').click();
          $("#loginModal").modal("hide");
          subscribeNewsletter();

        }
        else if ( $("#fromPage").val() == 'events' )
        {
          window.location.href = "<?=base_url('checkout/events')?>";
        }
        else if ( $("#fromPage").val() == 'services' )
        {
          window.location.href = "<?=base_url('checkout/service')?>";
        }
        else if ( $("#fromPage").val() == 'view-cart' )
        {
          window.location.href = "<?=base_url('Services/ViewCart')?>";
        }
        else{
          window.location.href = "<?=base_url('admin/update-profile')?>";
        }

// =============================================================



      }

    }else{
      $("#loginModal").modal('hide');
      $("#signupModal").modal('show');
      $("#signup-error-flashmsg").html("This phone no. is not registerd please signup !");
      setTimeout(function(){$("#signup-error-flashmsg").text('');},6000);
    }
  }             
});

  }



  function SignupUser(url) {
   loader.on();

   var btn = document.getElementById('signupBtn');
   event.preventDefault();
   var phone = $('#signupPhoneNumber').val();

   if (phone.length < 6) {
    $("#signup-error-flashmsg").html("Phone Number is required.");
    setTimeout(function(){$("#signup-error-flashmsg").text('');},6000);
    $('#signupPhoneNumber').focus();
    return false;
  }


  btn.disabled = true;
  btn.innerText = 'PLEASE WAIT...';

  var url = url;
  var fname = $('#fname').val();
  var lname = $('#lname').val();
  var email = $('#signupEmail').val();

  var newphone = 0;
  var cuntryCode =  $("#signupModal .iti__selected-flag").attr('title');
  cuntryCode =   (cuntryCode.split(':')[1]).trim();
    var value = phone.replace(cuntryCode, ''); //replace all $ with empty string
    newphone =  value; 

    $.ajax({
      url: url,
      type: "POST",
      dataType: "json",
      data : {'fname':fname,'lname':lname,'email' : email,'phone':newphone, 'countryCode': cuntryCode},
      success: function(data) 
      {
       loader.off();
       var loginbtn = document.getElementById('loginBtn');
       var emailotpntn = document.getElementById('emailotpntn');

       const obj = JSON.parse(data);
       if (obj.message == '') {

        loginbtn.disabled = false;
        loginbtn.innerText = 'LOGIN';

        emailotpntn.disabled = false;
        emailotpntn.innerText = 'LOGIN';

        $("#login-success-flashmsg").html(data);


        if((location.href.match(/([^\/]*)\/*$/)[1]).indexOf('Payonline') != -1){
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
          setTimeout(function(){$("#login-success-flashmsg").text('');},6000);


          if((location.href.match(/([^\/]*)\/*$/)[1]).indexOf('Payonline') != -1){
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
          setTimeout(function(){$("#signup-error-flashmsg").text('');},6000);

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
    apiKey: "<?=FIREBASE_API_KEY?>",
    authDomain: "<?=FIREBASE_AUTH_DOMAIN?>",
    projectId: "<?= FIREBASE_PROJECT_ID ?>",
    storageBucket: "<?= FIREBASE_STORAGE_BUCKET ?>",
    messagingSenderId: "<?= FIREBASE_MESSAGING_SENDER_ID ?>",
    appId: "<?= FIREBASE_APP_ID ?>",
    measurementId: "<?= FIREBASE_MEASUREMENT_ID ?>"
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
        // $("#mobiletoggle").toggle();
        $("#mobiletoggle").css('display','inline-flex');
        $('#mobileotp').focus();
        $(".otpsendmsg_number").html("OTP has been sent on this mobile number.");
        setTimeout(function(){$(".otpsendmsg_number").text('');},6000);
        $("#recaptcha-container").remove();
      }


    })
    .catch(function(error) {
      // console.log(error);
        // $(".otpsendmsg_number").html("OTP has been sent on this mobile number.");
      // $("#login-error-flashmsg").html(error.message);

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
     setTimeout(function(){$(".otpsendmsg_number_error").text('');},6000);

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
      // console.log(error);
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


<!-- <script src="https://www.paypal.com/sdk/js?client-id=<?=PAYPAL_LIVE_CLIENT_ID?>&currency=USD&intent=capture&enable-funding=venmo" data-sdk-integration-source="integrationbuilder"></script> -->



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

     loader.on();
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

      var startDate = $("#serviceStartDate").val();
      var startTime = $("#timepicker").val();


      if ($("#Address").val() != '') {
        var Address = $("#Address").val();
      }else{
        var Address = "<?=$this->session->userdata('address')?>";
      }

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
        'qty': 1,
        'serviceAddress':Address
      },
      success: function(response) 
      {
       loader.off();
          // console.log(response);

       if (response.statusCode == 1) {
           // console.log(response);
         $('.PaymentClosebtn').click();
         $("#paymentModal").modal("hide");


         if (serviceCategoryTypes == 'DONATIONS') {
          $("#DonateToTemplePaymentModal").modal("hide");

          swal({
            html: true,
            title: "Donation is processed successfully!",
            text: "<span style='font-weight: 600;margin:5px;padding:5px'>Token No:</span> "+response.data[0].invoiceNo,
            type: "success",
            confirmButtonText: 'OK',
            confirmButtonColor: '#008080',
                // timer:5000,
          },

          function(){
           if((location.href.match(/([^\/]*)\/*$/)[1]).indexOf('Payonline') != -1){
            window.location.href="<?= base_url('logout'); ?>"
          }
          else
          {
            window.location.reload(); 
          }

        });
        }else{
          swal({
            html: true,
            title: "Service Booking Confirmed!",
            text: "<span style='font-weight: 600;margin:5px;padding:5px'>Token No:</span> "+response.data[0].invoiceNo,
            type: "success",
            confirmButtonText: 'OK',
            confirmButtonColor: '#008080',
                // timer:5000,
          },

          function(){
           if((location.href.match(/([^\/]*)\/*$/)[1]).indexOf('Payonline') != -1){
            window.location.href="<?= base_url('logout'); ?>"
          }
          else
          {
            window.location.reload(); 
          }

        });
        }


      }else{
       $('.PaymentClosebtn').click();
       $("#paymentModal").modal("hide");
       swal({
        html: true,
        title: "Failed!",
        text: "<span>Transaction Failed!<span><br><span style='font-weight: 600;margin:5px;padding:5px'>Token No:</span> "+response.data[0].invoiceNo,
        type: "error",
        confirmButtonText: 'OK',
        confirmButtonColor: '#008080',
              // timer:5000,
      },
      function(){
        window.location.reload(); 
      });

     }

   }             
 });


      // Ajax Request End

  };

  return actions.order.capture().then(captureOrderHandler);
},


onError: (err) => {
  alert('Transaction Failed');

}
});

paypalButtonsComponent
.render("#paypal-button-container")
.catch((err) => {
  console.log('PayPal Buttons failed to render');
});


paypalButtonsComponent
.render("#paypal-button-container-donation")
.catch((err) => {
  console.log('PayPal Buttons failed to render');
});





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


    function checkValue(str, max) {
      if (str.charAt(0) !== '0' || str == '00') {
        var num = parseInt(str);
        if (isNaN(num) || num <= 0 || num > max) num = 1;
        str = num > parseInt(max.toString().charAt(0)) && num.toString().length == 1 ? '0' + num : num.toString();
      };
      return str;
    };

    function date_reformat_mm(date) {
      date.addEventListener('input', function(e) {
        this.type = 'text';
        var input = this.value;
        if (/\D\/$/.test(input)) input = input.substr(0, input.length - 3);
        var values = input.split('/').map(function(v) {
          return v.replace(/\D/g, '')
        });
        if (values[0]) values[0] = checkValue(values[0], 12);
        if (values[1]) values[1] = checkValue(values[1], 31);
        var output = values.map(function(v, i) {
          return v.length == 2 && i < 2 ? v + '/' : v;
        });
        this.value = output.join('').substr(0, 14);
      });

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
  $(document).ready(function() {
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



    $('input.currency').currencyInput();
  });



  function loginBy(type) { if(type=='email'){ 
    var cuntryCode =  $("#loginModal .iti__selected-flag").attr('title');
    cuntryCode     =   (cuntryCode.split(':')[1]).trim();
    $("#loginPhoneNumber").val(cuntryCode);
  }else{ $("#loginEmail").val(''); } }
  $(".modalClbtn").click(function(){window.location.reload();});


// Right Click Disabled Code
  // document.addEventListener("contextmenu", function(e){
  //   e.preventDefault();
  // }, false);

// Right Click Disabled Code


</script>


<script type="text/javascript" src="<?=base_url('assets/js/country_code.js')?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/country_code2.js')?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/time-picker.js')?>"></script>
</body>

</html>