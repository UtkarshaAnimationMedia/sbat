<?php $this->load->view('includes/head') ?>
<?php $this->load->view('includes/topbar') ?>
<?php $this->load->view('includes/header') ?>
<style type="text/css">
  button{
   background-color:#530A3A;border:0;    padding: 12px 23px 12px 23px;
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
.templedonatebtn:hover{
  transform : scale(1.02);
  -moz-transform : scale(1.02);
  -webkit-transform : scale(1.02);
  -o-transform : scale(1.02);
  -ms-transform : scale(1.02);
}


.currency {
  padding-left:12px;
}

.currency-symbol {
  position:absolute;
  padding: 2px 5px;
}

.donations{
  background-color:#db9619;
  border:0;  
  word-wrap: inherit;
  color: #642318;
  font-weight: bold!important;
  padding: 11px 17px;
}
.active-donations{
  background-color:#570000;
  border:0;color: white;    
  padding: 12px 0px;
  word-wrap: inherit;
  font-weight: 600;
  box-shadow: 2px 2px 10px red!important;
  padding: 11px 17px;
}

.border-3{
  border-left: 3px solid #e3b40e;
  border-right: 3px solid #e3b40e;
  border-bottom: 3px solid #e3b40e;
  background-color: #F9E3B8;
}
.border-4{
  border-top: 3px solid #e3b40e;
  border-left: 3px solid #e3b40e;
  border-right: 3px solid #e3b40e;
  background-color: #F9E3B8;
}

.other-page-link:hover{
  padding-left: 5px;
  color: red;
  text-shadow: 1px 1px 10px red;
}

.crop-center {
  background-position: center center;
  background-repeat: no-repeat;
  background-size: cover;
  height: 100px;
  width:100%;
}

.border-start{
  border-color: #910301!important;
}


</style>

<main id="main">
  <!-- ======= Donations Section ======= -->
  <section  style="background-color: var(--page-wrapper-bg-color)!important">

    <div class="container">

     <center> <h2 class="bottomborder" style="font-weight:bold!important;font-size: 35px!important;">Donations</h2> </center><br>
     <div class="services row justify-content-center"> 
       <div class="row">
        <div class="col-md-12 mx-auto text-center">
          <div class="row m-0 p-0">

           <div class="container-fluid justify-content-center align-items-center filter-tab" style="overflow:hidden">

            <?php if (isset($service_cat_types) && $service_cat_types!= '') { 
             $i = 1;
             foreach ($service_cat_types as $key => $item) { 
              ?>
              <div class="row text-center align-items-center my-1 p-0 filter-tab" style="overflow:hidden; border-left: 2px solid white;">
                <a href="javascript:void(0)" class="m-0 p-0">
                  <div id="<?=slugify($item['refDataName'])?>" class="styles <?= ($i == 1) ? 'active-donations' : 'donations'; ?>" onclick="getDonationsByCat('<?=base_url('Home/getDonations')?>','<?=$item['refDataName']?>', '<?=slugify($item['refDataName'])?>')"><?=$item['displayName']?>
                </div>
              </a>
            </div>
            <?php $i++;} }   ?>

          </div> 

        </div>
      </div>
    </div>
    <!-- Dynamic Tabs Section End-->

    <div class="row" id="donation-data">

      <!-- Data wil come here by jquery -->

    </div>

  </div>

</div>
</section><!-- End Donations Section -->
</main>
<!-- End #main -->


<script type="text/javascript">

 $(function(){
  $(".active-donations").click();
})

 function getDonationsByCat(url, serviceCategory, slugify_id) {

   loader.on();
// alert(slugify_id);
   var url = url;
   var param = serviceCategory;
   $.ajax({
    url: url,
    type: "POST",
    dataType: "json",
    data : {'param' : param},
    success: function(data) 
    {

        loader.off();
      


      var  id = '#'+slugify_id;
      
      $(".styles").removeClass('active-donations');
      $(".styles").addClass('donations');


      $(id).addClass('active-donations');
      $(id).removeClass('donations');

      $('#donation-data').html(data);

    }             
  });
 }



 $(document).ready(function() {
  window.scrollTo({ top: 225, behavior: 'smooth'});
});

</script>

<?php $this->load->view('includes/footer.php') ?>
<?php $this->load->view('includes/script.php') ?>