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
				<a href="index.php" class="logo">
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

					//fetch le nombre of players
					$sql_count = "select count(*), max(rating) from players;";
					$rersult_count = $conn->query($sql_count);
					$row = $rersult_count->fetch_row(); 
    				$num_players = $row[0]; 
					$max_rating = $row[1];

					//fetch le nombre of goalkeepers
					$sql_count_goalkeeper = "select count(*) from players where id_goalkeeper<>0;";
					$rersult_count_gk = $conn->query($sql_count_goalkeeper);
					$rowgk = $rersult_count_gk->fetch_row(); 
    				$num_goalkeepers = $rowgk[0]; 

					//select the name of the top striker
					$sql_top_striker = "select name_player from players where rating = (select max(rating) from players);";
					$resltat_top_striker = $conn->query($sql_top_striker);
					$row_top_striker = $resltat_top_striker->fetch_row();
					$top_striker = $row_top_striker[0];

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
													<p class="card-category">Players</p>
													<h4 class="card-title"><?php echo (int)$num_players;?></h4>
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
													<p class="card-category">Top Rating</p>
													<h4 class="card-title"><?php echo (int)$max_rating;?></h4>
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
													<i class="la la-arrow-up"></i>
												</div>
											</div>
											<div class="col-7 d-flex align-items-center">
												<div class="numbers">
													<p class="card-category">Top Striker</p>
													<h4 class="card-title"><?php echo $top_striker;?></h4>
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
													<i class="la la-road"></i>
												</div>
											</div>
											<div class="col-7 d-flex align-items-center">
												<div class="numbers">
													<p class="card-category">Goalkeepers</p>
													<h4 class="card-title"><?php echo $num_goalkeepers;?></h4>
												</div>
											</div>
										</div>
									</div>
								</div>
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
										// $requete_check="select id_goalkeeper from players";
										$sql = "SELECT p.id_player, p.name_player, n.name AS nationality, c.name AS club, p.rating, p.position,
												r.pace, r.dribbling, r.passing, r.shooting, r.defending, r.physical, 
												g.id_goalkeeper, g.diving, g.handling, g.kicking, g.reflexes, g.speed, g.positioning
												FROM players p
												JOIN nationalities n ON p.id_nationality = n.id_nationality
												JOIN clubs c ON p.id_club = c.id_club
												LEFT JOIN normal_players r ON p.id_normal_player = r.id_normal_player
												LEFT JOIN goalkeepers g ON p.id_goalkeeper = g.id_goalkeeper";

										// Check the database connection
										if ($conn->connect_error) {
											die("Connection failed: " . $conn->connect_error);
										}
										$count = 1;
										if ($result = $conn->query($sql)) {
											if ($result->num_rows > 0) {
												echo '<tbody>';
												while ($row = $result->fetch_assoc()) {
													echo '<tr>';
													echo '<td>' . $count++ . '</td>';
													echo '<td>' . $row['name_player'] . '</td>';
													echo '<td>' . $row['nationality'] . '</td>';
													echo '<td>' . $row['club'] . '</td>';
													echo '<td>' . $row['rating'] . '</td>';
													echo '<td>' . $row['position'] . '</td>';
													if (isset($row['id_goalkeeper']) && $row['id_goalkeeper'] !== NULL) {
														echo '<td>' . $row['diving'] . '</td>';
														echo '<td>' . $row['handling'] . '</td>';
														echo '<td>' . $row['kicking'] . '</td>';
														echo '<td>' . $row['reflexes'] . '</td>';
														echo '<td>' . $row['speed'] . '</td>';
														echo '<td>' . $row['positioning'] . '</td>';
													} else {
														// qsi ce n'est pas un gardien, on affiche les stats des joueurs normaux
														echo '<td>' . $row['pace'] . '</td>';
														echo '<td>' . $row['dribbling'] . '</td>';
														echo '<td>' . $row['passing'] . '</td>';
														echo '<td>' . $row['shooting'] . '</td>';
														echo '<td>' . $row['defending'] . '</td>';
														echo '<td>' . $row['physical'] . '</td>';
													}
													echo '<td><a href="update.php?id_player=' . urlencode($row['id_player']) . '" class="btn btn-primary" >update</a></td>';
													echo '<td><a href="delete_player.php?id_player=' . urlencode($row['id_player']) . '" class="btn btn-danger" onclick="return confirm(\"Do you really want to delete this player?\")">delete</a></td>';

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
				<form action="add_player.php" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label for="name_input">Name: </label>
						<input type="text" class="form-control input-square" id="name_input" name="name_input" placeholder="enter name">
					</div>
					<div class="form-group">
						<label for="photo_input">Photo: </label>
						<!-- <input type="text" class="form-control input-square" id="photo_input" name="photo_input" placeholder="enter url"> -->
						<input type="file" id="photo_input" accept="image/*" class="form-control input-square" name="photo_input">
					</div>
					<div class="form-group">
						<label for="nationalitySelect">Nationality: </label>
						<select class="form-control input-solid" id="nationalitySelect" name="nationalitySelect">
							<?php foreach ($nationalities as $nationality): ?>
								<option value="<?= htmlspecialchars($nationality) ?>"><?= htmlspecialchars($nationality) ?></option>
							<?php endforeach; ?>
						</select>
					</div>	
					<div class="form-group row">
						<div class="col-md-6">
							<label for="pace_input">Club: </label>
							<input type="text" class="form-control input-solid" id="clubSelect" name="clubSelect" placeholder="enter club">
						</div>
						<div class="col-md-6">
							<label for="dribbling_input">logo: </label>
							<input type="file" id="logo_club" accept="image/*" class="form-control input-square" name="logo_club">
						</div>
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

	<script src="./assets/js/script.js?v=<?php echo time(); ?>"></script>
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