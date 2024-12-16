<?php include('dbcon.php') ?>
<?php

    // Get the form data from POST
    $name = $_POST['name_input'];
    // $photo_url = $_POST['photo_input'];
    $nationality = $_POST['nationalitySelect'];
    $clubName = $_POST['clubSelect']; 
    //image infos----------------------------
    
    if (isset($_FILES["logo_club"])) {
        $imageName = $_FILES["logo_club"]["name"];
        $imageTmpName = $_FILES["logo_club"]["tmp_name"];
        $imageSize = $_FILES["logo_club"]["size"];
        $imageError = $_FILES["logo_club"]["error"];
    } else {
        echo "Logo du club non téléchargé.";
        exit;
    }
    
    if (isset($_FILES["photo_input"])) {
        $imageNamephoto = $_FILES["photo_input"]["name"];
        $imageTmpNamephoto = $_FILES["photo_input"]["tmp_name"];
        $imageSizephoto = $_FILES["photo_input"]["size"];
        $imageErrorphoto = $_FILES["photo_input"]["error"];
    } else {
        echo "Photo du joueur non téléchargée.";
        exit;
    }

    

    //---------------------------
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
    // $club_id_query = "SELECT id_club FROM clubs WHERE name = ?";
    // $stmt = $conn->prepare($club_id_query);
    // $stmt->bind_param("s", $club);
    // $stmt->execute();
    // $stmt->bind_result($club_id);
    // $stmt->fetch();
    // $stmt->close();



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
        $imageData = file_get_contents($imageTmpName);
        $insertQuery = "INSERT INTO clubs (name, logo) VALUES (?, ?)";
        $insertStmt = mysqli_prepare($conn, $insertQuery);
        mysqli_stmt_bind_param($insertStmt, "sb", $clubName, $imageData);
        mysqli_stmt_execute($insertStmt);

        // Fetch the inserted club's ID
        $club_id = mysqli_insert_id($conn);
    }


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

    $imageDataphoto = file_get_contents($imageTmpNamephoto);
    $insert_player_query = "INSERT INTO players (name_player, photo, id_nationality, id_club, rating, position, id_normal_player) 
    VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insert_player_query);
    $stmt->bind_param("ssiiiss", $name, $imageDataphoto, $nationality_id, $club_id, $rating, $position, $normal_player_id);

    if ($stmt->execute()) {
        header("Location: index.php");
    } else {
    echo "Error inserting player information: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

?>