<?php $this->load->view('managements/includes/head'); ?>
<?php $this->load->view('managements/includes/sidebar'); ?>
<?php $this->load->view('managements/includes/topbar'); ?>
<!-- Start Main content-->
<style type="text/css">
    input::placeholder {
        text-align: center;
    }

    table.table-expandable > tbody > tr:nth-child(odd) {
      cursor: pointer;
  }

  table.table-expandable.table-hover > tbody > tr:nth-child(even):hover td {
      background-color: white;
  }

  table.table-expandable > tbody > tr div.table-expandable-arrow {
      background:transparent url("<?=base_url('admin_assets/img/icons/arrows.png')?>") no-repeat scroll 0px -16px; width:16px; height:16px; display:block;
  }

  table.table-expandable > tbody > tr div.table-expandable-arrow.up {
      background-position:0px 0px;
  }
</style>


<div class="container my-3" id="TableData">

</div>

<!-- End Main content-->

<?php $this->load->view('managements/includes/footer'); ?>
<script src="<?=base_url('assets/js/jquery-ui.min.js');?>"></script>

<script type="text/javascript">
	$(document).ready(function() {
		$("#heading").text('Meetings');

		var FilterDate = 'currentMonth';

		 loader.on();
                $.ajax({
                    url: "<?=base_url('Managements/Managements/getMeetingList')?>",
                    type: "POST",
                    data : {'FilterDate':FilterDate},
                    success: function(data) {
                        $("#TableData").html();
                        $("#TableData").html(data);
                        loader.off();
                    }  
                });

    // Initialize datepicker
        $(".datepicker").datepicker({
            dateFormat: "mm/dd/yy",
            onSelect: function(date) {
                var FilterDate = date;
                loader.on();
                $.ajax({
                    url: "<?=base_url('Managements/Managements/getMeetingList')?>",
                    type: "POST",
                    data : {'FilterDate':FilterDate},
                    success: function(data) {
                        $("#TableData").html();
                        $("#TableData").html(data);
                        loader.off();
                    }  
                });
            }
        });
    });

</script>
</body>
</html>