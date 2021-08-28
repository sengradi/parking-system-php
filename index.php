<!DOCTYPE html>
<html>
	<head>
		<title>Parking Management System</title>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	</head>
	<body>
		<div class="container">
			<h1 style="font-wieght:bold;font-style:italic;">Parking System</h1>
			<hr>
			<?php 
				require 'parking-repository.php';
				$allData = getAll();
			?>

			<form action="" class="form">

			</form>

			<table class="table">
				<thead>
					<tr>
						<th>Plate Number</th>
						<th>Vehicle Type</th>
						<th>Check In</th>
						<th>Check Out</th>
						<th>Parking Fee</th>
						<th>Status</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php
						foreach($allData as $data) {
							echo '<tr>'.
									'<td>' . $data['plate_number'] .'</td>' .
									'<td>' . $data['vehicle_type'] . '</td>' . 
									'<td>' . $data['check_in'] . '</td>' .
									'<td>' . $data['check_out'] . '</td>' .
									'<td>' . $data['parking_fee'] . '</td>' .
									'<td>' . ( ($data['status']=='LEAVE') ? ('<span class="label label-danger">'.$data['status'].'</span>') : ('<span class="label label-info">'.$data['status'].'</span>') ) . '</td>' .
									'<td><a href="parking-form.php?id='. $data['id'] . '">View</a></td>' .
								'</tr>';
						}
					?>
				</tbody>
			</table>

		</div>
		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	</body>
</html>
