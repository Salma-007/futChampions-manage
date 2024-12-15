<?php

	$servername = "localhost"; 
	$username = "root"; 
	$password = ""; 
	$dbname = "fut_champions_db"; 

	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

    // Get the form data from POST
    $name = $_POST['name_input'];
    $photo_url = $_POST['photo_input'];
    $nationality = $_POST['nationalitySelect'];
    $club = $_POST['clubSelect']; 
    $rating = $_POST['rating_input'];
    $position = $_POST['positionSelect'];
    $pace = $_POST['pace_input'];
    $dribbling = $_POST['dribbling_input'];
    $passing = $_POST['passing_input'];
    $shooting = $_POST['shooting_input'];
    $defending = $_POST['defending_input'];
    $physical = $_POST['physical_input'];

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
    $stmt->bind_param("s", $club);
    $stmt->execute();
    $stmt->bind_result($club_id);
    $stmt->fetch();
    $stmt->close();

    // inserting the statistics 
    $insert_stats_query = "INSERT INTO normal_players (pace, shooting, passing, dribbling, defending, physical) 
    VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insert_stats_query);
    $stmt->bind_param("iiiiii", $pace, $shooting, $passing, $dribbling, $defending, $physical);

    if ($stmt->execute()) {

    $normal_player_id = $stmt->insert_id;
    } else {
    echo "Error inserting player statistics: " . $stmt->error;
    exit;
    }

    $stmt->close();


    $insert_player_query = "INSERT INTO players (name_player, photo, id_nationality, id_club, rating, position, id_normal_player) 
    VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insert_player_query);
    $stmt->bind_param("ssiiiss", $name, $photo_url, $nationality_id, $club_id, $rating, $position, $normal_player_id);

    if ($stmt->execute()) {
        header("Location: index.php");
    } else {
    echo "Error inserting player information: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

?>