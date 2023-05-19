<?php 
session_start();
if(!isset($_SESSION["login"])){
    header("location: login.php");
}

require 'allFunction.php';
$id = $_GET["id"];
if(deleteTodo($id)> 0 ){
    echo "<script>  
    alert('To do list berhasil dihapus!');
    document.location.href = 'index.php';
  </script>";
}else{
    echo "<script> 
    alert('To do list tidak berhasil dihapus!');
    document.location.href = 'index.php';
  </script>";
}
?>