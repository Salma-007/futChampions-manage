<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>FUT Dashboard</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
	<link rel="stylesheet" href="assets/css/ready.css">
	<link rel="stylesheet" href="assets/css/demo.css">
</head>
<body>
	<div class="wrapper">
		<div class="main-header">
			<div class="logo-header">
				<a href="index.html" class="logo">
					FUT Champions
				</a>
				<?php include('dbcon.php') ?>
				<?php

					// echo "Connected successfully";
					$sql = "SELECT name FROM nationalities"; 
					$result = $conn->query($sql);

					// Store the nationality names in an array
					$nationalities = [];
					if ($result->num_rows > 0) {					
    					while ($row = $result->fetch_assoc()) {
        					$nationalities[] = $row['name'];
    					}
					} else {					
    					echo "No nationalities found.";
					}

					$sql_club = "SELECT name FROM clubs"; 
					$result_club = $conn->query($sql_club);

					// Store the nationality names in an array
					$clubs = [];
					if ($result_club->num_rows > 0) {					
    					while ($row = $result_club->fetch_assoc()) {
        					$clubs[] = $row['name'];
    					}
					} else {					
    					echo "No clubs found.";
					}
					// $conn->close();
				?>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
			</div>
			
			</div>
			<div class="sidebar">
				<div class="scrollbar-inner sidebar-wrapper">
					
					<ul class="nav">
						<li class="nav-item active">
							<a href="index.php">
								<i class="la la-dashboard"></i>
								<p>Dashboard</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="terrain.php">
								<i class="la la-table"></i>
								<p>Terrain</p>
							</a>
						</li>
						
						
						<li class="nav-item update-pro">
							<button  data-toggle="modal" data-target="#modalUpdate">
								<i class="la la-hand-pointer-o"></i>
								<p>Add a player</p>
							</button>
						</li>
					</ul>
				</div>
			</div>
			<div class="main-panel">
				<div class="content">
					<div class="container-fluid">
						<h4 class="page-title">Dashboard</h4>
						<div class="row">
							<div class="col-md-3">
								<div class="card card-stats card-warning">
									<div class="card-body ">
										<div class="row">
											<div class="col-5">
												<div class="icon-big text-center">
													<i class="la la-users"></i>
												</div>
											</div>
											<div class="col-7 d-flex align-items-center">
												<div class="numbers">
													<p class="card-category">Visitors</p>
													<h4 class="card-title">1,294</h4>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="card card-stats card-success">
									<div class="card-body ">
										<div class="row">
											<div class="col-5">
												<div class="icon-big text-center">
													<i class="la la-bar-chart"></i>
												</div>
											</div>
											<div class="col-7 d-flex align-items-center">
												<div class="numbers">
													<p class="card-category">Sales</p>
													<h4 class="card-title">$ 1,345</h4>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="card card-stats card-danger">
									<div class="card-body">
										<div class="row">
											<div class="col-5">
												<div class="icon-big text-center">
													<i class="la la-newspaper-o"></i>
												</div>
											</div>
											<div class="col-7 d-flex align-items-center">
												<div class="numbers">
													<p class="card-category">Subscribers</p>
													<h4 class="card-title">1303</h4>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="card card-stats card-primary">
									<div class="card-body ">
										<div class="row">
											<div class="col-5">
												<div class="icon-big text-center">
													<i class="la la-check-circle"></i>
												</div>
											</div>
											<div class="col-7 d-flex align-items-center">
												<div class="numbers">
													<p class="card-category">Order</p>
													<h4 class="card-title">576</h4>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
<!-- 							<div class="col-md-3">
								<div class="card card-stats">
									<div class="card-body ">
										<div class="row">
											<div class="col-5">
												<div class="icon-big text-center icon-warning">
													<i class="la la-pie-chart text-warning"></i>
												</div>
											</div>
											<div class="col-7 d-flex align-items-center">
												<div class="numbers">
													<p class="card-category">Number</p>
													<h4 class="card-title">150GB</h4>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="card card-stats">
									<div class="card-body ">
										<div class="row">
											<div class="col-5">
												<div class="icon-big text-center">
													<i class="la la-bar-chart text-success"></i>
												</div>
											</div>
											<div class="col-7 d-flex align-items-center">
												<div class="numbers">
													<p class="card-category">Revenue</p>
													<h4 class="card-title">$ 1,345</h4>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="card card-stats">
									<div class="card-body">
										<div class="row">
											<div class="col-5">
												<div class="icon-big text-center">
													<i class="la la-times-circle-o text-danger"></i>
												</div>
											</div>
											<div class="col-7 d-flex align-items-center">
												<div class="numbers">
													<p class="card-category">Errors</p>
													<h4 class="card-title">23</h4>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="card card-stats">
									<div class="card-body">
										<div class="row">
											<div class="col-5">
												<div class="icon-big text-center">
													<i class="la la-heart-o text-primary"></i>
												</div>
											</div>
											<div class="col-7 d-flex align-items-center">
												<div class="numbers">
													<p class="card-category">Followers</p>
													<h4 class="card-title">+45K</h4>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div> -->
						</div>
						<?php 
						if(isset($_GET['delete_msg'])){
							echo"<h6>".$_GET['delete_msg']."</h6>";
						}
						?>
						<div class="card">
							<div class="card-header">
								<div class="card-title">Players :</div>
							</div>
							<div class="card-body">
								<table class="table table-hover">
									<thead>
										<tr>
											<th scope="col">#</th>
											<th scope="col">Name</th>
											<th scope="col">nationality</th>
											<th scope="col">club</th>
											<th scope="col">rating</th>
											<th scope="col">position</th>
											<th scope="col">pace</th>
											<th scope="col">shooting</th>
											<th scope="col">passing</th>
											<th scope="col">dribbling</th>
											<th scope="col">defending</th>
											<th scope="col">physical</th>
										</tr>
									</thead>
									<?php 
										$sql = "SELECT p.id_player, p.name_player, n.name AS nationality, c.name AS club, p.rating, p.position,
												r.pace, r.dribbling, r.passing, r.shooting, r.defending, r.physical
										FROM players p
										JOIN nationalities n ON p.id_nationality = n.id_nationality
										JOIN clubs c ON p.id_club = c.id_club
										JOIN normal_players r ON p.id_normal_player = r.id_normal_player";

										// Check the database connection
										if ($conn->connect_error) {
											die("Connection failed: " . $conn->connect_error);
										}

										if ($result = $conn->query($sql)) {
											if ($result->num_rows > 0) {
												echo '<tbody>';
												while ($row = $result->fetch_assoc()) {
													echo '<tr>';
													echo '<td>' . $row['id_player'] . '</td>';
													echo '<td>' . $row['name_player'] . '</td>';
													echo '<td>' . $row['nationality'] . '</td>';
													echo '<td>' . $row['club'] . '</td>';
													echo '<td>' . $row['rating'] . '</td>';
													echo '<td>' . $row['position'] . '</td>';
													echo '<td>' . $row['pace'] . '</td>';
													echo '<td>' . $row['dribbling'] . '</td>';
													echo '<td>' . $row['passing'] . '</td>';
													echo '<td>' . $row['shooting'] . '</td>';
													echo '<td>' . $row['defending'] . '</td>';
													echo '<td>' . $row['physical'] . '</td>';
													echo '<td><button class="btn btn-primary" data-toggle="modal" data-target="#modalUpdateplayer" data-id="' . $row['id_player'] . '" data-name="' . $row['name_player'] . '" >update</button></td>';
													echo '<td><a href="delete_player.php?id_player=' . urlencode($row['id_player']) . '" class="btn btn-danger">delete</a></td>';

													echo '</tr>';
												}
												echo '</tbody>';
											} else {
												echo "<tr><td colspan='12'>No players found.</td></tr>";
											}
										} else {
											echo "Error in SQL query: " . $conn->error;
										}
									?>
								</table>
							</div>
						</div>
						
						
					</div>
				</div>

			</div>
		</div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="modalUpdatePro" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header bg-primary">
					<h6 class="modal-title"> Add a Player: </h6>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="add_player.php" method="POST">
					<div class="form-group">
						<label for="name_input">Name: </label>
						<input type="text" class="form-control input-square" id="name_input" name="name_input" placeholder="enter name">
					</div>
					<div class="form-group">
						<label for="photo_input">Photo: </label>
						<input type="text" class="form-control input-square" id="photo_input" name="photo_input" placeholder="enter url">
					</div>
					<div class="form-group">
						<label for="nationalitySelect">Nationality: </label>
						<select class="form-control input-solid" id="nationalitySelect" name="nationalitySelect">
							<?php foreach ($nationalities as $nationality): ?>
								<option value="<?= htmlspecialchars($nationality) ?>"><?= htmlspecialchars($nationality) ?></option>
							<?php endforeach; ?>
						</select>
					</div>	
					<div class="form-group">
						<label for="solidSelect">Club: </label>
						<select class="form-control input-solid" id="clubSelect" name="clubSelect">
							<?php foreach ($clubs as $club): ?>
								<option value="<?= htmlspecialchars($club) ?>"><?= htmlspecialchars($club) ?></option>
							<?php endforeach; ?>
						</select>
					</div>	
					<div class="form-group">
						<label for="rating_input">Rating: </label>
						<input type="text" class="form-control input-square" id="rating_input" name="rating_input" placeholder="1 - 99">
					</div>
					<div class="form-group">
						<label for="positionSelect">Position:</label>
						<select class="form-control input-square" id="positionSelect" name="positionSelect">
							<option value="ST">ST</option>
							<option value="RW">RW</option>
							<option value="LW">LW</option>	
							<option value="CM">CM</option>
							<option value="CB">CB</option>
							<option value="LB">LB</option>
							<option value="RB">RB</option>
							<option value="GK">GK</option>
						</select>
					</div>
					<div class="form-group row">
						<div class="col-md-6">
							<label for="pace_input">Pace: </label>
							<input type="text" class="form-control form-control-sm" id="pace_input" name="pace_input" placeholder="enter rating">
						</div>
						<div class="col-md-6">
							<label for="dribbling_input">Dribbling: </label>
							<input type="text" class="form-control form-control-sm" id="dribbling_input" name="dribbling_input" placeholder="enter rating">
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-6">
							<label for="passing_input">Passing: </label>
							<input type="text" class="form-control form-control-sm" id="passing_input" name="passing_input" placeholder="enter rating">
						</div>
						<div class="col-md-6">
							<label for="shooting_input">Shooting: </label>
							<input type="text" class="form-control form-control-sm" id="shooting_input" name="shooting_input" placeholder="enter rating">
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-6">
							<label for="defending_input">Defending: </label>
							<input type="text" class="form-control form-control-sm" id="defending_input" name="defending_input" placeholder="enter rating">
						</div>
						<div class="col-md-6">
							<label for="physical_input">Physical: </label>
							<input type="text" class="form-control form-control-sm" id="physical_input" name="physical_input" placeholder="enter rating">
						</div>
					</div>

					<div class="modal-footer">
						<button type="submit" class="btn btn-success" >Submit</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="modal fade" id="modalUpdateplayer" tabindex="-1" role="dialog" aria-labelledby="modalUpdatePro" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header bg-primary">
					<h6 class="modal-title"> Update a Player: </h6>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="update_player.php" method="POST">
					<div class="form-group">
					<input type="hidden" id="player_id_input" name="player_id_input">

						<label for="name_input">Name: </label>
						<input type="text" class="form-control input-square" id="name_input" name="name_input" placeholder="enter name">
					</div>
					<div class="form-group">
						<label for="photo_input">Photo: </label>
						<input type="text" class="form-control input-square" id="photo_input" name="photo_input" placeholder="enter url">
					</div>
					<div class="form-group">
						<label for="nationalitySelect">Nationality: </label>
						<select class="form-control input-solid" id="nationalitySelect" name="nationalitySelect">
							<?php foreach ($nationalities as $nationality): ?>
								<option value="<?= htmlspecialchars($nationality) ?>"><?= htmlspecialchars($nationality) ?></option>
							<?php endforeach; ?>
						</select>
					</div>	
					<div class="form-group">
						<label for="solidSelect">Club: </label>
						<select class="form-control input-solid" id="clubSelect" name="clubSelect">
							<?php foreach ($clubs as $club): ?>
								<option value="<?= htmlspecialchars($club) ?>"><?= htmlspecialchars($club) ?></option>
							<?php endforeach; ?>
						</select>
					</div>	
					<div class="form-group">
						<label for="rating_input">Rating: </label>
						<input type="text" class="form-control input-square" id="rating_input" name="rating_input" placeholder="1 - 99">
					</div>
					<div class="form-group">
						<label for="positionSelect">Position:</label>
						<select class="form-control input-square" id="positionSelect" name="positionSelect">
							<option value="ST">ST</option>
							<option value="RW">RW</option>
							<option value="LW">LW</option>	
							<option value="CM">CM</option>
							<option value="CB">CB</option>
							<option value="LB">LB</option>
							<option value="RB">RB</option>
							<option value="GK">GK</option>
						</select>
					</div>
					<div class="form-group row">
						<div class="col-md-6">
							<label for="pace_input">Pace: </label>
							<input type="text" class="form-control form-control-sm" id="pace_input" name="pace_input" placeholder="enter rating">
						</div>
						<div class="col-md-6">
							<label for="dribbling_input">Dribbling: </label>
							<input type="text" class="form-control form-control-sm" id="dribbling_input" name="dribbling_input" placeholder="enter rating">
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-6">
							<label for="passing_input">Passing: </label>
							<input type="text" class="form-control form-control-sm" id="passing_input" name="passing_input" placeholder="enter rating">
						</div>
						<div class="col-md-6">
							<label for="shooting_input">Shooting: </label>
							<input type="text" class="form-control form-control-sm" id="shooting_input" name="shooting_input" placeholder="enter rating">
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-6">
							<label for="defending_input">Defending: </label>
							<input type="text" class="form-control form-control-sm" id="defending_input" name="defending_input" placeholder="enter rating">
						</div>
						<div class="col-md-6">
							<label for="physical_input">Physical: </label>
							<input type="text" class="form-control form-control-sm" id="physical_input" name="physical_input" placeholder="enter rating">
						</div>
					</div>

					<div class="modal-footer">
						<button type="submit" class="btn btn-success" >update</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					</div>
				</form>
			</div>
		</div>
	</div>

<script>
	$(document).ready(function() {
    $('#modalUpdateplayer').on('show.bs.modal', function(event) {
		console.log("salmaaa"); 
        var button = $(event.relatedTarget); 
        var playerId = button.data('id'); 
        var name = button.data('name');  
		console.log('Player Name:', name); 

        $('#name_input').val(name);
        $('#player_id_input').val(playerId);
    });
});


</script>
</body>
<script src="assets/js/core/jquery.3.2.1.min.js"></script>
<script src="assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="assets/js/core/popper.min.js"></script>
<script src="assets/js/core/bootstrap.min.js"></script>
<script src="assets/js/plugin/chartist/chartist.min.js"></script>
<script src="assets/js/plugin/chartist/plugin/chartist-plugin-tooltip.min.js"></script>
<script src="assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
<script src="assets/js/plugin/jquery-mapael/jquery.mapael.min.js"></script>
<script src="assets/js/plugin/jquery-mapael/maps/world_countries.min.js"></script>
<script src="assets/js/plugin/chart-circle/circles.min.js"></script>
<script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script src="assets/js/ready.min.js"></script>
<script src="assets/js/demo.js"></script>
</html>