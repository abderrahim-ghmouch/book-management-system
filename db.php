<?php 

$host="localhost";
$db="demo";
$username="abdo";
$password="abdoabdo";


try{
    $dbase=new PDO ("mysql:host=$host;dbname=$db;charset=utf8",$username,$password);
    echo "connected";
}
catch(PDOException $i)
{
echo "errorin connection";
$i -> getMessage();
}

?>