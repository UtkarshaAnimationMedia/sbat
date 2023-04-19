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
        var serviceStatus =  'sss';

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
                if(result.status>0)
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
                            alert();
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
