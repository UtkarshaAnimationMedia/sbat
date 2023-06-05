            <style type="text/css">

                body{
                    font-size: 16px;
                }
                #PdfPrintSection{
                    font-family: "Poppins", sans-serif;
                }
                html{
                    margin: 0px;
                    padding: 0px;
                }
                th{

                    padding: 15px!important;
                    border: 0px!important;
                    vertical-align: middle;
                }
                td{

                    padding: 15px!important;
                    border: 0px!important;
                    vertical-align: middle;
                }
            </style>
            <script src="https://cdn.bootcss.com/html2pdf.js/0.9.1/html2pdf.bundle.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.1/html2pdf.bundle.min.js"></script>
            <script>
                function createPDF() {
                    var element = document.getElementById('PdfPrintSection');
                    html2pdf(element, {
                        margin:0.5,
                        padding:0,
                        filename: '<?=date('Ymd').'-'.$envoice_data[0]['memberName'].'-PaymentsReceipt'?>.pdf',
                        image: { type: 'jpeg', quality: 1 },
                        html2canvas: { scale: 2,  logging: true },
                        jsPDF: { unit: 'in', format: 'A4', orientation: 'P' },
                        class: createPDF
                    });
                };

            </script>
            <?php
            $header_data = $this->mongo_db2->where(['aspectType'=> 'headerSettings'])->get('wesiteSettings');
            $GeneralSettings = GeneralSettings();
            $currency = isset($GeneralSettings['currencySymbol']) ? ( $GeneralSettings['currencySymbol'] != '' || $GeneralSettings['currencySymbol'] != 'null' ?  $GeneralSettings['currencySymbol'] : '$' ) : '$' ;


            $tax = isset($GeneralSettings['TaxPercent']) ? ($GeneralSettings['TaxPercent'] != '' || $GeneralSettings['TaxPercent'] != 0 ?  $GeneralSettings['TaxPercent'] : 0 ) : 0;

            // print_r($envoice_data);
            ?>


            <?php $this->load->view('admin/includes/head'); ?>


                    <?php $this->load->view('admin/includes/sidebar'); ?>

                        <!-- Top navigation-->
                        <?php $this->load->view('admin/includes/topbar'); ?>

                        <div class="container p-5">

                            <div class="row">

                                <div class="col-md-8 col-sm-12 shadow bg-white mx-auto d-block">
                                    <div class="p-5"> 

                                        <div class="bordered"  id="PdfPrintSection">
                                            <div style="background-color:#fff">
                                                <div class="row" style="vertical-align: middle!important;">
                                                    <div class="col-md-3 col-sm-2 col-lg-2 col-xl-2 mx-auto d-block">
                                                        <img src="<?=$header_data[0]['leftImage'] ? ApiBaseUrl()['url'].'/'.@$header_data[0]['leftImage'] : base_url('assets/img/logo-1.png')?>" class="img-fluid" height="100px" width="100px">

                                                    </div>
                                                    <div class="col-md-7 col-sm-10 col-lg-10 col-xl-10 mt-3 mx-auto d-block text-center">

                                                        <h1 style="font-size:25px; font-weight: bold;color: red;"><?=PROJECT_NAME?></h1>
                                                        <p><?=$header_data[0]['address'];?></p>
                                                    </div>
                                                    <div class="col-md-2"></div>
                                                </div>
                                            </div>
                                            <div >

                                                <h2 class="text-center fw-bold mt-4" style="font-size:25px">Payments Receipt</h2>
                                                <hr>



                                                <div class="row">
                                                    <div class="col-md-6 fw-bold mb-3" style="font-size:18px">Devotee Details</div>
                                                    <div class="col-md-6 fw-bold mb-3" style="font-size:18px">Transaction Details</div>
                                                    <div class="col-md-6">
                                                        <p><strong style="width: 150px;clear: left;float: left;text-align: left;padding-right: 2px;">Devotee Name</strong>: <?=$envoice_data[0]['memberName']?></p>

                                                        <p><strong style="width: 150px;clear: left;float: left;text-align: left;padding-right: 2px;">Address</strong>: <?=$this->session->userdata('address');?></p>

                                                        <p><strong style="width: 150px;clear: left;float: left;text-align: left;padding-right: 2px;">Phone</strong>: <?=formatPhoneNumber(base64_decode($envoice_data[0]['prsnPhone'])); ?></p>
                                                    </div>
                                                    <?php 
                                                    $serviceDate = $envoice_data[0]['recCreDate'] ;

                                                    $formatted_date = date('M d, Y', strtotime($serviceDate));

                                                    ?>
                                                    <div class="col-md-6">
                                                        <p><strong style="width: 150px;clear: left;float: left;text-align: left;padding-right: 2px;">Token</strong>: <?=$envoice_data[0]['tokenNumber']?></p>
                                                        <p><strong style="width: 150px;clear: left;float: left;text-align: left;padding-right: 2px;">Date &amp; Time</strong>: <?=$formatted_date;?></p>
                                                        <p><strong style="width: 150px;clear: left;float: left;text-align: left;padding-right: 2px;">Payment Mode</strong>: <?=$envoice_data[0]['paymentType']?></p>
                                                    </div>

                                                </div>
                                                <table class="table table-responsive table-hover">
                                                    <thead style="background-color: #c9c9c9">
                                                        <tr>
                                                            <th>Service Description</th>
                                                            <th>Qty</th>
                                                            <th class="text-end">Price</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php $sub_total = 0;  foreach($envoice_data[0]['paymentsData'] as $key=>$val){ ?>
                                                            <tr style="border-bottom:1px solid black;">
                                                                <td>
                                                                    <?=$val['ServiceSetup']?>
                                                                </td>
                                                                <td>
                                                                    <?=$val['qty']?>
                                                                </td>
                                                                <td class="text-end">
                                                                 <?=$currency.' '.price_format($val['serviceAmount'], 2);?>
                                                             </td>
                                                         </tr>
                                                         <?php  $sub_total = $sub_total + $val['serviceAmount'] ; } ?>


                                                         <?php 

                                                         $tax_total_in_price = ($sub_total * $tax)/100; 

                                                         ?>


                                                         <tr style="font-size: 17px; border-bottom:2px solid black!important ;" class="fw-bold">
                                                            <td class="text-start">Tax</td>
                                                            <td><?=$tax;?>%</td>
                                                            <td class="text-end"><?=$currency.' '.price_format($tax_total_in_price, 2); ?></td>
                                                        </tr>




                                                        <tr style="background-color:#c9c9c9;font-size: 17px;" class="fw-bold">
                                                            <td class="text-start">Total</td>
                                                            <td>
                                                            </td><td class="text-end"><?= $currency.' '.price_format(($sub_total+$tax_total_in_price), 2) ; ?></td>
                                                        </tr>


                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>


                                        <div class="row pt-3">
                                            <div class="col-md-7">
                                                <p>Thank you for using our services.</p>
                                            </div>

                                            <div class="col-md-5 text-end">
                                                <a  class="btn" style="background-color: #B02135;color: #fff;" class="html2PdfConverter" onclick="createPDF()">Download Receipt <i class="fa fa-download"></i></a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                    </div>
                </div>
                <!-- Bootstrap core JS-->
                <script src="<?=base_url('admin_assets/js/bootstrap.bundle.min.js')?>"></script>
                <!-- Core theme JS-->
                <script src="<?=base_url('admin_assets/js/theme.js')?>"></script>

                <script type="text/javascript">
                    $("#heading").text('Payments Receipt');
                </script>
            </body>
            </html>
