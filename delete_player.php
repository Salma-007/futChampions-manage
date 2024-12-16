<?php include('dbcon.php') ?>
<?php 

if(isset($_GET['id_player'])){
    $id_player = $_GET['id_player'];

    $query = "delete from `players` where `id_player` = '$id_player'";

    $result = mysqli_query($conn, $query);

    if(!$result){
        die("query failed");
    }
    else{
        header('Location: index.php?delete_msg=The player is deleted.');
    }

}
// header('Location: index.php');
  
?>