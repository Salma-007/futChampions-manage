<?php include('dbcon.php') ?>
<?php 

if(isset($_GET['id_player'])){

    $id_player = $_GET['id_player'];

    $querynormal = "select `id_normal_player` from `players` where `id_player` = '$id_player' ";
    $result_normal = $conn->query($querynormal);
    $row = $result_normal->fetch_assoc();
    $idStats = $row['id_normal_player'];

    $querygoal = "select `id_goalkeeper` from `players` where `id_player` = '$id_player' ";
    $result_goalkeeper = $conn->query($querygoal);
    $rowgoal = $result_goalkeeper->fetch_assoc();
    $idStatsGoalkeeper = $rowgoal['id_goalkeeper'];

    // echo  $idStats;
    if($idStatsGoalkeeper){
        $query = "delete from `players` where `id_player` = '$id_player'";
        $queryclub = "delete from `normal_players` where `id_normal_player` = '$idStatsGoalkeeper'";
        $result = mysqli_query($conn, $query);
        $resultstats = mysqli_query($conn, $queryclub);
    }
    else{
        $query = "delete from `players` where `id_player` = '$id_player'";
        $querygoal = "delete from `normal_players` where `id_normal_player` = '$idStats'";
        $result = mysqli_query($conn, $query);
        $resultstats = mysqli_query($conn, $querygoal);
    }


    if(!$result && !$resultstats){
        die("query failed");
    }
    else{
        header('Location: index.php?delete_msg=The player is deleted.');
    }

}
// header('Location: index.php');
  
?>