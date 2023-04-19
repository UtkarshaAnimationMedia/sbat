<?php $this->load->view('includes/head') ?>
<?php $this->load->view('includes/topbar') ?>
<?php $this->load->view('includes/header') ?>
  
<style type="text/css">


 .services{
  background-color:#db9619;
  border:0;
  word-wrap: inherit;
  color: #642318;
  font-weight: bold!important;
  padding: 11px 17px;
}
.active-services{
  background-color:#570000;
  border:0;color: white;    
  padding: 12px 0px;
  word-wrap: inherit;
  font-weight: 600;
  box-shadow: 2px 2px 10px red!important;
  padding: 11px 17px;
}

.center-cropped {
  width: 100%;
  height: 120px;
  background-position: center center;
  background-repeat: no-repeat;
  overflow: hidden;
}


</style>
<?php $header_data = $this->mongo_db2->where(['aspectType'=> 'headerSettings'])->get('wesiteSettings'); ?>
<main id="main">

  <!-- ======= Services Section ======= -->
  <section id="services" class="services" style="background-color: var(--page-wrapper-bg-color)!important">
    <div class="container">
      <div class="mb-3">
       <center> <h2 class="bottomborder" style="font-weight:bold!important;font-size: 35px!important;">Our Services</h2> </center><br>
     </div>
     <!-- Dynamic Tabs Section Start -->
     <div class="row">
      <div class="col-md-12 mx-auto text-center">
        <div class="row m-0 p-0">

         <div class="container-fluid justify-content-center align-items-center filter-tab" style="overflow:hidden">

           <?php   $serviceCatTypes = array_reverse($service_cat_types);
           if (isset($serviceCatTypes) && $serviceCatTypes!= '') {  
             $i = 1;
             foreach ($serviceCatTypes as $key => $item) { 
              if ($item['refDataName'] == 'IN-TEMPLE' || $item['refDataName'] == 'AWAY-TEMPLE' || $item['refDataName'] == 'SHRAADHAM') { 

                ?>
                <div class="row text-center align-items-center my-1 p-0 filter-tab" style="overflow:hidden; border-left: 2px solid white;">
                  <a href="javascript:void(0)" class="m-0 p-0">
                    <div id="<?=slugify($item['refDataName'])?>" class="styles <?= $i == 1 ? 'active-services' : 'services'; ?>" onclick="getServicesByCat('<?=base_url('get-services')?>','<?=$item['refDataName']?>', '<?=slugify($item['refDataName'])?>')"><?=$item['displayName']?>
                  </div>
                </a>
              </div>
              <?php $i++;} } }  ?>

            </div> 

          </div>
        </div>
      </div>
      <!-- Dynamic Tabs Section End-->

      <div class="row" id="service-data">

        <!-- Data wil come here by jquery -->

      </div>

    </div>
  </section><!-- End Services Section -->







</main><!-- End #main -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"> </script>  

<script type="text/javascript">

 $(function(){
  $(".active-services").click();
})

 function getServicesByCat(url, serviceCategory, slugify_id) {
// alert(serviceCategory);
   var url = url;
   var param = serviceCategory;
   $.ajax({
    url: url,
    type: "POST",
    dataType: "json",
    data : {'param' : param},
    success: function(data) 
    {
      var  id = '#'+slugify_id;

      

      $(".styles").removeClass('active-services');
      $(".styles").addClass('services');
      $(id).addClass('active-services');
      $(id).removeClass('services');
      
      $('#service-data').html(data);


    }             
  });
 }

  $(document).ready(function() {
    window.scrollTo({ top: 225, behavior: 'smooth'});
  });

</script>

<?php $this->load->view('includes/footer.php') ?>
<?php $this->load->view('includes/script.php') ?>