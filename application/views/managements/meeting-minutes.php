<?php $this->load->view('managements/includes/head'); ?>
<?php $this->load->view('managements/includes/sidebar'); ?>
<?php $this->load->view('managements/includes/topbar'); ?>
<!-- Main content-->
<div class="container my-3">
	<?php  $meeting_minutes = json_decode(json_encode($meeting_minutes), true)['data'];  ?>
	<style type="text/css">
		.meetDetails{
			color: #BB001A;
			font-size: 25px;
		}
	</style>

	<div class="row mb-4">
		<div class="container">
			<div class="row container p-2">

				<div class="col-md-4" style="font-size:20px"><span class="meetDetails py-2 fw-bold">Meeting Title: </span><?= @$meeting_data['data'][0]['refDataName']; ?></div>
				<div class="col-md-4" style="font-size:20px"><span class="meetDetails py-2 fw-bold">Organizer: </span><?= @$meeting_data['data'][0]['refDataName5']; ?></div>
				<div class="col-md-4" style="font-size:20px"><span class="meetDetails py-2 fw-bold">Group: </span><?= @$meeting_data['data'][0]['refDataName1']; ?></div>
				
			</div>
		</div>
	</div>

	<div class="table-responsive">
		<table id="attendanceData" class="table text-start">
			<thead>
				<tr style="background-color: #009688; color: white;">
					<th>Member Name <i class="fa fa-user"></i></th>
					<th>Meeting Notes <i class="fa fa-file"></i></th>
					<th>Action Items</th>
				</tr>
			</thead>
			<tbody>

				<?php if (!empty($meeting_minutes)) {
					$final_res = array_reverse($meeting_minutes[0]['Child Grid']); foreach($final_res as $val){ ?> 
						<tr>
							<td><?= @$val['refDataName'] ?></td>
							<td><?= @$val['Meeting Notes'] ?></td>
							<td><?= @$val['Action Items'] ?>
						</tr>
					<?php }  } ?>
				</tbody>
			</table>
		</div>
	</div>
	<!-- End Main content--> 
	<?php $this->load->view('managements/includes/footer'); ?>
	<script type="text/javascript" src="<?=base_url('assets/js/time-picker.js')?>"></script>
	<script src="<?=base_url('assets/js/jquery-ui.min.js');?>"></script>
	<script>
		$(document).ready(function() {
			$('#attendanceData').DataTable( {
				order: [[ 0, 'desc' ]],
				language: {
					emptyTable: "No Meeting Minutes to Show.."
				}
			});
		} );
	</script>
</body>
</html>
