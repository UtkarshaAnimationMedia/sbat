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
        loader.on();
        $.ajax({
            url: "<?=base_url('Managements/Managements/getMeetingList')?>",
            type: "POST",
            success: function(data) {
                $("#TableData").html();
                $("#TableData").html(data);

                $('.table-expandable').each(function() {
                    var table = $(this);
                    table.children('thead').children('tr').append('<th></th>');
                    table.children('tbody').children('tr:odd').hide();
                    table.children('tbody').children('tr:even').click(function() {
                      var element = $(this);
                      element.next('tr').toggle('slow');
                      element.find(".table-expandable-arrow").toggleClass("up");
                  });
                    table.children('tbody').children('tr:even').each(function() {
                      var element = $(this);
                      element.append('<td><div class="table-expandable-arrow"></div></td>');
                  });
                });
                loader.off();
            }  
        });

        

    });

</script>
</body>
</html>
