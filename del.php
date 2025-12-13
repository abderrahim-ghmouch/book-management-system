<?php

include_once "db.php";
$id=$_POST["id"];
try{

    $statemnet=$dbase->prepare("DELETE from book where id=?");
    $status=$statemnet->execute([$id]);

    if($status){
        echo "deleted from database";
           header("Location: view.php");
           exit();
    }
}
catch(PDOException $e)
{
    echo "erroe in deleting" . $e->getMessage();
}
?>