<div class="ldld full" style="    z-index: 999;"></div>
<?php
$footer_data = $this->mongo_db2->where(['aspectType'=> 'footerSettings'])->get('wesiteSettings');
$background_music = $this->mongo_db2->where(['aspectType'=> 'backgroundMusic'])->get('wesiteSettings');
  // print_r($footer_data);
?>

<?php $this->load->view('includes/modals'); ?>



<!-- ======= Footer ======= -->

<style type="text/css">
  audio {
/*border-radius: 90px;*/
width: 250px;
height: 45px;
margin-top: 5px;
margin-bottom: 5px;
border: 1px solid white;
border-radius: 28px;
}

audio::-webkit-media-controls-time-remaining-display {
  display: none !important;
}
audio::-webkit-media-controls-current-time-display{
  display: none!important;
}
audio::-webkit-media-controls-play-button,
audio::-webkit-media-controls-panel {
 color: #761842;
 background-color: var(--headerFooter)!important;
}
</style>

<footer id="footer" style="background-color:#130202">
  <div class="footer-top header-footer-bg" style="background-color:#AA1F32">
    <div class="container-fluid px-5">
      <div class="row p-0 m-0">
        <div class="col-md-8 m-0 p-0">
          <div class="row">
            <div class="col-lg-4 col-md-4 m-0 p-0 footer-links">

              <!-- ==================================== -->
              <?php if (isset($footer_data[0]['footerLogo']) && $footer_data[0]['footerLogo'] != '') { ?>
               <img src="<?=ApiBaseUrl()['url'].'/'.$footer_data[0]['footerLogo']?>" class="img-fluid footer-logo" alt="sri-hanuman-temple">
             <?php  }else{ ?> 
              <img src="<?=base_url('assets/img/image-1672655162220-934535808.png');?>" alt="sri-hanuman-temple" class="img-fluid footer-logo">
            <?php } ?>
            <!-- =================================== -->

            <!-- ==========================Background Music Start============================= -->

            <?php 
            if (!empty($background_music)) {
              $emptyD ='';

              foreach ($background_music as $value) {

                if (!empty($value['refDataName']) && strtoupper($value['dayName']) == strtoupper(date("l")) && $value['status'] == 'ACTIVE') {
                  $emptyD = 'active';

                  echo '<audio class="h-80 mt-3" id="bgMusic" controls controlslist="nodownload noplaybackrate">
                  <source src="'.ApiBaseUrl()['url'].$value['refDataName'].'" type="audio/mpeg">
                  Your browser does not support the audio element.
                  </audio>';
                  break;
                }
              }

              if(empty($emptyD))
              {
               $day = strtolower(date("l"));
               $file_path = "assets/music/{$day}-aarti.mp3";

               if (file_exists($file_path)) {

                echo '<audio class="h-80 mt-3" id="bgMusic" controls controlslist="nodownload noplaybackrate">
                <source src="'.base_url($file_path).'" type="audio/mpeg">
                Your browser does not support the audio element.
                </audio>';
              }
            }


          }
          else {

            $day = strtoupper(date("l"));
            $file_path = "assets/music/{$day}-aarti.mp3";

            if (file_exists($file_path)) {
             echo '<audio class="h-80 mt-3" id="bgMusic" controls controlslist="nodownload noplaybackrate">
             <source src="'.base_url($file_path).'" type="audio/mpeg">
             Your browser does not support the audio element.
             </audio>';
           }
         }
         ?>

         <!-- ===========================Background Music End============================ -->

       </div>

       <div class="col-lg-4 col-md-4 m-0 p-0 footer-links">
        <h4>ABOUT US</h4>
        <span class="bottomborder" style="position:absolute!important;    margin-top: -12px!important; width: 50px!important;"></span>
        <ul>
          <li><a href="<?=base_url('about-temple')?>">ABOUT TEMPLE</a></li>
          <li><a href="<?=base_url('calendar')?>">EVENTS</a></li>
          <li><a href="<?=base_url('services')?>">SERVICES</a></li>
          <li><a href="<?=base_url('donations')?>">DONATIONS</a></li>
          <li><a href="<?=base_url('calendar')?>">CALENDAR</a></li>
          <li><a href="<?=base_url('gallery')?>">GALLERY</a></li>
          <li><a href="<?=base_url('volunteer')?>">VOLUNTEERS FORM</a></li>
          <li><a href="<?=base_url('membership')?>">MEMBERSHIP FORM</a></li>
        </ul>
      </div>
      <div class="col-lg-4 col-md-4 m-0 p-0 footer-links">
        <div class="row">
          <div class="col-lg-12 col-md-12 m-0 p-0">
            <h4>TEMPLE TIMINGS</h4>
            <span class="bottomborder" style="position:absolute!important;    margin-top: -12px!important; width: 50px!important;"></span>
            <table class="table table-responsive text-white header-footer-bg">
              <tbody>
                <tr>
                 <td style="border-right: 1px solid #fff;">WEEKDAYS:</td>
                 <td> <?= @$footer_data[0]['weekdayMorningTime'] != '' ? @$footer_data[0]['weekdayMorningTime'] : ''?><br><?= @$footer_data[0]['weekDayEveningTime'] != '' ? @$footer_data[0]['weekDayEveningTime'] : ''?></td>
               </tr>
               <tr>

                <td style="border-right: 1px solid #fff;">WEEKENDS:</td>
                <td><?= @$footer_data[0]['weekEndMorningTime'] != '' ? @$footer_data[0]['weekEndMorningTime'] : ''?></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col-lg-12 col-md-12 m-0 p-0">
          <h4>FOLLOW US</h4>
          <span class="bottomborder" style="position:absolute!important;    margin-top: -12px!important; width: 50px!important;"></span>
          <a href="<?= @$footer_data[0]['facebookLink'] != '' ? @$footer_data[0]['facebookLink'] : 'javascript:void(0)'?>" <?= @$footer_data[0]['facebookLink'] != '' ? 'target="_blank"' : ''?>><i class="fa fa-facebook footer-icon-color" style="border-radius: 50%;font-size: 20px;padding: 18px 22px;border:1px solid white!important"></i></a>
            <a href="<?= @$footer_data[0]['twitterLink'] != '' ? @$footer_data[0]['twitterLink'] : 'javascript:void(0)'?>"><i class="fa fa-instagram footer-icon-color" style="border-radius: 50%;font-size: 20px;
              padding: 18px 19px;border:1px solid white!important"></i></a>


              <a href="<?= @$footer_data[0]['youtubeLink'] != '' ? @$footer_data[0]['youtubeLink'] : 'javascript:void(0)'?>"><i class="fa fa-youtube footer-icon-color" style="border-radius: 50%;font-size: 20px;
                padding: 18px 20px;border:1px solid white!important"></i></a>


              </div>
            </div>
          </div>
        </div>

      </div>
      <div class="col-md-4 m-0 p-0">
        <div class="row m-0 p-0">
         <div class="col-lg-4 col-md-4 m-0 p-0 footer-contact">
          <div class="footer-divider" style="border-style: solid;border-width: 2px 2px 2px 2px;border-color: #FBF10078;box-shadow: 0px 0px 10px 0px rgb(216 16 16 / 21%);transform: rotate(102deg);     margin: 137px -87px;width: 341px;">

          </div>
        </div>
        <div class="col-lg-8 col-md-8 p-0 footer-contact">
          <h4>CONNECT WITH US</h4>
          <span class="bottomborder" style="position:absolute!important;    margin-top: -12px!important; width: 50px!important;"></span>
          <p class="text-white mt-3">
           <i class="fa fa-map-marker"></i> <a href="https://maps.google.com/?q=<?= @$footer_data[0]['refDataCode'] != '' ? @$footer_data[0]['refDataCode'] : '390 Cumming Street Suite B, Alpharetta, GA 30004'?>" rel="nofollow" target="_blank" rel="nofollow"> <?=@$footer_data[0]['refDataCode']?></a><br>
           <i class="fa fa-phone"></i> <a href='tel:<?= @$footer_data[0]['phone'] != '' ? @$footer_data[0]['phone'] : '+1 770-475-7701'?>'>     <?php
           if (@$footer_data[0]['phone'] != '') {

            echo  nl2br('+1 '.$footer_data[0]['phone']);

          }else{
            echo '+1 770-475-7701';
          }
        ?></a><br>
        <i class="fa fa-envelope"></i> <a href='mailto:<?= @$footer_data[0]['email'] != '' ? @$footer_data[0]['email'] : 'manager@srihanuman.org'?>'>
          <?php
          if (@$footer_data[0]['email'] != '') {


            echo @$footer_data[0]['email'];

          }else{
            echo 'manager@srihanuman.org';
          }
          ?>
        </a><br>
      </p>
      <a href="<?=base_url('contact-us')?>" class="btn btn-primary my-5 py-2 loader text-white" style="color: #635C81; border-radius: 20px;  border-color: white; background: transparent !important; box-shadow: 1px 1px 10px #7e455561;">CONTACT US</a>
    </div>
  </div>
</div>

</div>
</div>
</div>

<div class="mx-5 d-md-flex py-2">

  <div class="me-md-auto text-center text-md-start">
    <div class="copyright">
      Copyright © <strong><span><?=date('Y');?></span></strong> VAAP Technologies Inc, All rights reserved.
    </div>
    <div class="credits">
    </div>
  </div>
  <div class="social-links text-center text-md-right pt-3 pt-md-0">
    COPYRIGHT | TERMS  OF USE | PRIVACY POLICY | SECURITY
  </div>
</div>
</footer><!-- End Footer -->