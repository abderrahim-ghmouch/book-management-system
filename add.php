<?php 

include_once "db.php";
$book=$_POST["title"];
$author=$_POST["author"];
$published=$_POST["published"];
$is_read = isset($_POST["is_read"]) ? 1 : 0; 

try {
    $statement = $dbase->prepare("INSERT INTO book(book, author, published, isRead) VALUES (?, ?, ?, ?)");
    
    $statu=$statement->execute([$book,$author,$published,$is_read]);
    
    header("location:/index.php");

}catch(PDOException $e){
    echo "error in inserting" .$e->getMessage();
}   