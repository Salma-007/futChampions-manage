<?php include('dbcon.php') ?>
<?php

    // Get the form data from POST
    $name = $_POST['name_input'];
    $nationality = $_POST['nationalitySelect'];
    $clubName = $_POST['clubSelect']; 

    // $logo = $_POST['logo_club'];
    $rating = $_POST['rating_input'];
    $position = $_POST['positionSelect'];
    $pace = $_POST['pace_input'];
    $dribbling = $_POST['dribbling_input'];
    $passing = $_POST['passing_input'];
    $shooting = $_POST['shooting_input'];
    $defending = $_POST['defending_input'];
    $physical = $_POST['physical_input'];
    
    // photo player upload 
    $photo = $_FILES['photo_input']['name'];
    $photo_tmp = $_FILES['photo_input']['tmp_name'];
    $photo_folder = 'uploads/photos/' . $photo; 
    move_uploaded_file($photo_tmp, $photo_folder);

    // logo image upload
    $logo_club = $_FILES['logo_club']['name'];
    $logo_tmp = $_FILES['logo_club']['tmp_name'];
    $logo_folder = 'uploads/logos/' . $logo_club; 
    move_uploaded_file($logo_tmp, $logo_folder);

    // fetch nationality id 
    $nationality_id_query = "SELECT id_nationality FROM nationalities WHERE name = ?";
    $stmt = $conn->prepare($nationality_id_query);
    $stmt->bind_param("s", $nationality);
    $stmt->execute();
    $stmt->bind_result($nationality_id);
    $stmt->fetch();
    $stmt->close();

    // check if the club already exists
    $checkQuery = "SELECT id_club FROM clubs WHERE name = ?";
    $stmt = mysqli_prepare($conn, $checkQuery);
    mysqli_stmt_bind_param($stmt, "s", $clubName);  
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        mysqli_stmt_bind_result($stmt, $club_id);
        mysqli_stmt_fetch($stmt);
    } 
    else{
        // ajout du club s'il n'existe pas
        $insertQuery = "INSERT INTO clubs (name, logo) VALUES (?, ?)";
        $insertStmt = mysqli_prepare($conn, $insertQuery);
        mysqli_stmt_bind_param($insertStmt, "ss", $clubName, $logo_club);
        mysqli_stmt_execute($insertStmt);

        // Fetch the inserted club's ID
        $club_id = mysqli_insert_id($conn);
    }


    if($position=='GK'){
            // inserting the statistics 
            $insert_stats_query_gk = "INSERT INTO goalkeepers (diving, handling, kicking, reflexes, speed, positioning) 
            VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($insert_stats_query_gk);
            $stmt->bind_param("iiiiii", $pace, $shooting, $passing, $dribbling, $defending, $physical);

            if ($stmt->execute()) {

            $goalkeeper_id = $stmt->insert_id;
            } else {
            echo "Error inserting player statistics: " . $stmt->error;
            exit;
            }
            $stmt->close();
            
            // insertion du joueur
            $insert_player_query = "INSERT INTO players (name_player, photo, id_nationality, id_club, rating, position, id_goalkeeper) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($insert_player_query);
            $stmt->bind_param("ssiiiss", $name, $photo, $nationality_id, $club_id, $rating, $position, $goalkeeper_id);

    }
    else{
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
            
            // insertion du joueur
            $insert_player_query = "INSERT INTO players (name_player, photo, id_nationality, id_club, rating, position, id_normal_player) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($insert_player_query);
            $stmt->bind_param("ssiiiss", $name, $photo, $nationality_id, $club_id, $rating, $position, $normal_player_id);
    }

    if ($stmt->execute()) {
        header("Location: index.php");
    } else {
    echo "Error inserting player information: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

?>