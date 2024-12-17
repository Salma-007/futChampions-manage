<?php include('dbcon.php') ?>
<?php 

if(isset($_GET['id_player'])){

    $id_player = $_GET['id_player'];

    $querynormal = "select `id_normal_player` from `players` where `id_player` = '$id_player' ";
    // $result_normal = mysqli_query($conn, $querynormal);
    $result_normal = $conn->query($querynormal);

    $row = $result_normal->fetch_assoc();
    $idStats = $row['id_normal_player'];
    // echo  $idStats;
    
    $query = "delete from `players` where `id_player` = '$id_player'";
    $queryclub = "delete from `normal_players` where `id_normal_player` = '$idStats'";

    $result = mysqli_query($conn, $query);
    $resultstats = mysqli_query($conn, $queryclub);

    if(!$result && !$resultstats){
        die("query failed");
    }
    else{
        header('Location: index.php?delete_msg=The player is deleted.');
    }

}
// header('Location: index.php');
  
?>