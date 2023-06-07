 <!-- ======= Hero Section ======= -->
 <style type="text/css">
  .carousel-caption{
   background-color: rgb(0 0 0 / 56%);
   background-image: linear-gradient(to top, rgb(0 0 0), rgb(0 0 0 / 0%));
   width: 100%;
   position: absolute;
   right: 0%!important;
   bottom: 0px;
   left: 0%!important;
   padding-top: 10px;
   padding-bottom: 10px;
   color: #fff;
   text-align: center;
 }
 .bannerBtn{
  color: #ffffff;
  border-radius: 9px!important;
  border-color: white;
  background: #7D1456 !important;
  padding: 10px 40px;
  box-shadow: 1px 1px 10px #7e455561;
}
.title3 {
  color: white!important;
  font-family: "Trirong", Sans-serif!important;
  font-weight: 600!important;
  font-size: 30px;
}

#sliderImg{

  width: 100%;
  height: 360px;
  object-fit: cover;
  object-position: center;

}

.carousel-control-next-icon {
  padding: 26px 22px;
  background-color: #78091459;
  border-radius: 5px;
}
.carousel-control-prev-icon {
  padding: 26px 22px;
  background-color: #78091459;
  border-radius: 5px;
}


.carousel-control-next, .carousel-control-prev {
  width: 5%;
}
</style>
<section style="padding: 0;">
  <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">

      <?php $i=1; $j=0; foreach($slider_image as $item){ ?>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?=$j?>" <?= $i==1 ? 'class="active" aria-current="true"' : ''; ?>  aria-label="Slide <?=$i?>" hidden></button>
        <?php $i++; $j++;} ?>


      </div>
      <div class="carousel-inner">
        <?php $i=1; foreach($slider_image as $item){ ?>


         <div class="carousel-item <?= $i=='1' ? 'active': ''?>">



          <!-- ******************************************************************* -->
          <?php if ($item['bannerType'] == 'IMAGE LEFT TEXT RIGHT') { ?>

            <div class="row m-0 p-0">
              <div class="col-md-6 m-0 p-0">

                <img src="<?= ApiBaseUrl()['url'].$item['refDataName']?>" style="height:62vh" class="d-block w-100" alt="<?=$item['bannerHeading']?>" id="sliderImg">
              </div>
              <div class="col-md-6 m-0 p-4" style="background-color:#F7DEA4">
                <h2><?=CheckEmptyNullVar(@$item['bannerHeading']);?></h2>
                <h5><?=CheckEmptyNullVar(@$item['bannerSubHeading']);?></h5>
                <p><?=CheckEmptyNullVar(@$item['bannerDesc']);?></p>

                <?php if ($item['bannerButtonLink'] != '') { ?>
                  <center>

                    <a href="<?= $item['bannerButtonLink'] == '' ? 'javascript:void(0)' : $item['bannerButtonLink']; ?>" class="btn btn-outline-danger" style="background-color:#AC0106;color: #fff;">Click Here</a>
                  </center>
                <?php } ?>
              </div>
            </div>

          <?php } ?>
          <!-- ******************************************************************* -->




          <!-- ******************************************************************* -->
          <?php if ($item['bannerType'] == 'IMAGE RIGHT TEXT LEFT') {?>
            <div class="row m-0 p-0">
              <div class="col-md-6 m-0 p-4" style="background-color:#F7DEA4">
                <h2><?=CheckEmptyNullVar(@$item['bannerHeading']);?></h2>
                <h5><?=CheckEmptyNullVar(@$item['bannerSubHeading']);?></h5>
                <p><?=CheckEmptyNullVar(@$item['bannerDesc']);?></p>
                <?php if ($item['bannerButtonLink'] != '') { ?>
                  <center>
                    <a href="<?= $item['bannerButtonLink'] == '' ? 'javascript:void(0)' : $item['bannerButtonLink']; ?>"  class="btn btn-outline-danger" style="background-color:#AC0106;color: #fff;">Click Here</a>
                  </center>
                <?php } ?>
              </div>
              <div class="col-md-6 m-0 p-0">

                <img src="<?= ApiBaseUrl()['url'].$item['refDataName']?>" style="height:62vh" class="d-block w-100" alt="<?=$item['bannerHeading']?>" id="sliderImg">
              </div>
            </div>
          <?php } ?>
          <!-- ******************************************************************* -->


          <!-- ******************************************************************* -->
          <?php if (@$item['bannerType'] == 'ONLY IMAGE') { ?>
            <div class="row m-0 p-0">
              <div class="col-md-12 m-0 p-0" style="background-color:#F7DEA4">

               <img src="<?= ApiBaseUrl()['url'].$item['refDataName']?>" style="height:62vh" class="d-block w-100" alt="<?=$item['bannerHeading']?>" id="sliderImg">
             </div>
           </div>

         <?php }?>
         <!-- ******************************************************************* -->


         <!-- ******************************************************************* -->
         <?php if ($item['bannerType'] == 'IMAGE WITH BOTTOM TEXT') { ?> 
          <img src="<?= ApiBaseUrl()['url'].$item['refDataName']?>" style="height:62vh" class="d-block w-100" alt="<?=$item['bannerHeading']?>" id="sliderImg">

          <div class="carousel-caption d-none d-md-block">

            <div class="row">
              <?php 

              $itemBannerButtonLink = CheckEmptyNullVar(@$item['bannerButtonLink']);

              if (!empty($itemBannerButtonLink)) {?>
              <div class="col-md-10 text-center">
              <?php }else{ ?>
                <div class="col-md-12 text-center">
              <?php } ?>

               <span class="text-white">
                <h2 style="color: white!important; margin: 0!important;padding: 0!important"><?=CheckEmptyNullVar(@$item['bannerHeading']);?></h2>
                <h5 style="color: white!important; margin: 0!important;padding: 0!important"><?=CheckEmptyNullVar(@$item['bannerSubHeading']);?></h5>
                <p style="color: white!important; margin: 0!important;padding: 0!important"><?=CheckEmptyNullVar(@$item['bannerDesc']);?></p>
              </span>
            </div>
           

             <?php 
             if (!empty($itemBannerButtonLink)) {?>
              <div class="col-md-2">
                <br>
                <div>
                  <a href="<?=$item['bannerButtonLink'] == '' ? 'javascript:void(0)' : $item['bannerButtonLink']; ?>"  class="btn btn-outline-danger" style="background-color:#AC0106;color: #fff;">Click Here</a>
                </div>
              </div>
          <?php } ?>


      </div>     
    </div>
  <?php   }?>
  <!-- ******************************************************************* -->

</div>

<?php $i++; } ?>
</div>
<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
  <span class="visually-hidden">Previous</span>
</button>
<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
  <span class="carousel-control-next-icon" aria-hidden="true"></span>
  <span class="visually-hidden">Next</span>
</button>
</div>

</section><!-- End Hero -->
