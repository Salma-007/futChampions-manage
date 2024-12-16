<?php 

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "fut_champions_db"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_GET['id_player'])){
    $id_player = $_GET['id_player'];

    $query = "delete from `players` where `id_player` = '$id_player'";

    $result = mysqli_query($conn, $query);

    if(!$result){
        die("query failed");
    }
    else{
        header('Location: index.php?delete_msg=The player id deleted.');
    }

}
header('Location: index.php');
  
?>