<?php $this->load->view('managements/includes/head'); ?>
<?php $this->load->view('managements/includes/sidebar'); ?>
<?php $this->load->view('managements/includes/topbar'); ?>
<!-- Main content-->
<div class="container my-3">
	<?php  $attendance_data = json_decode(json_encode($attendance_data), true)['data'];  

	// print_r($meeting_data);
	?>
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
					<th>Email <i class="fa fa-envelope"></i></th>
					<th>Phone <i class="fa fa-phone"></i></th>
					<th>Time In <i class="fa fa-clock-o"></i></th>
					<th>Time Out <i class="fa fa-clock-o"></i></th>
					<th>Attendance <i class="fa fa-check"></i></th>
				</tr>
			</thead>
			<tbody>

				<?php if (!empty($attendance_data)) {
					$final_res = array_reverse($attendance_data[0]['Child Grid']); foreach($final_res as $val){ ?> 
						<tr>
							<td><?= @$val['refDataName'] ?></td>
							<td><?= @$val['Email'] ?></td>
							<td><?= formatPhoneNumber(@$val['phone']) ?></td>
							<td><?= @$val['timeIn'] ?></td>
							<td><?= @$val['timeOut'] ?></td>
							<td><?= @$val['attendance'] ?></td>
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
					emptyTable: "No Attendance Available to Show.."
				}
			});
		} );
	</script>
</body>
</html>
