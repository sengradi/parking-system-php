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

				$id = $_GET['id'];

				//var_dump(isset($_POST['_method']) & $_POST['_method'] == 'PUT');
				

				if(isset($_POST['_method']))
					echo update($_POST, $id);

				if($id != null)
					$parkingData = get($id);
				
				$plate_number 	= $id ? $parkingData['plate_number'] 	: "";
				$vehicle_type 	= $id ? $parkingData['vehicle_type'] 	: "";
				$check_in 		= $id ? $parkingData['check_in'] 		: "";
				$check_out 		= $id ? $parkingData['check_out'] 		: "";
				$parking_fee 	= $id ? $parkingData['parking_fee'] 	: "";
				$status 		= $id ? $parkingData['status'] 			: "";
			?>
            <div class="row">
                <div class="col col-sm-6">
			        <a href="index.php">Back to parking list</a>
                </div>
                <div class="col col-sm-6">
			        <a style='color:red;' class="pull-right" href="index.php">Delete record</a>
                </div>
            </div><br><br>

			<form class="form" action="parking-form.php<?php echo '?id='.$id; ?>" method="POST">
				
				<?php if($id){ ?>
				<input name="_method" type="hidden" value="PUT">
				<?php } ?>
				
				<div class="form-group">
					<label for="plate_number">Plate Number</label>
					<input require="true" require class="form-control" type="text" <?php echo  ($parkingData['status'] == 'LEAVE') ? 'readonly' : ''; ?> name="plate_number" value="<?php echo $plate_number; ?>">
				</div>

				<div class="form-group">
					<label for="">Vehicle Type</label>
					<select name="vehicle_type" class="form-control" <?php echo  ($status == 'LEAVE') ? 'readonly disabled' : ''; ?>>
						<option <?php echo  ($vehicle_type == 'CAR') ? 'selected' : ''; ?> value="CAR">CAR</option>
						<option <?php echo  ($vehicle_type == 'MOTOCYCLE') ? 'selected' : ''; ?> value="MOTOCYCLE">MOTOCYCLE</option>
					</select>
				</div>

				<div class="form-group">
					<label for="birthdaytime">Check In</label>
					<input require type="datetime-local" class="form-control" <?php echo  ($status == 'LEAVE') ? 'readonly' : ''; ?> name="check_in" value="<?php echo str_replace(' ', 'T', $check_in); ?>">
				</div>

				<div class="form-group">
					<label for="birthdaytime">Check Out</label>
					<input type="datetime-local" class="form-control" <?php echo  ($status == 'LEAVE') ? 'readonly' : ''; ?> name="check_out" value="<?php echo str_replace(' ', 'T', $check_out); ?>">
				</div>

				<div class="form-group">
					<label for="">Parking Fee</label>
					<input class="form-control" type="text" <?php echo  ($status == 'LEAVE') ? 'readonly' : ''; ?> name="parking_fee" value="<?php echo $parking_fee; ?>">
				</div>

				<div class="form-group">
					<label for="">Status</label>
					<select require name="status" class="form-control" <?php echo  ($status == 'LEAVE') ? 'readonly disabled' : ''; ?>>
						<option <?php echo  ($status == 'IN PARK') ? 'selected' : ''; ?> value="STAY">IN PARK</option>
						<option <?php echo  ($status == 'LEAVE') ? 'selected' : ''; ?> value="LEAVE">LEAVE</option>
					</select>
				</div>

				<?php if($id == null) {?>
					<button class="btn btn-sm btn-info pull-right" type="submit">Submit</button>
				<?php }else { ?>
					<?php if($status != 'LEAVE') { ?>
						<button class="btn btn-sm btn-primary pull-right disable" type="submit">Edit</button>
					<?php } else { ?>
						<h2><span class="label label-lg label-danger">The vehicle has already leaved!</span></h2>
				<?php }

				} ?>

			</form>

		</div>
		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	</body>
</html>
