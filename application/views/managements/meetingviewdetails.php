<?php $this->load->view('managements/includes/head'); ?>
<?php $this->load->view('managements/includes/sidebar'); ?>
<?php $this->load->view('managements/includes/topbar'); ?>
<style type="text/css">
	* {
		font-family: sans-serif;
	}
	.photo-container {
		font-size: 1.5em;
		background-color: #2c3e52;
		color: white;
		padding: 20px;
		text-align: center;
		grid-area: photo;
		display: flex;
		justify-content: center;
		align-items: center;
	}
	.card-container {
		margin: 10px;
		display: grid;
		grid-template-areas: 'photo info';
		grid-template-columns: 150px 1fr;
		width: 50%;
		background-color: #fffad2;
		box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
		line-height: 1.75em;
	}
	.info-container {
		padding: 20px;
		grid-area: info;
	}
	.event-name {
		font-weight: bold;
		padding-bottom: 5px;
	}
	.event-location {
		font-weight: 300;
	}
	.day {
		font-weight: 300;
	}
	.month {
		font-weight: 600;
	}

	@media( max-width: 600px ) {
		.card-container {
			width: 100%;
		}
	}

	.btn-outline-danger{
		color: #dc3545;
		border-color: #dc3545;
		border: 2px solid;
		font-size: 16px;
	}
</style>
<?php foreach($meeting_data as $key => $item){ ?> 

	
	<div class="card-container mx-3  mt-3">
		<div class="photo-container">
			<div class="date">
				<div class="day"><?php
				$dateString = $item->meetingDate;
				$timestamp = strtotime($dateString);
				$date = date("jS", $timestamp);
				$year = date("Y", $timestamp);
				$month = date("M", $timestamp);
				echo $date;

			?></div>
			<div class="month"><?= $month; ?></div>
		</div>
		<div class="image"></div>
	</div>
	<div class="info-container">
		<div class="event-name">
			<?= camelCase($item->refDataName); ?>
		</div>
		<div class="event-location">
			Subject: <?= $item->meetingPurpose; ?>
		</div>
		<div class="event-time">
			Timings: <?= $item->meetingTime; ?>
		</div>

		<div class="event-location">
			Location: <?= camelCase($item->meetingLocation); ?>
		</div>

		<div class="event-time fw-bold">
			<?= camelCase($item->meetingCoordinator).($item->meetingMember ? '('.camelCase($item->meetingMember).')' : ''); ?>
		</div>


		<div class="event-link fw-bold mt-3">
			<a href="<?= $item->meetingUrl; ?>" class="btn btn-outline-danger" target="_blank">JOIN MEETING</a>
		</div>


	</div>
</div>

<?php } ?>

<?php $this->load->view('managements/includes/footer'); ?>
<script>
	$(document).ready(function() {
		$("#heading").text('Meeting Details');
		$('#MeetingsViewDetails').DataTable( {
			order: [[ 0, 'desc' ]]
		} );
	} );
</script>
</body>
</html>
