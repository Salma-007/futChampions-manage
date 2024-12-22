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
    <link rel="stylesheet" href="assets/css/style.css">
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

                    // Store the club names in an array
					$sql = "SELECT name FROM clubs"; 
					$result = $conn->query($sql);

					
					$clubs = [];
					if ($result->num_rows > 0) {					
    					while ($row = $result->fetch_assoc()) {
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
						

					</ul>
				</div>
			</div>
			<div class="main-panel">
				<div class="content">
					<div class="container-fluid">
                        <?php 
                            if(!empty($_GET['id_player'])){
                                $id_player = $_GET['id_player'];

                                //fetch les infos du club
                                $query = "select * from players where id_player = '$id_player'" ;
                                $result = $conn->query($query);
                                $row = $result->fetch_assoc();
                                // fetch statistics
                                $statistics = $row['id_normal_player'];
                                $queryclub = "select * from normal_players where id_normal_player = '$statistics'";
                                $resultclub = $conn->query($queryclub);
                                $rowstates = $resultclub->fetch_assoc();

                                // fetch statistics goalkeeper
                                $statistics_goalkeeper = $row['id_goalkeeper'];
                                $query_goalkeeper = "select * from goalkeepers where id_goalkeeper = '$statistics_goalkeeper'";
                                $resultgoalkeeper = $conn->query($query_goalkeeper);
                                $rowstates_goalkeeper = $resultgoalkeeper->fetch_assoc();

                                //fetch club
                                $clubsid = $row['id_club'];
                                $queryidclub = "select name from clubs where id_club = $clubsid";
                                $resultatclub = $conn->query($queryidclub);
                                $rowclub = $resultatclub->fetch_assoc();

                                //fetch club
                                $nationalid = $row['id_nationality'];
                                $queryidnatio = "select name from nationalities where id_nationality = $nationalid";
                                $resultatnation = $conn->query($queryidnatio);
                                $rownationality = $resultatnation->fetch_assoc();

                                // print_r ($rownationality);

                                

                            }
                        ?>
                        <?php 
                            // update function
                            
                            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                                $id_player = $_POST['id'];
                                $name = $_POST['name_input'];
                                $nationality = $_POST['nationalitySelect'];
                                $clubName = $_POST['clubSelect']; 
                                $rating = $_POST['rating_input'];
                                $position = $_POST['positionSelect'];

                                //fetch states
                                $pace = $_POST['pace_input'];
                                $dribbling = $_POST['dribbling_input'];
                                $passing = $_POST['passing_input'];
                                $shooting = $_POST['shooting_input'];
                                $defending = $_POST['defending_input'];
                                $physical = $_POST['physical_input'];

                                // check if the photo is uploaded
                                if ($_FILES["photo_input"]["size"] > 0 ) {
                                    $photo = $_FILES['photo_input']['name'];
                                    $photo_tmp = $_FILES['photo_input']['tmp_name'];
                                    $photo_folder = 'uploads/photos/' . $photo; 
                                    move_uploaded_file($photo_tmp, $photo_folder);
                                    $sql_photo = "UPDATE players SET photo = ? WHERE id_player = ?";
                                    $stmt = $conn->prepare($sql_photo);                            
                                    if ($stmt === false) {
                                        echo "Error preparing the SQL statement: " . $conn->error;
                                        exit;
                                    }
                                    $stmt->bind_param("si", $photo, $id_player); 
                                    if ($stmt->execute()) {
                                        echo "Photo updated successfully.";
                                    } else {
                                        echo "Error executing SQL query: " . $stmt->error;
                                    }                            
                                    $stmt->close();
                                }
                                else {
                                    echo "No file uploaded or the file is empty.";
                                }
                                                                
                                // fetch nationality id 
                                $nationality_id_query = "SELECT id_nationality FROM nationalities WHERE name = ?";
                                $stmt = $conn->prepare($nationality_id_query);
                                $stmt->bind_param("s", $nationality);
                                $stmt->execute();
                                $stmt->bind_result($nationality_id);
                                $stmt->fetch();
                                $stmt->close();

                                // fetch club id 
                                $club_id_query = "SELECT id_club FROM clubs WHERE name = ?";
                                $stmt = $conn->prepare($club_id_query);
                                $stmt->bind_param("s", $clubName);
                                $stmt->execute();
                                $stmt->bind_result($club_id);
                                $stmt->fetch();
                                $stmt->close();

                                
                                // update des statistiques depend de position
                                if($position =='GK'){
                                    $query_id_goalkeeper = "select id_goalkeeper from players where id_player = $id_player";
                                    $resultat_id_goalkeeper = $conn->query($query_id_goalkeeper);
                                    $row_goalkeeper = $resultat_id_goalkeeper->fetch_assoc();
                                    $id_goalkeeper = $row_goalkeeper['id_goalkeeper'];

                                    $insert_stats_query_gk = "update goalkeepers set diving=?, handling=?, kicking=?, reflexes=?, speed=?, positioning=? where id_goalkeeper=?";
                                    $stmt = $conn->prepare($insert_stats_query_gk);
                                    $stmt->bind_param("iiiiiii", $pace, $shooting, $passing, $dribbling, $defending, $physical,$id_goalkeeper);
                                    $stmt->execute();
                        
                                    // if (!$stmt->execute()) {
                                    //     echo "Error inserting player statistics: " . $stmt->error;
                                    //     exit;
                                
                                    // }
                                    $stmt->close();
                                }
                                else{
                                    $query_id_normal = "select id_normal_player from players where id_player = $id_player";
                                    $resultat_id_normal = $conn->query($query_id_normal);
                                    $row_normal = $resultat_id_normal->fetch_assoc();
                                    $id_normal_player = $row_normal['id_normal_player'];

                                    $insert_stats_query_normal = "update normal_players set pace=?, shooting=?, passing=?, dribbling=?, defending=?, physical=? where id_normal_player=?";
                                    $stmt = $conn->prepare($insert_stats_query_normal);
                                    $stmt->bind_param("iiiiiii", $pace, $shooting, $passing, $dribbling, $defending, $physical,$id_normal_player);
                                    $stmt->execute();
                        
                                    // if (!$stmt->execute()) {
                                    //     echo "Error inserting player statistics: " . $stmt->error;
                                    //     exit;
                                
                                    // }
                                    $stmt->close();

                                }
                                
                                $query_update = "UPDATE players SET rating = ?, position = ?, name_player = ?, id_nationality = ?, id_club = ? WHERE id_player = ?";
                                $stmt = $conn->prepare($query_update);
                                $stmt->bind_param("issiis", $rating, $position, $name,$nationality_id ,$club_id, $id_player);
                                $stmt->execute();
                                if ($conn->affected_rows > 0) {
                                    header("Location: index.php");
                                    exit;
                                } else {
                                echo "Error updating name: " . $stmt->error;
                                }
                                header("Location: index.php");
                            }
                        ?>

						<h4 class="page-title">Updating : </h4>
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-primary">
                                <h6 class="modal-title"> Update <?php echo $row['name_player'] ?>: </h6>
                                
                            </div>
                            <form action="update.php" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                <input type="hidden" name="id" value="<?php echo $_GET['id_player']; ?>">
                                    <label for="name_input">Name: </label>
                                    <input type="text" class="form-control input-square" id="name_input" name="name_input" placeholder="enter name" value='<?php echo $row['name_player'] ?>' >
                                </div>
                               
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="passing_input">photo: </label>
                                        <input type="file" id="photo_input" accept="image/*" class="form-control input-square" name="photo_input">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="shooting_input">preview: </label>
                                        <img src="uploads/photos/<?php echo $row['photo'] ?>" id="photo_player" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nationalitySelect">Nationality: </label>
                                    <select class="form-control input-solid" id="nationalitySelect" name="nationalitySelect">
                                        <?php foreach ($nationalities as $nationality): ?>
                                            <?php if ($nationality == $rownationality['name']) { ?>
                                                <option value="<?= htmlspecialchars($nationality) ?>" selected><?= htmlspecialchars($nationality) ?></option>
                                            <?php } else { ?>
                                                <option value="<?= htmlspecialchars($nationality) ?>"><?= htmlspecialchars($nationality) ?></option>
                                            <?php } ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>	
                                <div class="form-group">
                                    <label for="clubSelect">Club: </label>
                                    <select class="form-control input-solid" id="clubSelect" name="clubSelect">
                                        <?php foreach ($clubs as $club): ?>
                                            <?php if ($club == $rowclub['name']) { ?>
                                                <option value="<?= htmlspecialchars($club) ?>" selected><?= htmlspecialchars($club) ?></option>
                                            <?php } else { ?>
                                                <option value="<?= htmlspecialchars($club) ?>"><?= htmlspecialchars($club) ?></option>
                                            <?php } ?>
                                        <?php endforeach; ?>
                                    </select>

                                </div>	
                                <div class="form-group">
                                    <label for="rating_input">Rating: </label>
                                    <input type="text" class="form-control input-square" id="rating_input" name="rating_input" placeholder="1 - 99" value=<?php echo $row['rating'] ?>>
                                </div>
                                <?php 
                                    if ($row['position'] == 'GK') {

                                        echo '<div class="form-group">';
                                        echo '<label for="positionSelect">Position:</label>';
                                        echo '<select class="form-control input-square" id="positionSelect" name="positionSelect" disabled>';
                                        echo '<option value="ST" ' . ($row['position'] == 'ST' ? 'selected' : '') . '>ST</option>';
                                        echo '<option value="RW" ' . ($row['position'] == 'RW' ? 'selected' : '') . '>RW</option>';
                                        echo '<option value="LW" ' . ($row['position'] == 'LW' ? 'selected' : '') . '>LW</option>';
                                        echo '<option value="CM" ' . ($row['position'] == 'CM' ? 'selected' : '') . '>CM</option>';
                                        echo '<option value="CB" ' . ($row['position'] == 'CB' ? 'selected' : '') . '>CB</option>';
                                        echo '<option value="LB" ' . ($row['position'] == 'LB' ? 'selected' : '') . '>LB</option>';
                                        echo '<option value="RB" ' . ($row['position'] == 'RB' ? 'selected' : '') . '>RB</option>';
                                        echo '<option value="GK" ' . ($row['position'] == 'GK' ? 'selected' : '') . '>GK</option>';
                                        echo '</select>';
                                        echo '</div>';

                                        echo '<div class="form-group row">';
                                        echo '<div class="col-md-6">';
                                        echo '<label for="pace_input">Diving: </label>';
                                        echo '<input type="text" class="form-control form-control-sm" id="pace_input" name="pace_input" placeholder="enter rating" value="' . $rowstates_goalkeeper['diving'] . '">';
                                        echo '</div>';

                                        echo '<div class="col-md-6">';
                                        echo '<label for="dribbling_input">Handling: </label>';
                                        echo '<input type="text" class="form-control form-control-sm" id="dribbling_input" name="dribbling_input" placeholder="enter rating" value="' . $rowstates_goalkeeper['handling'] . '">';
                                        echo '</div>';
                                        echo '</div>';

                                        echo '<div class="form-group row">';
                                        echo '<div class="col-md-6">';
                                        echo '<label for="passing_input">Kicking: </label>';
                                        echo '<input type="text" class="form-control form-control-sm" id="passing_input" name="passing_input" placeholder="enter rating" value="' . $rowstates_goalkeeper['kicking'] . '">';
                                        echo '</div>';

                                        echo '<div class="col-md-6">';
                                        echo '<label for="shooting_input">Reflexes: </label>';
                                        echo '<input type="text" class="form-control form-control-sm" id="shooting_input" name="shooting_input" placeholder="enter rating" value="' . $rowstates_goalkeeper['reflexes'] . '">';
                                        echo '</div>';
                                        echo '</div>';

                                        echo '<div class="form-group row">';
                                        echo '<div class="col-md-6">';
                                        echo '<label for="defending_input">Speed: </label>';
                                        echo '<input type="text" class="form-control form-control-sm" id="defending_input" name="defending_input" placeholder="enter rating" value="' . $rowstates_goalkeeper['speed'] . '">';
                                        echo '</div>';

                                        echo '<div class="col-md-6">';
                                        echo '<label for="physical_input">Positioning: </label>';
                                        echo '<input type="text" class="form-control form-control-sm" id="physical_input" name="physical_input" placeholder="enter rating" value="' . $rowstates_goalkeeper['positioning'] . '">';
                                        echo '</div>';
                                        echo '</div>';
                                    } 
                                    else {

                                        echo '<div class="form-group">';
                                        echo '<label for="positionSelect">Position:</label>';
                                        echo '<select class="form-control input-square" id="positionSelect" name="positionSelect" >';
                                        echo '<option value="ST" ' . ($row['position'] == 'ST' ? 'selected' : '') . '>ST</option>';
                                        echo '<option value="RW" ' . ($row['position'] == 'RW' ? 'selected' : '') . '>RW</option>';
                                        echo '<option value="LW" ' . ($row['position'] == 'LW' ? 'selected' : '') . '>LW</option>';
                                        echo '<option value="CM" ' . ($row['position'] == 'CM' ? 'selected' : '') . '>CM</option>';
                                        echo '<option value="CB" ' . ($row['position'] == 'CB' ? 'selected' : '') . '>CB</option>';
                                        echo '<option value="LB" ' . ($row['position'] == 'LB' ? 'selected' : '') . '>LB</option>';
                                        echo '<option value="RB" ' . ($row['position'] == 'RB' ? 'selected' : '') . '>RB</option>';
                                        echo '<option disabled value="GK" ' . ($row['position'] == 'GK' ? 'selected' : '') . '>GK</option>';
                                        echo '</select>';
                                        echo '</div>';

                                        echo '<div class="form-group row">';
                                        echo '<div class="col-md-6">';
                                        echo '<label for="pace_input">Pace: </label>';
                                        echo '<input type="text" class="form-control form-control-sm" id="pace_input" name="pace_input" placeholder="enter rating" value="' . $rowstates['pace'] . '">';
                                        echo '</div>';

                                        echo '<div class="col-md-6">';
                                        echo '<label for="dribbling_input">Dribbling: </label>';
                                        echo '<input type="text" class="form-control form-control-sm" id="dribbling_input" name="dribbling_input" placeholder="enter rating" value="' . $rowstates['dribbling'] . '">';
                                        echo '</div>';
                                        echo '</div>';

                                        echo '<div class="form-group row">';
                                        echo '<div class="col-md-6">';
                                        echo '<label for="passing_input">Passing: </label>';
                                        echo '<input type="text" class="form-control form-control-sm" id="passing_input" name="passing_input" placeholder="enter rating" value="' . $rowstates['passing'] . '">';
                                        echo '</div>';

                                        echo '<div class="col-md-6">';
                                        echo '<label for="shooting_input">Shooting: </label>';
                                        echo '<input type="text" class="form-control form-control-sm" id="shooting_input" name="shooting_input" placeholder="enter rating" value="' . $rowstates['shooting'] . '">';
                                        echo '</div>';
                                        echo '</div>';

                                        echo '<div class="form-group row">';
                                        echo '<div class="col-md-6">';
                                        echo '<label for="defending_input">Defending: </label>';
                                        echo '<input type="text" class="form-control form-control-sm" id="defending_input" name="defending_input" placeholder="enter rating" value="' . $rowstates['defending'] . '">';
                                        echo '</div>';

                                        echo '<div class="col-md-6">';
                                        echo '<label for="physical_input">Physical: </label>';
                                        echo '<input type="text" class="form-control form-control-sm" id="physical_input" name="physical_input" placeholder="enter rating" value="' . $rowstates['physical'] . '">';
                                        echo '</div>';
                                        echo '</div>';
                                    }
                                ?>

                                <div class="modal-footer">
                                    <button id="formUpdate" type="submit" class="btn btn-success" >update</button>

                                </div>
                            </form>
                        </div>
		            </div>
						
					</div>
				</div>

			</div>
		</div>
	</div>
    
    <!-- <script src="./assets/js/script.js?v="></script> -->
    <script>
        // Fonction de validation du formulaire
		function validateForm() {
            console.log("stop fix")
			// Récupérer les valeurs des champs
			var name = document.getElementById("name_input").value;
			// var photo = document.getElementById("photo_input").files.length;
			var nationality = document.getElementById("nationalitySelect").value;
			var club = document.getElementById("clubSelect").value;
			// var logoClub = document.getElementById("logo_club").files.length;
			var rating = document.getElementById("rating_input").value;
			var position = document.getElementById("positionSelect").value;
			var pace = document.getElementById("pace_input").value;
			var dribbling = document.getElementById("dribbling_input").value;
			var passing = document.getElementById("passing_input").value;
			var shooting = document.getElementById("shooting_input").value;
			var defending = document.getElementById("defending_input").value;
			var physical = document.getElementById("physical_input").value;

			// Vérifier que tous les champs requis sont remplis
			if (name === "") {
				alert("Name is required.");
				return false;
			}

			var nameRegex = /^[a-zA-Z\s]+$/; 
			if (!nameRegex.test(name)) {
				alert("Name must be a valid string !");
				return false;
			}

			
			if (club === "") {
				alert("Club is required.");
				return false;
			}

			

			// rating doit être un nombre entre 1 et 99
			if (rating === "" || isNaN(rating) || rating < 1 || rating > 99) {
				alert("Rating must be a number between 1 and 99.");
				return false;
			}
			
			var ratings = [pace, dribbling, passing, shooting, defending, physical];
			var labels = ["Pace", "Dribbling", "Passing", "Shooting", "Defending", "Physical"];

			for (var i = 0; i < ratings.length; i++) {
				if (ratings[i] === "" || isNaN(ratings[i]) || ratings[i] < 1 || ratings[i] > 100) {
					alert(labels[i] + " must be a number between 1 and 100.");
					return false;
				}
			}
			return true;
		}

		document.querySelector("form").onsubmit = function(event) {
			if (!validateForm()) {
				event.preventDefault(); 
			}
	    };
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