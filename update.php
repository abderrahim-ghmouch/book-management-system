<?php
include_once "db.php";


$id = $_POST["id"];
$title = $_POST["title"]; 
$author = $_POST["author"];
$published = $_POST["published"];
$is_read = isset($_POST["is_read"]) ? 1 : 0; 

try {
   $statement = $dbase->prepare("UPDATE book SET book=?, author=?, published=?, isRead=? WHERE id=?"); 
  $status = $statement->execute([$title, $author, $published, $is_read, $id]);
 
    if($status) {
   header("Location: view.php");
     
        exit(); 
    } else {
        echo "Update failed!";
    }
    
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>